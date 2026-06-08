<?php
/**
 * Fahsishop - Site de vêtements et artisanat marocain traditionnel
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright 2026 fahsishop
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Fahsishop\Seo;

use Fahsishop\Catalog\ProductCategory;

/**
 * Aide à la construction du sitemap et des URLs SEO-friendly.
 */
class SitemapHelper
{
    private string $baseUrl;

    public function __construct(string $baseUrl = 'https://fahsishop.com')
    {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Priorités SEO par type de page.
     */
    public function getUrlPriority(string $type): float
    {
        return match($type) {
            'home'     => 1.0,
            'category' => 0.9,
            'product'  => 0.8,
            'cms'      => 0.5,
            default    => 0.6,
        };
    }

    /**
     * Change de mise à jour SEO par type.
     */
    public function getChangeFreq(string $type): string
    {
        return match($type) {
            'home'     => 'daily',
            'category' => 'weekly',
            'product'  => 'weekly',
            'cms'      => 'monthly',
            default    => 'monthly',
        };
    }

    /**
     * Génère les URLs des catégories principales pour le sitemap.
     */
    public function getCategoryUrls(): array
    {
        $urls = [];
        foreach (ProductCategory::all() as $slug => $label) {
            $urls[] = [
                'loc'        => $this->baseUrl . '/' . $slug,
                'changefreq' => 'weekly',
                'priority'   => '0.9',
                'label'      => $label,
            ];
        }
        return $urls;
    }

    /**
     * Génère les hreflang pour le multilangue (FR + AR + EN).
     */
    public function getHreflangTags(string $currentPath): string
    {
        $langs = [
            'fr' => $this->baseUrl . $currentPath,
            'ar' => $this->baseUrl . '/ar' . $currentPath,
            'en' => $this->baseUrl . '/en' . $currentPath,
        ];

        $html = '';
        foreach ($langs as $lang => $url) {
            $html .= sprintf(
                '<link rel="alternate" hreflang="%s" href="%s">' . "\n",
                $lang,
                htmlspecialchars($url, ENT_QUOTES)
            );
        }
        // x-default
        $html .= sprintf(
            '<link rel="alternate" hreflang="x-default" href="%s">' . "\n",
            htmlspecialchars($langs['fr'], ENT_QUOTES)
        );

        return $html;
    }

    /**
     * Génère un slug SEO depuis un nom de produit.
     */
    public static function slugify(string $text, string $separator = '-'): string
    {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9]+/', $separator, $text);
        return trim($text, $separator);
    }
}
