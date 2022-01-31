<?php

/**
 * UploadImage helper
 *
 * @param $request
 *
 */

function uploadImage($request)
{
    $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time() . '.' . $request->image->extension();

    $request->image->move(public_path('images'), $imageName);
    // public/images/file.png

    return $imageName;
}


