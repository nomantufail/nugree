<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class PropertyTypeTest extends TestCase
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
    public function testAddPropertyType()
    {
        $this->json('POST', $this->apiRoute('property/type'), [
            'p_type_name' => 'usa',
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testPropertyTypeInsertionInDb()
    {
        $this->seeInDatabase('property_types', ['type' =>'usa']);
    }

    public function testUpdatePropertyType()
    {
        $this->json('POST',$this->apiRoute('property/type/update'),[
            'p_type_id' => '1',
            'p_type_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeletePropertyType()
    {
        $this->json('POST',$this->apiRoute('property/type/delete'),['p_type_id'=>1])->seeJson(['status'=> 1]);
    }
    public function testTypeBySubtype()
    {
        $this->json('POST',$this->apiRoute('type-by-subtype'),[
            'sub_type_id'=>1
        ])->seeJson([
            'status'=>1
        ]);
    }
        public function GetAllPropertyType()
    {
        $this->json('post',$this->apiRoute('property/types'),[])->seeJson(['status'=>1]);
    }
}