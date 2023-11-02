<?php

namespace App\Filament\Resources;


use Filament\Tables;
use App\Models\Investment;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\InvestmentResource\Pages;
use App\Filament\Resources\InvestmentResource\RelationManagers\InstallmentRelationManager;

class InvestmentResource extends Resource
{
    protected static ?string $model = Investment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 3;

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
                    DatePicker::make('investmentDate')
                        ->label('Investment Date')
                        ->required()
                        ->placeholder('Investment Date'),
                    TextInput::make('investmentAmount')
                        ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                        ->required()
                        ->placeholder('Investment Amount')
                        ->numeric(),
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

                ])
                ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->searchable()->sortable(),
                TextColumn::make('project'),
                TextColumn::make('rentalPercentage')->label('Rental %age'),
                TextColumn::make('investmentDate')->date('M d, Y')->sortable(),
                TextColumn::make('created_at')->date('M d, Y')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            InstallmentRelationManager::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvestments::route('/'),
            'create' => Pages\CreateInvestment::route('/create'),
            'edit' => Pages\EditInvestment::route('/{record}/edit'),
        ];
    }
}
