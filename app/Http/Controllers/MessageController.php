<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Auth;
use App\Models\User;


class MessageController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'required|max:500',
            'tags' => 'required|max:40',

        ]);

        $user = Auth::user(); // on recupere le user connecté

        $message = new Message;
        
        if ($request['image']) {
            $message->image = uploadImage($request);
        }

        $message->message = $request['message'];
        $message->tags = $request['tags'];
        $message->user_id = $user->id;
        $message->save();
        return redirect()->route('home')->with('message', 'Le message a bien été envoyé');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, User $user)
    {

        $request->validate([
            'search' => 'required|max:30',

        ]);
        $recherche = $request['search'];
        $messages =  Message::where('message', 'like', "%$recherche%")->where('tags', 'like', "%$recherche%")->with('user', 'comments.user')->latest()->paginate(2);
        return view('search', compact('messages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)

    {
        $this->authorize('update', $message);
        // $this->authorize('update-post', $message); cela vien du gate dans authserviceprovider.php
        return view('user/modifiermessage', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {

        $request->validate([
            'message' => 'required|max:500',
        
            'tags' => 'max:40'
        ]);
        if ($request['image']) {
            $message->image = uploadImage($request);
        }

        $message->message = $request['message'];
     
        $message->tags = $request['tags'];
        $message->save();
        return redirect()->route('home')->with('message', 'Le message a bien était modifier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $this->authorize('delete', $message);
        $message->delete();
        return redirect()->route('home')->with('message', 'Le message a bien était supprimer');
    }
}
