<?php

namespace App\Filament\Resources\LiteraryGenresResource\Pages;

use App\Filament\Resources\LiteraryGenresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLiteraryGenres extends ListRecords
{
    protected static string $resource = LiteraryGenresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
