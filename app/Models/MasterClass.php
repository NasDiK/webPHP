<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;
use Jenssegers\Date\Date;

class MasterClass extends Model
{
    use HasFactory;

    protected $table = 'master_classes';
    protected $guarded = ['id'];

    protected $appends = ['startAtLocale', 'canRegister', 'emptySlots'];

    protected $casts = [
        'startAt' => 'datetime',
    ];

    public function creator():HasOne
    {
        return $this->hasOne(User::class, 'id', 'creatorId');
    }

    public function activity():HasOne
    {
        return $this->hasOne(Activity::class, 'id', 'activityId');
    }

    public function registrations():HasMany
    {
        return $this->hasMany(MasterClassRegistration::class, 'masterClassId', 'id');
    }

    public function getStartAtLocaleAttribute(): string
    {
        return Date::parse($this->startAt)->format('j F H:i');
    }

    public function getCanRegisterAttribute():bool
    {
        $hasEmptySpace = $this->registrations()->count() < $this->limit;
        $notStarted = $this->startAt->isFuture();

        return $hasEmptySpace && $notStarted;
    }

    public function getEmptySlotsAttribute():int
    {
        return $this->limit - count($this->registrations);
    }
}
