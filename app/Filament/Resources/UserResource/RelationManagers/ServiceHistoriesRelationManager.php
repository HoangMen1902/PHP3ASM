<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Tables\Columns\ToggleColumn;
class ServiceHistoriesRelationManager extends RelationManager
{
    protected static string $relationship = 'serviceHistories';
    protected static ?string $label = 'Lịch sử dịch vụ';
    protected static ?string $title = 'Lịch sử dịch vụ';

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('appointment_id')
            ->columns([
                TextColumn::make('appointment.id')
                    ->label('Mã lịch hẹn'),

                TextColumn::make('appointment.date')
                    ->label('Ngày'),

                TextColumn::make('appointment.time')
                    ->label('Giờ'),

                TextColumn::make('appointment.services.name')
                    ->label('Dịch vụ đã chọn')
                    ->badge()
                    ->separator(', ')
                    ->limit(50),

                TextColumn::make('total_price')
                    ->label('Tổng tiền')
                    ->formatStateUsing(fn($state) => '$' . number_format($state, 2)),


                    ToggleColumn::make('status')
                    ->label('Trạng thái')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->getStateUsing(fn($record) => $record->status == 1)
                    ->updateStateUsing(function ($record, $state) {
                        $record->status = $state ? 1 : 2;
                        $record->save();
                    })

            ])
            ->filters([])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
