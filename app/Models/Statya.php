<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Statya extends Model
{
    use HasFactory;

    protected $table = 'statyas';
    protected $guarded = ['id'];

    public function rubric(): HasOne
    {
        return $this->hasOne(Rubric::class, 'id', 'rubrics');
    }
}
