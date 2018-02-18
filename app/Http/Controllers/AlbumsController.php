<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
        $albums = Album::with('Photos')->get();
        return view('albums.index')->with('albums', $albums);
    }
    public function create(){
        return view('albums.create');
    }
    public function store(Request $request){
        $this ->validates($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999'
        ]);
        //Get filename with extension
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        //Get filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // get the extension of the file
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        $filenameToStore = $filename.''.time().'.'.$extension;

        $path = $request->file('cover_image')->storeAs('public/albums_covers', $filenameToStore);

        // Create album

        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;

        $album->save();

        return redirect('/albums')->with('success', 'Album Created');



    }
}
