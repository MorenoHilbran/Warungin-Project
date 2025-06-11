<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class StoreProfileWidget extends Widget
{
    protected static string $view = 'filament.widgets.store-profile-widget';

     // Urutan widget, -3 agar tampil paling atas
    protected static ?int $sort = -3; 

    // Atur agar widget ini memakan lebar penuh
    public function getColumnSpan(): int|string
    {
        return 'full';
    }

    // Hanya tampilkan widget ini untuk user dengan role 'store'
    public static function canView(): bool
    {
        return Auth::user()->role === 'store';
    }

    // Mengirim data 'user' ke dalam view
    protected function getViewData(): array
    {
        return [
            'user' => Auth::user(),
        ];
    }
}
