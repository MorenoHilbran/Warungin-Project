<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TopProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'Produk Terlaris';

    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = [
        'lg' => 2,
    ];

    public static function canView(): bool
    {
        return Auth::check() && Auth::user()->role === 'store';
    }

    public function table(Table $table): Table
    {
        // Konfigurasi nama tabel dan kolom
        $productsTable = 'products';
        $transactionsTable = 'transactions';
        $detailsTable = 'transaction_details';
        $quantityColumn = 'quantity';
        $priceColumn = 'price'; // Merujuk ke kolom price di tabel products

        try {
            $query = Product::query()
                ->where("$productsTable.user_id", Auth::id())
                ->join($detailsTable, "$productsTable.id", '=', "$detailsTable.product_id")
                ->join($transactionsTable, "$detailsTable.transaction_id", '=', "$transactionsTable.id")
                ->where("$transactionsTable.status", 'success')
                ->select(
                    "$productsTable.id",
                    "$productsTable.name",
                    // Hitung total unit terjual
                    DB::raw("SUM($detailsTable.$quantityColumn) as total_sold"),
                    // === LOGIKA BARU: Kalikan jumlah unit terjual dengan harga dari tabel produk ===
                    DB::raw("SUM($detailsTable.$quantityColumn) * $productsTable.$priceColumn as total_revenue")
                )
                // === PERUBAHAN: Tambahkan kolom harga ke groupBy ===
                ->groupBy("$productsTable.id", "$productsTable.name", "$productsTable.$priceColumn")
                ->orderByDesc('total_sold')
                ->limit(5);

        } catch (QueryException $e) {
            Log::error('Error pada TopProductsWidget: ' . $e->getMessage());
            $query = Product::query()->whereRaw('1 = 0');
        }
        
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('#')
                    ->rowIndex(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk'),

                Tables\Columns\TextColumn::make('total_sold')
                    ->label('Jml Terjual') // Disingkat agar lebih rapi
                    ->numeric()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Pendapatan')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->paginated(false)
            ->filters([])
            ->actions([])
            ->bulkActions([]);
    }
}