<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Citizen Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-cover bg-center bg-fixed relative text-slate-800" style="background-image: url('https://wallpapers.com/images/hd/pink-sunset-iphone-uum5fb0pu8x859zs.jpg');" x-data="{ currentTab: 'overview' }">

    <div class="absolute inset-0 bg-rose-950/45 backdrop-blur-[3px] fixed pointer-events-none"></div>

    <div class="relative z-10 flex h-screen overflow-hidden w-full">
        
        <aside class="w-72 bg-rose-950/90 backdrop-blur-xl border-r border-white/15 text-white flex flex-col justify-between shadow-2xl flex-shrink-0">
            <div class="p-6">
                <div class="pb-5 border-b border-white/10 mb-6">
                    <h2 class="text-xs font-bold tracking-widest uppercase text-rose-100">ADMIN PORTAL</h2>
                    <p class="text-[11px] text-rose-300 mt-0.5 font-medium">System Management</p>
                </div>

                <nav class="space-y-2">
                    <button @click="currentTab = 'overview'" :class="currentTab === 'overview' ? 'bg-rose-900 text-white font-semibold shadow-inner border border-rose-700/50' : 'text-rose-200 hover:bg-rose-900/60'" class="w-full flex items-center px-4 py-3 text-xs font-medium rounded-2xl transition text-left">
                        <span>System Overview</span>
                    </button>
                    <button @click="currentTab = 'citizens'" :class="currentTab === 'citizens' ? 'bg-rose-900 text-white font-semibold shadow-inner border border-rose-700/50' : 'text-rose-200 hover:bg-rose-900/60'" class="w-full flex items-center px-4 py-3 text-xs font-medium rounded-2xl transition text-left">
                        <span>All Citizens List</span>
                    </button>
                    <button @click="currentTab = 'vehicles'" :class="currentTab === 'vehicles' ? 'bg-rose-900 text-white font-semibold shadow-inner border border-rose-700/50' : 'text-rose-200 hover:bg-rose-900/60'" class="w-full flex items-center px-4 py-3 text-xs font-medium rounded-2xl transition text-left">
                        <span> All Vehicles</span>
                    </button>
                    <button @click="currentTab = 'skills'" :class="currentTab === 'skills' ? 'bg-rose-900 text-white font-semibold shadow-inner border border-rose-700/50' : 'text-rose-200 hover:bg-rose-900/60'" class="w-full flex items-center px-4 py-3 text-xs font-medium rounded-2xl transition text-left">
                        <span>Skills Directory</span>
                    </button>
                </nav>
            </div>

            <div class="p-6 border-t border-white/10">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-3 px-4 rounded-2xl transition text-center shadow-lg shadow-rose-600/30 uppercase tracking-wider">
                        Admin Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-y-auto">
            
            <header class="bg-rose-950/75 backdrop-blur-md border-b border-white/15 px-8 h-20 flex justify-between items-center sticky top-0 z-50 shadow-sm">
                <h1 class="text-sm font-extrabold tracking-widest uppercase text-white" x-text="currentTab.toUpperCase() + ' MANAGEMENT'"></h1>
            </header>

            <main class="flex-1 p-8">
                <div class="max-w-5xl w-full mx-auto space-y-6">

                    <div x-show="currentTab === 'overview'" class="space-y-6">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.2)] p-8 border border-white/60">
                            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Administrator Control Center</h2>
                            <p class="text-slate-500 text-xs mt-1">Welcome, Admin. System statistics are pulled directly from active records.</p>
                        </div>

                       <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-[0_15px_35px_rgba(136,19,55,0.15)] border border-white/60 relative overflow-hidden flex flex-col items-center justify-center text-center">
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-slate-700 to-slate-900"></div>
                <h3 class="font-bold text-slate-400 text-[11px] uppercase tracking-widest">TOTAL CITIZENS</h3>
                <p class="text-4xl font-extrabold text-slate-900 mt-3">{{ \App\Models\User::where('role', 'citizen')->count() }}</p>
                         </div>

    <div class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-[0_15px_35px_rgba(136,19,55,0.15)] border border-white/60 relative overflow-hidden flex flex-col items-center justify-center text-center">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
        <h3 class="font-bold text-slate-400 text-[11px] uppercase tracking-widest">TOTAL VEHICLES</h3>
        <p class="text-4xl font-extrabold text-indigo-950 mt-3">{{ count($allVehicles ?? []) }}</p>
    </div>

    <div class="bg-white/90 backdrop-blur-xl p-6 rounded-3xl shadow-[0_15px_35px_rgba(136,19,55,0.15)] border border-white/60 relative overflow-hidden flex flex-col items-center justify-center text-center">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-pink-500 to-rose-600"></div>
        <h3 class="font-bold text-slate-400 text-[11px] uppercase tracking-widest">TOTAL SKILLS</h3>
        <p class="text-4xl font-extrabold text-pink-950 mt-3">{{ count($allSkills ?? []) }}</p>
    </div>
