<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $label = 'Đơn hàng';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 9;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')->label('ID đơn hàng')->columnSpanFull(),
                Select::make('user_id')->relationship('user', 'name')->label('Người dùng'),
                Select::make('user_id')->relationship('user', 'email')->label('Email Người dùng'),
                TextInput::make('address_username')->label('Người nhận hàng'),
                TextInput::make('address_phone')->label('SĐT Liên hệ'),
                TextInput::make('total_price')->label('Tổng tiền'),
                RichEditor::make('address')->label('Địa chỉ giao hàng')->columnSpanFull(),
                Repeater::make('orderDetails')->relationship()->schema([
                    Select::make('sku_id')->relationship('productSku', 'sku')->label('SKU')->reactive(),
                    TextInput::make('price')->reactive()->default(fn($get) => $get('sku_id') ? \App\Models\ProductSku::find($get('sku_id'))->price : null)->label('Giá'),
                ])->label('Sản phẩm đã mua')->columnSpanFull()
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('address_username')->label('Người đặt'),
                TextColumn::make('address_phone')->label('SĐT liên hệ'),
                TextColumn::make('total_price')->label('Tổng giá')->money('usd', true),
                TextColumn::make('created_at')->label('Ngày đặt'),
                SelectColumn::make('status')
                    ->label('Trạng thái')
                    ->options([
                        0 => 'Đã hủy',
                        1 => 'Chờ xử lý',
                        2 => 'Đã thanh toán',
                        3 => 'Chờ hoàn tiền',
                        4 => 'Đã hoàn tiền',
                        5 => 'Đang vận chuyển',
                        6 => 'Vận chuyển thành công'
                    ])
            ])->searchable()

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Xem chi tiết')
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
            'index' => Pages\ListOrders::route('/'),

        ];
    }
}
