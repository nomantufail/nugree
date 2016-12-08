<?php

/***********   UPDATING SLUGS IN PREVIOUS PROPERTIES IN LIVE   **************/
function convertPropertyAreaToActualUnit(\App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype $property)
{
    $property->land->area = \App\Libs\Helpers\LandArea::convert('square feet',$property->land->unit->name, $property->land->area);
    return $property;
}
function propertySlug(\App\Libs\Json\Prototypes\Prototypes\Property\PropertyJsonPrototype $property)
{
    $slug = ''.$property->land->area.'-'.$property->land->unit->name .'-'.$property->type->subType->name.'-'. $property->purpose->name.'-in-'.$property->location->location->location.'-'.$property->location->city->name.'-'.$property->id;
    return preg_replace('/\s+/', '-',$slug);
}

Route::get('properties_with_dangling_location', function(){
    dd(\Illuminate\Support\Facades\DB::table('properties')->select('properties.id')->leftJoin('locations','locations.id','properties.location_id')->where('locations.id',null)->get());
});

Route::get('add_slug_to_locations', function(){
    $locationsRepo = (new \App\Repositories\Providers\Providers\LocationsRepoProvider())->repo();
    collect($locationsRepo->all())->each(function($location) use ($locationsRepo){
        $location->slug = $location->location."-".$location->cityId;
        $locationsRepo->update(clone($location));
    });
});

Route::get('slug_in_property_json',function(){
    $propertiesRepo =(new \App\Repositories\Repositories\Sql\PropertiesRepository());
    $propertiesJsonRepo =(new \App\Repositories\Repositories\Sql\PropertiesJsonRepository());
    $properties = $propertiesRepo->all();
    collect($properties)->each(function($property) use($propertiesRepo, $propertiesJsonRepo){
        $propertyJsonActual = $propertiesJsonRepo->getById($property->id);
        $propertyJson = convertPropertyAreaToActualUnit(clone($propertyJsonActual));
        $propertyJsonActual = $propertiesJsonRepo->getById($property->id);
        $property->slug = propertySlug($propertyJson);
        $propertiesRepo->update($property);
        \Illuminate\Support\Facades\Event::fire(new \App\Events\Events\Property\PropertyUpdated($property));
    });

//    $propertiesJsonRepo =(new \App\Repositories\Repositories\Sql\PropertiesJsonRepository());
//    $jsons = $propertiesJsonRepo->all();
//    collect($jsons)->each(function($json) use($propertiesJsonRepo){
//        $json->location->city->slug = $json->location->city->name;
//        $json->location->location->slug = $json->location->location->id;
//        $propertiesJsonRepo->update($json);
//    });


});

/********************************************************************************************************************************/

//Route::get('userjson',function(){
//
//    $users = (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->all();
//    $finalRecord =[];
//    foreach($users as $user)
//    {
//        $finalRecord[] = [
//            'user_id'=>$user->id,
//            'json'=>(new \App\Libs\Json\Creators\Creators\User\UserJsonCreator($user))->create()->encode()
//        ];
//    }
//    dd($finalRecord);
//    \Illuminate\Support\Facades\DB::table('user_json')->insert($finalRecord);
//    dd('done');
//});

Route::get('getLastInserted',function(){
    dd((new \App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory())->getLastInsertedId());
});


Route::get('test',function(){
    return collect((new \App\Repositories\Providers\Providers\LocationsRepoProvider())->repo()->all())->toJson();
});



Route::get('/imageResize', function()
{

    $mainFolder = storage_path('app\users');
    $subFolder = scandir($mainFolder);
    $sizeofSubFolder = sizeof($subFolder);
    for($limit =2; $limit<$sizeofSubFolder; $limit++)
    {
        $rawPath = storage_path('app\users'.'/'.$subFolder[$limit]);
        $pathToProperties = scandir($rawPath);
        if(isset($pathToProperties[3]) && ($pathToProperties[3]) == 'properties')
        {
            $propertiesPath = $rawPath . '/' . $pathToProperties[3];
            $propertiesSubFolderPath = scandir($propertiesPath);
            $sizeOfSubPropertiesFolder = sizeof($propertiesSubFolderPath);
            for ($i = 2; $i < $sizeOfSubPropertiesFolder; $i++) {
                $fullPath = $propertiesPath . '/' . $propertiesSubFolderPath[$i];
                $files = [];
                $dh = opendir($fullPath);
                while (false !== ($filename = readdir($dh))) {
                    $files[] = $filename;
                }
                $fileSize = sizeof($files);
                //dd($fileSize,$files);
                for ($a = 2; $a < $fileSize; $a++) {
                    $img = \Intervention\Image\Facades\Image::make($fullPath . '/' . $files[$a]);
                    $img->resize(300, 300);
                    $img->save($fullPath . '/' . $files[$a]);
                }
            }
        }

     }
    dd('pictures are resized and saved');

});

