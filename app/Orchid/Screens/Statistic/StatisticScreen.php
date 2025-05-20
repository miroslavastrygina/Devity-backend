<?php

namespace App\Orchid\Screens\Statistic;

use Orchid\Screen\Screen;
use App\Models\GroupMember;
use App\Models\TestUserResult;
use Orchid\Support\Facades\Layout;
use Illuminate\Support\Facades\Auth;
use App\Orchid\Layouts\Charts\ChartOne;
use App\Orchid\Layouts\Charts\ChartTwo;
use App\Orchid\Layouts\Charts\ChartThree;

class StatisticScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        // Получаем все результаты
        $results = TestUserResult::all();

        // Сортируем по дате
        $sorted = $results->sortBy('created_at');

        // Массивы данных для line-графика
        $labels = $sorted->map(function ($item, $key) {
            return $item->created_at->format('d.m.Y') . ' #' . $key;
        })->toArray();
        $avgPercent = $sorted->pluck('avg_percent')->map(fn($val) => (float) $val)->toArray();
        $avgPoints = $sorted->pluck('avg_points')->map(fn($val) => (float) $val)->toArray();


        // Распределение по проценту для pie-графика
        $lowPercent = $results->where('avg_percent', '<', 30)->count();
        $midPercent = $results->whereBetween('avg_percent', [30, 70])->count();
        $highPercent = $results->where('avg_percent', '>', 70)->count();

        $attemptsByDate = collect($results)
            ->groupBy(fn($item) => date('d.m.Y', strtotime($item['created_at'])))
            ->map(fn($group) => count($group))
            ->toArray();

        // Подготавливаем данные для графика
        $attemptsChart = [
            [
                'name' => 'Количество попыток',
                'values' => array_values($attemptsByDate),
                'labels' => array_keys($attemptsByDate),
            ],
        ];

        return [
            'dataset' => [
                [
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                    'name'  => 'Some Data',
                    'values' => [25, 40, 30, 35, 8, 52, 17, -4],
                ],
                [
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                    'name'  => 'Another Set',
                    'values' => [25, 50, -10, 15, 18, 32, 27, 14],
                ],
                [
                    'labels' => ['12am-3am', '3am-6am', '6am-9am', '9am-12pm', '12pm-3pm', '3pm-6pm', '6pm-9pm'],
                    'name'  => 'Yet Another',
                    'values' => [15, 20, -3, -15, 58, 12, -17, 37],
                ],
            ],
            'statistic' => [
                [
                    'labels' => $labels,
                    'name' => 'Сред. процент',
                    'values' => $avgPercent,
                ],
                [
                    'labels' => $labels,
                    'name' => 'Сред. баллы',
                    'values' => $avgPoints,
                ],
            ],
            'percent_pie' => [
                [
                    'labels' => ['<30%', '30-70%', '>70%'],
                    'values' => [$lowPercent, $midPercent, $highPercent],
                ]
            ],
            'attempts_chart' => $attemptsChart,
        ];
    }


    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'StatisticScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            ChartOne::make('statistic')
                ->title('Средние показатели'),
            Layout::split([
                ChartTwo::make('percent_pie')
                    ->title('Распределение по среднему проценту'),
                ChartThree::make('attempts_chart')
                    ->title('График активности по датам ')
            ]),
        ];
    }
}
