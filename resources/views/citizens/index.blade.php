<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citizen Portal - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-cover bg-center bg-fixed relative text-slate-800" style="background-image: url('https://wallpapers.com/images/hd/pink-sunset-iphone-uum5fb0pu8x859zs.jpg');" x-data="{ 
    currentTab: 'dashboard', 
    showAddVehicle: false, 
    showAddSkill: false,
    travelIndex: 0,
    travelImages: [
        { url: 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1400&q=80', title: 'Switzerland Alps', desc: 'Global Travel - Switzerland Destination' },
        { url: 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1400&q=80', title: 'Paris, France', desc: 'Global Travel - Paris Destination' },
        { url: 'https://images.unsplash.com/photo-1506973035872-a4ec16b8e8d9?auto=format&fit=crop&w=1400&q=80', title: 'Hong Kong Skyline', desc: 'Global Travel - Hong Kong Destination' }
    ],
    vehicleIndex: 0,
    vehicleImages: [
        { url: 'https://uncrate.com/p/2023/05/ford-ranger-raptor-1.jpg', title: 'Ford Ranger Raptor', desc: 'Rugged performance pickup truck' },
        { url: 'https://i.gaw.to/vehicles/photos/40/34/403433-2024-honda-civic.jpg', title: 'Honda Civic', desc: 'Sleek and popular modern sedan' },
        { url: 'https://imgcdn.zigwheels.ph/large/gallery/exterior/30/1943/toyota-vios-front-side-view-752875.jpg', title: 'Toyota Vios', desc: 'Standard trusted vehicle unit nationwide' }
    ],
    skillIndex: 0,
    skillImages: [
        { url: 'https://wondefull.com/wp-content/uploads/2023/08/5-Reasons-Why-You-Should-Switch-To-Digital-Planning-Now.png', title: 'Digital Planning & Management', desc: 'Professional organizational competency' },
        { url: 'https://pageone.zyndk8.com/wp-content/uploads/2024/02/Culinary-Arts-4.jpg', title: 'Culinary Arts & Professional Cooking', desc: 'Specialized kitchen and culinary competency' },
        { url: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80', title: 'Software Development & Coding', desc: 'Technical programming and system design' }
    ]
}">

    <div class="absolute inset-0 bg-rose-950/45 backdrop-blur-[3px] fixed pointer-events-none"></div>

    <div class="relative z-10 flex flex-col min-h-screen">

  
        <header class="bg-rose-950/75 backdrop-blur-md text-white shadow-lg sticky top-0 z-50 border-b border-white/15">
            <div class="max-w-7xl mx-auto px-6 h-16 grid grid-cols-3 items-center">
                
            
                <div class="flex items-center justify-start">
                    <span class="text-xs font-bold tracking-widest uppercase text-rose-100">CITIZEN PORTAL</span>
                </div>

                <nav class="hidden md:flex items-center justify-center gap-1.5">
                    <button @click="currentTab = 'dashboard'" :class="currentTab === 'dashboard' ? 'bg-rose-900 text-white font-semibold shadow-inner' : 'text-rose-200 hover:bg-rose-900/60'" class="px-3.5 py-1.5 rounded-full text-xs transition">
                        Dashboard
                    </button>
                    <button @click="currentTab = 'passport'" :class="currentTab === 'passport' ? 'bg-rose-900 text-white font-semibold shadow-inner' : 'text-rose-200 hover:bg-rose-900/60'" class="px-3.5 py-1.5 rounded-full text-xs transition">
                        Passport Record
                    </button>
                    <button @click="currentTab = 'vehicles'" :class="currentTab === 'vehicles' ? 'bg-rose-900 text-white font-semibold shadow-inner' : 'text-rose-200 hover:bg-rose-900/60'" class="px-3.5 py-1.5 rounded-full text-xs transition">
                        Registered Vehicles
                    </button>
                    <button @click="currentTab = 'skills'" :class="currentTab === 'skills' ? 'bg-rose-900 text-white font-semibold shadow-inner' : 'text-rose-200 hover:bg-rose-900/60'" class="px-3.5 py-1.5 rounded-full text-xs transition">
                        Skills Directory
                    </button>
                </nav>

              
                <div class="flex items-center justify-end gap-3">
                    <div class="text-xs font-medium bg-rose-900/60 border border-rose-700/50 px-4 py-1.5 rounded-full text-rose-100 backdrop-blur-sm">
                        {{ auth()->user()->name ?? 'Samantha Nicole Mata' }}
                    </div>
                    
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold px-4 py-1.5 rounded-full transition shadow-md">
                            Logout
                        </button>
                    </form>
                </div>

            </div>
        </header>

       
        <main class="flex-1 max-w-7xl w-full mx-auto p-8 space-y-8">

            @if(session('success'))
    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, 3000)" 
         x-show="show" 
         x-transition.duration.500ms
         class="bg-emerald-500/90 backdrop-blur-md border border-emerald-300 text-white px-5 py-3.5 rounded-2xl text-xs font-semibold mb-6 shadow-lg flex items-center justify-between">
        <span> {{ session('success') }}</span>
    </div>
@endif

            <div x-show="currentTab === 'dashboard'" class="space-y-6">
                
              
                <div class="bg-white/85 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.2)] border border-white/60 overflow-hidden relative group">
                    <div class="h-64 md:h-80 w-full relative overflow-hidden">
                        <img :src="travelImages[travelIndex].url" alt="Travel Banner" class="w-full h-full object-cover transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-rose-950/80 via-rose-950/30 to-transparent pointer-events-none"></div>
                        
                        <button @click.stop="travelIndex = (travelIndex === 0) ? travelImages.length - 1 : travelIndex - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2.5 rounded-full transition z-30">&larr;</button>
                        <button @click.stop="travelIndex = (travelIndex === travelImages.length - 1) ? 0 : travelIndex + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2.5 rounded-full transition z-30">&rarr;</button>

                        <div @click="currentTab = 'passport'" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-white cursor-pointer z-20">
                            <span class="bg-rose-600 text-white text-[11px] uppercase font-bold tracking-widest px-3.5 py-1 rounded-full mb-2 shadow" x-text="travelImages[travelIndex].title"></span>
                            <h2 class="text-2xl md:text-3xl font-extrabold drop-shadow-md">Passport Record & Global Travel (HK, Paris, Switzerland)</h2>
                            <p class="text-xs md:text-sm text-rose-100 mt-1 font-medium drop-shadow" x-text="travelImages[travelIndex].desc"></p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="bg-white/85 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.2)] border border-white/60 overflow-hidden relative group">
                        <div class="h-56 w-full relative overflow-hidden">
                            <img :src="vehicleImages[vehicleIndex].url" alt="Vehicle Fleet" class="w-full h-full object-cover transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-rose-950/80 via-rose-950/30 to-transparent pointer-events-none"></div>
                            
                            <button @click.stop="vehicleIndex = (vehicleIndex === 0) ? vehicleImages.length - 1 : vehicleIndex - 1" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2 rounded-full transition z-30">&larr;</button>
                            <button @click.stop="vehicleIndex = (vehicleIndex === vehicleImages.length - 1) ? 0 : vehicleIndex + 1" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2 rounded-full transition z-30">&rarr;</button>

                            <div @click="currentTab = 'vehicles'" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-white cursor-pointer z-20">
                                <span class="bg-rose-700 text-white text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full mb-1.5 shadow" x-text="vehicleImages[vehicleIndex].title"></span>
                                <h3 class="text-xl font-extrabold drop-shadow-md">Registered Vehicles</h3>
                                <p class="text-xs text-rose-100 mt-1 font-medium drop-shadow" x-text="vehicleImages[vehicleIndex].desc"></p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/85 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.2)] border border-white/60 overflow-hidden relative group">
                        <div class="h-56 w-full relative overflow-hidden">
                            <img :src="skillImages[skillIndex].url" alt="Skills Preview" class="w-full h-full object-cover transition duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-rose-950/80 via-rose-950/30 to-transparent pointer-events-none"></div>
                            
                            <button @click.stop="skillIndex = (skillIndex === 0) ? skillImages.length - 1 : skillIndex - 1" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2 rounded-full transition z-30">&larr;</button>
                            <button @click.stop="skillIndex = (skillIndex === skillImages.length - 1) ? 0 : skillIndex + 1" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/60 hover:bg-black text-white p-2 rounded-full transition z-30">&rarr;</button>

                            <div @click="currentTab = 'skills'" class="absolute inset-0 flex flex-col items-center justify-center text-center p-6 text-white cursor-pointer z-20">
                                <span class="bg-pink-600 text-white text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full mb-1.5 shadow" x-text="skillImages[skillIndex].title"></span>
                                <h3 class="text-xl font-extrabold drop-shadow-md">Skills Directory</h3>
                                <p class="text-xs text-rose-100 mt-1 font-medium drop-shadow" x-text="skillImages[skillIndex].desc"></p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div x-show="currentTab === 'passport'" style="display: none;">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 md:p-10 border border-white/60 max-w-2xl mx-auto">
                    <div class="flex items-center justify-between pb-4 mb-6 border-b border-rose-100">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Passport Information</h2>
                            <p class="text-slate-500 text-xs mt-0.5">Secure citizen registry and expiry tracking record.</p>
                        </div>
                        <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-700 text-[11px] font-bold px-3 py-1 rounded-full border border-emerald-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Active Record
                        </span>
                    </div>
                    
                    <div class="bg-rose-50/50 p-6 md:p-8 rounded-2xl border border-rose-100/80 shadow-inner">
                        <form action="/dashboard" method="POST" class="space-y-5" x-data="{ submitted: false }" @submit="submitted = true">
                            @csrf
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Passport Number</label>
                                <div class="relative">
                                    <input type="text" name="passport_number" value="{{ $passport_number ?? '' }}" required placeholder="e.g. P1234567A" class="w-full px-4 py-3.5 border border-rose-200 rounded-xl text-xs bg-white focus:outline-none focus:ring-2 focus:ring-rose-600 shadow-sm font-semibold text-slate-800">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Expiry Date</label>
                                <div class="relative">
                                    <input type="date" name="expiry_date" value="{{ $expiry_date ?? '' }}" required class="w-full px-4 py-3.5 border border-rose-200 rounded-xl text-xs bg-white focus:outline-none focus:ring-2 focus:ring-rose-600 shadow-sm font-medium text-slate-800">
                                </div>
                            </div>
                            <div class="pt-2">
                                <button type="submit" :disabled="submitted" class="w-full bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold py-3.5 rounded-xl transition shadow-lg shadow-rose-600/30 disabled:opacity-50 tracking-wide uppercase">
                                    <span x-show="!submitted">{{ !empty($passport_number) ? 'Update Official Passport' : 'Save Passport Record' }}</span>
                                    <span x-show="submitted" style="display: none;">Saving Changes...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div x-show="currentTab === 'vehicles'" style="display: none;">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 border border-white/60">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900">My Vehicles</h2>
                            <p class="text-slate-500 text-xs">You can add multiple vehicles and delete them when necessary.</p>
                        </div>
                        <button @click="showAddVehicle = !showAddVehicle" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-md shadow-rose-600/20">
                            + Add Vehicle
                        </button>
                    </div>

                    <div x-show="showAddVehicle" style="display: none;" class="bg-rose-50/80 backdrop-blur-sm p-5 rounded-2xl border border-rose-200 mb-6">
                        <h3 class="text-xs font-bold text-rose-900 uppercase mb-3">New Vehicle Form</h3>
                        <form action="/dashboard" method="POST" class="space-y-3" x-data="{ submitted: false }" @submit="submitted = true">
                            @csrf
                            <input type="text" name="model" required placeholder="Vehicle Name / Model (e.g. Ford Ranger Raptor, Honda Civic)" class="w-full px-4 py-2.5 border border-rose-300 rounded-xl text-sm bg-white shadow-sm">
                            <input type="text" name="plate" required placeholder="Plate Number (e.g. ABC-1234)" class="w-full px-4 py-2.5 border border-rose-300 rounded-xl text-sm bg-white shadow-sm">
                            <button type="submit" :disabled="submitted" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl disabled:opacity-50 shadow-md shadow-rose-600/20">
                                <span x-show="!submitted">Save Vehicle</span>
                                <span x-show="submitted" style="display: none;">Saving...</span>
                            </button>
                        </form>
                    </div>

                    @if(!empty($vehicles) && count($vehicles) > 0)
                        <div class="space-y-3 mt-4">
                            @foreach($vehicles as $index => $vehicle)
                                <div class="bg-white p-4 rounded-2xl border border-rose-200 flex justify-between items-center shadow-sm">
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-xs">{{ $vehicle['model'] }}</h4>
                                        <p class="text-xs text-slate-500 font-mono mt-0.5">Plate Number: {{ $vehicle['plate'] }}</p>
                                    </div>
                                    <form action="/dashboard" method="POST">
                                        @csrf
                                        <input type="hidden" name="delete_vehicle_index" value="{{ $vehicle['id'] }}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3.5 py-1.5 rounded-xl transition shadow-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 text-slate-400 text-xs border-2 border-dashed border-rose-200 rounded-2xl bg-white/50">
                            No vehicles added yet. Click "+ Add Vehicle" above.
                        </div>
                    @endif
                </div>
            </div>

            <div x-show="currentTab === 'skills'" style="display: none;">
                <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(136,19,55,0.25)] p-8 border border-white/60">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-xl font-extrabold text-slate-900">Skills</h2>
                            <p class="text-slate-500 text-xs">Type a new skill to add to your profile.</p>
                        </div>
                        <button @click="showAddSkill = !showAddSkill" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition shadow-md shadow-rose-600/20">
                            + Add / Map Skill
                        </button>
                    </div>

                    <div x-show="showAddSkill" style="display: none;" class="bg-rose-50/80 backdrop-blur-sm p-5 rounded-2xl border border-rose-200 mb-6 space-y-4">
                        <div class="pt-2">
                            <h3 class="text-xs font-bold text-rose-900 uppercase mb-2">Add a New Custom Skill</h3>
                            <form action="/dashboard" method="POST" class="flex gap-2" x-data="{ submitted: false }" @submit="submitted = true">
                                @csrf
                                <input type="text" name="skill" required placeholder="Type a new skill (e.g. Digital Planning, Culinary Arts)..." class="w-full px-4 py-2.5 border border-rose-300 rounded-xl text-sm bg-white shadow-sm">
                                <button type="submit" :disabled="submitted" class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl flex-shrink-0 disabled:opacity-50 shadow-md shadow-rose-600/20">
                                    <span x-show="!submitted">Create & Attach</span>
                                    <span x-show="submitted" style="display: none;">Saving...</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    @if(!empty($skills) && count($skills) > 0)
                        <div class="space-y-3 mt-4">
                            @foreach($skills as $index => $skill)
                                <div class="bg-white p-4 rounded-2xl border border-rose-200 flex justify-between items-center shadow-sm">
                                    <div>
                                        <h4 class="font-bold text-slate-800 text-xs">{{ $skill['name'] }}</h4>
                                    </div>
                                    <form action="/dashboard" method="POST">
                                        @csrf
                                        <input type="hidden" name="delete_skill_index" value="{{ $index }}">
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold px-3.5 py-1.5 rounded-xl transition shadow-sm">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 text-slate-400 text-xs border-2 border-dashed border-rose-200 rounded-2xl bg-white/50">
                            No skills chosen yet. Click "+ Add / Map Skill".
                        </div>
                    @endif
                </div>
            </div>

        </main>

        <footer class="bg-rose-950/75 backdrop-blur-md text-rose-200 text-center py-5 text-xs border-t border-white/15 mt-12">
     
        </footer>

    </div>

</body>
</html>