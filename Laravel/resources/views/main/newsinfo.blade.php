@extends('layouts.template')
@section('main-content')
<div class="main-content">
    <div class="content-top">
        <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
        <div class="slider"><img src="{{asset('img/slider.png')}}" alt="Image" class="image-main"></div>
    </div>
    <div class="content-middle">
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <div class="content-head__title-wrap__title bcg-title">Новости</div>
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

        <div class="content-main__container">
            <div class="news-block content-text">
                <h3 class="content-text__title">{{$news->namenews}}</h3>
                <img src="{{asset('storage/storage/images/'. $news['img'].'.jpg')}}" alt="Image" class="alignleft img-news">
                <p>{{$news->text}}</p>

            </div>
        </div>


    </div>
    <div class="content-bottom">
        <div class="line"></div>
        <div class="content-head__container">
            <div class="content-head__title-wrap">
                <div class="content-head__title-wrap__title bcg-title">Посмотрите наши товары</div>
            </div>
        </div>
        <div class="content-main__container">
            <div class="products-columns">
                @foreach($foot as $game)
                    <div class="products-columns__item">
                        <div class="products-columns__item__title-product"><a href="{{route('productnfo',['product'=>$game['namePrd']])}}" class="products-columns__item__title-product__link">{{$game['namePrd']}}</a></div>
                        <div class="products-columns__item__thumbnail"><a href="{{route('productnfo',['product'=>$game['namePrd']])}}" class="products-columns__item__thumbnail__link"><img src="{{asset('storage/storage/images/'. $game['img'].'.jpg')}}" alt="Preview-image" class="products-columns__item__thumbnail__img"></a></div>
                        <div class="products-columns__item__description"><span class="products-price">{{$game['price']}}руб</span><a href="#" class="btn btn-blue">Купить</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
