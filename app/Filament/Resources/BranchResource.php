<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BranchResource\Pages;
use App\Filament\Resources\BranchResource\RelationManagers;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $label = 'Chi Nhánh';

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('branch_name')
                    ->label('Tên chi nhánh')
                    ->rules('required')
                    ->validationMessages(['required' => 'Vui lòng nhập tên chi nhánh *'])
                    ->maxLength(255),
                TextInput::make('branch_address')
                    ->label('Địa chỉ chi nhánh')
                    ->rules('required')
                    ->validationMessages(['required' => 'Vui lòng nhập địa chỉ chi nhánh *'])
                    ->maxLength(255),
                Toggle::make('status')
                    ->label('Trạng thái')
                    ->default(1) // Mặc định là 1
                    ->formatStateUsing(fn($state) => $state ? 1 : 2)
                    ->dehydrateStateUsing(fn($state) => $state ? 1 : 2)
                    ->rules('required')
                    ->validationMessages(['required' => 'Vui lòng chọn trạng thái *'])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')->label('ID'),
            TextColumn::make('branch_name')->label('Tên Chi Nhánh'),
            TextColumn::make('branch_address')->label('Địa chỉ'),
            TextColumn::make('status')->label('Trạng thái')->formatStateUsing(function ($state) {
                return match ($state) {
                    1 => 'Hoạt động',
                    2 => 'Không hoạt động',
                    default => 'Không xác định'
                };
            })
        ])
        ->filters([
            SelectFilter::make('status')
            ->label('Trạng thái')
            ->options([
                1 => 'Hoạt động',
                2 => 'Không hoạt động',
            ])
            ->default(null), // Không lọc mặc định
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
