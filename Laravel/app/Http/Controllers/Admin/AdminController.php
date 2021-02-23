<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\MainController;
use App\Models\Category;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private $sideNews;
    private $categories;
    private $user;



    use UploadTrait;

    //products
    public function productlist()
    {
        $products = Product::get()->toArray();
        return view('admin/productlist', ['products' => $products]);
    }

    public function makegame()
    {
        return view('admin/makegame');
    }
    public function process_makegame(Request $request)
    {

        $request->validate([
            'namePrd' => 'required',
            'category' => 'required',
            'price' => 'required',
            'img' => 'required',
            'text' => 'required'
        ]);

        $name = '';
        if ($request->has('img')) {
            $image = $request->file('img');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product = Product::create([
            'namePrd' => $request->input('namePrd'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'img' => $name,
            'text' => $request->input('text'),
        ]);
        return redirect()->route('admin');
    }


    public function editgame($id)
    {
        $user = Product::find($id);
        return view('admin/editgame',['product' => $user]);

    }
    public function process_editgame(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'namePrd' => 'required',
            'category' => 'required',
            'image' => 'required',
            'price' => 'required',
            'text' => 'required'
        ]);

        $name = $request->input('img');

        if ($request->has('image')) {
            $image = $request->file('image');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product = Product::find($request->input('id'));
        $product->namePrd = $request->input('namePrd');
        $product->category = $request->input('category');
        $product->price = $request->input('price');
        $product->img = $name;
        $product->text = $request->input('text');
        $product->save();
        return redirect()->route('productlist');
    }


    public function deletegame($id)
    {
        return view('admin/deletegame', [ 'id' => $id]);
    }
    public function process_deletegame(Request $request)
    {
        $id = $request->input('id');
        $delete = Product::find($id);
        if ($delete !== null) {
            $delete->delete();
        }
        return redirect()->route('productlist');
    }

    //categories
    public function categorylist()
    {
        $categories=Category::get()->toArray();
        return view('admin/categorylist',['categories'=>$categories]);
    }
    public function makecategory()
    {
        return view('admin/makecategory', ['categories' => $this->categories, 'sidenews' => $this->sideNews]);
    }

    public function process_makecategory(Request $request)
    {
        $request->validate([
            'namecategory' => 'required',
            'text' => 'required',
        ]);


        $product = Category::create([
            'namecategory' => $request->input('namecategory'),
            'text' => $request->input('text'),
        ]);
        return redirect()->route('categorylist');
    }


    public function editcategory($id)
    {
        $category = Category::where('id', '=', $id)->first();
        return view('admin/editcategory', ['categoryinfo' => $category]);
    }

    public function process_editcategory(Request $request)
    {
        $request->validate([
            'namecategory' => 'required',
            'text' => 'required'
        ]);

        $category = Category::find($request->input('id'));
        $category->namecategory = $request->input('namecategory');
        $category->text = $request->input('text');
        $category->save();
        return redirect()->route('main');
    }


    public function deletecategory($id)
    {
        return view('admin/deletecategory', ['category' => $id]);
    }

    public function process_deletecategory(Request $request)
    {
        $category = $request->input('id');
        $delete = Category::where('id', '=', $category)->first();
        if ($delete !== null) {
            $delete->delete();
        }
        return redirect()->route('categorylist');
    }

    //orders
    public function checkOrder()
    {
        $orders = [];
        $all = Order::where('id', '>', 0)
            ->get();

        foreach ($all as $oneOfALl) {
            $orders[] = [
                'userName' => $oneOfALl->userName,
                'userEmail' => $oneOfALl->userEmail,
                'idOrder' => $oneOfALl->idOrder,
                'created_at' => $oneOfALl->created_at
            ];
        }
        return view('admin/checkorders', [ 'orders' => $orders]);
    }

    //news
    public function makeNews()
    {
        return view('admin/makenews');
    }

    public function admin()
    {
        return view('admin/admin');
    }
    //admin
    public function userlist()
    {
        $users=User::get()->toArray();
        return view('admin/userslist',['users'=>$users]);
    }

     public function process_makeAdmin($id)
     {
         $user=User::find($id);
         $user->admin=1;
         $user->save();
         return redirect()->route('userslist');
     }


    public function process_makeNews(Request $request)
    {
        $request->validate([
            'namenews' => 'required',
            'text' => 'required',
            'img' => 'required'
        ]);

        $name = '';
        if ($request->has('img')) {
            $image = $request->file('img');
            $name = Str::slug($request->input('namePrd')) . '_' . time();
            $folder = '/storage/images';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
        }

        $product = News::create([
            'namenews' => $request->input('namenews'),
            'text' => $request->input('text'),
            'img' => $name,
            'date' => date("Y-m-d H:i:s")
        ]);
        return redirect()->route('makenews');
    }

}
