<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreModel extends Model
{
    use HasFactory;

    protected $table = 'genres';
    protected $primaryKey = 'genre_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    public function mangas()
    {
        return $this->belongsToMany(
            MangaModel::class, 
            'manga_genre',
            'genre_id',
            'manga_id',
            'genre_id',
            'manga_id'
        );
    }
}