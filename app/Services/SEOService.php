<?php

namespace App\Services;

use App\Models\Article;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Database\Eloquent\Model;

class SEOService
{
    /**
     * Generate SEO data for a page
     */
    public function generatePageSEO(string $page, array $overrides = []): SEOData
    {
        $config = config("seo.pages.{$page}", []);
        
        return new SEOData(
            title: $overrides['title'] ?? $config['title'] ?? config('app.name'),
            description: $overrides['description'] ?? $config['description'] ?? config('seo.description.fallback'),
            author: $overrides['author'] ?? config('seo.author.fallback'),
            image: $overrides['image'] ?? asset(config('seo.image.fallback')),
            canonical_url: $overrides['canonical_url'] ?? url()->current(),
            robots: $overrides['robots'] ?? config('seo.robots.default'),
            type: $overrides['type'] ?? 'website',
        );
    }

    /**
     * Generate SEO for blog article
     */
    public function generateArticleSEO(Article $article): SEOData
    {
        $excerpt = $this->getExcerpt($article->content, 160);
        
        return new SEOData(
            title: $article->title,
            description: $article->meta_description ?: $excerpt,
            author: $article->user->name ?? 'Kréyatik Studio',
            image: $article->image ? asset('storage/' . $article->image) : asset('images/default-blog.jpg'),
            canonical_url: route('blog.show', $article->slug),
            robots: 'index, follow',
            type: 'article',
            published_time: $article->published_at ? \Carbon\Carbon::parse($article->published_at) : null,
            modified_time: $article->updated_at ? \Carbon\Carbon::parse($article->updated_at) : null,
        );
    }

    /**
     * Generate SEO for blog index
     */
    public function generateBlogIndexSEO(): SEOData
    {
        $latestArticle = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->first();

        return new SEOData(
            title: 'Blog - Actualités Web & Conseils Digital',
            description: 'Découvrez nos derniers articles sur le développement web, le design UX/UI, le SEO et les tendances digitales. Conseils d\'experts pour votre présence en ligne.',
            author: 'Kréyatik Studio',
            image: $latestArticle && $latestArticle->image 
                ? asset('storage/' . $latestArticle->image) 
                : asset('images/blog-og.jpg'),
            canonical_url: route('blog'),
            type: 'website',
            modified_time: $latestArticle && $latestArticle->updated_at ? \Carbon\Carbon::parse($latestArticle->updated_at) : null,
        );
    }

    /**
     * Get excerpt from content
     */
    private function getExcerpt(string $content, int $limit = 160): string
    {
        $cleaned = strip_tags($content);
        $cleaned = preg_replace('/\s+/', ' ', trim($cleaned));
        
        return strlen($cleaned) > $limit 
            ? substr($cleaned, 0, $limit - 3) . '...'
            : $cleaned;
    }

    /**
     * Generate structured data for an article
     */
    public function generateArticleStructuredData(Article $article): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $article->title,
            'description' => $article->meta_description ?: $this->getExcerpt($article->content),
            'image' => $article->image ? asset('storage/' . $article->image) : asset('images/default-blog.jpg'),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Kréyatik Studio',
                'url' => url('/')
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Kréyatik Studio',
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ],
            'datePublished' => $article->published_at?->toISOString(),
            'dateModified' => $article->updated_at->toISOString(),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $article->slug)
            ]
        ];
    }

    /**
     * Generate breadcrumbs structured data
     */
    public function generateBreadcrumbs(array $breadcrumbs): array
    {
        $items = [];
        
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url']
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items
        ];
    }

    /**
     * Generate organization structured data
     */
    public function generateOrganizationData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Kréyatik Studio',
            'url' => url('/'),
            'logo' => asset('images/logo.png'),
            'description' => 'Agence web spécialisée dans la création de sites internet modernes et performants',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => '2 rue du petit port marchand',
                'addressLocality' => 'Rochefort',
                'postalCode' => '17300',
                'addressCountry' => 'FR'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+33695800663',
                'contactType' => 'customer service',
                'email' => 'kreyatik@gmail.com'
            ],
            'sameAs' => [
                config('seo.social_facebook'),
                config('seo.social_twitter'),
                config('seo.social_instagram'),
                config('seo.social_linkedin')
            ]
        ];
    }
}