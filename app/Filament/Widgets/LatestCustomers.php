<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Closure;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestCustomers extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Customer::query()->latest()->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('name')->label('Customer'),
            TextColumn::make('fatherName')->label('Father Name'),
            TextColumn::make('email'),
            TextColumn::make('phone'),
            TextColumn::make('city'),
            IconColumn::make('status')
                ->options([
                    'heroicon-o-receipt-refund' => 'buyback',
                    'heroicon-o-check-circle' => 'active',
                    'heroicon-o-x-circle' => 'cancelled'
                ])
                ->colors([
                    'warning' => 'buyback',
                    'success' => 'active',
                    'danger' => 'cancelled'
                ]),
            // TextColumn::make('investments.project'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
