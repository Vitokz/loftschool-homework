
<div>
    <form action="{{route('editprocess')}}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Редактирование товара</p>
        <input type="hidden" name="id" value="{{$product['id']}}">
        <input type="hidden" name="img" value="{{$product['img']}}">
        <div class="form-group">
            <label>namePrd</label>
            <input type="text" name="namePrd" class="form-control p_input" value="{{$product['namePrd']}}">
        </div>

        <div class="form-group">
            <label>category</label>
            <input type="text" name="category" class="form-control p_input" value="{{$product['category']}}">
        </div>

        <div class="form-group">
            <label>price</label>
            <input type="number" name="price" class="form-control p_input" value="{{$product['price']}}">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control p_input" >
        </div>

        <div class="form-group">
            <label>Описание</label>
            <input type="text" name="text" class="form-control p_input" value="{{$product['text']}}">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Edit</button>
        </div>
    </form>
</div>

