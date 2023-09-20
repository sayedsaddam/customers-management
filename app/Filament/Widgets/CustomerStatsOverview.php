<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CustomerStatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getCards(): array
    {
        $active = Customer::where('status', 'active')->count();
        $cancelled = Customer::where('status', 'cancelled')->count();
        $buyback = Customer::where('status', 'buyback')->count();
        return [
            Card::make('Total Customers', Customer::all()->count()),
            Card::make('Active Customers', $active),
            Card::make('Cancelled Customers', $cancelled),
            Card::make('Buyback Customers', $buyback),
        ];
    }
}
