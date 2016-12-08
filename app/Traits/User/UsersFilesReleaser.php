<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 2/25/2016
 * Time: 3:28 PM
 */

namespace App\Traits\User;


use App\DB\Providers\SQL\Models\ReleasedFile;
use App\Libs\File\FileRelease;
use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use App\Traits\AppTrait;

trait UsersFilesReleaser
{
    use AppTrait;

    public function releaseAllUserFiles(UserJsonPrototype $user)
    {
        //releasing logo...
        $user = $this->releaseUserAgencyLogo($user);

        return $user;
    }

    public function releaseUserAgencyLogo(UserJsonPrototype $user)
    {
        $releasedFiles = [];
        foreach($user->agencies as $agency)
        {
            if($agency->logo != null)
            {
                if(file_exists(storage_path('app/'.$agency->logo))){
                    $releasedFile = (new FileRelease($agency->logo))->doNotLog()->release();
                }else{
                    $releasedFile = (new ReleasedFile());
                }
                $agency->logo = $releasedFile->path;
                $releasedFiles[] = $releasedFile;
            }
        }
        (new FileRelease())->multiLogInDb($releasedFiles);
        return $user;
    }

    public function releaseUsersAgenciesLogo(array $users)
    {
        $releasedFiles = [];
        foreach($users as $user /* @var  UserJsonPrototype */)
        {
            foreach($user->agencies as $agency)
            {
                if($agency->logo != null)
                {
                    if(file_exists(storage_path('app/'.$agency->logo))) {
                        $releasedFile = (new FileRelease($user->agencies[0]->logo))->doNotLog()->release();
                    }else{
                        $releasedFile = (new ReleasedFile());
                    }
                    $user->agencies[0]->logo = $releasedFile->path;
                    $releasedFiles[] = $releasedFile;
                }
            }
        }
        (new FileRelease())->multiLogInDb($releasedFiles);

        return $users;
    }
}