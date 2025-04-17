<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\ProductSku;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
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

use function Laravel\Prompts\select;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Sản phẩm';

    protected static ?int $navigationSort = 10;

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label('Tên sản phẩm')->rules('required')->validationMessages(['required' => 'Vui lòng điền thông tin *', 'unique' => 'Sản phẩm này đã tồn tại'])->columnSpanFull()->unique(ignoreRecord: true),

                RichEditor::make('short_description')->label('Mô tả ngắn')->rules('required')->validationMessages(['required' => 'Vui lòng điền thông tin *']),
                RichEditor::make('description')->label('Mô tả')->rules('required')->validationMessages(['required' => 'Vui lòng điền thông tin *']),
                FileUpload::make('thumbnail')->label('Ảnh sản phẩm')->rules('required')->image()->validationMessages(['required' => 'Vui lòng nhập ảnh', 'image' => 'File tải lên không phải hình ảnh'])->columnSpanFull(),
                Repeater::make('productSkus')->relationship()->schema([
                    TextInput::make('sku')->label('Mã SKU')->rules('required')->validationMessages(['required' => 'Vui lòng nhập thông tin *', 'unique' => 'Mã SKU đã tôn tại'])->columnSpanFull()->unique(ignoreRecord: true),
                    TextInput::make('price')->numeric()->label('Giá')->rules('required')->validationMessages(['required' => 'Vui lòng nhập thông tin *']),
                    TextInput::make('quantity')->numeric()->label('Số lượng')->rules('required')->validationMessages(['required' => 'Vui lòng nhập thông tin *']),
                    Repeater::make('skuValues')->relationship('skuValues')->label('Thuộc tính')->schema([
                        Select::make('option_id')->label('Thuộc tính')->options(Option::pluck('name', 'id'))->reactive()->afterStateUpdated(function (callable $set) {
                            $set('value_id', null);
                        })->searchable()->rule(['required'])->validationMessages(['Vui lòng chọn thuộc tính']),
                        Select::make('value_id')->label('Giá trị')->options(function (callable $get) {
                            $optionId = $get('option_id');
                            return $optionId ? OptionValue::where('option_id', $optionId)->pluck('value_name', 'id') : [];
                        })->searchable()->rules('required')->validationMessages(['required' => 'Vui lòng chọn giá trị *'])
                    ])->columns(2)->columnSpanFull(),
                    FileUpload::make('images')->label('Hình ảnh')->image()->rules('required')->columnSpanFull()->validationMessages(['required' => 'Vui lòng nhập ảnh', 'image' => 'File tải lên không phải hình ảnh']),

                ])->defaultItems(1)->addable(true)->deletable(true)->label('Biến thể')->rules(['min:1'])->validationMessages(['min' => 'Sản phẩm phải có ít nhất một thuộc tính.'])->columns(2)->columnSpanFull(),
                Select::make('category_id')->label('Phân loại sản phẩm')->relationship('category', 'name')->rules('required')->validationMessages(['required' => 'Vui lòng chọn phân loại *']),
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
                TextColumn::make('name')->label('Tên'),
                TextColumn::make('total_quantity')->label('Tổng số lượng')->getStateUsing(function ($record) {
                    return ProductSku::where('product_id', $record->id)->sum('quantity');
                }),
                TextColumn::make('variant')->label('Biến thể')->getStateUsing(fn($record) => ProductSku::where('product_id', $record->id)->count('sku')),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
