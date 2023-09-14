<?php

namespace App\Filament\Resources;

use Filament\Tables;
use App\Models\Customer;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Widgets\CustomerStatsOverview;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers\BuybackTransactionsRelationManager;
use App\Filament\Resources\CustomerResource\RelationManagers\InvestmentsRelationManager;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customer Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('Customer Name'),
                    TextInput::make('fatherName')
                        ->required()
                        ->label('Father Name')
                        ->placeholder('Father Name'),
                    TextInput::make('cnic')
                        ->required()
                        ->label('Customer CNIC')
                        ->placeholder('Customer CNIC')
                        ->mask(fn (TextInput\Mask $mask) => $mask->pattern('00000-0000000-0')),
                    TextInput::make('email')
                        ->email()
                        ->placeholder('Customer Email'),
                    TextInput::make('phone')
                        ->required()
                        ->label('Phone #')
                        ->tel()
                        ->placeholder('Customer Contact'),
                    DatePicker::make('dob')
                        ->required()
                        ->label('Date of Birth')
                        ->placeholder('Date of Birth'),
                    TextInput::make('city')
                        ->label('City')
                        ->placeholder('City'),
                    TextInput::make('address')
                        ->label('Address')
                        ->placeholder('Address'),
                    Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'cancelled' => 'Cancelled',
                        'buyback' => 'Buyback',
                    ])
                ])
                ->collapsible()
                ->columns(2),
                Section::make('Next of Kin Information')
                    ->schema([
                        TextInput::make('nokName')
                            ->required()
                            ->label('NoK Name')
                            ->placeholder('Next of Kin Name'),
                        TextInput::make('nokCnic')
                            ->required()
                            ->label('NoK CNIC')
                            ->placeholder('NoK CNIC')
                            ->mask(fn (TextInput\Mask $mask) => $mask->pattern('00000-0000000-0')),
                        TextInput::make('nokEmail')
                            ->label('Nok Email')
                            ->placeholder('Next of Kin Email'),
                        TextInput::make('nokPhone')
                            ->label('Nok Phone')
                            ->placeholder('Next of Kin Phone #'),
                        TextInput::make('nokRelation')
                            ->label('Relationship with Customer')
                            ->placeholder('Relationship with Customer')
                    ])
                    ->collapsible()
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('fatherName')->sortable()->searchable(),
                TextColumn::make('phone')->searchable(),
                TextColumn::make('status'),
            ])
            ->filters([
                SelectFilter::make('status')
                ->label('Customer Status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'cancelled' => 'Cancelled',
                    'buyback' => 'Buyback'
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
            InvestmentsRelationManager::class,
            BuybackTransactionsRelationManager::class,
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CustomerStatsOverview::class,
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
