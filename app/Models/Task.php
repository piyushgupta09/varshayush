<?php

namespace App\Models;

use App\Models\Checklist;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

    public function scopePending($query)
    {
        return $query->where('completed', false);
    }

    public function getBgColor()
    {
        switch ($this->priority) {
            case 'urgent':
                return 'text-danger';
            case 'important':
                return 'text-primary';
            case 'regular':
            default:
                return 'text-dark';
        }
    }
}
