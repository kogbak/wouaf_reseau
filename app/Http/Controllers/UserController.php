<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Illuminate\Support\Facades\Hash;
use Str;

use Illuminate\Validation\Rules\Password;
use App\Models\Message;
use App\Models\User;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function moncompte()
    {
        $user = Auth::user();
        return view('user/moncompte', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $messages = Message::where('user_id', '=', $user->id)->with('comments.user')->latest()->paginate(2);

        return view('user.profil', compact('user', 'messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modifier()
    {
        $user = Auth::user();
        return view('user/modifinfos', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) // j'ai enlever l'id
    {


        $request->validate([
            'nom' => 'required|max:30',
            'prenom' => 'required|max:30',
            'email' => 'required|max:40',

        ]);

        $user = Auth::user(); // on recupere le user connecté

        if ($request['image']) {
            $user->image = uploadImage($request);
        }

        $user->nom = $request['nom'];
        $user->prenom = $request['prenom'];
        $user->email = $request['email'];

        $user->save();
        return redirect()->route('moncompte')->with('message', 'Le compte a bien été modifié');
    }

    public function modifiermotdepasse(Request $request)
    {
        $request->validate([
            // 'token' => 'required',
            'password' => 'required',    //mot de passe actuel
            'new_password' => ['required', 'confirmed', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()]
        ]);

        $user = Auth::user();
        //  $user->password = $request['token'];
        if (!Hash::check($request['password'], $user->password)) { // si mdp et different du mdp acuel alors erreur sinon on continue dans le else

            return redirect()->back()->withErrors(['erreur' => 'erreur mot de passe actuel']);
        } else {

            if ($request['password'] == $request['new_password']) { // si mdp et pareille que le nouveau mdp  alors erreur sinon on continue dans le else

                return redirect()->back()->withErrors(['erreur' => 'le mot de passe actuel et identique au nouveau mot de passe']);
            } else

                $user->password = Hash::make($request['new_password']);
            $user->save();
            // ->setRememberToken(Str::random(60));
            return redirect()->route('moncompte')->with('message', 'Le mot de passe a bien été modifié');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
