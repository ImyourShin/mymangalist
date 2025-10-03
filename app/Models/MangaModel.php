<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MangaModel extends Model
{
    use HasFactory;

    protected $table = 'manga';
    protected $primaryKey = 'manga_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'status',
        'release_year',
        'type',
        'synopsis',
        'cover_img',
    ];

    public function reviews()
    {
        return $this->hasMany(ReviewModel::class, 'manga_id', 'manga_id');
    }

    public function favorites()
    {
        return $this->hasMany(FavoriteModel::class, 'manga_id', 'manga_id');
    }

    public function genres()
    {
        return $this->belongsToMany(
            GenreModel::class, 
            'manga_genre',
            'manga_id',
            'genre_id',
            'manga_id',
            'genre_id'
        );
    }
}