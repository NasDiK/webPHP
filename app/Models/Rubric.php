<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rubric extends Model
{
    use HasFactory;

    protected $table = 'rubrics';
    protected $guarded = ['id'];

    public function news():HasMany
    {
        return $this
            ->hasMany(Statya::class, 'rubrics', 'id')
            ->orderBy('created_at', 'desc');
    }
}
