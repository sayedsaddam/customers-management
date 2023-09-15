<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\RentalTransaction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\RentalTransactionResource\Pages;
use Filament\Tables\Columns\TextColumn;

class RentalTransactionResource extends Resource
{
    protected static ?string $model = RentalTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Select::make('customer_id')
                        ->relationship('customer', 'name')
                        ->searchable()
                        ->required()
                        ->preload(),
                    DatePicker::make('rentalDate')
                        ->placeholder('Rental Transfer Date')
                        ->required(),
                    TextInput::make('rentalAmount')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Rental Transfer Amount')
                        ->numeric(),
                ])
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->sortable()->searchable(),
                TextColumn::make('rentalAmount'),
                TextColumn::make('rentalDate')->date('M d, Y')->sortable(),
                TextColumn::make('created_at')->date()->since()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getNavigationBadge(): string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRentalTransactions::route('/'),
            'create' => Pages\CreateRentalTransaction::route('/create'),
            'edit' => Pages\EditRentalTransaction::route('/{record}/edit'),
        ];
    }
}