Route::get('update-location-slug',function(){
    $locations = (new \App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory())->all();
    foreach($locations as $location)
    {
        $location->slug = $location->location.'-'.$location->id;
        (new \App\DB\Providers\SQL\Factories\Factories\Location\LocationFactory())->update($location);
    }
    dd('hi');
});


//Route::get('/imageResize/{chunk_number}', function()
//{
//    $images = getDirContents(storage_path('app/users/'));
//    $image_chunks = array_chunk($images, 50);
//    $count = 0;
//    foreach($image_chunks[request()->route()->parameter('chunk_number')] as $imagePath){
//        try{
//            $img = \Intervention\Image\Facades\Image::make($imagePath);
//            $img = $img->heighten(env('PROPERTY_IMG_MAX_HEIGHT'), function ($constraint) {
//                $constraint->upsize();
//            });
//            $img = $img->widen(env('PROPERTY_IMG_MAX_WIDTH'), function ($constraint) {
//                $constraint->upsize();
//            });
//            $img->save($imagePath);
//            echo "pass<br>";
//        }catch (Exception $e){
//            echo "fail<br>";
//        }
//        $count++;
//    }
//    dd('pictures are resized and saved');
//});

Route::get('foo',function()
{
    // DB::table('properties')->delete();
    $lastProperty =  DB::table('properties')
        ->orderBy('properties.id','DESC')
        ->skip(0)->take(1)->get();
    $lastId = $lastProperty[0]->id;
    $statusesSeeder = new PropertyStatusTableSeeder();
    $PropertyFactory = (new \App\DB\Providers\SQL\Factories\Factories\Property\PropertyFactory());
    $activeStatus = $statusesSeeder->getActiveStatusId();


    for($b = 1; $b<=2; $b++) {
        $allProperties = [];
        for ($a = 1; $a <= 200; $a++) {
            $temp = [];
            $temp['purpose_id'] = rand(1, 2);
            $temp['property_sub_type_id'] = rand(1, 19);
            $temp['block_id'] = rand(1, 11045);
            $temp['title'] = 'This is my property';
            $temp['description'] = 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.' . rand(1, 200002);
            $temp['price'] = rand(2000000, 250000000);
            $temp['land_area'] = rand(1, 20);
            $temp['land_unit_id'] = rand(1, 4);
            $temp['contact_person'] = 'ab' . rand(1, 100000);
            $temp['phone'] = '0321450405' . rand(1, 3);
            $temp['mobile'] = '0321450405' . rand(1, 10);
            $temp['wanted'] = rand(0,1);
            $temp['property_status_id'] = $activeStatus;
            $temp['total_views'] = rand(1, 100000);
            $temp['rating'] = rand(1, 10);
            $temp['total_likes'] = rand(1, 100000);
            $temp['email'] = 'jrpropedrty167@gmail.com' . rand(1, 1000000);
            $temp['owner_id'] = rand(1, 2);
            $temp['created_by'] = 1;
            $temp['created_at'] = date('Y-m-d h:i:s');
            $temp['updated_at'] = date('Y-m-d h:i:s');
            $allProperties[] = $temp;

        }
        DB::table('properties')->insert($allProperties);
    }
    $allProperties = $PropertyFactory->mapCollection( DB::table('properties')->select('properties.*')->where('properties.id','>',$lastId)->get());
    $finalResult =[];
    foreach($allProperties as $property)
    {
        $propertyJson = (new \App\Libs\Json\Creators\Creators\Property\PropertyJsonCreator($property))->create();
        $finalResult[] = ['property_id' => $property->id, 'json'=> json_encode($propertyJson)];
    }
    DB::table('property_json')->insert($finalResult);
    return view('frontend.foo');

});

