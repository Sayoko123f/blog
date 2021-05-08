<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\ArticleTag;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'q' => 'string|max:60',
        ]);
        // Search
        if ($request->has('q')) {
            return $this->search($request);
        }
        // Default
        $res = DB::table('article')->select('article.id', 'article.title', 'article.created_at', 'tmp.tags')->leftJoin(DB::raw("(SELECT `article_id`,GROUP_CONCAT(`tag`) AS tags FROM `article_tag` GROUP BY `article_id`) AS tmp"), 'article.id', '=', 'tmp.article_id')->orderByDesc('created_at')->paginate(12);
        return response()->json($res);
    }

    public function search(Request $request)
    {
        $q = $request->input('q');
        $res = DB::table('article')->select('article.id', 'article.title', 'article.created_at', 'tmp.tags')->leftJoin(DB::raw("(SELECT `article_id`,GROUP_CONCAT(`tag`) AS tags FROM `article_tag` GROUP BY `article_id`) AS tmp"), 'article.id', '=', 'tmp.article_id')->where('article.title', 'like', "%$q%")->orWhere('tmp.tags', 'like', "%$q%")->orderByDesc('created_at')->paginate(12);
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
            'tags' => 'array',
        ]);
        $item = new Article();
        $item->title = $request->input('title');
        $item->ctx_md = $request->input('ctx_md');
        // HTMLPurifier
        $item->ctx_html = $this->purifyHTML($request->input('ctx_html'));
        $item->save();

        // Tags
        if ($request->has('tags')) {
            $this->tagStore($item->id, $request->input('tags'));
        }

        return response('Save', 200);
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

        // Tags
        if ($request->has('tags')) {
            $this->tagDestroy($id);
            $this->tagStore($id, $request->input('tags'));
        }
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
        $this->tagDestroy($id);
        return response('ok', 200);
    }

    public function edit($id)
    {
        // $res = Article::select(['id', 'title', 'ctx_md', 'created_at'])->where('id', $id)->get();
        $res = DB::table('article')->select('article.id', 'article.title', 'article.ctx_md', 'article.created_at', 'tmp.tags')->leftJoin(DB::raw("(SELECT `article_id`,GROUP_CONCAT(`tag`) AS tags FROM `article_tag` GROUP BY `article_id`) AS tmp"), 'article.id', '=', 'tmp.article_id')->where('article.id', '=', $id)->get();
        if (!isset($res[0])) {
            return response()->json([], 404);
        }
        return response()->json($res[0]);
    }

    private function purifyHTML(string $dirty_html): string
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

    // For Tag
    private function tagStore(string $articleId, array $tags)
    {
        foreach ($tags as $tag) {
            // check exists
            $data = ArticleTag::select('id')->where(['tag' => $tag, 'article_id' => $articleId])->get();
            if (count($data) > 0) {
                return response('The tag is exists.');
            }
            $item = new ArticleTag();
            $item->tag = $tag;
            $item->article_id = $articleId;
            $item->save();
        }
        return true;
    }
    /**
     * Remove all tags from the articleId
     */
    private function tagDestroy(string $articleId)
    {
        DB::table('article_tag')->where('article_id', '=', $articleId)->delete();
        return true;
    }
}
