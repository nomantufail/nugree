<?php

class DashboardSearchTest extends TestCase
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
    public function testSearchPropertiesByPurpose()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'purpose_id' => 1,

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testSearchPropertiesByOwner()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'owner_id' => 1,

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testSearchPropertiesByStatus()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'property_owner_id' => 1,

        ])->seeJson([
            'status' =>1,
        ]);
    }
    public function testSearchPropertiesBySort()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'sortOn' => 'id',
            'sortBy' => 'asc',

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testSearchPropertiesByLimit()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'limit' => 1,
            'start' => 1,

        ])->seeJson([
            'status' =>1,
        ]);
    }

    public function testSearchPropertiesBy()
    {
        $this->json('POST', $this->apiRoute('user/properties'), [
            'id' => 1,

        ])->seeJson([
            'status' =>1,
        ]);
    }
}