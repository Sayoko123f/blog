<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $res = Article::select('id', 'title', 'created_at')->paginate();
        /*
        SELECT REGEXP_REPLACE(`ctx_md`,'<(?!br).+?>','') FROM `article`
*/
        return response()->json($res);
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
        $request->validate([
            'title' => 'required',
            'ctx_md' => 'required',
            'ctx_html' => 'required',
        ]);
        $item = new Article();
        $item->title = $request->input('title');
        $item->ctx_md = $request->input('ctx_md');

        // HTMLPurifier
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('HTML.DefinitionID', 'article');
        $config->set('HTML.DefinitionRev', 1);
        $config->set('Cache.DefinitionImpl', null);
        $config->set('HTML.Allowed', 'p,ul,ol,li,h1,h2,h3,h4,h5,h6,span,br,em,strong,del,ul,li');
        $purifier = new \HTMLPurifier($config);
        $item->ctx_html = $purifier->purify($request->input('ctx_html'));
        // $item->ctx_html  = \Purifier::clean($request->input('ctx_html'));
        $item->save();
        // try {
        //     $item->saveOrFail();
        // } catch (\Exception $e) {
        //     echo $e->getMessage();
        // }
        return response(strval($item->ctx_html), 200);
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
        $res = Article::find($id);
        return response()->json($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        
        $request->validate([
            'title' => 'required',
            'ctx' => 'required',
            'ctx_html' => 'required',
        ]);
        $item = Article::find($id);
        $item->title = $request->input('title');
        $item->ctx_md = $request->input('ctx');

        // HTMLPurifier
        $item->ctx_html  = \Purifier::clean($request->input('ctx_html'));
        $item->save();
        return response('ok', 200);
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
        Article::destroy($id);
        return response('ok', 200);
    }
}
