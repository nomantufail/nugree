<?php
/**
 * Created by PhpStorm.
 * User: JR Tech
 * Date: 4/13/2016
 * Time: 2:32 PM
 */

namespace App\Libs\File;


use App\DB\Providers\SQL\Models\ReleasedFile;
use App\Libs\Helpers\Helper;
use App\Repositories\Repositories\Sql\ReleasedFilesRepository;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\File\File;

class FileRelease
{
    private $filePath = null;
    private $file = null;
    private $log = true;
    private $releasedFiles = null;
    public function __construct($filePath = null)
    {
        if($filePath != null)
        {
            $this->setFilePath($filePath);
            $this->setFile(new File($this->getCompleteFilePath()));
        }
        $this->releasedFiles = new ReleasedFilesRepository();
    }

    public function getCompleteFilePath()
    {
        return storage_path('app/').$this->getFilePath();
    }

    public function release($minutes = null)
    {
        if(!file_exists($this->getCompleteFilePath()))
            return new ReleasedFile();
        /* releasing file */
        $secureName = $this->secureName();
        $releasePath = $this->getReleasedFilesPath().$secureName;
        $this->copyTo($releasePath);

        /* log it in db */
        $now = Carbon::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s'))->addHours(5);
        $deadline = ($minutes != null)?$now->addMinutes($minutes):null;
        $deadline = ($deadline != null)?$deadline:$this->defaultDeadline();
        $releasedFile = $this->map([
            'path' => $secureName,
            'deadline' =>$deadline,
            'createdAt' => $now->toDateTimeString(),
            'updatedAt' => $now->toDateTimeString(),
        ]);

        return ($this->log)?$this->logInDb($releasedFile):$releasedFile;
    }

    public static function multiRelease($paths, $minutes = null)
    {
        $releasedFiles = [];
        foreach($paths as $path)
        {
            $releasedFiles[] = (new FileRelease($path))->doNotLog()->release($minutes);
        }
        return (new FileRelease())->multiLogInDb($releasedFiles);
    }

    private function defaultDeadline()
    {
        return Carbon::createFromFormat('Y-m-d h:i:s', date('Y-m-d h:i:s'))->addHours(24);
    }

    public function multiLogInDb(array $files)
    {
        $this->releasedFiles->storeMultiple($this->notAlreadyLoggedFiles($files));
        return $this->releasedFiles->getByPaths(Helper::propertyToArray($files, 'path'));
    }

    private function notAlreadyLoggedFiles(array $files)
    {
        $alreadyLoggedFiles = $this->releasedFiles->getByPaths(Helper::propertyToArray($files, 'path'));
        $finalFiles = [];
        foreach($files as $file){
            if(!$this->isAlreadyLogged($file, $alreadyLoggedFiles))
                $finalFiles[] = $file;
        }
        return $finalFiles;
    }

    private function isAlreadyLogged(ReleasedFile $file, $alreadyLoggedFiles = [])
    {
        foreach($alreadyLoggedFiles as $alreadyLoggedFile){
            if($file->path == $alreadyLoggedFile->path){
                return true;
            }
        }
        return false;
    }

    public function logInDb(ReleasedFile $releasedFile)
    {
        if($this->isAlreadyLogged($releasedFile, $this->releasedFiles->getByPaths([$releasedFile->path])))
            $releasedFile->id = $this->releasedFiles->getByPaths([$releasedFile->path])[0];
        else
            $releasedFile->id = $this->releasedFiles->store($releasedFile);

        return $releasedFile;
    }

    public function copyTo($newLocation)
    {
        return copy($this->getCompleteFilePath(), $newLocation);
    }

    public function getReleasedFilesPath()
    {
        return public_path('temp/');
    }

    public function secureName()
    {
        return md5($this->getFilePath()).'.'.$this->getFile()->getExtension();
    }

    /**
     * @return null
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param $filePath
     * @return $this
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
        return $this;
    }


    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\File\File::class $file
     **/
    public function getFile()
    {
        return $this->file;
    }

    public function doNotLog()
    {
        $this->log = false;
        return $this;
    }

    public function mapCollection(array $collection)
    {
        return array_map([$this, 'map'], $collection);
    }


    /**
     * @param array $record
     * @return ReleasedFile
     */
    public function map(array $record)
    {
        $file = new ReleasedFile();
        $file->path = $record['path'];
        $file->deadline = $record['deadline'];
        $file->updatedAt = $record['updatedAt'];
        return $file;
    }

}