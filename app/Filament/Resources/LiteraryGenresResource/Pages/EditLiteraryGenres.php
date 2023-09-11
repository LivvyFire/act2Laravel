<?php

namespace App\Filament\Resources\LiteraryGenresResource\Pages;

use App\Filament\Resources\LiteraryGenresResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLiteraryGenres extends EditRecord
{
    protected static string $resource = LiteraryGenresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
