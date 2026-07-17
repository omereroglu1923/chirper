<x-layout>
    <x-slot:title>Home Feed</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        <div class="space-y-4 mt-8">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <p class="mt-4 text-base-content/60">No chirps yet. Be the first to chirp!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>