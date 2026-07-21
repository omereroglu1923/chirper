<x-layout>
    <x-slot:title>Edit Chirp</x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Edit Chirp</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                {{-- PUT metodu, update() metoduna gidiyor --}}
                <form method="POST" action="/chirps/{{ $chirp->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        {{-- old('message', $chirp->message): hata yoksa mevcut chirp mesajını göster --}}
                        <textarea name="message" class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4" maxlength="255" required>{{ old('message', $chirp->message) }}</textarea>

                        @error('message')
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="/" class="btn btn-ghost btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm">Update Chirp</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
