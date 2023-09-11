<?php

namespace App\Filament\Resources\BooksResource\Widgets;

use App\Models\LiteraryGenres;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookOverviews extends BaseWidget
{
    protected function getStats(): array
    {
        $literary_genres = LiteraryGenres::withCount('books')->get();
        $stats = [];

        foreach ($literary_genres as $literary_genre){
            $stats[] = Stat::make($literary_genre->name, $literary_genre->books_count);
        }

        return $stats;
    }
}
