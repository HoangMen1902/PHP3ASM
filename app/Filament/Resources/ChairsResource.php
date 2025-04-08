<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChairsResource\Pages;
use App\Filament\Resources\ChairsResource\RelationManagers;
use App\Models\Chair;
use App\Models\Chairs;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ChairsResource extends Resource
{
    protected static ?string $model = Chair::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Ghế';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Ghế')->rules(['required'])->validationMessages(['required' => 'Vui lòng nhập tên ghế']),
                Select::make('branch_id')->relationship('branch', 'branch_name')->rules(['required'])->validationMessages(['required' => 'Vui lòng chọn chi nhánh']),
                Toggle::make('status')
                ->label('Trạng thái')
                ->default(1) 
                ->formatStateUsing(fn ($state) => $state ? 1 : 2) 
                ->dehydrateStateUsing(fn ($state) => $state ? 1 : 2) 
                ->rules('required')
                ->validationMessages(['required' => 'Vui lòng chọn trạng thái *'])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('name')->label('Ghế'),
                TextColumn::make('status')->label('Trạng thái')->formatStateUsing(function ($state) {
                    return match ($state) {
                        1 => 'Hoạt động',
                        2 => 'Khóa',
                        default => 'Không xác định'
                    };
                })->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListChairs::route('/'),
            'create' => Pages\CreateChairs::route('/create'),
            'edit' => Pages\EditChairs::route('/{record}/edit'),
        ];
    }
}
