<?php

namespace App\Filament\Resources\InvestmentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class InstallmentRelationManager extends RelationManager
{
    protected static string $relationship = 'installment';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
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
