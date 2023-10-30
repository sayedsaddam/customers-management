<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InstallmentResource\Pages;
use App\Models\Installment;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class InstallmentResource extends Resource
{
    protected static ?string $model = Installment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?int $navigationSort = 2;

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
                        Select::make('investment_id')
                            ->relationship('investments', 'project')
                            ->label('Project, Invested In')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('paymentMode')
                            ->options([
                                'cash' => 'Cash',
                                'cheque' => 'Cheque',
                                'ibft' => 'IBFT',
                                'wire transfer' => 'Wire Transfer',
                                'pay order' => 'Pay Order',
                            ])
                            ->required()
                            ->searchable(),
                        TextInput::make('referenceNo')
                            ->placeholder('Reference Number')
                            ->default('0')
                            ->label('Reference No.'),
                        TextInput::make('bankName')
                            ->placeholder('Bank Name')
                            ->default('0')
                            ->label('Bank Name'),
                        TextInput::make('branchCode')
                            ->placeholder('Branch Code')
                            ->default('0')
                            ->label('Branch Code'),
                        TextInput::make('amount')
                            ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 0))
                            ->required()
                            ->placeholder('Amount')
                            ->numeric(),
                        Select::make('receivedAt')
                            ->options([
                                'Islamabad' => 'Islamabad',
                                'Peshawar' => 'Peshawar',
                                'Kohat' => 'Kohat',
                                'Hangu' => 'Hangu',
                                'D.I Khan' => 'D.I Khan',
                                'Mardan' => 'Mardan'
                            ])
                            ->searchable()
                            ->label('Received In')
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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

    public static function getNavigationBadge(): ?string{
        return static::getModel()::count();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInstallments::route('/'),
            'create' => Pages\CreateInstallment::route('/create'),
            'edit' => Pages\EditInstallment::route('/{record}/edit'),
        ];
    }
}
