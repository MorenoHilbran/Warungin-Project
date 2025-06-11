<?php

namespace App\Filament\Widgets;

use App\Models\Subscription;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class SubscriptionNotificationWidget extends Widget
{
    protected static string $view = 'filament.widgets.subscription-notification-widget';

    // Urutan widget, -4 agar tampil paling atas, di atas widget profil
    protected static ?int $sort = -4; 

    // Atur agar widget ini memakan lebar penuh
    public function getColumnSpan(): int | string | array
    {
        return 'full';
    }

    /**
     * Logika utama untuk menampilkan widget.
     * Widget ini HANYA akan tampil jika kondisi di bawah ini terpenuhi:
     * 1. Pengguna sudah login dan memiliki peran 'store'.
     * 2. Pengguna TIDAK memiliki data di tabel 'subscriptions' dengan end_date di masa depan.
     */
    public static function canView(): bool
    {
        $user = Auth::user();

        // Jangan tampilkan jika user belum login atau bukan 'store'
        if (!$user || $user->role !== 'store') {
            return false;
        }

        // Cek apakah ada langganan yang aktif (end_date >= hari ini)
        $hasActiveSubscription = Subscription::where('user_id', $user->id)
            ->where('end_date', '>=', now())
            ->exists();

        // Tampilkan widget jika TIDAK ADA langganan aktif
        return !$hasActiveSubscription;
    }
}