<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['home']);
        $this->middleware('guest')->only(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('index');
    }

    public function home()
    {
        // recuperer liste message et envoyer a la view

        $messages = Message::with('user', 'comments.user')->latest()->paginate(2);
        return view('home', ['messages' => $messages]); // 'message = le nom de la variable quon va utilisé dans la view , $message = ce quon a recuperer dans la db et qu'on a asigner a la variable $message
    }
}
