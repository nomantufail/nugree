<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class PropertyStatusTest extends TestCase
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
    public function testAddPropertyStatus()
    {
        $this->json('POST', $this->apiRoute('property/status'), [
            'property_status_name' => 'waqas',
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testPropertyStatusInsertionInDb()
    {
        $this->seeInDatabase('property_statuses', ['status' =>'waqas']);
    }

    public function testUpdatePropertyStatus()
    {
        $this->json('POST',$this->apiRoute('property/status/update'),[
            'property_status_id' => '1',
            'property_status_name' => 'waqas',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeletePropertyStatus()
    {
        $this->json('POST',$this->apiRoute('property/status/delete'),['property_status_id'=>1])->seeJson(['status'=> 1]);
    }

    public function GetAllPropertyStatus()
    {
        $this->json('post',$this->apiRoute('property/statuses'),[])->seeJson(['status'=>1]);
    }
}