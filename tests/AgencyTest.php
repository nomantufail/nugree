<?php


class AgencyTest extends TestCase
{
    private $userEmail = 'jrteam@gmail.com';
    private $userPassword = '123';

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
    public function testAddAgency()
    {
        $this->json('POST', $this->apiRoute('agency'), [
            'agency_name' => 'JROne',
            'user_id' => 1,
            'mobile' => 03044567051,
            'phone' => 03044567051,
            'email' => 'waqas@gmail.com',
            'address' => 'Lahore',

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testAddAgencyStaff()
    {
        $this->json('POST', $this->apiRoute('user/agency/staff'), [
            'first_name' => 'JROne',
            'last_name' => 'e',
            'mobile' => 03044567051,
            'phone' => 03044567051,
            'email' => 'waqas123@gmail.com',
            'address' => 'Lahore',
            'country_id' => 1,
            'password'=>12345,
            'membership_plan_id'=>1

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testUpdateAgencyStaff()
    {
        $this->json('POST', $this->apiRoute('user/agency/staff/update'), [
            'user_id' =>3,
            'first_name' => 'JROne',
            'last_name' => 'e',
            'mobile' => 03044567051,
            'phone' => 03044567051,
            'email' => 'waqas123@gmail.com',
            'password'=>12345,
            'address' => 'Lahore',

        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testAgencyInsertionInDb()
    {
        $this->seeInDatabase('agencies', ['agency' =>'JR']);
    }
    public function testUpdateAgency(){
        $this->json('POST',$this->apiRoute('agency/update'),[
            'agency_id'=>1,
            'agency_name' => 'JRDealer',
            'user_id' => 1,
            'mobile' => 03044567051,
            'phone' => 03044567051,
            'email' => 'mrwaqas@gmail.com',
            'address' => 'Lahore',
        ])->seeJson([
            'status' => 1
        ]);
    }
    public function testAgencyStaff()
    {
        $this->json('POST',$this->apiRoute('agency/staff'),[
            'agency_id'=>1
         ])->seeJson([
            'status' => 1
        ]);
    }
    public function testDeleteStaff()
    {
        $this->json('POST',$this->apiRoute('user/agency/staff/delete'),['user_id'=>3])->seeJson(['status'=> 1]);
    }
}