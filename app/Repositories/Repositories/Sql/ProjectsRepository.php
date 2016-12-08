<?php
/**
 * Created by WAQAS.
 * User: waqas
 * Date: 4/7/2016
 * Time: 11:14 AM
 */

namespace App\Repositories\Repositories\Sql;


use App\DB\Providers\SQL\Factories\Factories\Project\ProjectFactory;
use App\DB\Providers\SQL\Factories\Factories\ProjectImages\ProjectImagesFactory;
use App\DB\Providers\SQL\Models\Project;
use App\Repositories\Interfaces\Repositories\BannersRepoInterface;


class ProjectsRepository extends SqlRepository implements BannersRepoInterface
{
    private $factory;
    private $projectImagesFactory;
    public function __construct()
    {
         $this->factory = new ProjectFactory();
        $this->projectImagesFactory = new ProjectImagesFactory();
    }
    public function addProject(Project $project)
    {
        return $this->factory->addProject($project);
    }
    public function addImages($images,$projectId)
    {
        return $this->projectImagesFactory->addImages($images,$projectId);
    }
    public function getAllProjects($params =[])
    {
        return $this->factory->getAllProjects($params);
    }
    public function projectCount()
    {
        return $this->factory->projectCount();
    }
    public function deleteProject($projectId)
    {
        return $this->factory->deleteProject($projectId);
    }
    public function getProject($projectId)
    {
        return $this->factory->getProject($projectId);
    }
    public function getProjectImages($projectId)
    {
        return $this->projectImagesFactory->getProjectImages($projectId);
    }
    public function updateProject(Project $project)
    {
        return $this->factory->updateProject($project);
    }
    public function deleteProjectImages($projectId)
    {
        return $this->projectImagesFactory->deleteProjectImages($projectId);
    }
    public function deleteProjectImage($imageId)
    {
        return $this->projectImagesFactory->deleteProjectImage($imageId);
    }
}