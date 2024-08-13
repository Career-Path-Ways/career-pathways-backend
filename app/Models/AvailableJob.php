<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AvailableJob extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['company'];

    public function applicants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'available_job_users', 'job_id', 'user_id')->withTimestamps()->withPivot('id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(company::class);
    }
}
