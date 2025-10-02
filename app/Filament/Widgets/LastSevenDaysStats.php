<?php

namespace App\Filament\Widgets;

use App\Models\Property;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LastSevenDaysStats extends StatsOverviewWidget
{
    protected int|array|null $columns = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Last 7 days new properties', Property::where('created_at', '>', now()->subDays(7)->endOfDay())->count()),
            Stat::make('Last 7 days new users', User::where('created_at', '>', now()->subDays(7)->endOfDay())->count()),
        ];
    }
}
