<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $label = 'Data Siswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama'),
                TextInput::make('nisn')->unique('students', 'nisn'),
                TextInput::make('kelas'),
                TextInput::make('ttl'),
                TextInput::make('agama'),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nisn')->searchable()->copyable(),
                TextColumn::make('nama')->searchable(),
                TextColumn::make('kelas')->badge(),
                TextColumn::make('ttl')->searchable(),
                TextColumn::make('agama'),
                //
            ])
            ->filters([
                //
                /* SelectFilter::make('kelas')
                    ->options(function () {
                        $data = DB::table('students')->select('kelas')->distinct()->get();

                        $daftarkelas = [];
                        foreach($data as $kls) {
                            array_push($daftarkelas, $kls->kelas);
                        }
                        return $daftarkelas;


                    }) */])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
