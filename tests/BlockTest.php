<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/8/2016
 * Time: 2:38 PM
 */

class BlockTest extends TestCase
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
    public function testAddBlock()
    {
        $this->json('POST', $this->apiRoute('block'), [
            'block_name' => 'usa',
            'society_id' => 1
        ])->seeJson([
            'status' =>1,
        ]);
    }
    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testBlockInsertionInDb()
    {
        $this->seeInDatabase('blocks', ['block' =>'usa']);
    }

    public function testUpdateBlock()
    {
        $this->json('POST',$this->apiRoute('block/update'),[

            'block_id' => '1',
            'society_id' => '1',
            'block_name' => 'usa',
        ])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteBlock()
    {
        $this->json('POST',$this->apiRoute('block/delete'),['block_id'=>1])->seeJson(['status'=> 1]);
    }

    public function GetAllBlocks()
    {
        $this->json('post',$this->apiRoute('blocks'),[])->seeJson(['status'=>1]);
    }
}