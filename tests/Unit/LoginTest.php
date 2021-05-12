<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class LoginTest extends TestCase
{
    public const CORRECTEMAIL = ['email' => 'collect123a@gmail.com', 'password' => '11111111'];
    private const NOTEXISTSEMAIL = ['email' => 'error@error.com', 'password' => '11111111'];

    public function test_register()
    {
        $data = DB::table('users')->select(['id', 'email'])->where('email', '=', self::CORRECTEMAIL['email'])->get();
        if (count($data) === 0) {
            $this->post('/register', [
                'name' => 'Test User',
                'email' => self::CORRECTEMAIL['email'],
                'password' => self::CORRECTEMAIL['password'],
                'password_confirmation' => self::CORRECTEMAIL['password'],
            ]);
            $this->assertAuthenticated();
        }
        $this->post('/register', self::NOTEXISTSEMAIL)->assertSessionHasErrors(['name', 'password']);
    }

    public function test_login()
    {
        $this->assertGuest();
        $res = $this->post('/login', self::CORRECTEMAIL);
        $res->assertStatus(302);
        $this->assertAuthenticated();
    }

    public function test_errorLogin()
    {
        // Not exists email
        $res1 = $this->post('/login', self::NOTEXISTSEMAIL);
        $this->assertGuest();
        // dd($res1->getSession()->get("errors"));
    }

    public function test_logout()
    {
        $this->assertGuest();
        $this->post('/logout');
        $this->assertGuest();

        $res = $this->post('/login', self::CORRECTEMAIL);
        $res->assertStatus(302);

        $this->assertAuthenticated();

        $this->post('/logout');
        $this->assertGuest();
    }
}
