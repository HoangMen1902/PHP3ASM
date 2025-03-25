<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
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

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Dịch vụ';

    protected static ?string $label = 'Dịch vụ';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên dịch vụ')->rules(['required'])->unique(ignoreRecord: true)->validationMessages(['required' => 'Vui lòng nhập thông tin', 'unique' => 'Dịch vụ này đã tồn tại']),
                TextInput::make('price')->label('Giá (Ví dụ: 100000)')->rules(['required'])->validationMessages(['required' => 'Vui lòng nhập thông tin']),
                
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
                TextColumn::make('name')->label('Tên'),
                TextColumn::make('status')->label('Trạng thái')->formatStateUsing(function ($state) {
                    return match ($state) {
                        1 => 'Hoạt động',
                        2 => 'Không hoạt động',
                        default => 'Không xác định'
                    };
                })
            ])
            ->searchable()
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
