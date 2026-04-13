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
                ->route('platform.courses')
                ->permission('platform.courses'),
            Menu::make('Блоки')
                ->icon('boxes')
                ->route('platform.blocks')
                ->permission('platform.blocks'),
            Menu::make('Уроки')
                ->icon('journal-bookmark')
                ->route('platform.lessons')
                ->permission('platform.lessons'),
            Menu::make('Группы')
                ->icon('people')
                ->route('platform.groups')
                ->permission('platform.groups'),
            Menu::make('Статистика')
                ->icon('pie-chart')
                ->route('platform.statistics')
                ->permission('platform.statistics'),
            Menu::make('Задания на проверку')
                ->icon('check2-circle')
                ->route('platform.assignment-submissions')
                ->permission('platform.assignment-submissions'),
            Menu::make('Управление')
                ->icon('code')
                ->list([
                    Menu::make('Пользователи')
                        ->icon('heart')
                        ->route('platform.systems.users'),
                    Menu::make('Роли')
                        ->icon('gear')
                        ->route('platform.systems.roles'),
                ])->permission('platform.systems.roles'),
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

            ItemPermission::group("Учитель")
                ->addPermission('platform.groups', 'Группы')
                ->addPermission("platform.statistics", "Статистика")
                ->addPermission("platform.assignment-submissions", "Проверка"),

            ItemPermission::group("Управление")
                ->addPermission('platform.courses', 'Курсы')
                ->addPermission("platform.blocks", "Блоки")
                ->addPermission("platform.lessons", "Уроки")
        ];
    }
}
