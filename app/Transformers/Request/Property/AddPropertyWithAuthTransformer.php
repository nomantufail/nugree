<?php
/**
 * Created by PhpStorm.
 * User: waqas
 * Date: 4/4/2016
 * Time: 2:43 PM
 */

namespace App\Transformers\Request\Property;

use App\Transformers\Request\RequestTransformer;


class AddPropertyWithAuthTransformer extends RequestTransformer
{
    public function transformExtraFeatures()
    {
        $extraFeatures = [];
        foreach($this->request->all() as $input => $value)
        {
            if(!in_array($input,$this->staticInputs()))
                $extraFeatures[$input] = $value;
        }
        return $extraFeatures;
    }
    public function transform()
    {
       $files = $this->request->all()['files'];
       //$files = [$this->request->file('file')];
        return [
           /* property info */
            'wanted' => $this->request->input('wanted'),
            'ownerId' => $this->request->input('owner'),
            'purposeId' => $this->request->input('propertyPurpose'),
            'subTypeId' => $this->request->input('propertySubType'),
            'location' => $this->request->input('location'),
            'title' => $this->request->input('propertyTitle'),
            'description' => $this->request->input('propertyDescription'),
            'price' => $this->request->input('price'),
            'landArea' => $this->request->input('landArea'),
            'landUnitId' => $this->request->input('landUnit'),

            /* contact information */
            'contactPerson' => $this->request->input('contactPerson'),
            'phone' => $this->request->input('phone'),
            'mobile' => $this->request->input('cell'),
            'email' => $this->request->input('email'),
            'fax' => $this->request->input('fax'),

            'features' => $this->request->input('features'),
            'files' => $files,
            'memberType' => $this->request->input('memberType'),
            'loginDetails' => $this->request->input('loginDetails'),
            'newMemberDetails' => $this->request->input('newMemberDetails'),
        ];
    }

    private function staticInputs()
    {
        return [
            'ownerId',
            'propertyPurpose',
            'propertySubType',
            'block',
            'propertyTitle',
            'propertyDescription',
            'price',
            'landArea',
            'landUnit',
            'contactPerson',
            'phone',
            'mobile',
            'email',
            'fax'
        ];
    }
}