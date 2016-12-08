<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\ProjectImages;

use App\DB\Providers\SQL\Factories\Factories\ProjectImages\Gateways\ProjectImagesQueryBuilder;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;

use App\DB\Providers\SQL\Models\ProjectImages;


class ProjectImagesFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public $bannerDetail = null;

    public function __construct()
    {
        $this->model = new ProjectImages();
        $this->tableGateway = new ProjectImagesQueryBuilder();
    }

    public function addImages($images,$projectId)
    {
        $final=[];
        foreach($images as $image)
        {
            $final[] = ['project_id'=>$projectId,'image'=>$image];
        }
       return $this->tableGateway->insertMultiple($final);
    }
    public function addProject(ProjectImages $projectImages)
    {
        return $this->tableGateway->insert($this->mapProjectOnTable($projectImages));
    }
    public function all()
    {
        return $this->tableGateway->all();
    }


    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }
    public function deleteProjectImage($imageId)
    {
        return $this->tableGateway->deleteWhere(['id'=>$imageId]);
    }
    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }

    public function deleteProjectImages($projectId)
    {
        return $this->tableGateway->deleteWhere(['project_id'=>$projectId]);
    }
    public function map($result)
    {
        $projectImage = clone($this->model);
        $projectImage->id = $result->id;
        $projectImage->image = $result->image;
        $projectImage->projectId = $result->project_id;
        $projectImage->createdAt = $result->created_at;
        $projectImage->updatedAt = $result->updated_at;
        return $projectImage;
    }

    private function mapProjectOnTable(ProjectImages $bannerImage)
    {
        return [
            'image'     => $bannerImage->image,
            'project_id'     => $bannerImage->projectId,
        ];
    }
    public function getProjectImages($projectId)
    {
        return $this->mapCollection($this->tableGateway->getWhere(['project_id'=>$projectId]));
    }
}