<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    private $categories;
    private $sideNews;

    public function __construct(){
        $this->categories=self::categoryPrint();
        $this->sideNews=self::newsPrint(5);
    }

    //main
    public function goMain(){
        return redirect()->route('main');
    }
    public function goMainGet()
    {
        //$games=self::gamePrint();
        $games=[];
        $product=Product::paginate(3);
        foreach ($product as $item){
            $games[]=[
                'namePrd'=>$item->namePrd,
                'price'=>$item->price,
                'img'=>$item->img,
                'text'=>$item->text
            ];
        }

        return view('main/main',['categories'=> $this->categories, 'games'=>$games,'sidenews'=>$this->sideNews,'product'=>$product]);
    }

    public function goMyOrders()
    {
        $data=auth()->user();
        if($data !== null){
            $orders=[];
            $product=Product::paginate(5);
            foreach ($product as $item){
                $orders[]=[
                    'namePrd'=>$item->namePrd,
                    'price'=>$item->price,
                    'img'=>$item->img,
                    'text'=>$item->text,
                    'created_at'=>$item->created_at
                ];
            }
            return view('main/myorders',['categories'=> $this->categories,'sidenews'=>$this->sideNews,'order'=>$orders, 'product'=>$product]);
        }else{
            return redirect()->route('login');
        }
    }

    public function goMarketInfo()
    {
        return view('main/marketinfo',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }

    //Categories
    public function goCategory($name)
    {
        $products=self::categoryProductsPrint($name);
        return view('categories/categories',['categories'=> $this->categories,'products'=>$products,'categoryname'=>$name,'sidenews'=>$this->sideNews]);
    }

    //product
    public function productInfo($product)
    {
        $productInfo=Product::where('namePrd','=',$product)->first();
        $foot=self::gamePrint(3);
        return view('main/productinfo',['categories'=> $this->categories,'product'=>$productInfo,'foot'=>$foot,'sidenews'=>$this->sideNews]);
    }

    //news
    public function news()
    {
       $news=self::newsPrint();
       return view('main/news',['categories'=> $this->categories,'news'=>$news,'sidenews'=>$this->sideNews]);
    }

    public function newsInfo($news)
    {
        $news=News::where('namenews','=',$news)->first();
        $foot=self::gamePrint(3);
        return view('main/newsinfo',['categories'=> $this->categories,'news'=>$news,'foot'=>$foot,'sidenews'=>$this->sideNews]);
    }

    //buy
    public function buy($name,$email,$id)
    {

        if(auth()->user()){
            $user=['name'=>$name,'email'=>$email,'id'=>$id];
            return view('main/buy',['categories'=> $this->categories,'sidenews'=>$this->sideNews,'user'=>$user]);
        }else{
            return redirect()->route('login');
        }


    }
    public function buyProcess(Request $request)
    {
        Mail::to('vitalik-kaziev@mail.ru')->send(new \App\Mail\Order($request->input('id'),$request->input('email')));
        $create=Order::create([
            'userName'=>$request->input('name'),
            'userEmail'=>$request->input('email'),
            'idOrder'=>$request->input('id')
        ]);
        return redirect()->route('main');
    }

    //Прочие вспомогательные функции
    public static function categoryPrint()
    {
        $categories=[];
        $all = Category::where('id','>',1)
            ->get();

        foreach ($all as $category){
            $categories[]=[
                'namecategory'=>$category->namecategory
                ];
        }
        return $categories;
    }
    public static function categoryProductsPrint($name)
    {
        $products=[];
        $all = Product::where('category','=',$name)
            ->get();

        foreach ($all as $product){
            $products[]=[
                'namePrd'=>$product->namePrd,
                'price'=>$product->price,
                'img'=>$product->img,
                'text'=>$product->text
            ];
        }
        return $products;
    }
    public static function gamePrint($limit=500)
    {
        $games=[];
        $all = Product::where('id','>',0)
            ->limit($limit)
            ->get();

        foreach ($all as $game){
            $games[]=[
                'id'=>$game->id,
                'namePrd'=>$game->namePrd,
                'price'=>$game->price,
                'img'=>$game->img,
                'text'=>$game->text
            ];
        }
        return $games;
    }
    public static function newsPrint($limit=500)
    {
        $news=[];
        $all = News::where('id','>',0)
            ->limit($limit)
            ->get();

        foreach ($all as $new){
            $news[]=[
                'namenews'=>$new->namenews,
                'text'=>$new->text,
                'img'=>$new->img,
                'date'=>$new->date
            ];
        }
        return $news;
    }
}
