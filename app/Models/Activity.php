<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';
    protected $guarded = ['id'];

    public function master_classes():HasMany
    {
        return $this->hasMany(MasterClass::class, 'activityId', 'id');
    }
}
