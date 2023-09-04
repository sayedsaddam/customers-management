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
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput\Mask;
use App\Filament\Widgets\CustomerStatsOverview;
use App\Filament\Resources\CustomerResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CustomerResource\RelationManagers;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Customer Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->placeholder('Customer Name'),
                    TextInput::make('cnic')
                        ->required()
                        ->label('CNIC #')
                        ->placeholder('Customer CNIC'),
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
                    ]),
                    TextInput::make('investmentAmount')->mask(fn (TextInput\Mask $mask) => $mask
                        ->patternBlocks([
                            'money' => fn (Mask $mask) => $mask
                                ->numeric()
                                ->thousandsSeparator(',')
                                ->decimalSeparator('.'),
                        ])
                        ->pattern('money'),
                    )
                    ->placeholder('Investment Amount'),
                    DatePicker::make('investmentDate')
                        ->label('Investment Date')
                        ->placeholder('Investment Date'),
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
                            ->label('Nok CNIC #')
                            ->placeholder('Next of Kin CNIC #'),
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
                TextColumn::make('contact')->searchable(),
                IconColumn::make('status')->boolean(),
                TextColumn::make('investment_amount')->sortable()->money('pkr'),
                IconColumn::make('buyback_status')->boolean()->label('Buyback'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Customer Status')
                    ->options([
                        1 => 'Active',
                        0 => 'Inactive',
                    ]),
                SelectFilter::make('buyback_status')
                    ->label('Buyback Status')
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
