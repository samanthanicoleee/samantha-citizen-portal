<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Portal - Login & Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans flex items-center justify-center h-screen m-0 bg-cover bg-center relative" style="background-image: url('https://wallpapers.com/images/hd/tropical-sunset-violet-and-pink-skies-2xdqxwn2rmtirorg.jpg');">

    <div class="absolute inset-0 bg-slate-950/45 backdrop-blur-[2px]"></div>

    <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] flex w-full max-w-4xl overflow-hidden m-4 relative z-10 border border-white/50">
        
        <div class="w-1/2 bg-gradient-to-br from-rose-950/85 to-pink-900/80 backdrop-blur-md text-white p-10 flex-col justify-between hidden md:flex border-r border-white/15">
            <div>
                <div class="inline-flex items-center space-x-2 bg-white/10 px-3 py-1 rounded-full border border-white/20 mb-4">
                    <span class="text-[11px] font-bold uppercase tracking-widest text-rose-100">Official Citizen Portal</span>
                </div>
                <h1 class="text-3xl font-extrabold mt-1 leading-tight tracking-tight">Welcome Back, Citizen!</h1>
                <p class="text-rose-100/90 text-sm mt-3 leading-relaxed">
                    Log in or register to manage your personal records, update your passport, and keep your vehicle and skills profiles organized securely.
                </p>
            </div>

            <div class="space-y-3 my-6">
                <div class="flex items-center space-x-3 bg-white/10 px-4 py-3 rounded-xl border border-white/15 text-sm backdrop-blur-sm">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span class="font-medium">Secure Passport Record & Expiry Tracking</span>
                </div>
                <div class="flex items-center space-x-3 bg-white/10 px-4 py-3 rounded-xl border border-white/15 text-sm backdrop-blur-sm">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span class="font-medium">Registered Vehicles Management</span>
                </div>
                <div class="flex items-center space-x-3 bg-white/10 px-4 py-3 rounded-xl border border-white/15 text-sm backdrop-blur-sm">
                    <span class="text-emerald-400 font-bold">✓</span>
                    <span class="font-medium">Associated Skills Profile</span>
                </div>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center bg-white/60" x-data="{ tab: 'login' }">
            
            <div class="flex border-b border-gray-300/80 mb-6">
                <button @click="tab = 'login'" :class="tab === 'login' ? 'border-rose-700 text-rose-900 font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 font-medium'" class="pb-2.5 px-4 border-b-2 text-sm transition">
                    Login
                </button>
                <button @click="tab = 'signup'" :class="tab === 'signup' ? 'border-rose-700 text-rose-900 font-bold' : 'border-transparent text-gray-500 hover:text-gray-700 font-medium'" class="pb-2.5 px-4 border-b-2 text-sm transition">
                    Sign Up
                </button>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-300 text-emerald-800 px-4 py-2.5 rounded-xl text-xs mb-4 font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-300 text-rose-800 px-4 py-2.5 rounded-xl text-xs mb-4 font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <form x-show="tab === 'login'" action="/login" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Email Address</label>
                    <input type="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-transparent bg-white/90 shadow-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Password</label>
                    <input type="password" name="password" required placeholder="Enter your password" class="w-full px-4 py-3 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-transparent bg-white/90 shadow-sm">
                </div>
                <button type="submit" class="w-full bg-rose-700 hover:bg-rose-800 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-rose-700/25 text-sm mt-2">
                    Log In
                </button>
            </form>

            <form x-show="tab === 'signup'" style="display: none;" action="/register" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter full name" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-transparent bg-white/90 shadow-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter email" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-transparent bg-white/90 shadow-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Password</label>
                    <input type="password" name="password" required placeholder="Create password" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-rose-600 focus:border-transparent bg-white/90 shadow-sm">
                </div>
                <button type="submit" class="w-full bg-rose-700 hover:bg-rose-800 text-white font-bold py-3 rounded-xl transition shadow-lg shadow-rose-700/25 text-sm mt-2">
                    Register Account
                </button>
            </form>

        </div>

    </div>

</body>
</html>