Route::get('foo/blocks',function(){
    $societyTable = (new \App\DB\Providers\SQL\Factories\Factories\Society\SocietyFactory())->getTable();
    $blocks = DB::table('blocks')
        ->select('blocks.society_id')
        ->groupBy('blocks.society_id')
        ->where('blocks.block','other')
        ->get();
    $blocks = (new \App\Libs\Helpers\Helper())->propertyToArray($blocks,'society_id');
    $societies = DB::table($societyTable)
        ->select($societyTable.'.*')
        ->whereNotIn($societyTable.'.id', $blocks)
        ->get();
    $insertBlocks =[];
    foreach($societies as $society)
    {
        $insertBlocks[] = ['society_id'=>$society->id,'block'=>'other'];
    }
    DB::table('blocks')->insert($insertBlocks);
});

Route::get('print-societies/12345',function(){
    $allSocieties = (new \App\Repositories\Repositories\Sql\SocietiesRepository())->all();
    foreach($allSocieties as $society)
    {
        echo '(object)[
               "id"=>'.$society->id.' ,"name"=>'."'".$society->name."'".'
           ],<br />';
    }
}
);

Route::get('maliksajidawan786@gmail.com/city',
    [
        'middleware'=>
            [

            ],
        'uses'=>'CitiesController@index'
    ]
);

Route::get('wanted-properties',
    [
        'middleware'=>
            [
                'webValidate:WantedPropertyRequest'
            ],
        'uses'=>'PropertiesController@wantedProperties'
    ]
);

Route::post('join-us',
    [
        'middleware'=>
            [
                'webValidate:addJoinUsRequest'
            ],
        'uses'=>'JoinUsController@store'
    ]
);

Route::post('maliksajidawan786@gmail.com/add/city',
    [
        'middleware'=>
            [
                'webValidate:addCityRequest'
            ],
        'uses'=>'CitiesController@store'
    ]
);

Route::get('maliksajidawan786@gmail.com/city/listing',
    [
        'middleware'=>
            [
            ],
        'uses'=>'CitiesController@getAllCities'
    ]
);

Route::post('get/update/city/form',
    [
        'middleware'=>
            [
            ],
        'uses'=>'CitiesController@getCityUpdateForm'
    ]
);

Route::get('location/{location_slug}',
    [
        'middleware'=>
            [
                'webValidate:GetLocationRequest'
            ],
        'uses'=>'PropertiesController@getLocationProperties'
    ]
);

Route::post('maliksajidawan786@gmail.com/update/city',
    [
        'middleware'=>
            [
                'webValidate:UpdateCityRequest'
            ],
        'uses'=>'CitiesController@update'
    ]
);

Route::post('maliksajidawan786@gmail.com/delete/city',
    [
        'middleware'=>
            [
                'webValidate:deleteCityRequest'
            ],
        'uses'=>'CitiesController@delete'
    ]
);








Route::get('maliksajidawan786@gmail.com/project',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\ProjectsController@project'
    ]
);

Route::post('maliksajidawan786@gmail.com/add/project',
    [
        'middleware'=>
            [
                'webValidate:addProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@addProject'
    ]
);

Route::get('maliksajidawan786@gmail.com/project/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllProjectsRequest'
            ],
        'uses'=>'admin\ProjectsController@getAllProjects'
    ]
);

