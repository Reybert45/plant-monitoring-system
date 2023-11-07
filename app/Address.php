<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = [
        'person_id', 'address_status_id', 'street_id', 'barangay_id', 'city_id', 'province_id', 'zipcode_id', 'region_id'
    ];

    public function address_status()
    {
        return $this->belongsTo(AddressStatus::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }
   
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    
    public function barangay()
    {
        return $this->belongsTo(Barangay::class);
    }
    
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    
    public function zipcode()
    {
        return $this->belongsTo(ZipCode::class);
    }
}
