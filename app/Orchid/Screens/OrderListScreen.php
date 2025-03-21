<?php

namespace App\Orchid\Screens;
use App\Models\Order;
use Orchid\Screen\Screen;
use App\Orchid\Layouts\OrderListLayout;

class OrderListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'orders'=>Order::paginate()

        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Все заказы || Общая стоимость заказов: '. Order::getTotalPriceOfAllOrders(). "$";
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
    public function layout(): iterable
    {
        return [

            OrderListLayout::class
        ];
    }
}
