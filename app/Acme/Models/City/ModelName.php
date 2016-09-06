<?php
namespace Model\City;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'cities';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

    public function getName() { return $this->name; }
    public function getNameEn() { return $this->nameEn; }

    public function getCountryCode() { return $this->country_code; }
    public function getCityCode() { return $this->city_code; }    
    public function getAirportCode() { return $this->airport_code; }

    public function getAirportName() { return $this->airport_name; }
    public function getAirporNameEn() { return $this->airport_nameEn; }

    public function getStatus() { return $this->status; }

}
