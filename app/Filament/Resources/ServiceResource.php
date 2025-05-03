<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\ServiceResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ServiceResource\RelationManagers;
use Filament\Infolists\Components\Section as InfolistSection;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $navigationIcon = 'icon-washing';
    protected static ?int $navigationSort = 7;

    public static function getModelLabel(): string
    {
        return __('Service');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Services');
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    Section::make(__('Main Information'))
                        ->description(__('This is the main information about the service.'))
                        ->collapsible(true)
                        ->schema([
                            TextInput::make('name_ar')
                                ->label(__('title_ar'))
                                ->minLength(3)
                                ->maxLength(255)

                                ->required(),

                            TextInput::make('name_en')
                                ->required()
                                ->label(__('title_en'))
                                ->minLength(3)
                                ->maxLength(255)

                                ->autofocus()
                                ->lazy()
                                ->afterStateUpdated(function (Set $set, ?string $state) {
                                    $set('slug', str()->slug($state));
                                }),
                            TextInput::make('slug')
                                ->required()

                                ->unique(Service::class, 'slug', ignoreRecord: true)
                                ->disabled()
                                ->dehydrated(),


                            TextInput::make('price')
                                ->label(__('price'))
                                ->minValue(1)
                                ->numeric()
                                ->inputMode('decimal')
                                ->required(),

                        ])->columns(4),


                    Section::make(__('Description Information'))
                        ->description(__('This is the description information about the service.'))
                        ->collapsible(true)

                        ->schema([

                            Textarea::make('desc_ar')
                                ->label(__('desc_ar'))
                                ->minLength(3)
                                ->rows(5),

                            Textarea::make('desc_en')
                                ->label(__('desc_en'))
                                ->minLength(3)
                                ->rows(5),


                        ])->columns(2),

                    Section::make(__('Images Information'))
                        ->description(__('This is the images information about the service.'))
                        ->collapsible(true)

                        ->schema([



                            FileUpload::make('image')
                                ->label(__('image'))
                                ->disk('public')->directory('services')
                                ->columnSpanFull()

                                ->reorderable()
                                ->image()


                                ->required(),
                        ]),




                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading(__('No Services Found'))
            ->emptyStateDescription(__('Try creating a new service.'))
            ->emptyStateIcon('icon-washing')
            ->striped()
            ->heading(__('Services'))
            ->description(__('This is the services information.'))
            ->modifyQueryUsing(function (Builder $query) {
                return $query->latest('created_at');
            })
            ->columns([
                ImageColumn::make('image')
                    ->label(__('image'))
                    ->circular(),
                TextColumn::make('name_' . app()->getLocale())
                    ->searchable()
                    ->default('N/A')
                    ->label(__('title_' . app()->getLocale())),

                TextColumn::make('desc_' . app()->getLocale())
                    ->searchable()
                    ->label(__('desc_' . app()->getLocale()))
                    ->wrap()
                    ->default('N/A')
                    ->html()
                    ->words(50),

                TextColumn::make('price')
                    ->label(__('price'))
                    ->money('EGP')
                    ->sortable()
                    ->searchable(),
                // ->toggleable(isToggledHiddenByDefault: true),

                ToggleColumn::make('is_available')
                    ->label(__('Is Available')),


                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                // TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),

                ]),
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
            'view' => Pages\ViewService::route('/{record}'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make(__('Service Information'))
                    ->description(__('This is the main information about the service.'))
                    ->collapsible(true)

                    ->schema([
                        ImageEntry::make('image')
                            ->label(__('image')),





                        TextEntry::make('name_' . app()->getLocale())
                            ->default('N/A')
                            ->label(__('Name')),

                        TextEntry::make('price')

                            ->money('EGP')
                            ->default(0)
                            ->label(__('price')),



                        TextEntry::make('desc_' . app()->getLocale())
                            ->default('N/A')
                            ->columnSpanFull()
                            ->label(__('desc_' . app()->getLocale()))
                            ->lineClamp(2)
                            ->default('N/A'),

                    ])->columns(2)







            ]);
    }

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\EditService::class,
            Pages\ViewService::class,
        ]);
    }
}
