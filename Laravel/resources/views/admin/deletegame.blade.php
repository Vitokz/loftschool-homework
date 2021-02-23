
    <div>
    <form action="{{route('deletegameprocess')}}" method="post">
        @csrf
        <div class="form-group">
        <input type="hidden" name="id" value="{{$id}}">
        </div>
        <button type="submit" class="btn btn-primary btn-block enter-btn">Удалить товар</button>
    </form>
    <a href="{{route('main')}}">Отмена</a>
    </div>

