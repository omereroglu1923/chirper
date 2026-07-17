<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    public function run(): void
    {
        // 3'ten az kullanıcı varsa 3 yeni kullanıcı oluştur (tekrar çalıştırılınca UNIQUE hatası almamak için),
        // yoksa var olan ilk 3 kullanıcıyı kullan
        $users = User::count() < 3
            ? collect([
                User::create(['name' => 'Alice Developer', 'email' => 'alice@example.com', 'password' => bcrypt('password')]),
                User::create(['name' => 'Bob Builder', 'email' => 'bob@example.com', 'password' => bcrypt('password')]),
                User::create(['name' => 'Charlie Coder', 'email' => 'charlie@example.com', 'password' => bcrypt('password')]),
            ])
            : User::take(3)->get();

        // Örnek chirp mesajları
        $chirps = [
            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with Chirper today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
        ];

        // Her mesaj için rastgele bir kullanıcı seç, ona ait chirp olarak oluştur
        foreach ($chirps as $message) {
            $users->random()->chirps()->create([
                'message' => $message,
                // Zaman damgasını 5 dk ile 24 saat öncesi arasında rastgele ayarla (daha gerçekçi feed için)
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}