<?php

namespace Tests\Unit;

use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class LoginTest extends TestCase
{
    private const CORRECTEMAIL = ['email' => 'collect123a@gmail.com', 'password' => '11111111'];
    private const NOTEXISTSEMAIL = ['email' => 'error@error.com', 'password' => '11111111'];

    public function test_login()
    {
        $res1 = $this->get('/islogin');
        $res1->assertStatus(403);
        $res2 = $this->post('/login', self::CORRECTEMAIL);
        $res2->assertStatus(302);
        $res3 = $this->get('/islogin');
        $res3->assertStatus(200);
    }

    public function test_errorLogin()
    {
        // Not exists email
        $res1 = $this->post('/login', self::NOTEXISTSEMAIL);
        $this->get('/islogin')->assertStatus(403);
        // dd($res1->getSession()->get("errors"));
    }

    public function test_logout()
    {
        $res1 = $this->get('/islogin');
        $res1->assertStatus(403);
        $this->post('/logout');
        $res2 = $this->get('/islogin');
        $res2->assertStatus(403);

        $res3 = $this->post('/login', self::CORRECTEMAIL);
        $res3->assertStatus(302);

        $res4 = $this->get('/islogin');
        $res4->assertStatus(200);
        $this->post('/logout');
        $res5 = $this->get('/islogin');
        $res5->assertStatus(403);
    }

    public function test_register()
    {
        $res1 = $this->post('register',[
            
        ]);
    }
}
