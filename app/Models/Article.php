<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
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

    public function setContentAttribute($value): void
    {
        $this->attributes['content'] = html_entity_decode($value ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    public function getPlainTextAttribute(): string
    {
        $decoded = html_entity_decode($this->attributes['content'] ?? '', ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $decoded = str_replace("\xC2\xA0", ' ', $decoded); // NBSP → espace normal
        return trim(strip_tags($decoded));
    }

    public function getExcerptAttribute($value): string
    {
        if (!empty($value)) {
            // Si tu as saisi un excerpt manuel en BO
            $manual = html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            return Str::limit(str_replace("\xC2\xA0", ' ', strip_tags($manual)), 160);
        }

        return Str::limit($this->plain_text, 160);
    }

}
