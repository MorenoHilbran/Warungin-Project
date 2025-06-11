<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class TotalSellingChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Produk Terlaris';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $user = Auth::user();

        $details = TransactionDetail::whereHas('transaction', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('status', 'success');
        })->get();

        $products = $details->groupBy('product_id')
            ->map(function ($items) {
                return $items->sum('quantity');
            })->sortDesc()->take(5); 

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
                    'backgroundColor' => 'bg-primary-600', 
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; 
    }
    
     public static function canView(): bool
    {
        return Auth::user()?->role === 'store';
    }
}

