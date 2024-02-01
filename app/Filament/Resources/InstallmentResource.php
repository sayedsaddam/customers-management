<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Customer;
use App\Models\Installment;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\InstallmentResource\Pages;
use App\Models\Investment;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InstallmentResource extends Resource
{
    protected static ?string $model = Installment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Select::make('customer_id')
                            ->label('Customer Name')
                            ->options(Customer::all()->pluck('name', 'id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('investment_id', null))
                            ->searchable()
                            ->preload(),
                        Select::make('investment_id')
                            ->label('Project, Invested In')
                            ->options(function (callable $get){
                                $investments = Customer::find($get('customer_id'));
                                if(!$investments){
                                    return Investment::all()->pluck('project', 'id');
                                }
                                return $investments->investments->pluck('project', 'id');
                            })
                            ->searchable(),
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
                            ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 2))
                            ->required()
                            ->placeholder('Amount')
                            ->numeric(),
                        DatePicker::make('receivedAt')
                            ->placeholder('Receiving Date')
                            ->required()
                            ->label('Receiving Date'),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->searchable()->sortable()->label('Name'),
                TextColumn::make('investment.project')->label('Project'),
                TextColumn::make('investment.investmentAmount'),
                TextColumn::make('amount')->label('Amount'),
                TextColumn::make('paymentMode')->label('Payment Mode')->translateLabel(),
                TextColumn::make('receivedAt')->label('Receiving Date')->date(),
                TextColumn::make('bankName')->label('Bank'),
                TextColumn::make('branchCode')->label('Br. Code'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
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
