<?php
namespace Model\Ttransact;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'ttransact';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

}
