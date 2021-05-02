<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;

class ArticelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store()
    {
        $res1 = $this->post('/api/article', [
            'title' => 'hello',
            'ctx' => 'ccc',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
        ]);
        $res1->assertSuccessful();
        Article::factory()->count(1)->create();
    }

    public function test_update()
    {
        $res1 = $this->put('/api/article/1', [
            'title' => 'update test',
            'ctx' => 'updatetest',
            'ctx_html' => '<p>abc<iframe//src=jAva&Tab;script:alert(3)>def</p>',
        ]);
        $res1->assertSuccessful();

        $res2 = $this->put('/api/article/1', [
            'title' => 'fail test',
        ]);
        $res2->assertStatus(302);

        $res2 = $this->put('/api/article/999999', [
            'title' => 'fail test',
            'ctx' => 'fail',
            'ctx_html' => '123',
        ]);
        $res2->assertStatus(500);

    }

    public function test_show()
    {
        $res1 = $this->get('api/article/13');
        $res1->assertStatus(200);

        $res1 = $this->get('api/article/1');
        $res1->assertStatus(200)->assertSee('update');
    }

    public function test_index()
    {
        $res = $this->get('api/article');
        $res->assertSuccessful();
        //$data = $res->getOriginalContent();
    }

    public function test_destroy()
    {
        $res = $this->delete('api/article/9999');
        $res->assertSuccessful();
    }
}
