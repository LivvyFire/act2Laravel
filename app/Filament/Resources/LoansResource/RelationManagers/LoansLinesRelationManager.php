<?php

namespace App\Filament\Resources\LoansResource\RelationManagers;

use App\Models\Books;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoansLinesRelationManager extends RelationManager
{
    protected static string $relationship = 'LoansLines';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Lines of loans:id', replace: ['id' => $ownerRecord->id]);
    }

    protected static function getRecordLabel(): ?string
    {
        return __('Lines of Loans');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('loans_id')
                ->default($this->ownerRecord->id),
                Forms\Components\Select::make('books_tile')
                ->label(__('Book:'))
                ->placeholder(__('Select a book:'))
                ->options(
                    Books::query()
                    ->orderBy('title')
                    ->get()
                    ->pluck('title', 'id')
                )
                ->required()
                ->searchable(),
                Forms\Components\TextInput::make('quantity')
                ->numeric()
                ->label('Quantity of books')
                ->required()
                ->placeholder(__('Quantity of books'))
                ->default(0)
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
}
