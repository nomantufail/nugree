<?php
/**
 * Created by Noman Tufail.
 * User: JR Tech
 * Date: 4/14/2016
 * Time: 9:57 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\ReleasedFile\ReleasedFileFactory;
use App\DB\Providers\SQL\Models\ReleasedFile;
use App\Repositories\Interfaces\Repositories\ReleasedFilesRepoInterface;

class ReleasedFilesRepository extends SqlRepository implements ReleasedFilesRepoInterface
{
    private $factory = null;
    public function __construct()
    {
        $this->factory = new ReleasedFileFactory();
    }

    public function getById($id)
    {
        return $this->factory->find($id);
    }

    public function store(ReleasedFile $file)
    {
        return $this->factory->store($file);
    }

    public function storeMultiple(array $files)
    {
        return $this->factory->storeMultiple($files);
    }

    public function removeExpiredFiles()
    {
        return $this->factory->removeExpiredFiles();
    }

    public function getExpiredFiles()
    {
        return $this->factory->getExpiredFiles();
    }

    public function deleteByIds(array $ids)
    {
        return $this->factory->deleteByIds($ids);
    }

    /**
     * @param array ReleasedFile
     * @return array
     */
    public function getByPaths(array $paths)
    {
        return $this->factory->getByPaths($paths);
    }
}
