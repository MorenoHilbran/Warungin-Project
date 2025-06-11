<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class SalesChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Statistik Penjualan';

    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 2;

    // Atur lebar widget. 8 dari 12 kolom grid, menyisakan 4 untuk tabel produk terlaris.
    protected int | string | array $columnSpan = [
        'lg' => 1,
    ];

    /**
     * Hanya tampilkan widget untuk pengguna dengan peran 'store'
     */
    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'store';
    }

    /**
     * Mendefinisikan filter yang akan muncul di pojok kanan atas widget.
     */
    protected function getFilters(): ?array
    {
        return [
            'daily' => 'Harian (7 Hari Terakhir)',
            'weekly' => 'Mingguan (8 Minggu Terakhir)',
            'monthly' => 'Bulanan (12 Bulan Terakhir)',
        ];
    }

    protected function getData(): array
    {
        $user = Auth::user();
        $activeFilter = $this->filter;
        $data = [];
        $labels = [];

        switch ($activeFilter) {
            case 'daily':
                $startDate = now()->subDays(6)->startOfDay();
                $endDate = now()->endOfDay();
                
                $sales = Transaction::query()
                    ->where('user_id', $user->id)
                    ->where('status', 'success')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->selectRaw('DATE(created_at) as date, SUM(total_price) as total')
                    ->groupBy('date')
                    ->pluck('total', 'date');

                // Iterasi 7 hari terakhir untuk memastikan semua hari ada di label
                for ($i = 0; $i < 7; $i++) {
                    $date = now()->subDays($i);
                    $labels[] = $date->format('D, d M'); // Format: Tue, 09 Jun
                    $data[] = $sales[$date->format('Y-m-d')] ?? 0;
                }
                $data = array_reverse($data);
                $labels = array_reverse($labels);
                break;

            case 'weekly':
                $startDate = now()->subWeeks(7)->startOfWeek();
                $endDate = now()->endOfWeek();

                $sales = Transaction::query()
                    ->where('user_id', $user->id)
                    ->where('status', 'success')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->selectRaw('YEAR(created_at) as year, WEEK(created_at, 1) as week, SUM(total_price) as total')
                    ->groupBy('year', 'week')
                    ->get()
                    ->mapWithKeys(function ($item) {
                        return [$item->year . '-' . str_pad($item->week, 2, '0', STR_PAD_LEFT) => $item->total];
                    });

                // Iterasi 8 minggu terakhir
                for ($i = 0; $i < 8; $i++) {
                    $date = now()->subWeeks($i);
                    $labels[] = 'W-' . $date->weekOfYear;
                    $key = $date->year . '-' . str_pad($date->weekOfYear, 2, '0', STR_PAD_LEFT);
                    $data[] = $sales[$key] ?? 0;
                }
                $data = array_reverse($data);
                $labels = array_reverse($labels);
                break;

            case 'monthly':
            default:
                $startDate = now()->subMonths(11)->startOfMonth();
                $endDate = now()->endOfMonth();

                $sales = Transaction::query()
                    ->where('user_id', $user->id)
                    ->where('status', 'success')
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total_price) as total')
                    ->groupBy('month')
                    ->pluck('total', 'month');

                // Iterasi 12 bulan terakhir
                for ($i = 0; $i < 12; $i++) {
                    $date = now()->subMonths($i);
                    $labels[] = $date->format('M Y'); // Format: Jun 2024
                    $data[] = $sales[$date->format('Y-m')] ?? 0;
                }
                $data = array_reverse($data);
                $labels = array_reverse($labels);
                break;
        }
        
        return [
            'datasets' => [
                [
                    'label' => 'Total Penjualan',
                    'data' => $data,
                    'borderColor' => Color::Amber[600],
                    'backgroundColor' => Color::Amber[100],
                    'tension' => 0.2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
