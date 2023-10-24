<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

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
                Select::make('project')
                    ->options([
                        '091 Mall' => '091 Mall',
                        'Florenza' => 'Florenza',
                        'AH Tower' => 'AH Tower',
                        'AH Residencia' => 'AH Residencia',
                        'AH City' => 'AH City',
                        'MoH' => 'MoH',
                        'North Hills' => 'North Hills',
                    ])
                    ->searchable()
                    ->required(),
                Select::make('rentalStatus')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->required(),
                TextInput::make('rentalPercentage')
                    ->required()
                    ->label('Rental Percentage')
                    ->placeholder('Rental Percentage'),
                TextInput::make('floorName')
                        ->required()
                        ->label('Floor Name')
                        ->placeholder('Floor Name'),
                TextInput::make('rate')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Rate')
                        ->numeric(),
                TextInput::make('saleValue')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Sale Value')
                        ->numeric(),
                TextInput::make('amountReceived')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Amount Received')
                        ->numeric(),
                TextInput::make('sqft')
                    ->required()
                    ->label('Area in Sqft')
                    ->placeholder('Area in sqft')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.id')->label('S. No'),
                TextColumn::make('customer.name')->label('Name'),
                TextColumn::make('customer.fatherName')->label('Father Name'),
                TextColumn::make('customer.cnic')->label('CNIC'),
                TextColumn::make('customer.email')->label('Email'),
                TextColumn::make('customer.phone')->label('Phone'),
                TextColumn::make('customer.dob')->label('Birthday')->date(),
                TextColumn::make('customer.city')->label('City'),
                TextColumn::make('customer.address')->label('Address'),
                TextColumn::make('customer.nokName')->label('Nok'),
                TextColumn::make('customer.nokCnic')->label('CNIC'),
                TextColumn::make('investmentDate')->dateTime('M d, Y')->label('Investment Date'),
                TextColumn::make('investmentAmount')->label('Amount'),
                TextColumn::make('saleValue')->label('Sale Value'),
                TextColumn::make('sqft')->label('Area'),
                TextColumn::make('floorName')->label('Floor'),
                TextColumn::make('rate')->label('Rate /sqft'),
                TextColumn::make('project'),
                IconColumn::make('rentalStatus')->label('Rental Status')
                    ->options([
                        'heroicon-o-check-circle' => 'active',
                        'heroicon-o-x-circle' => 'inactive'
                    ])
                    ->colors([
                        'danger' => 'inactive',
                        'success' => 'active'
                    ]),
                TextColumn::make('rentalPercentage')
                    ->label('Percentage'),
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
                ExportBulkAction::make(),
            ]);
    }
}
