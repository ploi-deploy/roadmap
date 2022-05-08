<?php

namespace App\Http\Livewire\Welcome;

use App\Models\Item;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Filament\Tables;

class RecentItems extends Component implements HasTable
{
    use InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return Item::query()->limit(10)->latest();
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\TextColumn::make('total_votes')->label('Votes')->sortable(),
            Tables\Columns\TextColumn::make('board.project.title')->label('Project'),
            Tables\Columns\TextColumn::make('board.title'),
        ];
    }

    public function render()
    {
        return view('livewire.welcome.recent-items');
    }
}