<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Courses extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $guarded = ['id'];

    protected $appends = ['hasMembers', 'hasEmptySpace', 'notStarted'];

    protected $casts = [
        'startAt' => 'datetime',
    ];


    public function members():HasMany
    {
        return $this->hasMany(CoursesMembers::class, 'courseId', 'id');
    }

    public function getHasMembersAttribute(): bool
    {
        return $this->members()->count() > 0;
    }

    public function getHasEmptySpaceAttribute(): bool
    {
        return $this->members()->count() < $this->limit;
    }

    public function getNotStartedAttribute(): bool
    {
        return $this->startAt->isFuture();
    }
}
