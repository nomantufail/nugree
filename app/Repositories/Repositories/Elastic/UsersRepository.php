<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 3/16/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Elastic;

use App\Repositories\Interfaces\Repositories\UsersRepoInterface;
use App\Repositories\Transformers\Elastic\UserTransformer;

class UsersRepository extends ElasticRepository implements UsersRepoInterface
{
    private $userTransformer;
    public function __construct(){
        $this->userTransformer = new UserTransformer();
    }

    public function getFirst(array $where = [])
    {
        $user = (object)[
            'f_name' => 'noman',
            'l_name' => 'tufail',
            'email' => 'nomantufail100@gmail.com'
        ];

        return $this->userTransformer->transform($user);
    }

    public function updateUser($user)
    {
        return true;
    }

    public function storeUser($userInfo)
    {
        return true;
    }

    public function deleteUser($userId)
    {
        return true;
    }

    public function getUserDocument($userId)
    {
        return (object)[];
    }
}
