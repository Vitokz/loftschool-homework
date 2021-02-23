<div>
    <table>
        <tr>Список заказов</tr>
        @foreach($users as $user)
            <tr>
                <td>ID:{{$user['id']}}</td>
                <td>Имя:{{$user['name']}}</td>
                <td>admin:{{$user['admin']}}</td>
                <td><a href="{{route('makeadmin',['id'=>$user['id']])}}">сделать админом</a></td>
            </tr>
        @endforeach

    </table>
</div>
<a href="{{route('admin')}}">Назад</a>
