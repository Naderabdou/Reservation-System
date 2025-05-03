<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\OrderResource\Pages;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'icon-orderNew';

    protected static ?int $navigationSort = 8;


    public static function getModelLabel(): string
    {
        return __('Order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Orders');
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             //
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Orders Found'))
            ->emptyStateDescription(__('Orders will appear here once they are created.'))
            ->emptyStateIcon('icon-order')
            ->striped()
            ->heading(__('Orders'))
            ->description(__('Here you can view all orders'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                TextColumn::make("order_number")
                    ->badge()
                    ->label(__('Order Number')),


                TextColumn::make('name')
                    ->default('NA')
                    ->label(__('user name')),


                TextColumn::make('email')
                    ->default('NA')
                    ->label(__('email')),



                TextColumn::make('phone')
                    ->default('NA')
                    ->label(__('phone')),


                TextColumn::make('service_name')
                    ->default('NA')
                    ->label(__('Service Name')),
                TextColumn::make('service_price')
                    ->money('EGP')
                    ->default('0')
                    ->label(__('Service Price')),
                TextColumn::make('reservation_date')
                    ->label(__('Reservation Date')),





                TextColumn::make('status')
                    ->label(__('Status'))
                    ->color(fn(Order $order) => match ($order->status) {
                        'pending' => 'gray',
                        'accepted' => 'primary',
                        'completed' => 'success',
                        'canceled' => 'danger',
                    })
                    ->icon(fn(Order $order) => match ($order->status) {
                        'pending' => 'icon-pending',
                        'accepted' => 'icon-checked',
                        'completed' => 'icon-loading',
                        'canceled' => 'icon-multiply',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => __('Pending'),
                        'accepted' => __('Accepted'),
                        'completed' => __('Completed'),
                        'canceled' => __('Canceled'),
                    })
                    ->badge(),



                // TextColumn::make('pickup_date')
                //     ->label(__('Pickup Date'))
                //     ->formatStateUsing(fn(string $state): string => \Carbon\Carbon::parse($state)->format('Y-m-d')),


            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name'),



                SelectFilter::make('service_id')
                    ->label(__('Service'))
                    ->relationship('service', 'name_' . app()->getLocale())
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([

                    Tables\Actions\ViewAction::make(),
                    // Tables\Actions\DeleteAction::make()->hidden(function (Order $record) {
                    //     return $record->status !== 'canceled' ? true : false;
                    // }),
                    Action::make('change status')
                        ->label(__('Change Status'))
                        ->form([
                            Select::make('status')
                                ->options([
                                    'pending' => __('Pending'),
                                    'completed' => __('Completed'),
                                    'canceled' => __('Canceled'),
                                ])
                                ->label(__('Status'))
                                ->required()
                                ->default(function (Order $record) {
                                    return $record->status;
                                }),

                        ])->action(function (Order $order, array $data) {


                            $order->update($data);

                            Notification::make()
                                ->title(__('تم تغيير حالة الطلب بنجاح'))
                                ->color('success')
                                ->send();
                        })->icon('icon-orderNew'),




                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([

                Section::make(__('User Information'))
                    ->collapsible(true)
                    ->schema([
                        TextEntry::make('name')
                            ->default('NA')
                            ->label(__('Name')),

                        TextEntry::make('email')
                            ->default('NA')
                            ->label(__('Email')),

                        TextEntry::make('phone')
                            ->default('NA')
                            ->label(__('Phone')),
                    ])->columns(3),

                Section::make(__('Order Information'))
                    ->collapsible(true)
                    ->schema([
                        Fieldset::make(__('Status Information'))
                            ->schema([

                                TextEntry::make('order_number')
                                    ->badge()
                                    ->label(__('Order Number')),

                                TextEntry::make('reservation_date')
                                    ->label(__('Reservation Date')),

                                TextEntry::make('service_name')
                                    ->default('NA')
                                    ->label(__('Service Name')),

                                TextEntry::make('service_price')
                                    ->money('SAR')
                                    ->default(0)
                                    ->label(__('Price')),




                                TextEntry::make('status')
                                    ->badge()
                                    ->formatStateUsing(fn(string $state): string => match ($state) {
                                        'pending' => __('Pending'),
                                        'completed' => __('Completed'),
                                        'canceled' => __('Canceled'),
                                        default => ucfirst($state),
                                    })
                                    ->icon(fn(string $state): string => match ($state) {
                                        'pending' => 'icon-pending',
                                        'completed' => 'icon-loading',
                                        'canceled' => 'icon-multiply',
                                    })
                                    ->color(fn(string $state): string => match ($state) {
                                        'pending' => 'gray',
                                        'completed' => 'success',
                                        'canceled' => 'danger',
                                        default => 'secondary',
                                    })
                                    ->label(__('Status')),



                            ])->columns(5),






                    ])->columns(2),


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
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
