@extends('layouts.template')
@section('main-content')
    <div class="main-content">
        <div class="content-top">
            <h3 class="title">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</h3>
            <div class="slider"><img src="{{asset('/img/slider.png')}}" alt="Image" class="image-main"></div>
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
                <div class="news-list__container">
                    @foreach($news as $new)
                    <div class="news-list__item">
                        <div class="news-list__item__thumbnail"><img src="{{asset('storage/storage/images/'. $new['img'].'.jpg')}}"></div>
                        <div class="news-list__item__content">
                            <div class="news-list__item__content__news-title">{{$new['namenews']}}</div>
                            <div class="news-list__item__content__news-date">{{$new['date']}}</div>
                            <div class="news-list__item__content__news-content">
                                {{$new['text']}}
                            </div>
                        </div>
                        <div class="news-list__item__content__news-btn-wrap"><a href="{{route('newsinfo',['news'=>$new['namenews']])}}" class="btn btn-brown">Подробнее</a></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="content-bottom"></div>
    </div>
@endsection
