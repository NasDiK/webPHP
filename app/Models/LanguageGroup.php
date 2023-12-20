<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LanguageGroup extends Model
{
    use HasFactory;

    protected $table = 'language_groups';
    protected $guarded = ['id'];

    public function courses():HasMany
    {
        return $this->hasMany(Courses::class, 'languageGroupId', 'id');
    }
}
