<table>
    <tr>Список категорий</tr>
    @foreach($categories as $category)
        <tr>
            <td>ID:{{$category['id']}}</td>
            <td>Имя:{{$category['namecategory']}}|</td>
            <td>Описание:{{$category['text']}}|</td>
            <td><a href="{{route('editcategory',['id'=>$category['id']])}}">редактировать</a></td>
            <td><a href="{{route('deletecategory',['id'=>$category['id']])}}">удалить</a></td>
        </tr>
    @endforeach
</table>
