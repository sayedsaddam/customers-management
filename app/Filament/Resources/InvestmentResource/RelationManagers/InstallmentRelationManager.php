<?php

namespace App\Filament\Resources\InvestmentResource\RelationManagers;

use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\RelationManagers\RelationManager;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InstallmentRelationManager extends RelationManager
{
    protected static string $relationship = 'installment';

    protected static ?string $recordTitleAttribute = 'Installment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                    ->label('Customer Name')
                    ->options(Customer::all()->pluck('name', 'id')->toArray())
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
                    ->mask(fn (TextInput\Mask $mask) => $mask->money(prefix: '', thousandsSeparator: ',', decimalPlaces: 2))
                    ->required()
                    ->placeholder('Amount')
                    ->numeric(),
                DatePicker::make('receivedAt')
                    ->placeholder('Receiving Date')
                    ->required()
                    ->label('Receiving Date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')->label('Customer'),
                TextColumn::make('investment.project')->label('Project'),
                TextColumn::make('investment.investmentAmount')->label('Amount Invested'),
                TextColumn::make('id')->label('ID'),
                TextColumn::make('paymentMode')->label('Payment Mode'),
                TextColumn::make('referenceNo')->label('Reference No'),
                TextColumn::make('bankName')->label('Bank Name'),
                TextColumn::make('amount')->label('Amount'),
                TextColumn::make('receivedAt')->date()->label('Date Received'),
                TextColumn::make('created_at')->since()->label('Date Added'),
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
