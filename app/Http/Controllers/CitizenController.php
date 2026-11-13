<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitizenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $citizen = Citizen::with(['passport', 'vehicles', 'skills'])->firstOrCreate(
            ['email' => $user->email],
            ['id' => $user->id, 'name' => $user->name]
        );

        $passport = $citizen->passport;
        $passport_number = $passport ? $passport->passport_number : '';
        $expiry_date = $passport ? $passport->expiry_date : '';
        
        $vehicles = $citizen->vehicles ? $citizen->vehicles->map(function($v) {
            return [
                'id' => $v->id,
                'model' => $v->vehicle_type,
                'plate' => $v->plate_number,
            ];
        })->toArray() : [];

        $skills = $citizen->skills ? $citizen->skills->map(function($s) {
            return [
                'id' => $s->id,
                'name' => $s->name,
            ];
        })->toArray() : [];

        return view('citizens.index', compact('passport_number', 'expiry_date', 'vehicles', 'skills'));
    }
}