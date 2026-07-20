<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Chirp;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Gelen veriyi doğrula; kurallar sağlanmazsa Laravel otomatik geri yönlendirir
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            // Özelleştirilmiş, markaya uygun hata mesajları
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        // $fillable sayesinde sadece message alınıyor, user_id kod içinde elle veriliyor
        \App\Models\Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // 11. derste gerçek kullanıcıyla değiştirilecek
        ]);

        // Ana sayfaya geri dön, session'a geçici bir başarı mesajı bırak
        return redirect('/')->with('success', 'Your chirp has been posted!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
