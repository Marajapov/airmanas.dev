<?php
namespace Model\Tuser;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ModelName extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, ModelHelpers, ModelRelationships;

    protected $table = 'tuser';

    protected $guarded = ['id'];

    public function id()
    {
        return $this->id;
    }

    public function getUserAccount()
    {
        return $this->user_account;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStatus()
    {
        return $this->status;
    }

}
