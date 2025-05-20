<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Курсы')
                ->icon('journal')
                ->route('platform.courses'),
            Menu::make('Роли')
                ->icon('gear')
                ->route('platform.systems.roles'),
            Menu::make('Блоки')
                ->icon('boxes')
                ->route('platform.blocks'),
            Menu::make('Уроки')
                ->icon('journal-bookmark')
                ->route('platform.lessons'),
            Menu::make('Группы')
                ->icon('people')
                ->route('platform.groups'),
            Menu::make('Статистика')
                ->icon('pie-chart')
                ->route('platform.statistics'),
            // Menu::make('Тесты')
            //     ->icon('clipboard2-minus')
            //     ->route('platform.tests'),
            // Menu::make('Вопросы теста')
            //     ->icon('question-square')
            //     ->route('platform.tests-question')
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
