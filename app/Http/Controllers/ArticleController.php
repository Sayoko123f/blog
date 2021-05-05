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
        $res = Article::select('id', 'title', 'created_at')->orderBy('created_at', 'desc')->paginate(12);
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
        $item->ctx_html = $this->purifyHTML($request->input('ctx_html'));

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
        // $res = Article::find($id);
        $res = Article::select(['id', 'title', 'ctx_html', 'created_at'])->where('id', $id)->get();
        if (!isset($res[0])) {
            return response()->json([], 404);
        }
        return response()->json($res[0]);
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
            'ctx_md' => 'required',
            'ctx_html' => 'required',
        ]);
        $item = Article::find($id);
        $item->title = $request->input('title');
        $item->ctx_md = $request->input('ctx_md');

        // HTMLPurifier
        $item->ctx_html = $this->purifyHTML($request->input('ctx_html'));
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

    private function purifyHTML($dirty_html): string
    {
        $config = \HTMLPurifier_Config::createDefault();
        // $config->set('HTML.DefinitionID', 'article');
        // $config->set('HTML.DefinitionRev', 2);
        // $config->set('Cache.DefinitionImpl', null); for test
        $config->set('HTML.Allowed', 'p,ul,ol,li,h1,h2,h3,h4,h5,h6,span,br,em,strong,del,ol,ul,li,blockquote,dl,dt,dd,code[data-language|data-backticks],pre[class],hr,table,thead,tr,th[align],td[align],tbody,a[title|href],img[src|alt|title]');
        $def = $config->getHTMLDefinition(true);
        $def->addAttribute('code', 'data-language', 'Text');
        $def->addAttribute('code', 'data-backticks', 'Text');
        $purifier = new \HTMLPurifier($config);
        return $purifier->purify($dirty_html);
    }
}
