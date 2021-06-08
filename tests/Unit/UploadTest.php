<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Tests\Unit\LoginTest;

class UploadTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_image()
    {
        $this->post('/login', LoginTest::CORRECTEMAIL);
        $img = UploadedFile::fake()->image('test.png');
        $img2 = UploadedFile::fake()->image('test2.png');
        $res = $this->post('/api/upload/image', ['images' => array($img, $img2)]);
        $res->assertSuccessful();
    }
}
