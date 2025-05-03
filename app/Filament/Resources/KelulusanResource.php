<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelulusanResource\Pages;
use App\Filament\Resources\KelulusanResource\RelationManagers;
use App\Models\Kelulusan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KelulusanResource extends Resource
{
    protected static ?string $model = Kelulusan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Forms\Components\Toggle::make('lulus')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('student.nama')->searchable(),
                TextColumn::make('student.nisn')->searchable(),
                TextColumn::make('student.kelas')->badge()->searchable()->sortable(),
                Tables\Columns\IconColumn::make('lulus')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('luluskan')
                    ->label('Luluskan')
                    ->color('success')
                    ->action(function (Model $record) {
                        $record->update(['lulus' => true]);
                        Notification::make()
                            ->title($record->student->nama . ' diluluskan')
                            ->success()
                            ->send();
                    })
                    ->visible(fn(Model $record): bool => !$record->lulus),
                Tables\Actions\Action::make('batalkan')
                    ->label('Batalkan Kelulusan')
                    ->color('danger')
                    ->action(function (Model $record) {
                        $record->update(['lulus' => false]);
                        Notification::make()
                            ->title($record->student->nama . ' tidak lulus')
                            ->danger()
                            ->send();
                    })
                    ->visible(fn(Model $record): bool => $record->lulus),
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListKelulusans::route('/'),
            'create' => Pages\CreateKelulusan::route('/create'),
            'edit' => Pages\EditKelulusan::route('/{record}/edit'),
        ];
    }
}
