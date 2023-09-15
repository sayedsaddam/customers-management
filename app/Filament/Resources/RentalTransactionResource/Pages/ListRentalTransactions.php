<?php

namespace App\Filament\Resources\RentalTransactionResource\Pages;

use App\Filament\Resources\RentalTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRentalTransactions extends ListRecords
{
    protected static string $resource = RentalTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
