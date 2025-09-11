<div 
    x-data 
    class="relative overflow-hidden group"
>
    <div 
        class="flex gap-6 animate-scroll group-hover:animate-scroll-slow"
    >
        @foreach($scholarships as $scholarship)
            <div class="relative flex-shrink-0 w-72 h-96 rounded-2xl overflow-hidden shadow-lg">
                <!-- Background Image -->
                <img src="{{ $scholarship->image_url }}" 
                     alt="{{ $scholarship->title }}" 
                     class="object-cover w-full h-full">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                
                <!-- Text -->
            <div class="absolute bottom-4 left-4 right-4 text-white text-lg font-bold">
                    {{ $scholarship->title }}
                </div>
            </div>
        @endforeach
    </div>
</div>

