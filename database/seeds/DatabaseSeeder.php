<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SocietiesTableSeeder::class);
        $this->call(BlocksTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(MembershipPlansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PropertyPurposeTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(PropertySubTypeTableSeeder::class);
        $this->call(LandUnitTableSeeder::class);
        $this->call(PropertyStatusTableSeeder::class);
        $this->call(HtmlStructuresTableSeeder::class);
        $this->call(FeatureSectionsTableSeeder::class);
        $this->call(PropertyFeaturesTableSeeder::class);
        $this->call(PropertySubTypeAssignedFeaturesTableSeeder::class);
        $this->call(ValidationRulesTableSeeder::class);
        $this->call(AppMessagesTableSeeder::class);
        $this->call(ValidationErrorMessagesTableSeeder::class);
        $this->call(AssignedFeatureValidationsTableSeeder::class);
        $this->call(AgencyTableSeeder::class);
        $this->call(AgencySocietyTableSeeder::class);
        $this->call(UsersRolesTableSeeder::class);
        $this->call(AgencyStaffTableSeeder::class);
        $this->call(AgencyLocationsTableSeeder::class);
        $this->call(UsersJsonTableSeeder::class);
        $this->call(PropertiesTableSeeder::class);
        $this->call(PropertyFeatureValuesTableSeeder::class);
        $this->call(PropertiesJsonTableSeeder::class);
        $this->call(AssignedFeaturesJsonTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(SocietiesFilesTableSeeder::class);
        $this->call(PagesTableSeeder::class);
    }
}
