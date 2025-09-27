<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaModel extends Model
{
    protected $table = 'manga';         // ชื่อตาราง
    protected $primaryKey = 'manga_id';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'genre',
        'status',
        'release_year',
        'cover_img',
    ];


    public function reviews()
    {
        return $this->hasMany(ReviewModel::class, 'manga_id', 'manga_id');
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteModel::class, 'manga_id');
    }
}
