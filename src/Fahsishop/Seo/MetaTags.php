<?php
/**
 * Fahsishop - Site de vêtements et artisanat marocain traditionnel
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright 2026 fahsishop
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Fahsishop\Seo;

/**
 * Génère les balises meta SEO optimisées pour fahsishop.
 * Spécialisé vêtements et artisanat marocain traditionnel.
 */
class MetaTags
{
    private string $shopName   = 'fahsishop';
    private string $shopDomain = 'fahsishop.com';
    private string $locale     = 'fr_FR';

    // Mots-clés globaux du site
    private array $globalKeywords = [
        'artisanat marocain',
        'vêtements marocains traditionnels',
        'djellaba',
        'kaftan',
        'babouches',
        'artisanat Maroc',
        'fait main Maroc',
        'tapis berbère',
        'bijoux berbères',
        'poterie marocaine',
    ];

    public function __construct(string $locale = 'fr_FR')
    {
        $this->locale = $locale;
    }

    /**
     * Meta tags pour la page d'accueil.
     */
    public function homeMeta(): array
    {
        return [
            'title'       => 'fahsishop – Vêtements & Artisanat Marocain Traditionnel | Fait Main',
            'description' => 'Découvrez fahsishop, votre boutique en ligne de vêtements et artisanat marocain traditionnel : djellaba, kaftan, babouches, tapis berbères, bijoux et poterie. Livraison internationale.',
            'keywords'    => implode(', ', $this->globalKeywords),
            'og:title'    => 'fahsishop – Artisanat & Mode Marocaine Authentique',
            'og:description' => 'Bijoux, vêtements, tapis et objets d\'artisanat du Maroc. Pièces uniques faites à la main par des artisans marocains.',
            'og:type'     => 'website',
            'og:locale'   => $this->locale,
        ];
    }

    /**
     * Meta tags pour une page catégorie.
     */
    public function categoryMeta(string $categoryName, string $description = ''): array
    {
        $title = $categoryName . ' Marocain(e) | fahsishop';
        $desc  = $description ?: sprintf(
            'Découvrez notre sélection de %s marocain(e)s authentiques, faits à la main par des artisans du Maroc. Qualité traditionnelle, livraison internationale.',
            strtolower($categoryName)
        );

        return [
            'title'       => $title,
            'description' => $desc,
            'keywords'    => $categoryName . ' marocain, ' . implode(', ', array_slice($this->globalKeywords, 0, 5)),
            'og:title'    => $title,
            'og:description' => $desc,
            'og:type'     => 'website',
        ];
    }

    /**
     * Meta tags pour une fiche produit.
     */
    public function productMeta(
        string $productName,
        string $description,
        string $price,
        string $imageUrl = '',
        string $sku      = ''
    ): array {
        $title = $productName . ' | fahsishop – Artisanat Marocain';

        return [
            'title'           => $title,
            'description'     => mb_substr($description, 0, 160),
            'keywords'        => $productName . ', artisanat marocain, fait main Maroc',
            'og:title'        => $title,
            'og:description'  => mb_substr($description, 0, 200),
            'og:type'         => 'product',
            'og:image'        => $imageUrl,
            'og:locale'       => $this->locale,
            'product:price:amount'   => $price,
            'product:price:currency' => 'EUR',
        ];
    }

    /**
     * Render les balises <meta> en HTML.
     */
    public function render(array $meta): string
    {
        $html = '';
        $standard = ['title', 'description', 'keywords'];

        if (!empty($meta['title'])) {
            $html .= '<title>' . htmlspecialchars($meta['title'], ENT_QUOTES) . '</title>' . "\n";
        }

        foreach ($meta as $name => $content) {
            if ($name === 'title') {
                continue;
            }
            $content = htmlspecialchars((string)$content, ENT_QUOTES);
            if (str_starts_with($name, 'og:') || str_starts_with($name, 'product:')) {
                $html .= sprintf('<meta property="%s" content="%s">' . "\n", $name, $content);
            } else {
                $html .= sprintf('<meta name="%s" content="%s">' . "\n", $name, $content);
            }
        }

        return $html;
    }
}
