
    <div>
        <table>
            <tr>Список заказов</tr>
            @foreach($orders as $order)
                <tr>
                    <td>Имя:{{$order['userName']}}|</td>
                    <td>Почта:{{$order['userEmail']}}|</td>
                    <td>Код товара:{{$order['idOrder']}}|</td>
                    <td>Время заказа:{{$order['created_at']}}|</td>
                </tr>
            @endforeach

        </table>
    </div>

