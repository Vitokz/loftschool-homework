<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Main\MainController;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    private $sideNews;
    private $categories;
    public function __construct()
    {
        $this->sideNews=MainController::newsPrint(5);
        $this->categories=MainController::categoryPrint();
        $this->middleware('guest')->except('logout');
    }

    public function login_form()
    {
        return view('auth/login',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->except(['_token']);
        $user = User::where('email', $request->email)->first();

        if (auth()->attempt($credentials)) {
            return redirect()->route('main');
        }else{
            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }

    public function register_form()
    {
        return view('auth/register',['categories'=> $this->categories,'sidenews'=>$this->sideNews]);
    }
    public function process_register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => trim($request->input('name')),
            'email' => strtolower($request->input('email')),
            'password' => bcrypt($request->input('password')),
            'admin'=>$request->input('admin')
        ]);

        session()->flash('message', 'Your account is created');

        return redirect()->route('login');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('login');
    }

}
