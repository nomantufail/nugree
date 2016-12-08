<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class SocietyTest extends TestCase
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
    public function testAddSociety()
    {
        $this->json('POST', $this->apiRoute('society'), [
            'society_name' => 'usa',
            'city_id' => 1
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testSocietyInsertionInDb()
    {
        $this->seeInDatabase('societies', ['society' =>'usa']);
    }

    public function testUpdateSociety()
    {
        $this->json('POST',$this->apiRoute('society/update'),[
            'society_id' => '1',
            'city_id' => '1',
            'society_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteSociety()
    {
        $this->json('POST',$this->apiRoute('society/delete'),['society_id'=>3])->seeJson(['status'=> 1]);
    }

}