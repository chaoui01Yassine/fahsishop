<?php
/**
 * Fahsishop - Site de vêtements et artisanat marocain traditionnel
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright 2026 fahsishop
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Fahsishop\Theme;

use Fahsishop\Seo\MetaTags;
use Fahsishop\Seo\StructuredData;
use Fahsishop\Shop\ShopConfig;

/**
 * Helper pour le thème fahsishop.
 * Injecte le SEO, les données structurées et les assets dans les templates.
 */
class ThemeHelper
{
    private MetaTags      $metaTags;
    private StructuredData $structuredData;

    public function __construct()
    {
        $this->metaTags      = new MetaTags();
        $this->structuredData = new StructuredData();
    }

    /**
     * Génère le bloc <head> complet optimisé SEO pour la homepage.
     */
    public function renderHomepageHead(): string
    {
        $meta = $this->metaTags->homeMeta();
        $html  = $this->metaTags->render($meta);
        $html .= $this->structuredData->websiteSchema();
        $html .= $this->getCanonical(ShopConfig::SHOP_URL . '/');
        $html .= $this->getPreconnects();
        return $html;
    }

    /**
     * Génère le bloc SEO pour une page produit.
     */
    public function renderProductHead(array $product): string
    {
        $meta = $this->metaTags->productMeta(
            $product['name'],
            $product['description'] ?? '',
            $product['price'] ?? '0',
            $product['image'] ?? '',
            $product['reference'] ?? ''
        );
        $html  = $this->metaTags->render($meta);
        $html .= $this->structuredData->productSchema($product);
        if (!empty($product['url'])) {
            $html .= $this->getCanonical($product['url']);
        }
        return $html;
    }

    /**
     * Génère le bloc SEO pour une page catégorie.
     */
    public function renderCategoryHead(string $categoryName, array $products = []): string
    {
        $meta = $this->metaTags->categoryMeta($categoryName);
        $html  = $this->metaTags->render($meta);
        if (!empty($products)) {
            $html .= $this->structuredData->categoryListSchema($categoryName, $products);
        }
        return $html;
    }

    /**
     * Balise canonical.
     */
    public function getCanonical(string $url): string
    {
        return sprintf('<link rel="canonical" href="%s">' . "\n", htmlspecialchars($url, ENT_QUOTES));
    }

    /**
     * Preconnects pour les polices et CDN (performance).
     */
    public function getPreconnects(): string
    {
        $domains = [
            'https://fonts.googleapis.com',
            'https://fonts.gstatic.com',
        ];
        $html = '';
        foreach ($domains as $domain) {
            $html .= sprintf('<link rel="preconnect" href="%s" crossorigin>' . "\n", $domain);
        }
        return $html;
    }

    /**
     * Balises Open Graph pour le partage social.
     */
    public function getOpenGraphImage(string $imageUrl, int $width = 1200, int $height = 630): string
    {
        return sprintf(
            '<meta property="og:image" content="%s">' . "\n" .
            '<meta property="og:image:width" content="%d">' . "\n" .
            '<meta property="og:image:height" content="%d">' . "\n",
            htmlspecialchars($imageUrl, ENT_QUOTES),
            $width,
            $height
        );
    }

    /**
     * Twitter Card tags.
     */
    public function getTwitterCard(string $title, string $description, string $imageUrl = ''): string
    {
        $html  = '<meta name="twitter:card" content="summary_large_image">' . "\n";
        $html .= '<meta name="twitter:site" content="@fahsishop">' . "\n";
        $html .= sprintf('<meta name="twitter:title" content="%s">' . "\n", htmlspecialchars($title, ENT_QUOTES));
        $html .= sprintf('<meta name="twitter:description" content="%s">' . "\n", htmlspecialchars($description, ENT_QUOTES));
        if ($imageUrl) {
            $html .= sprintf('<meta name="twitter:image" content="%s">' . "\n", htmlspecialchars($imageUrl, ENT_QUOTES));
        }
        return $html;
    }
}
