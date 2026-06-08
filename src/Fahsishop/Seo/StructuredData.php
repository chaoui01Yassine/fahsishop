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
 * Génère les données structurées JSON-LD (Schema.org) pour le SEO.
 * Optimisé pour les produits d'artisanat et vêtements marocains.
 */
class StructuredData
{
    private string $shopUrl  = 'https://fahsishop.com';
    private string $shopName = 'fahsishop';
    private string $logo     = 'https://fahsishop.com/img/logo.png';

    /**
     * Schema Organisation / WebSite pour la homepage.
     */
    public function websiteSchema(): string
    {
        $data = [
            '@context' => 'https://schema.org',
            '@graph'   => [
                [
                    '@type'  => 'Organization',
                    '@id'    => $this->shopUrl . '/#organization',
                    'name'   => $this->shopName,
                    'url'    => $this->shopUrl,
                    'logo'   => [
                        '@type' => 'ImageObject',
                        'url'   => $this->logo,
                    ],
                    'description' => 'Boutique en ligne de vêtements et artisanat marocain traditionnel. Djellaba, kaftan, babouches, tapis berbères, bijoux et poterie faits à la main.',
                    'address' => [
                        '@type'           => 'PostalAddress',
                        'addressCountry'  => 'MA',
                    ],
                    'sameAs' => [
                        'https://www.facebook.com/fahsishop',
                        'https://www.instagram.com/fahsishop',
                    ],
                ],
                [
                    '@type'          => 'WebSite',
                    '@id'            => $this->shopUrl . '/#website',
                    'url'            => $this->shopUrl,
                    'name'           => $this->shopName,
                    'publisher'      => ['@id' => $this->shopUrl . '/#organization'],
                    'potentialAction' => [
                        '@type'       => 'SearchAction',
                        'target'      => $this->shopUrl . '/recherche?q={search_term_string}',
                        'query-input' => 'required name=search_term_string',
                    ],
                ],
            ],
        ];

        return $this->toScript($data);
    }

    /**
     * Schema Product pour une fiche produit artisanal.
     */
    public function productSchema(array $product): string
    {
        $data = [
            '@context'    => 'https://schema.org',
            '@type'       => 'Product',
            'name'        => $product['name'] ?? '',
            'description' => $product['description'] ?? '',
            'image'       => $product['images'] ?? [],
            'sku'         => $product['sku'] ?? '',
            'brand' => [
                '@type' => 'Brand',
                'name'  => $this->shopName,
            ],
            'offers' => [
                '@type'         => 'Offer',
                'url'           => $product['url'] ?? '',
                'priceCurrency' => 'EUR',
                'price'         => $product['price'] ?? '',
                'availability'  => ($product['in_stock'] ?? true)
                    ? 'https://schema.org/InStock'
                    : 'https://schema.org/OutOfStock',
                'seller' => [
                    '@type' => 'Organization',
                    'name'  => $this->shopName,
                ],
            ],
        ];

        // Ajouter matière si disponible
        if (!empty($product['material'])) {
            $data['material'] = $product['material'];
        }

        // Ajouter région d'origine si disponible
        if (!empty($product['region'])) {
            $data['countryOfOrigin'] = [
                '@type' => 'Country',
                'name'  => 'Maroc',
            ];
            $data['locationCreated'] = [
                '@type'       => 'Place',
                'name'        => $product['region'],
                'addressCountry' => 'MA',
            ];
        }

        // Ajouter les avis si disponibles
        if (!empty($product['rating']) && !empty($product['review_count'])) {
            $data['aggregateRating'] = [
                '@type'       => 'AggregateRating',
                'ratingValue' => $product['rating'],
                'reviewCount' => $product['review_count'],
                'bestRating'  => '5',
                'worstRating' => '1',
            ];
        }

        return $this->toScript($data);
    }

    /**
     * Schema BreadcrumbList pour la navigation.
     */
    public function breadcrumbSchema(array $items): string
    {
        $list = [];
        foreach ($items as $i => $item) {
            $list[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'name'     => $item['name'],
                'item'     => $item['url'],
            ];
        }

        $data = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => $list,
        ];

        return $this->toScript($data);
    }

    /**
     * Schema ItemList pour une page catégorie (liste de produits).
     */
    public function categoryListSchema(string $categoryName, array $products): string
    {
        $items = [];
        foreach ($products as $i => $product) {
            $items[] = [
                '@type'    => 'ListItem',
                'position' => $i + 1,
                'url'      => $product['url'],
                'name'     => $product['name'],
            ];
        }

        $data = [
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => $categoryName . ' – fahsishop',
            'itemListElement' => $items,
        ];

        return $this->toScript($data);
    }

    private function toScript(array $data): string
    {
        return '<script type="application/ld+json">' . "\n"
            . json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT)
            . "\n</script>\n";
    }
}
