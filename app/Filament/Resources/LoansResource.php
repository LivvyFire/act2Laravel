<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoansResource\Pages;
use App\Filament\Resources\LoansResource\RelationManagers;
use App\Models\Loans;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoansResource extends Resource
{
    protected static ?string $model = Loans::class;

    protected static ?int $navigationSort = 30;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // añadimos los grupos
    public static function getNavigationGroup(): ?string
    {
        return __('BookStore'); // TODO: Change the autogenerated stub
    }

    public static function getLabel(): ?string
    {
        return __('Loans'); // TODO: Change the autogenerated stub
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                ->columns(3)
                ->schema([
                    Forms\Components\Select::make('user_id')
                    ->options(User::customers()->pluck('name', 'id'))
                    ->label(__('Reader'))
                    ->searchable(),
                    Forms\Components\Select::make('status')
                    ->label(__('Status of the loan'))
                    ->options([
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'declined' => 'Denied',
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->label(__('Reader'))
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('status')
                ->label(__('Status'))
                ->sortable()
                ->color(fn (string $state):string => match($state) {
                    'processing' => 'info',
                    'completed' => 'success',
                    'declined' => 'warning',
                })
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('user_id')
                ->label(__('Reader'))
                ->options(User::customers()->pluck('name', 'id'))
                ->searchable(),
                Tables\Filters\SelectFilter::make('status')
                ->label(__('Status'))
                ->options([
                    'processing' => 'info',
                    'completed' => 'success',
                    'declined' => 'warning',
                ])
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
            RelationManagers\LoansLinesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoans::route('/create'),
            'edit' => Pages\EditLoans::route('/{record}/edit'),
        ];
    }
}
