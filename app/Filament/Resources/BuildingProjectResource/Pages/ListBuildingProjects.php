<?php

namespace App\Filament\Resources\BuildingProjectResource\Pages;

use App\Filament\Resources\BuildingProjectResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBuildingProjects extends ListRecords
{
    protected static string $resource = BuildingProjectResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