Route::post('maliksajidawan786@gmail.com/delete/project',
    [
        'middleware'=>
            [
              'webValidate:deleteProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@deleteProject'
    ]
);




Route::post('maliksajidawan786@gmail.com/update/project',
    [
        'middleware'=>
            [
                'webValidate:updateProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@updateProject'
    ]
);

Route::post('maliksajidawan786@gmail.com/delete/image',
    [
        'middleware'=>
            [
                'webValidate:deleteProjectImageRequest'
            ],
        'uses'=>'admin\ProjectsController@deleteProjectImage'
    ]
);

Route::get('maliksajidawan786@gmail.com/get/project/images',
    [
        'middleware'=>
            [
                'webValidate:getProjectImagesRequest'
            ],
        'uses'=>'admin\ProjectsController@getProjectImages'
    ]
);

Route::post('get/update/project/form',
    [
        'middleware'=>
            [
              'webValidate:getProjectRequest'
            ],
        'uses'=>'admin\ProjectsController@updateProjectForm'
    ]
);

Route::get('city/{city_slug}',
    [
        'middleware'=>
            [
                'webValidate:GetLocationByCityRequest'
            ],
        'uses'=>'LocationsController@getByCity'
    ]
);

Route::post('city/society',
    [
        'middleware'=>
            [
                'webValidate:'
            ],
        'uses'=>'admin\ProjectsController@updateProject'
    ]
);


Route::get('maliksajidawan786@gmail.com/news',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\NewsController@news'
    ]
);

Route::post('maliksajidawan786@gmail.com/add/news',
    [
        'middleware'=>
            [
                'webValidate:addNewsRequest'
            ],
        'uses'=>'admin\NewsController@addNews'
    ]
);

Route::get('maliksajidawan786@gmail.com/news/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllNewsRequest'
            ],
        'uses'=>'admin\NewsController@getAllNews'
    ]
);

Route::post('maliksajidawan786@gmail.com/delete/news',
    [
        'middleware'=>
            [
                'webValidate:deleteNewsRequest'
            ],
        'uses'=>'admin\NewsController@deleteNews'
    ]
);

Route::post('maliksajidawan786@gmail.com/update/news',
    [
        'middleware'=>
            [
                'webValidate:updateNewsRequest'
            ],
        'uses'=>'admin\NewsController@updateNews'
    ]
);

Route::post('maliksajidawan786@gmail.com/delete/news/image',
    [
        'middleware'=>
            [
                'webValidate:deleteNewsImageRequest'
            ],
        'uses'=>'admin\NewsController@deleteNewsImage'
    ]
);

Route::get('maliksajidawan786@gmail.com/get/news/images',
    [
        'middleware'=>
            [
                'webValidate:getNewsImagesRequest'
            ],
        'uses'=>'admin\NewsController@getNewsImages'
    ]
);

Route::post('get/update/news/form',
    [
        'middleware'=>
            [
                'webValidate:getNewsRequest'
            ],
        'uses'=>'admin\NewsController@getNews'
    ]
);

Route::get('get/news',
    [
        'middleware'=>
            [
                'webValidate:getNewsRequest'
            ],
        'uses'=>'NewsController@getNewsDetail'
    ]
);





Route::get('maliksajidawan786@gmail.com/banners',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\BannersController@banners'
    ]
);



Route::post('maliksajidawan786@gmail.com/add/banner',
    [
        'middleware'=>
            [
                'webValidate:addBannerRequest'
            ],
        'uses'=>'admin\BannersController@addBanner'
    ]
);

Route::get('maliksajidawan786@gmail.com/banners/listing',
    [
        'middleware'=>
            [
                'webValidate:getAllBannersRequest'
            ],
        'uses'=>'admin\BannersController@bannersListing'
    ]
);

Route::post('get/page/banners',
    [
        'middleware'=>
            [
                'webValidate:getPageBannersRequest'
            ],
        'uses'=>'admin\BannersController@pageBanners'
    ]
);

Route::get('maliksajidawan786@gmail.com/location',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\LocationsController@index'
    ]
);

Route::post('maliksajidawan786@gmail.com/add/location',
    [
        'middleware'=>
            [
                'webValidate:addLocationRequest'
            ],
        'uses'=>'admin\LocationsController@store'
    ]
);

Route::get('maliksajidawan786@gmail.com/location/listing',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\LocationsController@listing'
    ]
);

Route::get('maliksajidawan786@gmail.com/get/location/by/City',
    [
        'middleware'=>
            [
                'webValidate:getLocationByCityRequest'
            ],
        'uses'=>'admin\LocationsController@getByCity'
    ]
);

Route::post('get/update/location/form',
    [
        'middleware'=>
            [
                'webValidate:getLocationRequest'
            ],
        'uses'=>'admin\LocationsController@getUpdateLocationForm'
    ]
);

