<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Tenant extends Model
{
    public function daysRemaining()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->lease_end), false);
    }

    public function isExpired()
    {
        return $this->daysRemaining() < 0;
    }

    public function isExpiringSoon()
    {
        $days = $this->daysRemaining();
        return $days <= 7 && $days >= 0;
    }
}
