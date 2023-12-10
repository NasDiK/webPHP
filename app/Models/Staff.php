<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Staff extends Model
{
    use HasFactory;

    public function Person():HasMany
    {
        return $this->hasMany(Person::class, 'Staff', 'id');
    }

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'Staff';
}