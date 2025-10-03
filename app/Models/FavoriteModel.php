<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorites';
    protected $primaryKey = 'favorite_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'manga_id'
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function manga()
    {
        return $this->belongsTo(MangaModel::class, 'manga_id');
    }
}