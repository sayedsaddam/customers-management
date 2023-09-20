<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class RentalTransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'rentalTransactions';

    protected static ?string $recordTitleAttribute = 'customer_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('rentalDate')
                    ->required()
                    ->placeholder('Rental Transfer Date'),
                    TextInput::make('rentalAmount')
                    ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                    ->required()
                    ->placeholder('Rental Transfer Amount')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name'),
                TextColumn::make('rentalAmount')->sortable(),
                TextColumn::make('rentalDate')->date('M d, Y')->sortable()
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
