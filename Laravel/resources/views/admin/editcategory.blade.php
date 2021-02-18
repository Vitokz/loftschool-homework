@extends('layouts.template')
@section('main-content')
<form action="{{route('editcategoryprocess')}}" method="post" >
    @csrf
    <p>Редактирование категории</p>
    <input type="hidden" name="id" value="{{$categoryinfo['id']}}">
    <div class="form-group">
        <label>namecategory</label>
        <input type="text" name="namecategory" class="form-control p_input" value="{{$categoryinfo['namecategory']}}">
    </div>

    <div class="form-group">
        <label>описание</label>
        <input type="text" name="text" class="form-control p_input" value="{{$categoryinfo['text']}}">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-block enter-btn">Edit</button>
    </div>

    <a href="{{asset('main')}}">На главную</a>
</form>
@endsection
