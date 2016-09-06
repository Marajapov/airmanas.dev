<?php
namespace Model\Ttransactlog;
use Illuminate\Database\Eloquent\Model;

class ModelName extends Model
{
    use ModelHelpers, ModelRelationships;
    protected $table = 'ttransactlog';
    protected $guarded = ['id'];
    public function getId() { return $this->id; }

}
