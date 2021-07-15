<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
    public function store (Request $request) {

        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {
                //
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1014',
                ]);
                $extension = $request->image->extension();
                $request->image->storeAs('app/public', $validated['name'].".".$extension);
                $url = Storage::url("app/public/".$validated['name'].".".$extension);
                $file = File::create([
                   'name' => $validated['name'],
                    'url' => $url,
                ]);
                Session::flash('success', "Success!");
                return \Redirect::back();
            }
        }
        abort(500, 'Could not upload image :(');
    }

    public function viewUploads () {
        $images = File::all();
        return view('view_uploads')->with('images', $images);
    }

    public function viewUploads2 () {
        $images = File::all();
        return view('candidate-view')->with('images', $images);
    }

    
}