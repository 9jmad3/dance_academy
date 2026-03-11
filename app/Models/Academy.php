<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Academy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'phone',
        'email',
        'whatsapp',
        'address',
        'instagram_url',
        'banner',
        'hero_title',
        'hero_text',
    ];

    public function danceStyles(): HasMany
    {
        return $this->hasMany(DanceStyle::class)->orderBy('sort_order')->orderBy('name');
    }

    public function teachers(): HasMany
    {
        return $this->hasMany(Teacher::class)->orderBy('sort_order')->orderBy('name');
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class)
            ->orderByRaw("CASE day_of_week
                WHEN 'monday' THEN 1
                WHEN 'tuesday' THEN 2
                WHEN 'wednesday' THEN 3
                WHEN 'thursday' THEN 4
                WHEN 'friday' THEN 5
                WHEN 'saturday' THEN 6
                WHEN 'sunday' THEN 7
                ELSE 8 END")
            ->orderBy('start_time')
            ->orderBy('sort_order');
    }
}
