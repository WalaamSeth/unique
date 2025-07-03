<?php

namespace App\Filament\Resources\PermissionBoxResource\Pages;

use App\Filament\Resources\PermissionBoxResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermissionBoxes extends ListRecords
{
    protected static string $resource = PermissionBoxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
