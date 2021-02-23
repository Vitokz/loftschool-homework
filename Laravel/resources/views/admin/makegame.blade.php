
    <form action="{{ route('makegame') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Создание нового товара</p>
        <div class="form-group">
            <label>namePrd</label>
            <input type="text" name="namePrd" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>category</label>
            <input type="text" name="category" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>price</label>
            <input type="number" name="price" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>img</label>
            <input type="file" name="img" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>Описание</label>
            <input type="text" name="text" class="form-control p_input">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Make</button>
        </div>
    </form>
    <br>
    <a href="{{asset('main')}}">На главную</a>