</div>
                    </div>

                    <div x-show="currentTab === 'citizens'" style="display: none;" class="w-full">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 border border-white/60">
                            <h2 class="text-xl font-extrabold text-slate-900 mb-1">Registered Citizens Directory</h2>
                            <p class="text-slate-500 text-xs mb-6">List of users registered in the portal. Passports are confidential.</p>
                            
                            <div class="overflow-x-auto rounded-2xl border border-rose-100">
                                <table class="w-full text-left text-xs text-slate-600">
                                    <thead class="bg-rose-50/70 text-[11px] uppercase text-rose-900 font-bold tracking-wider">
                                        <tr>
                                            <th class="px-5 py-3.5">Name</th>
                                            <th class="px-5 py-3.5">Email</th>
                                            <th class="px-5 py-3.5">Passport (Confidential)</th>
                                            <th class="px-5 py-3.5">Role</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-rose-100">
                                        @foreach(\App\Models\User::all() as $citizen)
                                        <tr class="hover:bg-rose-50/40 transition">
                                            <td class="px-5 py-4 font-bold text-slate-900">{{ $citizen->name }}</td>
                                            <td class="px-5 py-4 text-slate-600">{{ $citizen->email }}</td>
                                            <td class="px-5 py-4 text-purple-700 font-mono font-semibold">P****🔒 <span class="text-[10px] bg-purple-100 px-2.5 py-1 rounded-full text-purple-800 ml-1 font-bold">Protected</span></td>
                                            <td class="px-5 py-4 uppercase text-[10px] font-extrabold text-rose-600 tracking-wider">{{ $citizen->role ?? 'citizen' }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div x-show="currentTab === 'vehicles'" style="display: none;" class="w-full">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 border border-white/60">
                            <h2 class="text-xl font-extrabold text-slate-900 mb-1">All Registered Vehicles</h2>
                            <p class="text-slate-500 text-xs mb-6">Overview of all vehicles linked to citizens.</p>
                            
                            @if(!empty($allVehicles) && count($allVehicles) > 0)
                                <div class="space-y-3 mt-4">
                                    @foreach($allVehicles as $vehicle)
                                        <div class="bg-white p-5 rounded-2xl border border-rose-200 flex justify-between items-center shadow-sm">
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-xs">{{ $vehicle['model'] }}</h4>
                                                <p class="text-xs text-slate-500 mt-1">Owner: <span class="font-semibold text-slate-700">{{ $vehicle['owner'] }}</span> | Plate Number: <span class="font-mono text-slate-700">{{ $vehicle['plate'] }}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 text-slate-400 text-xs border-2 border-dashed border-rose-200 rounded-2xl bg-white/50">
                                    No vehicles recorded in the system yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <div x-show="currentTab === 'skills'" style="display: none;" class="w-full">
                        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 border border-white/60">
                            <h2 class="text-xl font-extrabold text-slate-900 mb-1">Skills Directory</h2>
                            <p class="text-slate-500 text-xs mb-6">Directory mapping skills across citizen profiles.</p>
                            
                            @if(!empty($allSkills) && count($allSkills) > 0)
                                <div class="space-y-3 mt-4">
                                    @foreach($allSkills as $skill)
                                        <div class="bg-white p-5 rounded-2xl border border-rose-200 flex justify-between items-center shadow-sm">
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-xs">{{ $skill['name'] }}</h4>
                                                <p class="text-xs text-slate-500 mt-1">Owner: <span class="font-semibold text-slate-700">{{ $skill['owner'] }}</span></p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12 text-slate-400 text-xs border-2 border-dashed border-rose-200 rounded-2xl bg-white/50">
                                    No skills mapped in the directory yet.
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </main>

        </div>

    </div>

</body>
</html>