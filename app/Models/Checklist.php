<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasker()
    {
        return $this->user;
    }

    public function getPrioritisedTasks($tasks)
    {
        $urgentTasks = $tasks->map(function ($task) {
            if ($task->priority == 'urgent') {
              return $task;
            }
        });
        $importantTasks = $tasks->map(function ($task) {
            if ($task->priority == 'important') {
              return $task;
            }
        });
        $regularTasks = $tasks->map(function ($task) {
            if ($task->priority == 'regular') {
              return $task;
            }
        });
        $prioritisedTasks = $urgentTasks->merge($importantTasks);
        $prioritisedTasks = $prioritisedTasks->merge($regularTasks);
        $prioritisedTasks = $prioritisedTasks->filter(function($value) {
            return  $value != null;
        });

        return $prioritisedTasks;
    }

    public function taskerInitials()
    {
        // $initials = array();
        $taskerName = $this->user->name;
        // $taskerNameArray = explode(' ', $taskerName);
        // foreach ($taskerNameArray as $part) {
            //     array_push($initials, substr($part, 0, 1));
        // }
        // return implode("", $initials);
        return substr($taskerName, 0, 2);
    }

    public function getTaskerColor()
    {
        switch ($this->tasker()->slug) {
            case 'piyush-gupta': return 'danger-800';
            case 'ayush-gupta': return 'primary-800';
            case 'swati-gupta': return 'warning-800';
            case 'poonam-gupta': return 'success-800';
            case 'varsha-gupta': return 'dark-800';
            default: return;
        }
    }

    public function hasTasks()
    {
        return $this->tasks->isNotEmpty();
    }

    public function getHeadBgColor()
    {
        return $this->color;
    }

    public function getIconColor()
    {
        return '#ffffff';
        // if ($this->detectBrightness($this->color)) {
        //     //bright color, use dark font
        //     return '#ea0000';
        // } else {
        //     //dark color, use bright font
        //     return '#ffff00';
        // }
    }

    public function getBodyBgColor()
    {
        $tint = '10';
        return ($this->color . $tint);
    }

    public function getHeadTextColor()
    {
        if ($this->detectBrightness($this->color)) {
            //bright color, use dark font
            return '#333333';
        } else {
            //dark color, use bright font
            return '#ffffff';
        }
    }

    private function detectBrightness($hex) {
        //$hex = "78ff2f"; //Bg color in hex, without any prefixing #!
        $hex = str_replace('#', '', $hex);
        //break up the color in its RGB components
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
        //do simple weighted avarage
        // dd($r + $g + $b);
        return ($r + $g + $b > 450);
    }

    private function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));

        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }

        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';

        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }

        return $return;
    }
}
