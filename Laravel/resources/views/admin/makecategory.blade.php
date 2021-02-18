@extends('layouts.template')
@section('main-content')
    <form action="{{ route('makecategory') }}" method="post" >
        @csrf
        <p>Создание новой категории</p>
        <div class="form-group">
            <label>namecategory</label>
            <input type="text" name="namecategory" class="form-control p_input">
        </div>

        <div class="form-group">
            <label>описание</label>
            <input type="text" name="text" class="form-control p_input">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Make</button>
        </div>

    <a href="{{asset('main')}}">На главную</a>
@endsection
