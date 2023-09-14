<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;

class InvestmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'investments';

    protected static ?string $recordTitleAttribute = 'customer_id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('investmentDate')
                    ->required()
                    ->placeholder('Investment Date'),
                    TextInput::make('investmentAmount')
                    ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                    ->placeholder('Investment Amount')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('investmentAmount'),
                TextColumn::make('investmentDate')->dateTime('M d, Y'),
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
