<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Models\BuybackTransaction;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\BuybackTransactionResource\Pages;
use Filament\Tables\Columns\TextColumn;

class BuybackTransactionResource extends Resource
{
    protected static ?string $model = BuybackTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Buybacks';

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
                    TextInput::make('buybackAmount')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Investment Amount')
                        ->numeric(),
                    DatePicker::make('buybackDate')
                        ->required()
                        ->placeholder('Buyback Date')

                ])
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->searchable(),
                TextColumn::make('buybackDate')->date('M d, Y')->sortable(),
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBuybackTransactions::route('/'),
            'create' => Pages\CreateBuybackTransaction::route('/create'),
            'edit' => Pages\EditBuybackTransaction::route('/{record}/edit'),
        ];
    }
}
