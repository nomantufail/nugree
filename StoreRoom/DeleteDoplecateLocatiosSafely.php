Route::get('test',function(){

$propertiesLocation = [];
$propertyRepo = (new \App\Repositories\Providers\Providers\PropertiesRepoProvider())->repo();
$locationRepo = (new \App\Repositories\Providers\Providers\LocationsRepoProvider())->repo();
$propertyTable = 'properties';
$locationTable = 'locations';

$propertiesLocations[] = DB::table($propertyTable)
->leftjoin($locationTable,$propertyTable.'.location_id','=',$locationTable.'.id')
->select($locationTable.'.id',$locationTable.'.location')
->distinct()
->get();
$collectedPropertyLocationIds = [];

foreach($propertiesLocations[0] as $propertyLocation)
{
$collectedPropertyLocationIds[]= $propertyLocation->id;
}

$locations =[];
$locations[]= DB::table($locationTable)
->select(DB::raw("count($locationTable.location) as locationCount,$locationTable.location"))
->groupBy($locationTable.'.location')
->having('locationCount', '>', 1)
->get();
$rawLocation= [];

foreach($locations[0] as $location){

$rawLocation[] = $location->location;
}

$locationIds = DB::table($locationTable)
->select($locationTable.'.id')
->whereIn($locationTable.'.location', $rawLocation)
->get();
$finalLocationIds = [];
foreach($collectedPropertyLocationIds as $collectedPropertyLocationId)
{
foreach($locationIds as $locationId){
if(($locationId->id) != $collectedPropertyLocationId)
{
if(!in_array($locationId->id, $finalLocationIds)){
$finalLocationIds[] = $locationId->id;
}
}
}
}

$locations =[];
$locations[]= DB::table($locationTable)
->select(DB::raw("count($locationTable.location) as locationCount,$locationTable.id as location_id"))
->groupBy($locationTable.'.location')
->having('locationCount', '>', 1)
->whereIn('locations.id', $finalLocationIds)
->get();

$deleteLocationIds =[];
foreach($locations[0] as $location)
{
$deleteLocationIds[]= $location->location_id;
}

DB::table($locationTable)
->whereIn($locationTable.'.id',$deleteLocationIds)
->where($locationTable.'.city_id','=',1)
->delete();
dd('Records Are Deleted');
});

-----------------------------------------Add slug and update properties and user json --------------------------------------------------------------------

Route::get('add-slug',function(){

$agents = (new \App\Repositories\Repositories\Sql\UsersJsonRepository())->all();
foreach($agents as $agent)
{
if(empty($agent->agencies) != 'true')
{
$agency = new \App\DB\Providers\SQL\Models\Agency();

$agency->id = $agent->agencies[0]->id;
$agency->name = $agent->agencies[0]->name;
$agency->userId = $agent->id;
$agency->description = $agent->agencies[0]->description;
$agency->mobile = $agent->agencies[0]->mobile;
$agency->phone = $agent->agencies[0]->phone;
$agency->address = $agent->agencies[0]->address;
$agency->email = $agent->agencies[0]->email;
$agency->logo = $agent->agencies[0]->logo;
$agency->slug = preg_replace('/\s+/', '-', $agent->agencies[0]->name . $agent->id);

(new \App\DB\Providers\SQL\Factories\Factories\Agency\AgencyFactory())->update($agency);

$agencyJson = (new \App\Libs\Json\Creators\Creators\User\AgencyJsonCreator($agency))->create();
$userJsonObjects = (new \App\Repositories\Repositories\Sql\UsersJsonRepository())->getAgencyStaff($agency->id);
foreach ($userJsonObjects as $userJsonObj) {
$agencies = $userJsonObj->agencies;
$agency = null;
$final_agencies = [];
foreach ($agencies as $agency) {
if ($agency->id == $agency->id) {
array_push($final_agencies, $agencyJson);
} else {
array_push($final_agencies, $agency);
}
}
$userJsonObj->agencies = $final_agencies;
(new \App\Repositories\Repositories\Sql\UsersJsonRepository())->update($userJsonObj);
}
$propertiesJson = (new \App\Repositories\Providers\Providers\PropertiesJsonRepoProvider())->repo()->getAgencyProperties($agency->id);
$finalResult = [];
if (empty($propertiesJson) != 'true') {
foreach ($propertiesJson as $property) {
$property->owner->agency = $agencyJson;

$finalResult[] = $property;
}
(new \App\Repositories\Providers\Providers\PropertiesJsonRepoProvider())->repo()->updateMultipleByIds($finalResult);
}

}
}

dd('done');
});