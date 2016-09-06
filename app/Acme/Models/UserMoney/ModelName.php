<?php
namespace Model\UserMoney;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'user_money';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

}
