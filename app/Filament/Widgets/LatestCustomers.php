<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Closure;
use Filament\Tables;
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
            TextColumn::make('name')->label('Customer')->sortable()->searchable(),
            TextColumn::make('fatherName')->searchable()->label('Father Name'),
            TextColumn::make('email'),
            TextColumn::make('phone'),
            TextColumn::make('city'),
            TextColumn::make('status'),
            TextColumn::make('investments.project'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
