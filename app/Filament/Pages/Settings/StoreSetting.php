<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class StoreSetting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.settings.store-setting';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $title = 'Pengaturan Toko';

    protected static ?int $navigationSort = 100;
    public ?array $data = [];

     public static function canAccess(): bool
    {
        return Auth::user()?->role === 'store';
    }
    public function mount(): void
    {
        $this->form->fill(Auth::user()->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->description('Informasi umum tentang toko Anda.')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Toko')
                            ->image()
                            ->imageEditor()
                            ->directory('logos')
                            ->disk('public'),
                        TextInput::make('name')
                            ->label('Nama Toko')
                            ->disabled()
                            ->required(),
                        Placeholder::make('store_url')
                            ->label('Alamat Toko')
                            ->content(function () {
                                $username = Auth::user()?->username;
                                if ($username) {
                                    $url = url('/' . $username);
                                    // Membuat URL menjadi link yang bisa di-klik
                                    return new HtmlString(
                                        "<a href='{$url}' target='_blank' class='text-primary-600 hover:underline'>{$url}</a>"
                                    );
                                }
                                return 'Tidak tersedia';
                            })
                            ->helperText('warungin/' . Auth::user()?->username),
                    ])->columns(1),

                
                Section::make('Tentang Toko')
                    ->schema([
                        Textarea::make('about')
                            ->label('Deskripsi Toko')
                            ->rows(3)
                            ->placeholder('Ceritakan tentang keunikan dan produk unggulan toko Anda...'),
                    ]),
                

                Section::make('Informasi Tambahan')
                    ->schema([
                        TextInput::make('operating_hours')
                            ->label('Jam Operasional')
                            ->placeholder('Contoh: Senin - Jumat, 09:00 - 17:00'),
                    ]),
                
                Section::make('Media Sosial')
                    ->description('Tautkan akun media sosial dan marketplace Anda.')
                    ->schema([
                        Group::make()->schema([
                            TextInput::make('social_media.instagram')
                                ->label('Instagram')
                                ->prefix('https://instagram.com/'),
                            TextInput::make('social_media.shopee')
                                ->label('Shopee')
                                ->prefix('https://shopee.co.id/'),
                        ])->columns(2),

                        Group::make()->schema([
                            TextInput::make('social_media.whatsapp')
                                ->label('WhatsApp')
                                ->prefix('+62')
                                ->numeric()
                                ->helperText('Masukkan nomor tanpa 0 atau +62, contoh: 81234567890'),
                            TextInput::make('social_media.facebook')
                                ->label('Facebook')
                                ->prefix('https://facebook.com/'),
                        ])->columns(2),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        Auth::user()->update($data);

        Notification::make()
            ->title('Berhasil disimpan')
            ->success()
            ->send();
    }
}