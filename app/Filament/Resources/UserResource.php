<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers\ServiceHistoriesRelationManager;

use Guava\FilamentModalRelationManagers\Actions\Table\RelationManagerAction;

use function Laravel\Prompts\select;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Tên người dùng')

                    ->maxLength(255)
                    ->rules(['required']),
                TextInput::make('email')
                    ->label('Địa chỉ email')
                    ->email()
                    ->maxLength(255)
                    ->rules(['required', 'email'])
                    ->unique(ignoreRecord: true),

                TextInput::make('password')
                    ->label('Mật khẩu')
                    ->password()
                    ->required(fn($livewire) => $livewire instanceof CreateRecord)
                    ->hidden(fn($livewire) => $livewire instanceof EditRecord)
                    ->maxLength(255)
                    ->rules(['required']),


                TextInput::make('phone')
                    ->label('Số điện thoại')

                    ->minLength(10)
                    ->maxLength(10)
                    ->rules(['required', 'regex:/^0\d{9}$/']),

                Select::make('role')
                    ->label('Vai trò')
                    ->options([
                        1 => 'Khách hàng',
                        2 => 'Quản trị',
                    ])
                    ->native(false)

                    ->rules(['required']),

                Select::make('status')
                    ->label('Trạng thái')
                    ->options([
                        1 => 'Hoạt động',
                        2 => 'Khóa',
                    ])
                    ->native(false)

                    ->rules(['required']),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id'),
                TextColumn::make('name')->label('Tên người dùng'),
                TextColumn::make('email')->label('Địa chỉ email'),
                TextColumn::make('phone')->label('Số điện thoại'),
                TextColumn::make('status')->label('Trạng thái')->formatStateUsing(function ($state) {
                    return match ($state) {
                        1 => 'Hoạt động',
                        2 => 'Khóa',
                        default => 'Không xác định',
                    };
                }),
                TextColumn::make('role')->label('Vai trò')->formatStateUsing(function ($state) {
                    return match ($state) {
                        1 => 'Khách hàng',
                        2 => 'Quản trị',
                        default => 'Không xác định'
                    };
                }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                RelationManagerAction::make('Lịch sử dịch vụ')
                    ->label('Lịch sử dịch vụ')
                    ->relationManager(ServiceHistoriesRelationManager::make()),

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
            ServiceHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return 'Người dùng';
    }

    public static function getLabel(): string
    {
        return 'Người dùng';
    }
}
