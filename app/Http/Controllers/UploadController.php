<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    //
    public function image(Request $request)
    {
        // return response(dd($request->all()));
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $files = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = rand(1, 100) . '_' . time() . '.' . $image->extension();
                $image->move(public_path('imgs/upload'), $imageName);
                $files[] = $imageName;
            }
        }
        // Save filename to Database.
        foreach ($files as $name) {
            DB::table('image')->insert(['path' => 'imgs/upload/' . $name]);
        }

        return response()->json($files, 200);
    }

    public function image_show()
    {
        $data = DB::table('image')->select(['id', 'path'])->orderByDesc('id')->get();
        return response()->json($data, 200);
    }
}