Route::post('maliksajidawan786@gmail.com/update/location',
    [
        'middleware'=>
            [
                'webValidate:updateLocationRequest'
            ],
        'uses'=>'admin\LocationsController@update'
    ]
);


Route::post('maliksajidawan786@gmail.com/delete/location',
    [
        'middleware'=>
            [
                'webValidate:deleteLocationRequest'
            ],
        'uses'=>'admin\LocationsController@delete'
    ]
);













Route::post('maliksajidawan786@gmail.com/delete/banner',
    [
        'middleware'=>
            [
                'webValidate:deleteBannerRequest'
            ],
        'uses'=>'admin\BannersController@deleteBanner'
    ]
);

Route::post('get/update/banner/form',
    [
        'middleware'=>
            [
                'webValidate:getBannerRequest'
            ],
        'uses'=>'admin\BannersController@getUpdateBannerForm'
    ]
);

Route::post('maliksajidawan786@gmail.com/update/banner',
    [
        'middleware'=>
            [
                'webValidate:updateBannerRequest'
            ],
        'uses'=>'admin\BannersController@updateBanner'
    ]
);

Route::get('maliksajidawan786@gmail.com/societies',
    [
        'middleware'=>
            [
                'webValidate:getAllSocietiesRequest'
            ],
        'uses'=>'admin\AdminController@societies'
    ]
);

Route::get('maliksajidawan786@gmail.com/blocks',
    [
        'middleware'=>
            [],
        'uses'=>'admin\AdminController@getBlocks'
    ]
);

Route::get('get/blocks',
    [
        'middleware'=>
            [
                'webValidate:getBlocksBySocietyRequest'
            ],
        'uses'=>'admin\AdminController@getBlocksBySociety'
    ]
);

Route::post('add/blocks',
    [
        'middleware'=>
            [
                'webValidate:addBlockRequest'
            ],
        'uses'=>'admin\AdminController@addBlock'
    ]
);

Route::post('delete/blocks',
    [
        'middleware'=>
            [
                'webValidate:deleteBlockRequest'
            ],
        'uses'=>'admin\AdminController@deleteBlock'
    ]
);

Route::post('update/blocks',
    [
        'middleware'=>
            [
                'webValidate:updateBlockRequest'
            ],
        'uses'=>'admin\AdminController@updateBlock'
    ]
);

Route::post('get/update/block/form',
    [
        'middleware'=>
            [
                'webValidate:getUpdateBlockFormRequest'
            ],
        'uses'=>'admin\AdminController@getBlockUpdateForm'
    ]
);

Route::post('delete/society',
    [
        'middleware'=>
            [
                'webValidate:deleteSocietyRequest'
            ],
        'uses'=>'admin\AdminController@deleteSociety'
    ]
);

Route::post('update/society',
    [
        'middleware'=>
            [
                'webValidate:updateSocietyRequest'
            ],
        'uses'=>'admin\AdminController@updateSociety'
    ]
);

Route::post('get/update/society/form',
    [
        'middleware'=>
            [
                'webValidate:getUpdateSocietyFormRequest'
            ],
        'uses'=>'admin\AdminController@getUpdateSocietyForm'
    ]
);

Route::post('add/society',
    [
        'middleware'=>
            [
                'webValidate:addSocietyRequest'
            ],
        'uses'=>'admin\AdminController@addSociety'
    ]
);

Route::get('get/society/form',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\AdminController@getSocietyForm'
    ]
);

Route::get('admin',
    [
        'middleware'=>
            [

            ],
        'uses'=>'admin\AuthController@getLoginPage'
    ]
);


Route::post('admin/login',
    [
        'middleware'=>
            [
                // 'webAuthenticate:adminLoginRequest',
                'webValidate:adminLoginRequest'
            ],
        'uses'=>'admin\AuthController@login'
    ]
);

Route::get('get/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getById'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/active/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminActivePropertyRequest'
            ],
        'uses'=>'admin\AdminController@getActiveProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/expired/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminExpiredPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getExpiredProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/rejected/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminRejectedPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getRejectedProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/deleted/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminDeletedPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getDeletedProperties'
    ]
);

Route::get('get/maliksajidawan786@gmail.com/pending/property',
    [
        'middleware'=>
            [
                'webValidate:getAdminPendingPropertyRequest'
            ],
        'uses'=>'admin\AdminController@getPendingProperties'
    ]
);

