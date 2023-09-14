<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class BuybackTransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'buybackTransactions';

    protected static ?string $recordTitleAttribute = 'customer_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('buybackAmount')
                    ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                    ->required()
                    ->placeholder('Investment Amount')
                    ->numeric(),
                DatePicker::make('buybackDate')
                    ->required()
                    ->placeholder('Buyback Date')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name'),
                TextColumn::make('buybackAmount'),
                TextColumn::make('buybackDate')->date('M d, Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
