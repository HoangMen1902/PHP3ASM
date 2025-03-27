<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OptionResource\Pages;
use App\Filament\Resources\OptionResource\RelationManagers;
use App\Models\Option;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OptionResource extends Resource
{
    protected static ?string $model = Option::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $label = 'Thuộc tính';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên thuộc tính')->columnSpanFull(),
                Toggle::make('status')
                    ->label('Trạng thái')
                    ->default(1)
                    ->formatStateUsing(fn($state) => $state ? 1 : 2)
                    ->dehydrateStateUsing(fn($state) => $state ? 1 : 2)
                    ->rules('required')
                    ->validationMessages(['required' => 'Vui lòng chọn trạng thái *'])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Tên thuộc tính'),
                TextColumn::make('status')->label('Trạng thái')->formatStateUsing(function ($state) {
                    return match ($state) {
                        1 => 'Hoạt động',
                        2 => 'Khóa',
                        default => 'Không xác định',
                    };
                }),
            ])
            ->filters([
                //
            ])
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
            'index' => Pages\ListOptions::route('/'),
            'create' => Pages\CreateOption::route('/create'),
            'edit' => Pages\EditOption::route('/{record}/edit'),
        ];
    }
}
