<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Guest;
use App\Models\Venue;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public static function defaultImage()
    {
        return 'https://i.ibb.co/sbq56fJ/calender-2389150-640.png';
    }

    public function getDatetime()
    {
        return Carbon::parse($this->start)->toDayDateTimeString();
    }

    public function getDate()
    {
        return Carbon::parse($this->start)->format("l, jS \\of M'y");
    }

    public function getTimeLeft()
    {
        $occationDate = Carbon::parse($this->start);
        return $occationDate->diffForHumans(Carbon::now());
    }

    public function hasExpired()
    {
        return Carbon::parse($this->start)->isPast();
    }

    public function startDate()
    {
        return Str::replaceFirst(' ', 'T', $this->start);
    }

    public function endDate()
    {
        return Str::replaceFirst(' ', 'T', $this->end);
    }

    public function guests()
    {
        return $this->belongsToMany(Guest::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('start', '>=', Carbon::today()->toDateString());
    }

}
