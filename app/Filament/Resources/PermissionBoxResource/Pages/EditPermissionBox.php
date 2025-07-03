<?php

namespace App\Filament\Resources\PermissionBoxResource\Pages;

use App\Filament\Resources\PermissionBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermissionBox extends EditRecord
{
    protected static string $resource = PermissionBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
