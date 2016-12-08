<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    private $userEmail = 'noman@gmail.com';
    private $userPassword = '12345';

    public function generateUniqueEmail()
    {
        $email = date('Y-m-d-h-i-s')."@gmail.com";
        $this->userEmail = $email;
        return $email;
    }

    /**
     * Testing user Registration
     *
     * @return void
     */
    public function testUserRegistration()
    {
        $this->json('POST', $this->apiRoute('register'), [
            'fName' => 'unit',
            'lName'=>'test',
            'email'=>$this->generateUniqueEmail(),
            'password'=>$this->userPassword,
            'passwordAgain' => $this->userPassword,
            'phone' => '03154379760',
            'address' => 'Lahore, Punjab, Pakistan',
            'userRoles' => [1],
            'securityCode' => '123',
            'termsConditions' => 1
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testUserInsertionInDb()
    {
        $this->seeInDatabase('users', ['email' => $this->userEmail]);
    }

    /**
     * Testing user login
     *
     * @return void
     */
    public function testUserLogin()
    {
        $this->json('POST', $this->apiRoute('login'), [
            'email' => $this->userEmail,
            'password'=>$this->userPassword
        ])->seeJson([
            'status' => 1,
        ]);
    }

    /**
     * Testing user login
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $this->json('GET', $this->apiRoute('users'))->seeJson([
            'status' => 1
        ]);
    }
    public function testDeleteUser()
    {
        $this->json('POST',$this->apiRoute('user/agency/staff/delete'),['user_id'=>4])->seeJson(['status'=> 1]);
    }
}
