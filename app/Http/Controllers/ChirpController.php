<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // authorize() için ZORUNLU

class ChirpController extends Controller
{
    use AuthorizesRequests; // bu satır unutulursa authorize() hata verir

    // Ana sayfa: tüm chirp'leri (kullanıcı bilgisiyle birlikte) en yeniden eskiye listeler
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Artık anonim değil, gerçek giriş yapmış kullanıcı üzerinden oluşturuluyor
        auth()->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    public function edit(Chirp $chirp)
    {
        // Bu chirp'i düzenlemeye yetkisi yoksa otomatik 403 hatası
        $this->authorize('update', $chirp);
        return view('chirps.edit', compact('chirp'));
    }

    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);
        return redirect('/')->with('success', 'Chirp updated!');
    }

    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();
        return redirect('/')->with('success', 'Chirp deleted!');
    }
}
