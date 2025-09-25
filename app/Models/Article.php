<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Article extends Model
{
    use HasFactory, HasSEO;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'excerpt',
        'meta_description',
        'meta_keywords',
        'is_published',
        'published_at',
        'user_id'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDynamicSEOData(): SEOData
    {
        $excerpt = $this->excerpt ?: strip_tags(substr($this->content, 0, 160));
        
        return new SEOData(
            title: $this->title . ' - Blog',
            description: $this->meta_description ?: $excerpt,
            author: 'Kréyatik Studio',
            image: $this->image ? asset('storage/' . $this->image) : asset('images/default-blog.jpg'),
            canonical_url: route('blog.show', $this->slug),
            type: 'article',
            published_time: $this->published_at?->toISOString(),
            modified_time: $this->updated_at?->toISOString(),
        );
    }

    public function getExcerptAttribute($value)
    {
        return $value ?: strip_tags(substr($this->content, 0, 160)) . '...';
    }
}
