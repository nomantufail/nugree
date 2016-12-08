<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\Project;


use App\DB\Providers\SQL\Models\ProjectImages;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\ProjectValidators\UpdateProjectValidator;
use App\Repositories\Providers\Providers\ProjectsRepoProvider;
use App\Transformers\Request\Project\UpdateProjectTransformer;


class UpdateProjectRequest extends Request implements RequestInterface{

    public $validator;
    public $projectRepo;

    public function __construct(){
        parent::__construct(new UpdateProjectTransformer($this->getOriginalRequest()));
        $this->validator = new UpdateProjectValidator($this);
        $this->projectRepo = (new ProjectsRepoProvider())->repo();
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getProjectModel()
    {
        $project = $this->projectRepo->getProject($this->get('projectId'));
        $project->id = $this->get('projectId');
        $project->title = $this->get('title');
        $project->cityId = $this->get('cityId');
        $project->societyId = $this->get('societyId');
        $project->description = $this->get('description');
        return $project;
    }
    public function getProjectImageModel()
    {
        $final = [];
        $projectImages = $this->get('images');

        if($projectImages[0] !=null && $projectImages !="")
        foreach($projectImages as $image)
        {
            $extension = $image->getClientOriginalExtension();
            $imageName = md5($image->getClientOriginalName()) . '.' . $extension;
            $image->move(public_path() . '/assets/imgs/projects', $imageName);
            $final[] = 'assets/imgs/projects/' . $imageName;
        }
        return $final;
    }

} 