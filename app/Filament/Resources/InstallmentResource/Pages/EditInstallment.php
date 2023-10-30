<?php

namespace App\Filament\Resources\InstallmentResource\Pages;

use App\Filament\Resources\InstallmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInstallment extends EditRecord
{
    protected static string $resource = InstallmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
