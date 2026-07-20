{{-- Bu sayfa layout'u çağırıyor, arasına yazılanlar $slot'a girer --}}
<x-layout>
    {{-- title prop'u: sekme başlığı için layout'a "Home Feed" gönderiliyor --}}
    <x-slot:title>Home Feed</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                {{-- POST ile /chirps route'una gönderilecek, @csrf zorunlu güvenlik token'ı --}}
                <form method="POST" action="/chirps">
                    @csrf
                    <div class="form-control w-full">
                        <textarea name="message" placeholder="What's on your mind?" {{-- Hata varsa kırmızı kenarlık göster (DaisyUI error class'ı) --}}
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror" rows="4"
                            maxlength="255" required {{-- Validation hatasından sonra kullanıcının yazdığını geri getir --}}>{{ old('message') }}</textarea>

                        {{-- message alanına özel hata mesajını göster --}}
                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">Chirp</button>
                    </div>
                </form>
            </div>
        </div>
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
