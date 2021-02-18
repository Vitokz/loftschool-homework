<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\MainController;
use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private $sideNews;
    private $categories;
    private $user;
    public function __construct()
    {
        $this->user=auth()->user();
        $this->sideNews=MainController::newsPrint(5);
        $this->categories=MainController::categoryPrint();
        //$this->middleware('guest')->except('logout');
    }

    use UploadTrait;
    //products
    public function makegame()
    {
        return view('admin/makegame',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }

    public function process_makegame(Request $request)
    {

        $request->validate([
            'namePrd' => 'required',
            'category' => 'required',
            'price'=>'required',
            'img'=>'required',
            'text'=>'required'
        ]);

        $name='';
        if ($request->has('img')) {
            $image = $request->file('img');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product=Product::create([
            'namePrd' => $request->input('namePrd'),
            'category'=> $request->input('category'),
            'price'=> $request->input('price'),
            'img'=>$name,
            'text'=>$request->input('text'),
        ]);
        return redirect()->route('makegame');
    }


    public function editgame($id)
    {
       $user=Product::find($id);
        return view('admin/editgame',['categories'=>$this->categories,'sidenews'=>$this->sideNews,'product'=>$user]);

    }

    public function process_editgame(Request $request)
    {
       $request->validate([
           'id'=>'required',
           'namePrd' => 'required',
           'category' => 'required',
           'image'=>'required',
           'price'=>'required',
           'text'=>'required'
       ]);

       $name=$request->input('img');

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product=Product::find($request->input('id'));
        $product->namePrd=$request->input('namePrd');
        $product->category=$request->input('category');
        $product->price=$request->input('price');
        $product->img=$name;
        $product->text=$request->input('text');
        $product->save();
        return redirect()->route('main');
    }


    public function deletegame($id)
    {
        return view('admin/deletegame',['categories'=>$this->categories,'sidenews'=>$this->sideNews,'id'=>$id]);
    }

    public function process_deletegame(Request $request)
    {
        $id=$request->input('id');
        $delete=Product::find($id);
        if ($delete !== null) {
            $delete->delete();
        }
        return redirect()->route('main');
    }

    //categories
    public function makecategory()
    {
        return view('admin/makecategory',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }

    public function process_makecategory(Request $request)
    {
        $request->validate([
            'namecategory' => 'required',
            'text' => 'required',
        ]);


        $product=Category::create([
            'namecategory' => $request->input('namecategory'),
            'text'=> $request->input('text'),
        ]);
        return redirect()->route('makecategory');
    }


    public function editcategory($namecategory)
    {
        $category=Category::where('namecategory','=',$namecategory)->first();
        return view('admin/editcategory',['categories'=>$this->categories,'sidenews'=>$this->sideNews,'categoryinfo'=>$category]);
    }

    public function process_editcategory(Request $request)
    {
         $request->validate([
             'namecategory'=>'required',
             'text'=>'required'
         ]);

         $category=Category::find($request->input('id'));
         $category->namecategory=$request->input('namecategory');
         $category->text=$request->input('text');
         $category->save();
         return redirect()->route('main');
    }


    public function deletecategory($namecategory)
    {
        return view('admin/editcategory',['categories'=>$this->categories,'sidenews'=>$this->sideNews,'categoryname'=>$namecategory]);
    }

    public function process_deletecategory(Request $request)
    {
        $namecategory=$request->input('id');
        $delete=Category::where('namecategory','=',$namecategory)->first();
        if ($delete !== null) {
            $delete->delete();
        }
        return redirect()->route('main');
    }

    //orders
    public function checkOrder()
    {
        $orders=[];
        $all = Order::where('id','>',0)
            ->get();

        foreach ($all as $oneOfALl){
            $orders[]=[
                'userName'=>$oneOfALl->userName,
                'userEmail'=>$oneOfALl->userEmail,
                'idOrder'=>$oneOfALl->idOrder,
                'created_at'=>$oneOfALl->created_at
            ];
        }
        return view('admin/checkorders',['categories'=>$this->categories,'sidenews'=>$this->sideNews,'orders'=>$orders]);
    }
    //news
    public function makeNews()
    {
        return view('admin/makenews',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }
    //admin
    /**
    public function makeAdmin()
    {

    }

    public function process_makeAdmin(Request $request)
    {

    }
     */

    public function process_makeNews(Request $request)
    {
        $request->validate([
            'namenews' => 'required',
            'text' => 'required',
            'img'=>'required'
        ]);

        $name='';
        if ($request->has('img')) {
            $image = $request->file('img');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product=News::create([
            'namenews' => $request->input('namenews'),
            'text'=> $request->input('text'),
            'img'=>$name,
            'date'=>date("Y-m-d H:i:s")
        ]);
        return redirect()->route('makenews');
    }

}
