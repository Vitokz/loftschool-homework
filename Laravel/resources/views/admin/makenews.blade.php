@extends('layouts.template')
@section('main-content')
    <form action="{{ route('makenews') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p>Создание нового товара</p>
        <div class="form-group">
            <label>Название новости</label>
            <input type="text" name="namenews" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>Описание новости</label>
            <input type="text" name="text" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>img</label>
            <input type="file" name="img" class="form-control p_input">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Make</button>
        </div>
    </form>
    <br>
    <a href="{{asset('main')}}">На главную</a>
@endsection
