<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/6/2016
 * Time: 9:58 AM
 */
namespace App\DB\Providers\SQL\Factories\Factories\Project;

use App\DB\Providers\SQL\Factories\Factories\Project\Gateways\ProjectsQueryBuilder;
use App\DB\Providers\SQL\Factories\Factories\ProjectImages\ProjectImagesFactory;
use App\DB\Providers\SQL\Factories\SQLFactory;
use App\DB\Providers\SQL\Interfaces\SQLFactoriesInterface;
use App\DB\Providers\SQL\Models\Project;
use App\DB\Providers\SQL\Models\ProjectDetail;


class ProjectFactory extends SQLFactory implements SQLFactoriesInterface
{
    private $tableGateway = null;
    public $bannerDetail = null;
    public $projectImages = null;

    public function __construct()
    {
        $this->model = new Project();
        $this->tableGateway = new ProjectsQueryBuilder();
        $this->projectImages = new ProjectImagesFactory();
    }

    public function addProject(Project $banner)
    {
        return $this->tableGateway->insert($this->mapProjectOnTable($banner));
    }
    public function all()
    {
        return $this->tableGateway->all();
    }
    public function getAllProjects($params =[])
    {
        $final =[];
        $projects = $this->tableGateway->getAllProjects($params);
        foreach($projects as $project)
        {
            $final[] = $this->mapDetail($project);
        }
        return $final;
    }
    public function projectCount()
    {
        return $this->tableGateway->projectCount();
    }
    public function find($id)
    {
        return $this->map($this->tableGateway->find($id));
    }

    public function getTable()
    {
        return $this->tableGateway->getTable();
    }
    private function setTable($table)
    {
        $this->tableGateway->setTable($table);
    }
    public function updateProject(Project $project)
    {
        return $this->tableGateway->updateWhere(['id'=>$project->id],$this->mapProjectOnTable($project));
    }

    public function deleteProject($projectId)
    {
        return $this->tableGateway->delete($projectId);
    }
    public function getProject($projectId)
    {
        return $this->map($this->tableGateway->find($projectId));
    }
    public function map($result)
    {
        $project = clone($this->model);
        $project->id = $result->id;
        $project->title = $result->title;
        $project->description = $result->description;
        $project->cityId = $result->city_id;
        $project->societyId = $result->society_id;
        $project->createdAt = $result->created_at;
        $project->updatedAt = $result->updated_at;
        return $project;
    }
    public function mapDetail($result)
    {
        $project = new ProjectDetail();
        $project->id = $result->id;
        $project->title = $result->title;
        $project->cityId = $result->city_id;
        $project->societyId = $result->society_id;
        $project->description = $result->description;
        $project->images = $this->projectImages->getProjectImages($result->id);
        return $project;
    }

    private function mapProjectOnTable(Project $project)
    {
        return [
            'title'     => $project->title,
            'description'=> $project->description,
            'city_id'=>$project->cityId,
            'society_id'=>$project->societyId,
            'created_at'=> $project->createdAt,
        ];
    }
}