<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;
use App\Models\Category;
use Filament\Tables\Filters\SelectFilter;
class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->live(debounce: 500)->afterStateUpdated(function ($state, $set) { $set('slug', Str::slug($state)); })->required(),
                TextInput::make('slug')->required()->readonly(),
                TextInput::make('description')->required(),
                TextInput::make('price')->required()->minValue(0),
                TextInput::make('stock')->required()->integer(),
                // FileUpload::make('image')->image()->nullable(),
                Hidden::make('user_id')->default(auth()->id()),
                Select::make('category_id')->options(Category::all()->pluck('name', 'id'))->required()->searchable(),
                Select::make('tags')->relationship('tags', 'name')->multiple()->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('price')->money('INR')->sortable(),
                TextColumn::make('stock'),
                TextColumn::make('category.name')->searchable(),
            ])
            ->filters([
                SelectFilter::make('category')  ->relationship('category', 'name')
                ->options(Category::all()->pluck('name', 'id'))
                ->label('Filter by Category'),

                SelectFilter::make('price')->options([
                    'low' => 'Below ₹10',
                    'medium' => '₹50 - ₹1500',
                    'high' => 'Above ₹15000',
                ])->label('Filter by Price'),
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
