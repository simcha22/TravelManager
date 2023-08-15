<?php

namespace App\Filament\Widgets\Admin;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->description('Registered users in the system')
                ->icon('heroicon-o-user-group')
                ->color('info'),
        ];
    }
}
