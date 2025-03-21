<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\Order;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;

class OrderEditScreen extends Screen
{
     /**
     * @var Order
     */
    public $order;

    /**
     * Query data.
     *
     * @param Order $order
     *
     * @return array
     */
    public function query(Order $order): iterable
    {
        return [

            'order'=>$order
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        // return $this->order->exists ? 'Просмотр заказа' : 'Создание нового заказа';
        return "Просмотр заказа";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

        Button::make('Закрыть заказ')
            ->icon('trash')
            ->method('remove')
            ->canSee($this->order->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::legend('order', [
                Sight::make('id','Номер заказа'),
                Sight::make('products','Товары')->render(function(Order $order){
                   return $order->getProductNames();
                }),
                Sight::make('total_price','Общая стоимость')->render(function(Order $order){
                    return $order->getTotalPrice() ."$";
                 }),
            
                Sight::make('created_at','Дата создания'),
                
                // Sight::make('updated_at'),
            ]),

        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove()
    {
        $this->order->delete();

        Alert::info('Вы успешно закрыли заказ');

        return redirect()->route('platform.order.list');
    }
}
