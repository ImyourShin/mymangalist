<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteVisit extends Model
{
    protected $table = 'site_visits';
    protected $fillable = ['ip_address', 'url', 'user_agent'];
}
