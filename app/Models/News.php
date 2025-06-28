<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'status',
        'thumbnail',
        'slug',
        'poster_id',
        'medical_service_id',
    ];

    public function newsCategories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_category_news', 'news_id', 'category_id');
    }

    public function poster()
    {
        return $this->belongsTo(Admin::class, 'poster_id');
    }

    public function service()
    {
        return $this->belongsTo(MedicalService::class, 'medical_service_id');
    }
}
