<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BestSellingChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Produk Terlaris';

    protected function getData(): array
    {
        $user = Auth::user();

        $details = TransactionDetail::whereHas('transaction', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', 'success');
        })->get();

        $products = $details->groupBy('product_id')
            ->map(function ($items) {
                return $items->sum('quantity');
            })->sortDesc()->take(5); // Ambil 5 produk terlaris

        $labels = [];
        $data = [];

        foreach ($products as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $labels[] = $product->name;
                $data[] = $quantity;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Terjual',
                    'data' => $data,
                    'backgroundColor' => '#3b82f6', // Biru
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti dengan 'pie', 'line', dll.
    }
}
