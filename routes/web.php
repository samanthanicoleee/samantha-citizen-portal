<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Citizen;
use App\Models\Passport;
use App\Models\Vehicle;
use App\Models\Skill;


Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/register', function (Request $request) {
    $inputName = trim($request->input('name'));

    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:users,name',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $firstName = explode(' ', $inputName)[0]; 
    $existingUser = User::where('name', 'LIKE', $firstName . '%')->where('email', '!=', $validated['email'])->exists();

    if ($existingUser) {
        return back()->withErrors(['name' => 'Warning: This citizen or a similar name already exists in the system! Only one account per person is allowed.'])->withInput();
    }

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'citizen', 
    ]);

    Citizen::updateOrCreate(
        ['email' => $user->email],
        [
            'id' => $user->id,
            'name' => $user->name,
            'password' => $user->password,
        ]
    );

    return redirect('/')->with('success', 'Registration successful! You can now login!.');
});


Route::post('/login', function (Request $request) {
    $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        $minutes = ceil($seconds / 60);

        return back()->withErrors([
            'email' => "Too many login attempts. Please wait for {$minutes} minutes before you can try again!.",
        ]);
    }

    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        RateLimiter::clear($throttleKey);
        $request->session()->regenerate();
        
        $user = auth()->user();
        
        Citizen::updateOrCreate(
            ['email' => $user->email],
            [
                'id' => $user->id,
                'name' => $user->name,
                'password' => $user->password,
            ]
        );
        
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/dashboard');
    }

    RateLimiter::hit($throttleKey, 300);

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records. (Limit: 5 attempts)',
    ]);
});


Route::get('/admin/dashboard', function (Request $request) {
    if (!auth()->check() || auth()->user()->role !== 'admin') {
        return redirect('/');
    }

    $citizens = Citizen::with(['passport', 'vehicles', 'skills'])->get();
    
    $allVehicles = [];
    $allSkills = [];

    foreach ($citizens as $citizen) {
        if ($citizen->vehicles) {
            foreach ($citizen->vehicles as $veh) {
                $allVehicles[] = [
                    'owner' => $citizen->name,
                    'model' => $veh->vehicle_type ?? 'N/A',
                    'plate' => $veh->plate_number ?? 'N/A',
                ];
            }
        }

        if ($citizen->skills) {
            foreach ($citizen->skills as $skl) {
                $allSkills[] = [
                    'owner' => $citizen->name,
                    'name' => $skl->name ?? 'N/A',
                ];
            }
        }
    }

    return view('admin.dashboard', [
        'allVehicles' => $allVehicles,
        'allSkills' => $allSkills,
        'citizens' => $citizens
    ]);
});


Route::match(['get', 'post'], '/dashboard', function (Request $request) {
    if (!auth()->check()) {
        return redirect('/');
    }

    $user = auth()->user();

    $citizen = Citizen::updateOrCreate(
        ['email' => $user->email],
        [
            'id' => $user->id,
            'name' => $user->name,
            'password' => $user->password,
        ]
    );

    if ($request->isMethod('post')) {
        
        if ($request->has('delete_vehicle_index')) {
            $vehicleId = $request->input('delete_vehicle_index');
            Vehicle::where('id', $vehicleId)->where('citizen_id', $citizen->id)->delete();
            return redirect('/dashboard')->with('success', 'Vehicle deleted successfully!');
        }

        if ($request->has('delete_skill_index')) {
            $skillId = $request->input('delete_skill_index');
            $citizen->skills()->detach($skillId);
            return redirect('/dashboard')->with('success', 'Skill deleted successfully!');
        }

        if ($request->has('passport_number')) {
            Passport::updateOrCreate(
                ['citizen_id' => $citizen->id],
                [
                    'passport_number' => $request->input('passport_number'),
                    'expiry_date' => $request->input('expiry_date'),
                ]
            );
            return redirect('/dashboard')->with('success', 'Passport saved successfully!');
        }

        if ($request->has('model') || $request->has('plate')) {
            Vehicle::create([
                'citizen_id' => $citizen->id,
                'vehicle_type' => $request->input('model'),
                'plate_number' => $request->input('plate'),
            ]);
            return redirect('/dashboard')->with('success', 'Vehicle added successfully!');
        }

        if ($request->has('skill')) {
            $skillName = trim($request->input('skill'));
            $skill = Skill::firstOrCreate(['name' => $skillName]);
            
            if (!$citizen->skills()->where('skill_id', $skill->id)->exists()) {
                $citizen->skills()->attach($skill->id);
            }

            return redirect('/dashboard')->with('success', 'Skill added successfully!');
        }

        return redirect('/dashboard')->with('success', 'Record saved successfully!');
    }

    $passport = $citizen->passport;

    $vehiclesWithId = $citizen->vehicles ? $citizen->vehicles->map(function($v) {
        return [
            'id' => $v->id,
            'model' => $v->vehicle_type,
            'plate' => $v->plate_number,
        ];
    })->toArray() : [];

    $skillsWithId = $citizen->skills ? $citizen->skills->map(function($s) {
        return [
            'id' => $s->id,
            'name' => $s->name,
        ];
    })->toArray() : [];

    return view('citizens.index', [
        'vehicles' => $vehiclesWithId,
        'skills' => $skillsWithId,
        'passport_number' => $passport ? $passport->passport_number : '',
        'expiry_date' => $passport ? $passport->expiry_date : '', 
    ]);
});


Route::match(['get', 'post'], '/logout', function (Request $request) {
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});