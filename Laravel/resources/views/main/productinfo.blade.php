@extends('layouts.template')
@section('main-content')
    <div class="main-content">
        @php
            $data=auth()->user();
        @endphp
        <div class="content-top">
            <div class="content-top__text">Купить игры неборого без регистрации смс с торента, получить компкт диск, скачать Steam игры после оплаты</div>
            <div class="image-container"><img src="{{asset('img/slider.png')}}" alt="Image" class="image-main"></div>
        </div>
        <div class="content-middle">
            <div class="content-head__container">
                <div class="content-head__title-wrap">
                    <div class="content-head__title-wrap__title bcg-title">{{$product->namePrd}}</div><br>
                    @if($data !== null)
                        @if($data['admin']==1)
                            <a href="{{route('editegame',['id'=>$product->id])}}">Редактировать товар</a>
                        @endif
                    @endif
                    @if($data !== null)
                        @if($data['admin']==1)
                            <a href="{{route('deletegame',['id'=>$product->id])}}">Удалить товар</a>
                        @endif
                    @endif
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
                <div class="product-container">
                    <div class="product-container__image-wrap"><img src="{{asset('storage/storage/images/'. $product['img'].'.jpg')}}" class="image-wrap__image-product"></div>
                    <div class="product-container__content-text">
                        <div class="product-container__content-text__title">{{$product->namePrd}}</div>
                        <div class="product-container__content-text__price">
                            <div class="product-container__content-text__price__value">
                                Цена: <b>{{$product->price}}</b>
                                руб
                                @if($data !== null)
                            </div><a href="{{route('buy',['name'=>$data->name,'email'=>$data->email,'id'=>$product['id']])}}" class="btn btn-blue">Купить</a>
                                 @endif
                                @if($data === null)
                                   </div><a href="{{route('login')}}" class="btn btn-blue">Купить</a>
                                @endif
                        </div>
                        <div class="product-container__content-text__description">
                            <p>{{$product->text}}</p>
                        </div>
                    </div>
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
                        <div class="products-columns__item__description"><span class="products-price">{{$game['price']}}руб</span><a href="{{route('productnfo',['product'=>$game['namePrd']])}}" class="btn btn-blue">Купить</a></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
