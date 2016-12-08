<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 3/15/2016
 * Time: 9:56 PM
 */

namespace App\Http\Requests\Requests\News;


use App\DB\Providers\SQL\Models\News;
use App\Http\Requests\Interfaces\RequestInterface;
use App\Http\Requests\Request;
use App\Http\Validators\Validators\NewsValidators\AddNewsValidator;
use App\Transformers\Request\News\AddNewsTransformer;


class AddNewsRequest extends Request implements RequestInterface{

    public $validator;
    public function __construct(){
        parent::__construct(new AddNewsTransformer($this->getOriginalRequest()));
        $this->validator = new AddNewsValidator($this);
    }

    public function authorize(){
        return true;
    }

    public function validate(){
        return $this->validator->validate();
    }
    public function getNewsModel()
    {
        $news = new News();
        $news->title = $this->get('title');
        $news->description = $this->get('description');
        return $news;
    }
    public function getNewsImageModel()
    {
        $final = [];
        $newsImages = $this->get('images');
        foreach($newsImages as $image)
        {
            $extension = $image->getClientOriginalExtension();
            $imageName = md5($image->getClientOriginalName()) . '.' . $extension;
            $image->move(public_path() . '/assets/imgs/projects', $imageName);
            $final[] = 'assets/imgs/projects/' . $imageName;
        }
        return $final;
    }


} 