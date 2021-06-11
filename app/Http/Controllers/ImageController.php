<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('image')->select(['id', 'path'])->orderByDesc('id')->get();
        return response()->json($data, 200);
    }

    public function destroy($id)
    {
        DB::table('image')->where('id', $id)->delete();
        return response()->json("Destroy $id.", 200);
    }
}
