<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use App\Models\TransactionDetail;

class DashboardOverview extends BaseWidget
{
    protected function getStats(): array
    {
    $user = Auth::user();

    $totalTransaction = Transaction::where('user_id', $user->id)
        ->where('status', 'success')
        ->count();

    $totalAmount = Transaction::where('user_id', $user->id)
        ->where('status', 'success')
        ->sum('total_price');

    if ($user->role === 'admin') {
        return [
            Stat::make('Total Pengguna', User::count()),
            Stat::make('Total Pendapatan Langganan', 'Rp ' . number_format(SubscriptionPayment::where('status', 'success')->count() * 50000)),
            Stat::make('Total Produk', Product::count()),
        ];
    } else {
        // Ambil semua detail transaksi sukses untuk user ini
        $details = TransactionDetail::whereHas('transaction', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', 'success');
        })->get();

        // Hitung total produk terjual
        $totalSold = $details->sum('quantity');

        // Produk terlaris
        $bestSelling = $details->groupBy('product_id')
            ->map(function ($items) {
                return $items->sum('quantity');
            })->sortDesc()->take(1);

        $bestSellingProduct = 'Belum ada penjualan';
        if ($bestSelling->count()) {
            $productId = $bestSelling->keys()->first();
            $product = Product::find($productId);
            if ($product) {
                $bestSellingProduct = $product->name . ' (' . $bestSelling->first() . ' terjual)';
            }
        }

        return [
            Stat::make('Total Transaksi', $totalTransaction),
            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalAmount)),
            Stat::make('Rata-Rata Pendapatan', $totalTransaction > 0 ? 'Rp ' . number_format($totalAmount / $totalTransaction) : 'Rp 0'),
            Stat::make('Produk Terjual', $totalSold),
            Stat::make('Produk Terlaris', $bestSellingProduct),
        ];
    }
    }
}
