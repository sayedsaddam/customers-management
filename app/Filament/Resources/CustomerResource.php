<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Filament\Resources\CustomerResource\Widgets\CustomerOverview;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('Customer Name'),
                    TextInput::make('contact')
                        ->required()
                        ->placeholder('Customer Contact'),
                    TextInput::make('email')
                        ->placeholder('Customer Email'),
                    TextInput::make('investment_amount')
                        ->required()
                        ->numeric()
                        ->placeholder('Amount Invested'),
                    DatePicker::make('investment_date')
                        ->required()
                        ->placeholder('Investment Date'),
                    TextInput::make('buyback_amount')
                        ->required()
                        ->numeric()
                        ->placeholder('Buyback Amount'),
                    DatePicker::make('buyback_date')
                        ->placeholder('Buyback Date'),
                    Textarea::make('address')
                        ->placeholder('Customer Address')
                        ->columns(1),
                    Toggle::make('status')
                        ->onColor('success')
                        ->default('active'),
                    Toggle::make('Buyback Status')
                        ->onColor('success'),
                ])
                ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('contact')->searchable(),
                IconColumn::make('status')->boolean(),
                TextColumn::make('investment_amount')->sortable()->money('pkr'),
                IconColumn::make('buyback_status')->boolean()->label('Buyback'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
                SelectFilter::make('buyback_status')
                    ->options([
                        1 => 'Applied',
                        0 => 'No Applied'
                    ])
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

    public static function getWidgets(): array
    {
        return [
            CustomerOverview::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
