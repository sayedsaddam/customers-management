<?php

namespace App\Filament\Resources\BuybackTransactionResource\Pages;

use App\Filament\Resources\BuybackTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuybackTransactions extends ListRecords
{
    protected static string $resource = BuybackTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
