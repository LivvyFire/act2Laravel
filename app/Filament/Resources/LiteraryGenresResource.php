<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LiteraryGenresResource\Pages;
use App\Models\LiteraryGenres;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Console\View\Components\Secret;

class LiteraryGenresResource extends Resource
{
    protected static ?string $model = LiteraryGenres::class;

    // añadimos la estructuración:
    protected static ?int $navigationSort = 10;

    // añadimos los grupos
    public static function getNavigationGroup(): ?string
    {
        return __('BookStore'); // TODO: Change the autogenerated stub
    }

    public static function getLabel(): ?string
    {
        return __('Literary Genre'); // TODO: Change the autogenerated stub
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->minLength(4)
                ->maxLength(20)
                ->unique(static::getModel(), 'name', ignoreRecord: true)
                ->label(__('Name'))
                ->columnSpanFull(),
                Textarea::make('description')
                ->label(__('Description'))
                ->rows(5)
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label(__('Name'))
                ->searchable()
                ->sortable()
                ->description(fn (LiteraryGenres $literaryGenres)=>$literaryGenres->description)
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('literary_genres_id')
                ->relationship('literary_genres', 'name')
                ->label(__('Literary Genre')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLiteraryGenres::route('/'),
            'create' => Pages\CreateLiteraryGenres::route('/create'),
            'edit' => Pages\EditLiteraryGenres::route('/{record}/edit'),
        ];
    }
}
