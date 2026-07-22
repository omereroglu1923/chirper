{{-- Bu component, tek bir chirp'i "chirp" prop'u olarak dışarıdan alır --}}
@props(['chirp'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            {{-- Chirp'in bir sahibi (user) varsa gerçek avatar, yoksa anonim avatar göster --}}
            @if ($chirp->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        {{-- Kullanıcının email'i URL-güvenli hale getirilip avatar servisine gönderiliyor --}}
                        <img src="https://avatars.laravel.cloud/{{ urlencode($chirp->user->email) }}"
                            alt="{{ $chirp->user->name }}'s avatar" class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        {{-- Sabit, anonim kullanıcılar için varsayılan avatar --}}
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                            alt="Anonymous User" class="rounded-full" />
                    </div>
                </div>
            @endif
            @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                <span class="text-base-content/60">·</span>
                <span class="text-sm text-base-content/60 italic">edited</span>
            @endif
            <div class="min-w-0">
                <div class="flex items-center gap-1">
                    {{-- Kullanıcı adı varsa göster, yoksa "Anonymous" yaz --}}
                    <span class="text-sm font-semibold">{{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</span>
                    <span class="text-base-content/60">·</span>
                    {{-- Carbon'un diffForHumans() metodu: "5 dakika önce" gibi okunabilir zaman üretir --}}
                    <span class="text-sm text-base-content/60">{{ $chirp->created_at->diffForHumans() }}</span>
                </div>
                {{-- Not: Ders dokümanında <p> etiketi var ama videoda eğitmen
                     fazladan boşluk sorunu yüzünden bunu <span> ile değiştiriyor --}}
                <span class="mt-1 block">{{ $chirp->message }}</span>
            </div>
            {{-- chirp.blade.php içine eklenen edit/delete butonları --}}
            @can('update', $chirp)
                <div class="flex gap-1">
                    <a href="/chirps/{{ $chirp->id }}/edit" class="btn btn-ghost btn-xs">Edit</a>
                    <form method="POST" action="/chirps/{{ $chirp->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this chirp?')"
                            class="btn btn-ghost btn-xs text-error">
                            Delete
                        </button>
                    </form>
                </div>
            @endcan
        </div>
    </div>
</div>
