<?php

namespace App\Console\Commands;

use App\Libs\Helpers\Helper;
use App\Repositories\Repositories\Sql\ReleasedFilesRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveExpiredFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'removeExpiredFiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove all expired files from temp';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $releasedFiles = new ReleasedFilesRepository();
        $expiredFiles = $releasedFiles->getExpiredFiles();
        $filePaths = [];
        foreach($expiredFiles as $file)
        {
            $filePaths[] = public_path('temp/'.$file->path);
        }
        File::delete($filePaths);
        $releasedFiles->deleteByIds(Helper::propertyToArray($expiredFiles, 'id'));
        echo "Expired files removed successfully";
        return true;
    }
}
