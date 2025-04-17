<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Select;
use App\Models\Branch;
use App\Models\Chair;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\CheckboxList;
use App\Models\Service;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Đặt Lịch';

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Thông tin đặt lịch
                Section::make('Thông tin đặt lịch')
                    ->schema([
                        TextInput::make('customer_name')
                            ->label('Tên người dùng')
                            ->maxLength(255)
                            ->rules(['required']),

                        Select::make('user_id')
                            ->label('Chọn người dùng')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        TextInput::make('customer_phone')
                            ->label('Số điện thoại')
                            ->minLength(10)
                            ->maxLength(10)
                            ->rules(['required', 'regex:/^0\d{9}$/']),

                        DatePicker::make('date')
                            ->label('Ngày')
                            ->rules(['required']),

                        TimePicker::make('time')
                            ->label('Giờ')
                            ->rules(['required']),
                        Select::make('branch_id')
                            ->label('Chi nhánh')
                            ->options(Branch::all()->pluck('branch_name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive(),

                        Select::make('chair_id')
                            ->label('Ghế')
                            ->options(function (callable $get) {
                                $branchId = $get('branch_id');
                                if (!$branchId) {
                                    return [];
                                }

                                return Chair::where('branch_id', $branchId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->visible(fn(callable $get) => $get('branch_id') !== null),

                    ])
                    ->columns(2),

                //  Chọn dịch vụ
                Section::make('Dịch vụ')
                    ->schema([
                        CheckboxList::make('services')
                            ->label('Chọn dịch vụ')
                            ->options(Service::where('status', 1)->pluck('name', 'id'))
                            ->columns(2)
                    ])
                    ->columns(1),
                Section::make('Trạng thái')
                    ->schema([
                        Toggle::make('status')
                            ->label('Trạng thái')
                            ->default(1) // 1 là Thành công
                            ->onIcon('heroicon-o-check-circle')
                            ->offIcon('heroicon-o-x-circle')
                            ->onColor('success')
                            ->offColor('danger')
                            ->formatStateUsing(fn($state) => $state ? 1 : 2)
                            ->dehydrateStateUsing(fn($state) => $state ? 1 : 2)
                            ->helperText('Bật là Thành công, Tắt là Hủy')
                            ->rules('required')
                            ->validationMessages([
                                'required' => 'Vui lòng chọn trạng thái *'
                            ])
                            ->columns(2)
                    ])
                    ->columns(1),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id'),
                TextColumn::make('customer_name')->label('Tên người dùng'),
                TextColumn::make('customer_phone')->label('Số điện thoại'),
                TextColumn::make('date')->label('Ngày'),
                TextColumn::make('time')->label('Giờ'),
                TextColumn::make('branch.branch_name')
                    ->label('Chi nhánh')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('chair.name')
                    ->label('Ghế')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('services.name')
                    ->label('Dịch vụ')
                    ->badge()
                    ->separator(', ')
                    ->limit(50),


                ToggleColumn::make('status')
                    ->label('Trạng thái')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->getStateUsing(fn($record) => $record->status == 1)
                    ->updateStateUsing(fn($record, $state) => $record->update(['status' => $state ? 1 : 2]))


            ])
            ->filters([
                // Lọc theo ngày
                Filter::make('date')
                    ->form([
                        DatePicker::make('from')->label('Từ ngày'),
                        DatePicker::make('to')->label('Đến ngày'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('date', '>=', $data['from']))
                            ->when($data['to'], fn($q) => $q->whereDate('date', '<=', $data['to']));
                    }),

                // Lọc theo chi nhánh
                SelectFilter::make('branch_id')
                    ->label('Chi nhánh')
                    ->options(Branch::pluck('branch_name', 'id'))
                    ->searchable(),
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        1 => 'Thành công',
                        2 => 'Hủy',
                    ]),

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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
