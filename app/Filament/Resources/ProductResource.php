<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get; // Import 'Get'

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationLabel = 'Manajemen Produk';
    protected static ?string $navigationGroup = 'Manajemen Menu';

    public static function getEloquentQuery(): Builder
    {
        $user = Auth::user();

        // === PERBAIKAN 1: Memeriksa role pengguna dengan benar ===
        if ($user->role === 'admin') {
            return parent::getEloquentQuery();
        }
        
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function canCreate(): bool
    {
        if (Auth::user()->role === 'admin') {
            return true;
        }

        $subscription = Subscription::where('user_id', Auth::user()->id)
            ->where('end_date', '>', now())
            ->where('is_active', true)
            ->latest()
            ->first();
        
        $countProduct = Product::where('user_id', Auth::user()->id)->count();

        // Jika punya langganan, bisa buat produk tanpa batas.
        if ($subscription) {
            return true;
        }

        // Jika tidak punya langganan, hanya bisa buat maksimal 5 produk.
        return $countProduct < 5;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Toko')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->reactive() // Dibuat reactive agar kategori produk bisa menyesuaikan
                    ->hidden(fn() => Auth::user()->role === 'store'),
                
                // === PERBAIKAN 2: Menggabungkan dua field kategori produk menjadi satu ===
                Forms\Components\Select::make('product_category_id')
                    ->label('Kategori Produk')
                    ->required()
                    ->options(function (Get $get) {
                        $user = Auth::user();
                        if ($user->role === 'admin') {
                            // Admin: ambil kategori berdasarkan toko yang dipilih
                            $userId = $get('user_id');
                            if (!$userId) {
                                return []; // Kosongkan jika belum ada toko yang dipilih
                            }
                            return ProductCategory::where('user_id', $userId)->pluck('name', 'id');
                        } else {
                            // Store: ambil kategori milik toko itu sendiri
                            return ProductCategory::where('user_id', $user->id)->pluck('name', 'id');
                        }
                    })
                    // Nonaktifkan jika admin belum memilih toko
                    ->disabled(fn (Get $get): bool => Auth::user()->role === 'admin' && !$get('user_id')),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto Menu')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->label('Nama Menu')
                    ->required(),
                Forms\Components\TextArea::make('description')
                    ->label('Deskripsi Menu')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->label('Harga Menu')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Forms\Components\TextInput::make('rating')
                    ->label('Rating Menu')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(5)
                    ->required(),
                Forms\Components\Toggle::make('is_popular')
                    ->label('Popular Menu')
                    ->required(),
                Forms\Components\Repeater::make('productIngredients')
                    ->label('Bahan Baku Menu')
                    ->relationship()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Bahan')
                            ->required(),
                    ])
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('productCategory.name')
                    ->label('Kategori Menu')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Menu')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto Menu'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga Menu')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating Menu')
                    ->numeric(),
                Tables\Columns\ToggleColumn::make('is_popular')
                    ->label('Favorit'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user')
                    ->relationship('user', 'name')
                    ->label('Toko')
                    ->hidden(fn() => Auth::user()->role === 'store'),
                // Filter Kategori juga perlu diperbaiki
                Tables\Filters\SelectFilter::make('product_category_id')
                    ->label('Kategori Produk')
                    ->options(function () {
                        if (Auth::user()->role === 'admin') {
                            return ProductCategory::pluck('name', 'id');
                        }
                        return ProductCategory::where('user_id', Auth::user()->id)->pluck('name', 'id');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
