<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Http\UploadedFile;

class UploadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_image()
    {
        $img = UploadedFile::fake()->image('test.png');
        $res = $this->post('/api/upload/image',['image'=>$img]);
        $res->assertSuccessful();
    }
}
