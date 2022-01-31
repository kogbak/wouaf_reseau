<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) // affiche le formulaire des modif donc faire voir la page create
    {
       return view('user/commentaire', compact('id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:500',
         
            'tags' => 'max:40'
        ]);

        $user = Auth::user();
        $commentaire = new Comment;
    

        if ($request['image']) {
            $commentaire->image = uploadImage($request);
        }
        

        $commentaire->content = $request['content'];
 
        $commentaire->tags = $request['tags'];

        $commentaire->user_id = $user->id;
        $commentaire->message_id =$request['messageId'];

        $commentaire->save();
        return redirect()->route('home')->with('message', 'Le commentaire a bien était envoyé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $commentaire)
    {
        $this->authorize('update', $commentaire);
        return view('user/modifiercommentaire', compact('commentaire'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $commentaire)
    {
        $request->validate([
            'commentaire' => 'required|max:500',
         
            'tags' => 'max:40'
        ]);
        if ($request['image']) {
            $commentaire->image = uploadImage($request);
        }
        
        $commentaire->content = $request['commentaire'];
   
        $commentaire->tags = $request['tags'];
        $commentaire->save();
        return redirect()->route('home')->with('message', 'Le commentaire a bien était modifier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $commentaire)

    {
        $this->authorize('delete', $commentaire);
        $commentaire->delete();     
        return redirect()->route('home')->with('message', 'Le commentaire a bien était supprimer');
    }
}