Route::get('get/agent',
    [
        'middleware'=>
            [
                'webValidate:getAdminAgentRequest'
            ],
        'uses'=>'admin\AdminController@getAgent'
    ]
);

Route::get('add-property',
    [
        'uses'=>'PropertiesController@addProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/reject',
    [
        'middleware'=>
            [
                'webValidate:RejectPropertyRequest'
            ],
        'uses'=>'admin\AdminController@rejectProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/verify',
    [
        'middleware'=>
            [
                'webValidate:verifyPropertyRequest'
            ],
        'uses'=>'admin\AdminController@VerifyProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/deActive',
    [
        'middleware'=>
            [
                'webValidate:DeActivePropertyRequest'
            ],
        'uses'=>'admin\AdminController@deActiveProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/deVerify',
    [
        'middleware'=>
            [
                'webValidate:deVerifyPropertyRequest'
            ],
        'uses'=>'admin\AdminController@deVerifyProperty'
    ]
);

Route::post('maliksajidawan786@gmail.com/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'admin\AdminController@approveProperty'
    ]
);

Route::get('admin/logout',function(){

    if(session()->has('admin'))
    {
        session()->pull('admin');
    }
    return redirect('admin');
});
Route::get('maliksajidawan786@gmail.com/agents',
    [
        'middleware'=>
            [
            ],
        'uses'=>'admin\AdminController@getAgents'
    ]);


Route::post('admin/property/approve',
    [
        'middleware'=>
            [
                'webValidate:ApprovePropertyRequest'
            ],
        'uses'=>'admin\AdminController@approveProperty'
    ]
);

Route::post('admin/agent/approve',
    [
        'middleware'=>
            [
//                'webAuthenticate:getAdminsPropertiesRequest',
                'webValidate:approveAgentRequest'
            ],
        'uses'=>'admin\AdminController@approveAgent'
    ]
);

Route::get('society/doc/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyAffidavitRequest'
            ],
        'uses'=>'SocietiesController@getSocietyDoc'
    ]);

Route::get('society/image/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyAffidavitRequest'
            ],
        'uses'=>'SocietiesController@getSocietyImage'
    ]);

Route::get('society/pdf/download',
    [
        'middleware'=>
            [
                'webValidate:downloadSocietyFilesRequest'
            ],
        'uses'=>'SocietiesController@downloadSocietyPDF'
    ]);

Route::get('get/society/files',
    [
        'middleware'=>
            [
                'webValidate:GetSocietyFilesRequest'
            ],
        'uses'=>'SocietiesController@getSocietyFiles'
    ]);

Route::get('societies/files',
    [
        'middleware'=>
            [
                'webValidate:GetAllSocietiesForFilesRequest'
            ],
        'uses'=>'SocietiesController@getAllSocietiesForFiles'
    ]);

Route::get('societies/maps',
    [
        'middleware'=>
            [
                'webValidate:GetAllSocietiesForMapsRequest'
            ],
        'uses'=>'SocietiesController@getAllSocietiesForMaps'
    ]);

Route::get('society/maps',
    [
        'middleware'=>
            [
                'webValidate:GetSocietyMapsRequest'
            ],
        'uses'=>'SocietiesController@getSocietyMaps'
    ]);

Route::get('maliksajidawan786@gmail.com/properties',
    [
        'middleware'=>
            [
                'webAuthenticate:getAdminsPropertiesRequest',
            ],
        'uses'=>'admin\AdminController@getProperties'
    ]);

Route::get('maliksajidawan786@gmail.com/agents',
    [
        'middleware'=>
            [
                //'webAuthenticate:getAdminsPropertiesRequest',
            ],
        'uses'=>'admin\AdminController@getAgents'
    ]);
Route::get('society',
    [
        'middleware'=>
            [
                'webValidate:getSocietyRequest'
            ],
        'uses'=>'admin\PropertiesController@getSociety'
    ]
);


Route::get('/login',
    [
        'uses'=>'Auth\AuthController@showLoginPage', 'as'=>'loginPage'
    ]
);

Route::post('/login',
    [
        'middleware'=>
            [
                'webValidate:loginRequest'
            ],
        'uses'=>'Auth\AuthController@login', 'as' =>'login'
    ]
);

