<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User; // <-- Pastikan User di-import
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationLabel = 'Manajemen Transaksi';

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        // === PERBAIKAN 1: Memeriksa role pengguna dengan benar ===
        if ($user->role === 'admin') {
            return parent::getEloquentQuery();
        }
        
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Toko')
                    // === PERBAIKAN 3: Memfilter pilihan toko agar tidak menampilkan admin ===
                    ->options(User::where('role', 'store')->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive() // Sangat penting agar pilihan produk di bawah bisa menyesuaikan
                    ->hidden(fn() => Auth::user()->role === 'store'),
                
                Forms\Components\TextInput::make('code')
                    ->label('Kode Transaksi')
                    ->default(fn(): string => 'TRX-' . mt_rand(10000, 99999))
                    ->readOnly()
                    ->required(),
                
                Forms\Components\TextInput::make('name')
                    ->label('Nama Customer')
                    ->required(),
                
                Forms\Components\TextInput::make('phone_number')
                    ->label('Nomor HP Customer')
                    ->tel()
                    ->required(),
                
                Forms\Components\TextInput::make('table_number')
                    ->label('Nomor Meja')
                    ->required(),
                
                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'cash' => 'Tunai',
                        'midtrans' => 'Midtrans',
                    ])
                    ->required(),
                
                Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Tertunda',
                        'success' => 'Berhasil',
                        'failed' => 'Gagal',
                    ])
                    ->required(),
                
                Forms\Components\Repeater::make('transactionDetails')
                    ->relationship()
                    ->label('Detail Pesanan')
                    ->schema([
                        // === PERBAIKAN 2: Logika pilihan produk disesuaikan ===
                        Forms\Components\Select::make('product_id')
                            ->label('Produk')
                            ->options(function (Get $get) {
                                $user = Auth::user();
                                if ($user->role === 'admin') {
                                    $storeId = $get('../../user_id'); // Ambil ID toko yang dipilih di atas
                                    if (!$storeId) {
                                        return [];
                                    }
                                    return Product::where('user_id', $storeId)->get()->mapWithKeys(function($product){
                                        return [$product->id => "$product->name (Rp " . number_format($product->price) . ")"];
                                    });
                                } else {
                                    // Untuk role 'store'
                                    return Product::where('user_id', $user->id)->get()->mapWithKeys(function($product){
                                        return [$product->id => "$product->name (Rp " . number_format($product->price) . ")"];
                                    });
                                }
                            })
                            ->searchable()
                            ->required()
                            ->reactive() // Buat reactive untuk memicu kalkulasi ulang
                            ->disabled(fn (Get $get) => Auth::user()->role === 'admin' && !$get('../../user_id')),
                        
                        Forms\Components\TextInput::make('quantity')
                            ->label('Jumlah')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(1)
                            ->reactive(), // Buat reactive untuk memicu kalkulasi ulang
                        
                        Forms\Components\TextInput::make('note')
                            ->label('Catatan'),
                    ])
                    ->columns(3) // Atur layout repeater
                    ->columnSpanFull()
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set) {
                        self::updateTotals($get, $set);
                    })
                    ->reorderable(false),
                
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Harga')
                    ->prefix('Rp')
                    ->required()
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Toko')
                    ->searchable()
                    ->hidden(fn() => Auth::user()->role === 'store'),
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode Transaksi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Customer')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->badge(),
                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Transaksi')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // === PERBAIKAN 4: Memfilter opsi pada tabel agar tidak menampilkan admin ===
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Toko')
                    ->options(fn () => User::where('role', 'store')->pluck('name', 'id'))
                    ->searchable()
                    ->hidden(fn() => Auth::user()->role === 'store'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function updateTotals(Get $get, Set $set): void
    {
        $selectedProducts = collect($get('transactionDetails'))->filter(fn($item) => !empty($item['product_id']) && !empty($item['quantity']));

        if ($selectedProducts->isEmpty()) {
            $set('total_price', 0);
            return;
        }

        $prices = Product::find($selectedProducts->pluck('product_id'))->pluck('price', 'id');

        $total = $selectedProducts->reduce(function ($total, $product) use ($prices) {
            $price = $prices[$product['product_id']] ?? 0;
            return $total + ($price * $product['quantity']);
        }, 0);

        $set('total_price', $total);
    }
}
