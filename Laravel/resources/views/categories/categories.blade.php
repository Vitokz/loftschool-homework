@extends('layouts.template')
@section('main-content')
    @php
        $data=auth()->user();
    @endphp
    <div class="main-content">
        <div class="content-top">
            <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
            <div class="slider"><img src="{{asset('img/slider.png')}}" alt="Image" class="image-main"></div>
        </div>
        <div class="content-middle">
            <div class="content-head__container">
                <div class="content-head__title-wrap">
                    <div class="content-head__title-wrap__title bcg-title">Игры в разделе {{$categoryname}}</div><br>
                </div>
                <div class="content-head__search-block">
                    <div class="search-container">
                        <form class="search-container__form">
                            <input type="text" class="search-container__form__input">
                            <button class="search-container__form__btn">search</button>
                        </form>
                    </div>
                </div>
            </div>

            @foreach($products as $product)
                <div class="content-main__container">
                    <div class="products-category__list">
                        <div class="products-category__list__item">
                            <div class="products-category__list__item__title-product"><a href="{{route('productnfo',['product'=>$product['namePrd']])}}">{{$product['namePrd']}}</a></div>
                            <div class="products-category__list__item__thumbnail"><a href="{{route('productnfo',['product'=>$product['namePrd']])}}" class="products-category__list__item__thumbnail__link"><img src="{{asset('storage/storage/images/'. $product['img'].'.jpg')}}" alt="Preview-image"></a></div>
                            <div class="products-category__list__item__description"><span class="products-price">{{$product['price']}}руб</span><a href="#" class="btn btn-blue">Купить</a></div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection
