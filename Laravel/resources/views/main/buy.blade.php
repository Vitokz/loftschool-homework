@extends('layouts.template')
@section('main-content')
    <form method="post" action="{{ route('buyprocess') }}">
        @csrf
        <div class="text-center">
            <input type="hidden" name="name" value="{{$user['name']}}">
            <input type="hidden" name="email" value="{{$user['email']}}">
            <input type="hidden" name="id" value="{{$user['id']}}">
            <button type="submit" class="btn btn-primary btn-block enter-btn">Создать заказ</button>
        </div>
    </form>
    <div><a href="{{route('main')}}">Отмена</a></div>
@endsection
