<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CoursesMembers extends Model
{
    use HasFactory;

    protected $table = 'courses_members';

    protected $guarded = ['id'];

    public $timestamps = false;

    protected $appends = ['canDeleteRecord', 'isStarted'];

    public function course():HasOne
    {
        return $this->hasOne(Courses::class, 'id', 'courseId');
    }

    public function user():HasOne
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    public function getCanDeleteRecordAttribute(): bool
    {
        $timestampDate = Carbon::parse($this->course['startAt']);

        $currentDatePlusOneDay = Carbon::now()->addDay();

        return $timestampDate->greaterThan($currentDatePlusOneDay);
    }

    public function getIsStartedAttribute(): bool
    {
        $timestampDate = Carbon::parse($this->course['startAt']);

        return Carbon::now()->greaterThan($timestampDate);
    }
}
