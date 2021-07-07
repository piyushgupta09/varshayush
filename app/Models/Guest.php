<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{

    public static function defaultImage()
    {
        return "https://i.ibb.co/180Qwd7/profile-picture-640.png";
    }

    public function membersCount()
    {
        $adult = " adult";
        if ($this->adults > 1) {
            $adult = $adult . 's';
        }
        $string = $this->adults . $adult;

        $kid = " kid";
        if ($this->kids > 1) {
            $kid = $kid . 's';
        }

        if ($this->kids > 0) {
            return  $string . ' and ' . $this->kids . $kid;
        } else {
            return  $string;
        }
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
