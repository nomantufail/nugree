<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class PropertyPurposeTest extends TestCase
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
    public function testAddPropertyPurpose()
    {
        $this->json('POST', $this->apiRoute('property/purpose'), [
            'purpose_name' => 'usa',
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testPropertyPurposeInsertionInDb()
    {
        $this->seeInDatabase('property_purposes', ['purpose' =>'usa']);
    }

    public function testUpdatePropertyPurpose()
    {
        $this->json('POST',$this->apiRoute('property/purpose/update'),[

            'purpose_id' => '1',
            'purpose_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeletePropertyPurpose()
    {
        $this->json('POST',$this->apiRoute('property/purpose/delete'),['purpose_id'=>2])->seeJson(['status'=> 1]);
    }

    public function GetAllPropertyPurpose()
    {
        $this->json('post',$this->apiRoute('property/purposes'),[])->seeJson(['status'=>1]);
    }
}