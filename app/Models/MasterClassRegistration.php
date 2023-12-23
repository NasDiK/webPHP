<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MasterClassRegistration extends Model
{
    use HasFactory;

    protected $table = 'master_class_registrations';
    protected $guarded = ['id'];
    protected $with = ['user', 'masterClass'];

    public $timestamps = false;

    public function user():HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function masterClass():HasOne
    {
        return $this->hasOne(MasterClass::class, 'id', 'masterClassId');
    }
}