Route::get('/',
    [
        'middleware'=>
            [
                'webValidate:indexRequest'
            ],
        'uses'=>'PropertiesController@index',
    ]
);

Route::post('feedback',
    [
        'middleware'=>
            [
                'webValidate:feedbackRequest'
            ],
        'uses'=>'MailController@feedback',
    ]
);

Route::post('user/requirement',
    [
        'middleware'=>
            [
                'webValidate:addUserRequirementRequest'
            ],
        'uses'=>'UserRequirementsController@store',
    ]
);

Route::get('search',
    [
        'middleware'=>
            [
                //'webValidate:searchRequest'
            ],
        'uses'=>'PropertiesController@search',
    ]
);

Route::post('get-new-password',
    [
        'middleware'=>
            [
                'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@getNewPassword',
    ]
);

Route::get('forget-password',
    [
        'middleware'=>
            [
                //'webValidate:forgetPasswordRequest'
            ],
        'uses'=>'UsersController@forgetPassword',
    ]
);

Route::get('/register',
    [
        'uses'=>'Auth\AuthController@showRegisterPage'
    ]
);
Route::post('/register',
    [
        'middleware'=>
            [
                'webValidate:registrationRequest'
            ],
        'uses'=>'Auth\AuthController@register','as' => 'register'
    ]
);

Route::get('property/{property_title}',
    [
        'middleware'=>
            [
                'webValidate:getPropertyRequest'
            ],
        'uses'=>'PropertiesController@getById'
    ]
);

//Route::get('property/{property_title}',
//    [
//        'middleware'=>
//            [
//                //'webValidate:getPropertyRequest'
//            ],
//        'uses'=>'PropertiesController@getById'
//    ]
//);

Route::get('agents',
    [
        'middleware'=>
            [
                'webValidate:getAgentsRequest'
            ],
        'uses'=>'UsersController@trustedAgents'
    ]
);

Route::get('agent/{agent_title}',
    [
        'middleware'=>
            [
                'webValidate:getAgentRequest'
            ],
        'uses'=>'UsersController@getTrustedAgent'
    ]
);

Route::get('agent/mail',
    [
        'middleware'=>
            [
                'webValidate:agentMailRequest'
            ],
        'uses'=>'MailController@mailAgent'
    ]);

Route::post('mail-to-agent',
    [
        'middleware'=>
            [
                'webValidate:mailToAgentRequest'
            ],
        'uses'=>'MailController@mailToAgent'
    ]);


Route::post('property/wanted',
    [
        'middleware'=>
            [
                'webValidate:wantedMailRequest'
            ],
        'uses'=>'MailController@propertyWanted'
    ]);

Route::post('contact_us',
    [
        'middleware'=>
            [
                'webValidate:contactUSMailRequest'
            ],
        'uses'=>'MailController@contactUS'
    ]);
Route::post('property-to-friend',
    [
        'middleware'=>
            [
                'webValidate:mailPropertyToFriendRequest'
            ],
        'uses'=>'MailController@mailToFriend'
    ]);

/**
trusted-agent route is not redirect on right path its temporary
 **/

Route::post('trusted-agent',
    [
        'middleware'=>
            [
                'webValidate:trustedAgentRequest'
            ],
        'uses'=>'UsersController@makeTrustedAgent'
    ]);

Route::get('properties/{city_slug}/{location_slug?}', 'PropertiesController@fetchProperties');
Route::get('properties', 'PropertiesController@getGeneralProperties');


Route::get('/redirect', 'Auth\SocialAuthController@redirect');
Route::get('/callback', 'Auth\SocialAuthController@callback');




Route::get('/logout', function(){
    if(isset($_SESSION['authUser']) && $_SESSION['authUser'] != null)
    {
        $usersRepo = (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo();
        $authUser = $_SESSION['authUser'];
        try{
            unset($_SESSION['authUser']);
            $authUser = $usersRepo->getById($authUser->id);
            $authUser->access_token = null;
            (new \App\Repositories\Providers\Providers\UsersRepoProvider())->repo()->update($authUser);
        }catch (\Exception $e){

        }
    }
    return redirect('/login');
});