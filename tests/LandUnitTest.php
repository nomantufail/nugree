<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class LandUnitTest extends TestCase
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
    public function testAddLandUnit()
    {
        $this->json('POST', $this->apiRoute('landUnit'), [
            'land_unit_name' => 'waqas',
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testLandUnitInsertionInDb()
    {
        $this->seeInDatabase('land_units', ['unit' =>'waqas']);
    }

    public function testUpdateLandUnit()
    {
        $this->json('POST',$this->apiRoute('landUnit/update'),[
            'land_unit_id' => '1',
            'land_unit_name' => 'waqas',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteLandUnit()
    {
        $this->json('POST',$this->apiRoute('landUnit/delete'),['land_unit_id'=>1])->seeJson(['status'=> 1]);
    }

    public function GetAllLandUnits()
    {
        $this->json('post',$this->apiRoute('landUnits'),[])->seeJson(['status'=>1]);
    }
}