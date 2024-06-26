<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmenityResource\Pages;
use App\Filament\Resources\AmenityResource\RelationManagers;
use App\Models\Amenity;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class AmenityResource extends Resource
{
    protected static ?string $model = Amenity::class;
    protected static ?string $navigationLabel = 'Facilities';
    protected static ?string $navigationIcon = 'heroicon-o-square-2-stack';
    protected static ?string $navigationGroup = 'Room';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('name')
                        ->unique(),
                        Select::make('icon')
                            ->label('Bed Type')
                            ->options([
                                'fa-solid fa-wifi' => 'Wifi',
                                'fa-solid fa-swimming-pool' => 'Kolam Renang',
                                'fa-solid fa-utensils' => 'Restoran',
                                'fa-solid fa-coffee' => 'Kafe',
                                'fa-solid fa-spa' => 'Spa',
                                'fa-solid fa-fitness-center' => 'Pusat Kebugaran',
                                'fa-solid fa-parking' => 'Parkir',
                                'fa-solid fa-umbrella-beach' => 'Pantai',
                                'fa-solid fa-bed' => 'Ruang Tidur',
                                'fa-solid fa-bath' => 'Kamar Mandi',
                                'fa-solid fa-tv' => 'TV',
                                'fa-solid fa-phone' => 'Telepon',
                                'fa-solid fa-clock' => 'Jam Weker',
                                'fa-solid fa-music' => 'Musik',
                                'fa-solid fa-thermometer' => 'AC/Heater',
                                'fa-solid fa-car' => 'Layanan Antar-Jemput',
                                'fa-solid fa-bicycle' => 'Penyewaan Sepeda',
                                'fa-solid fa-wine-glass' => 'Bar',
                                'fa-solid fa-shopping-bag' => 'Belanja',
                                'fa-solid fa-shower' => 'Shower',
                                'fa-solid fa-utensil-spoon' => 'Makanan dan Minuman',
                                'fa-solid fa-hiking' => 'Hiking',
                                'fa-solid fa-camera' => 'Fotografi',
                                'fa-solid fa-charging-station' => 'Stasiun Pengisian Daya',
                                'fa-solid fa-credit-card' => 'Pembayaran Kartu Kredit',
                                'fa-solid fa-dumbbell' => 'Gym',
                                'fa-solid fa-baby' => 'Fasilitas untuk Anak-anak',
                                'fa-solid fa-umbrella' => 'Payung',
                                'fa-solid fa-bicycle' => 'Penyewaan Sepeda',
                                'fa-solid fa-car' => 'Parkir Mobil',
                                'fa-solid fa-concierge-bell' => 'Layanan Resepsionis',
                                'fa-solid fa-gift' => 'Toko Hadiah',
                                'fa-solid fa-leaf' => 'Taman',
                                'fa-solid fa-cutlery' => 'Restoran',
                                'fa-solid fa-binoculars' => 'Pemandangan',
                                'fa-solid fa-plug' => 'Soket Listrik',
                                'fa-solid fa-thermometer-half' => 'Kontrol Suhu',
                                'fa-solid fa-palette' => 'Seni dan Kreativitas',
                                'fa-solid fa-exclamation-triangle' => 'Keadaan Darurat',
                                'fa-solid fa-truck' => 'Layanan Antar-Jemput Barang',
                                'fa-solid fa-dog' => 'Fasilitas untuk Hewan Peliharaan',
                                'fa-solid fa-microphone' => 'Fasilitas Konferensi',
                                'fa-solid fa-fire' => 'Kemudahan Pemanasan',
                                'fa-solid fa-glass-martini' => 'Bar',
                                'fa-solid fa-gamepad' => 'Ruangan Bermain',
                                'fa-solid fa-couch' => 'Ruang Santai',
                                'fa-solid fa-caravan' => 'Parkir Karavan',
                                'fa-solid fa-tint' => 'Tinted Windows',
                                'fa-solid fa-train' => 'Akses ke Stasiun Kereta Api',
                                'fa-solid fa-futbol' => 'Lapangan Olahraga',
                                'fa-solid fa-volleyball-ball' => 'Lapangan Voli',
                                'fa-solid fa-american-sign-language-interpreting' => 'Layanan Penyandang Tuna Rungu',
                                'fa-solid fa-universal-access' => 'Akses Universal',
                                'fa-solid fa-wrench' => 'Perbaikan',
                                'fa-solid fa-tools' => 'Perkakas',
                                'fa-solid fa-hammer' => 'Pekerjaan Bangunan',
                                'fa-solid fa-hands-helping' => 'Bantuan Layanan',
                                'fa-solid fa-wheelchair' => 'Fasilitas Difabel',
                                'fa-solid fa-shuttle-van' => 'Layanan Antar-Jemput Bandara',
                                'fa-solid fa-bus' => 'Akses ke Transportasi Umum',
                                'fa-solid fa-bicycle' => 'Penyewaan Sepeda',
                                'fa-solid fa-biking' => 'Tempat Penyimpanan Sepeda',
                                'fa-solid fa-map-marked-alt' => 'Peta dan Informasi',
                                'fa-solid fa-bell' => 'Layanan Kamar',
                                'fa-solid fa-exclamation-circle' => 'Informasi Penting',
                                'fa-solid fa-bug' => 'Layanan Teknis',
                                'fa-solid fa-comments' => 'Layanan Pelanggan',
                                'fa-solid fa-exchange-alt' => 'Penukaran Uang',
                                'fa-solid fa-smoking' => 'Area Merokok',
                                'fa-solid fa-tshirt' => 'Laundry',
                                'fa-solid fa-toothbrush' => 'Perlengkapan Mandi',
                                'fa-solid fa-binoculars' => 'Pemandangan',
                                'fa-solid fa-hiking' => 'Hiking',
                                'fa-solid fa-tree' => 'Hutan',
                                'fa-solid fa-fishing' => 'Pancing',
                                'fa-solid fa-golf-ball' => 'Golf',
                                'fa-solid fa-tennis-ball' => 'Tenis',
                                'fa-solid fa-snowflake' => 'Cuaca Dingin',
                                'fa-solid fa-sun' => 'Cuaca Cerah',
                                'fa-solid fa-cloud-sun' => 'Cuaca Berawan',
                                'fa-solid fa-cloud-showers-heavy' => 'Hujan',
                                'fa-solid fa-snowman' => 'Salju',
                                'fa-solid fa-sunrise' => 'Pemandangan Matahari Terbit',
                                'fa-solid fa-moon' => 'Pemandangan Malam',
                                'fa-solid fa-mountain' => 'Pegunungan',
                                'fa-solid fa-campground' => 'Kemah',
                                'fa-solid fa-fireplace' => 'Kemudahan Pemanasan',
                                'fa-solid fa-bath' => 'Kamar Mandi Pribadi',
                                'fa-solid fa-broadcast-tower' => 'Sinyal TV',
                                'fa-solid fa-wind' => 'Kondisi Angin',
                                'fa-solid fa-thermometer-full' => 'Kontrol Suhu',
                                'fa-solid fa-fan' => 'Kipas Angin',
                                'fa-solid fa-drafting-compass' => 'Pemandu Petunjuk',
                                'fa-solid fa-map-signs' => 'Peta dan Informasi',
                                'fa-solid fa-car-side' => 'Parkir Mobil',
                                'fa-solid fa-hotel' => 'Hotel',
                                'fa-solid fa-building' => 'Bangunan',
                                'fa-solid fa-bed' => 'Tempat Tidur Nyaman',
                                'fa-solid fa-home' => 'Rumah',
                                'fa-solid fa-hotel' => 'Hotel',
                                'fa-solid fa-building' => 'Bangunan',
                            ])
                            ->unique()
                            ->searchable()
                            ->helperText(new HtmlString('Use <strong><a href="https://fontawesome.com/icons" target="_blank">fontawesome</a></strong> class.'))
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAmenities::route('/'),
        ];
    }

}
