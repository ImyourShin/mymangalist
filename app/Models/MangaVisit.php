<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MangaVisit extends Model
{
    protected $table = 'manga_visits';
    protected $fillable = ['manga_id', 'ip_address', 'url', 'user_agent'];

    public function manga()
    {
        return $this->belongsTo(MangaModel::class, 'manga_id', 'manga_id');
    }
}
