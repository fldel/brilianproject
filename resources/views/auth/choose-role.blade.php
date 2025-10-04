<x-guest-layout>
    <div class="flex items-center justify-center w-full">
        <div class="w-full max-w-5xl p-4">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <!-- User Card -->
                <div class="rounded-2xl border-2 border-gray-300 bg-[#0C56B3] p-8 flex flex-col items-center justify-between min-h-[520px]">
                    <p class="mb-6 text-white font-cave text-xl text-center">I'm here for find scholarships</p>
                    <img src="{{ asset('img/user.png') }}" alt="User" class="w-48 h-48 object-contain" />
                    <a href="{{ url('/register?role=user') }}" class="mt-8">
                        <x-pixel-button class="px-10 text-white" main-color="#9CA3AF" shadow-color="#6B7280">User</x-pixel-button>
                    </a>
                </div>

                <!-- Admin Card -->
                <div class="rounded-2xl border-2 border-gray-300 bg-[#9FA3FF] p-8 flex flex-col items-center justify-between min-h-[520px]">
                    <p class="mb-6 text-white font-cave text-xl text-center">I'm here for make scholarships</p>
                    <img src="{{ asset('img/admin.png') }}" alt="Admin" class="w-48 h-48 object-contain" />
                    <a href="{{ url('/register?role=admin') }}" class="mt-8">
                        <x-pixel-button class="px-10 text-white" main-color="#0A66C2" shadow-color="#083B73">Admin</x-pixel-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
