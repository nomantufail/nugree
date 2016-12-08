<?php



class TestUserRole extends TestCase
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
    public function testAddUserRole()
    {
        $this->json('POST', $this->apiRoute('user/role/add'), [
            'user_id' => 1,
            'role_id' => 1
        ])->seeJson([
            'status' =>1,
        ]);
    }

    /**
     * Checking user inserted in db
     *
     * @return void
     */
    public function testUserRoleInsertionInDb()
    {
        $this->seeInDatabase('user_roles', ['user_id' =>1]);
    }

    public function testUpdateUserRole()
    {
        $this->json('POST',$this->apiRoute('user/role/update'),[
            'user_id' => 1,
            'role_id' => 1,
            'user_role_id'=> 1,
        ])->seeJson([
            'status' => 1
        ]);
    }
    public function testAllUserRole()
    {
        $this->json('GET',$this->apiRoute('user/roles'),[])->seeJson([
            'status' => 1
        ]);
    }

    public function testDeleteUserRole()
    {
        $this->json('POST',$this->apiRoute('user/role/delete'),[
            'user_role_id'=>1
        ])
            ->seeJson(['status'=> 1]);
    }

}
