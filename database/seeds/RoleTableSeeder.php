<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public $Owner_Investor = 1;
    public $tenant = 2;
    public $agent_broker = 3;
    public $appraiser = 4;
    public $architect = 5;
    public $builder = 6;
    public $corporate_investor = 7;
    public $developer = 8;
    public $listing_administrator = 9;
    public $mortgage_broker = 10;
    public $property_asset_manager = 11;
    public $researcher = 12;


    public function run()
    {
        DB::table('roles')->insert([
            ['role' => 'Owner/Investor'],
            ['role' => 'tenant'],
            ['role' => 'agent/broker'],
            ['role' => 'appraiser'],
            ['role' => 'architect'],
            ['role' => 'builder'],
            ['role' => 'corporate investor'],
            ['role' => 'developer'],
            ['role' => 'listing administrator'],
            ['role' => 'mortgage broker'],
            ['role' => 'property/asset manager'],
            ['role' => 'researcher']
        ]);
    }

    /**
     * @return mixed
     */
    public function getOwnerInvestor()
    {
        return $this->Owner_Investor;
    }

    /**
     * @return int
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @return int
     */
    public function getAgentBroker()
    {
        return $this->agent_broker;
    }

    /**
     * @return int
     */
    public function getAppraiser()
    {
        return $this->appraiser;
    }

    /**
     * @return int
     */
    public function getArchitect()
    {
        return $this->architect;
    }

    /**
     * @return int
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * @return int
     */
    public function getCorporateInvestor()
    {
        return $this->corporate_investor;
    }

    /**
     * @return int
     */
    public function getDeveloper()
    {
        return $this->developer;
    }

    /**
     * @return int
     */
    public function getListingAdministrator()
    {
        return $this->listing_administrator;
    }

    /**
     * @return int
     */
    public function getMortgageBroker()
    {
        return $this->mortgage_broker;
    }

    /**
     * @return int
     */
    public function getPropertyAssetManager()
    {
        return $this->property_asset_manager;
    }

    /**
     * @return int
     */
    public function getResearcher()
    {
        return $this->researcher;
    }


}
