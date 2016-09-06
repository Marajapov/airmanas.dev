<?php
namespace Model\Passenger;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'passenger';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

//    public function getPaycode() { return $this->paycode; }

}
