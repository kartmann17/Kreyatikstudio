<?php

namespace App\Traits;

use RalphJSmit\Laravel\SEO\Support\SEOData;

trait HasDynamicSEO
{
    /**
     * Generate dynamic SEO data for the model
     */
    public function generateSEOData(array $overrides = []): SEOData
    {
        $defaultData = $this->getDefaultSEOData();
        
        return new SEOData(
            title: $overrides['title'] ?? $defaultData['title'],
            description: $overrides['description'] ?? $defaultData['description'],
            author: $overrides['author'] ?? $defaultData['author'] ?? 'Kréyatik Studio',
            image: $overrides['image'] ?? $defaultData['image'] ?? asset('images/default-og.jpg'),
            canonical_url: $overrides['canonical_url'] ?? $defaultData['canonical_url'],
            robots: $overrides['robots'] ?? $defaultData['robots'] ?? 'index, follow',
            type: $overrides['type'] ?? $defaultData['type'] ?? 'website',
        );
    }

    /**
     * Get default SEO data - should be implemented by the model
     */
    abstract protected function getDefaultSEOData(): array;

    /**
     * Get meta description from content or fallback
     */
    protected function getMetaDescription(?string $content = null, int $limit = 160): string
    {
        if (!$content) {
            return config('seo.description.fallback');
        }
        
        $cleaned = strip_tags($content);
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);
        
        return strlen($cleaned) > $limit 
            ? substr($cleaned, 0, $limit - 3) . '...'
            : $cleaned;
    }

    /**
     * Generate structured data for search engines
     */
    public function getStructuredData(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => $this->getSchemaType(),
            'name' => $this->getSEOTitle(),
            'description' => $this->getSEODescription(),
            'url' => $this->getSEOCanonicalUrl(),
            'author' => [
                '@type' => 'Organization',
                'name' => 'Kréyatik Studio'
            ]
        ];
    }

    /**
     * Get schema.org type - should be implemented by model
     */
    protected function getSchemaType(): string
    {
        return 'Thing';
    }

    /**
     * Get SEO title - should be implemented by model
     */
    abstract protected function getSEOTitle(): string;

    /**
     * Get SEO description - should be implemented by model  
     */
    abstract protected function getSEODescription(): string;

    /**
     * Get SEO canonical URL - should be implemented by model
     */
    abstract protected function getSEOCanonicalUrl(): string;
}