<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CustomerStatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        $active = Customer::where('status', 1)->count();
        $inactive = Customer::where('status', 0)->count();
        return [
            Card::make('Total Customers', Customer::all()->count()),
            Card::make('Active Customers', $active),
            Card::make('Inactive Customers', $inactive),
        ];
    }
}
