<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefundResource\Pages;
use App\Filament\Resources\RefundResource\RelationManagers;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductSku;
use App\Models\Refund;
use App\Services\StripeService;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class RefundResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Yêu cầu hoàn tiền';
    protected static ?int $navigationSort = 11;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('id')->label('Đơn hàng'),
                Select::make('user_id')
                    ->relationship('user', 'name')->label('Người dùng'),
                Select::make('user_id')
                    ->relationship('user', 'email')
                    ->label('Email người dùng'),
                TextInput::make('address_username')->label('Tên người nhận'),
                TextInput::make('address_phone')->label('Số điện thoại người nhận'),
                Repeater::make('orderDetails')->relationship()->schema([
                    Repeater::make('productSku')->relationship()->schema([
                        FileUpload::make('images')->label('Hình ảnh'),
                        TextInput::make('sku')->label('SKU'),
                        TextInput::make('price')->label('Giá')
                    ])->hiddenLabel(),
                    TextInput::make('quantity')->label('Số lượng')
                ])->label('Sản phẩm đã mua')
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }
    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Builder $query) => $query->where('status', '=', 3))
            ->columns([
                TextColumn::make('id')->label('Đơn hàng'),
                TextColumn::make('user.name')->label('Người dùng'),
                TextColumn::make('user.email')->label('Email người dùng'),
                TextColumn::make('total_price')->label('Giá trị')->money('usd', true),
                TextColumn::make('created_at')->label('Ngày đặt'),
            ])->searchable()
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Xem chi tiết'),
                Action::make('duyet')
                    ->label('Duyệt')
                    ->action(function ($record) {
                        $result = StripeService::handleRefund($record->id);
                        if ($result && $result->status === 'succeeded') {
                            $record->update([
                                'status' => 4,
                            ]);
                            Notification::make()->title('Duyệt thành công')->send();
                        } else {
                            Log::error('Lỗi trong quá trình hoàn tiền: ' . $result . ', ' . $record->id);
                            Notification::make()->title('Duyệt thất bại')->send();
                        }                        
                    })
                    ->color('primary'),
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
            'index' => Pages\ListRefunds::route('/'),
        ];
    }
}
