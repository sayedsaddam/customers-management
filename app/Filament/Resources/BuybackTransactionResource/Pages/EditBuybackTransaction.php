<?php

namespace App\Filament\Resources\BuybackTransactionResource\Pages;

use App\Filament\Resources\BuybackTransactionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBuybackTransaction extends EditRecord
{
    protected static string $resource = BuybackTransactionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
