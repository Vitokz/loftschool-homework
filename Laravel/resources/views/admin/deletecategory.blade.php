
 <div>
     <form action="{{route('deletecategoryprocess')}}" method="post">
         @csrf
         <div class="form-group">
             <input type="hidden" name="id" value="{{$category}}">
         </div>
         <button type="submit" class="btn btn-primary btn-block enter-btn">Удалить категорию</button>
     </form>
     <a href="{{route('main')}}">Отмена</a>
 </div>

