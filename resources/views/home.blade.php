{{-- Bu sayfa layout'u çağırıyor, arasına yazılanlar $slot'a girer --}}
<x-layout>
    {{-- title prop'u: sekme başlığı için layout'a "Home Feed" gönderiliyor --}}
    <x-slot:title>Home Feed</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        <div class="space-y-4 mt-8">
            {{-- Controller'dan gelen $chirps listesinde dön, her biri için kart üret --}}
            @forelse ($chirps as $chirp)
                {{-- Her turda o chirp'i, chirp.blade.php component'ine "chirp" prop'u olarak gönder --}}
                <x-chirp :chirp="$chirp" />
            @empty
                {{-- Liste boşsa (hiç chirp yoksa) gösterilecek durum --}}
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <p class="mt-4 text-base-content/60">No chirps yet. Be the first to chirp!</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>