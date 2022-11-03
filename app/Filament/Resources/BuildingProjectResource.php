<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BuildingProjectResource\Pages;
use App\Filament\Resources\BuildingProjectResource\RelationManagers;
use App\Models\BuildingProject;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BuildingProjectResource extends Resource
{
    protected static ?string $model = BuildingProject::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->autofocus()
                        ->required(),
                    TextInput::make('code'),
                    TextInput::make('investment')->required(),
                    TextInput::make('progress')->required(),
                    TextInput::make('stuck'),
                    TextInput::make('leader_direction')
                        ->disabled(!auth()->user()->isAdmin())
                        ->dehydrated(auth()->user()->isAdmin()),
                    TextInput::make('construction_company'),
                    TextInput::make('audit_company'),
                    TextInput::make('application_procedure'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                TextInputColumn::make('leader_direction')
                    ->visibleFrom('lg')
                    ->disabled(!auth()->user()->isAdmin())->visibleFrom('md'),
                TextColumn::make('investment')->visibleFrom('md'),
                TextColumn::make('progress')->visibleFrom('md'),
                TextColumn::make('stuck')->visibleFrom('md'),
                TextColumn::make('construction_company')->visibleFrom('md'),
                TextColumn::make('audit_company')->visibleFrom('md'),
                TextColumn::make('application_procedure')->visibleFrom('md'),
                TextColumn::make('created_at')->visibleFrom('md')->since()
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListBuildingProjects::route('/'),
            'create' => Pages\CreateBuildingProject::route('/create'),
            'view' => Pages\ViewBuildingProject::route('/{record}'),
            'edit' => Pages\EditBuildingProject::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
