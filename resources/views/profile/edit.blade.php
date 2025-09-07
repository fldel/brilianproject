<x-app-layout>
<!-- Container scrollable -->
    <div class="relative min-h-screen overflow-y-auto">
        
        <!-- Background Video -->
        <div class="relative h-[450px] flex items-center justify-center">
            <video autoplay muted loop playsinline 
                class="absolute inset-0 object-cover w-full h-full">
                <source src="/videos/bgvidprofile.mp4" type="video/mp4">
            </video>

            <!-- Overlay hitam transparan -->
            <div class="absolute inset-0 bg-black/60"></div>

            <!-- Judul Tengah -->
            <h1 class="relative z-10 text-[200px] font-cave leading-[0.7] text-center text-white drop-shadow-lg">
                {{ Auth::user()->name }}
            </h1>

            <!-- Gradient putih di bawah video -->
            <div class="absolute bottom-0 w-full h-16 bg-gradient-to-b from-transparent to-white"></div>
        </div>
        
        <!-- Konten Halaman -->
    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
            </div>
            </div>
    </div>
    </div>
</x-app-layout>
