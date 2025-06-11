<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\SubscriptionPayment;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DashboardOverview extends BaseWidget
{
    protected static ?int $sort = -2; // <-- Tambahkan ini untuk menempatkannya di baris kedua

    protected int | string | array $columnSpan = 'full'; // <-- Tambahkan ini agar lebar penuh

    protected function getStats(): array
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return [
                Stat::make('Total Toko UMKM', User::count())
                    ->color('primary')
                    ->icon('heroicon-o-users'),
                Stat::make('Total Pendapatan Langganan', 'Rp ' . number_format(SubscriptionPayment::where('status', 'success')->count() * 50000))
                    ->color('success')
                    ->icon('heroicon-o-credit-card'),
                Stat::make('Total Produk UMKM', Product::count())
                    ->color('info')
                    ->icon('heroicon-o-cube'),
            ];
        } else {
            $totalTransaction = Transaction::where('user_id', $user->id)
                ->where('status', 'success')
                ->count();

            $totalAmount = Transaction::where('user_id', $user->id)
                ->where('status', 'success')
                ->sum('total_price');

            return [
                Stat::make('Total Transaksi', $totalTransaction)
                    ->color('primary')
                    ->icon('heroicon-o-shopping-cart'),
                Stat::make('Total Pendapatan', 'Rp ' . number_format($totalAmount))
                    ->color('success')
                    ->icon('heroicon-o-banknotes'),
                Stat::make('Rata-Rata Pendapatan', $totalTransaction > 0 ? 'Rp ' . number_format($totalAmount / $totalTransaction) : 'Rp 0')
                    ->color('warning')
                    ->icon('heroicon-o-chart-bar'),
            ];
        }
    }
}
