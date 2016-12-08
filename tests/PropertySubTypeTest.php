<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class PropertySubTypeTest extends TestCase
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
    public function testAddPropertySubType()
    {
        $this->json('POST', $this->apiRoute('property/subtype'), [
            'p_type_id' => '1',
            'p_sub_type_name' => 'subTypeForUnitTesting',
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     * @return void
     */
    public function testPropertySubTypeInsertionInDb()
    {
        $this->seeInDatabase('property_sub_types', ['sub_type' =>'subTypeForUnitTesting']);
    }

    public function testUpdatePropertySubType()
    {
        $this->json('POST',$this->apiRoute('property/subtype/update'),[
            'p_type_id' => '1',
            'p_sub_type_name' => 'waqs',
            'p_sub_type_id' => '1',
        ])->seeJson([
            'status' => 1
        ]);
    }
    public function testSubTypesByType()
    {
        $this->json('POST',$this->apiRoute('subtype-by-type'),[
            'type_id'=>1
        ])->seeJson([
            'status'=>1
        ]);
    }
    public function GetAllPropertyType()
    {
        $this->json('post',$this->apiRoute('property/subtypes'),[])->seeJson(['status'=>1]);
    }

    public function testDeletePropertySubType()
    {
        $this->json('POST',$this->apiRoute('property/subtype/delete'),['p_sub_type_id'=>4])->seeJson(['status'=> 1]);
    }

}