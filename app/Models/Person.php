<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Person extends Model
{
	use HasFactory;
	
	public function staff(): HasOne {
		// return $this->hasOne(Staff::class);
		return $this->hasOne(Staff::class, 'id', 'Staff');
	}
	
	protected $primaryKey = 'id';
	protected $guarded = ['id'];
	
	protected $table = 'Person';
}