<?php

namespace Tests\Unit;

use Tests\Unit\LoginTest;
use Tests\TestCase;
use App\Models\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store()
    {
        // log in
        $this->post('/login', LoginTest::CORRECTEMAIL);
        $res1 = $this->post('/api/article', [
            'title' => '測試',
            'ctx_md' => '中文',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
        ]);
        $res1->assertSuccessful();

        $data = array(
            'title' => 'Tags Update Test',
            'ctx_md' => 'ccc',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
            'tags' => array('5456456', '中文標籤', '測試')
        );
        $res2 = $this->post('/api/article', $data);
        $res2->assertStatus(200);

        // Fail Test
        $faildata = array(
            'title' => 'Tags Update Test',
            'ctx_md' => 'ccc',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
            'tags' => 'Fail,&&&\\'
        );
        $res2 = $this->post('/api/article', $faildata);
        $res2->assertStatus(302);
        Article::factory()->count(1)->create();
    }

    public function test_update()
    {
        // log in
        $this->post('/login', LoginTest::CORRECTEMAIL);
        $res1 = $this->put('/api/article/1', [
            'title' => 'update test',
            'ctx_md' => 'updatetest',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
        ]);
        $res1->assertSuccessful();

        $res2 = $this->put('/api/article/1', [
            'title' => 'fail test',
        ]);
        $res2->assertStatus(302);

        $res2 = $this->put('/api/article/999999', [
            'title' => 'fail test',
            'ctx_md' => 'fail',
            'ctx_html' => '123',
        ]);
        $res2->assertStatus(500);
    }

    public function test_show()
    {
        $res1 = $this->get('/api/article/13');
        $res1->assertStatus(200);

        $res1 = $this->get('/api/article/1');
        $res1->assertStatus(200)->assertSee('update');
    }

    public function test_index()
    {
        $res = $this->get('/api/article');
        $res->assertSuccessful();
        //$data = $res->getOriginalContent();
    }

    public function test_destroy()
    {
        // log in
        $this->post('/login', LoginTest::CORRECTEMAIL);
        $res = $this->delete('/api/article/9999');
        $res->assertSuccessful();
    }

    public function test_search()
    {
        $res = $this->get('/api/article?q=3');
        $res->assertStatus(200);
    }
}
