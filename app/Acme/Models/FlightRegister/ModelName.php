<?php
namespace Model\FlightRegister;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'flight_register';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

    public function getPaycode() { return $this->paycode; }

}
