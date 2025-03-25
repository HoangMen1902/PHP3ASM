<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function Laravel\Prompts\select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Sản phẩm';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên sản phẩm')->unique()->rules('required')->validationMessages(['required'=> 'Vui lòng điền thông tin *', 'unique' => 'Sản phẩm này đã tồn tại'])->columnSpanFull(),
                RichEditor::make('short_description')->label('Mô tả ngắn')->rules('required')->validationMessages(['required'=>'Vui lòng điền thông tin *']),
                RichEditor::make('description')->label('Mô tả')->rules('required')->validationMessages(['required'=>'Vui lòng điền thông tin *']),
                Select::make('category_id')->label('Phân loại sản phẩm')->relationship('category','name')->rules('required')->validationMessages(['required'=>'Vui lòng chọn phân loại *']),
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
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
