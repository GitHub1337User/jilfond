<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Order;
use Orchid\Screen\Actions\Link;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [

        TD::make('id', 'Номер заказа'),

        TD::make('created_at', 'Created'),
     
        TD::make('Действия')->render(function (Order $order) {
            return Link::make("Просмотр")
                ->route('platform.order.edit', $order)->icon('bs.eye');
        }),
        ];
    }
}
