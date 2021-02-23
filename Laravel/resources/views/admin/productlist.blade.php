<table>
        <tr>Список товаров</tr>
        @foreach($products as $product)
                <tr>
                    <td><img src="{{asset('storage/storage/images/'. $product['img'].'.jpg')}}" alt="Preview-image" height="150px" width="250px"></td>
                    <td>ID:{{$product['id']}}</td>
                    <td>Имя:{{$product['namePrd']}}|</td>
                    <td>Категория:{{$product['category']}}|</td>
                    <td>цена:{{$product['price']}}|</td>
                    <td>описание:{{$product['text']}}|</td>
                    <td><a href="{{route('editegame',['id'=>$product['id']])}}">редактировать</a></td>
                    <td><a href="{{route('deletegame',['id'=>$product['id']])}}">удалить</a></td>
                </tr>
        @endforeach
</table>

