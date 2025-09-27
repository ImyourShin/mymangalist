<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewModel extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'manga_id',
        'rating',
        'comment'
    ];

    // ความสัมพันธ์กับ Users
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    // ความสัมพันธ์กับ Manga
    public function manga()
    {
        return $this->belongsTo(MangaModel::class, 'manga_id');
    }
}
