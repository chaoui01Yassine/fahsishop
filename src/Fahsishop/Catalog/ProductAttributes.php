<?php
/**
 * Fahsishop - Site de vêtements et artisanat marocain traditionnel
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright 2026 fahsishop
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Fahsishop\Catalog;

/**
 * Attributs produits spécifiques à l'artisanat marocain.
 * Utilisé pour enrichir les fiches produit et le SEO.
 */
class ProductAttributes
{
    /** Régions artisanales du Maroc */
    const REGIONS = [
        'fes'         => 'Fès',
        'marrakech'   => 'Marrakech',
        'sale'        => 'Salé',
        'essaouira'   => 'Essaouira',
        'meknes'      => 'Meknès',
        'ouarzazate'  => 'Ouarzazate',
        'tetouan'     => 'Tétouan',
        'tanger'      => 'Tanger',
        'safi'        => 'Safi',
        'taznakht'    => 'Taznakht',
    ];

    /** Matières traditionnelles */
    const MATIERES = [
        'laine'       => 'Laine',
        'soie'        => 'Soie',
        'coton'       => 'Coton',
        'velours'     => 'Velours',
        'brocart'     => 'Brocart',
        'lin'         => 'Lin',
        'cuir'        => 'Cuir',
        'cedre'       => 'Bois de cèdre',
        'argile'      => 'Argile',
        'laiton'      => 'Laiton',
        'argent'      => 'Argent',
        'alfa'        => 'Alfa (jonc)',
        'cactus_silk' => 'Soie de cactus',
    ];

    /** Types de broderie */
    const BRODERIES = [
        'fassi'        => 'Broderie fassi (Fès)',
        'rabati'       => 'Broderie rabati',
        'chefchaouni'  => 'Broderie Chefchaouen',
        'azemmouri'    => 'Broderie d\'Azemmour',
    ];

    /** Techniques artisanales */
    const TECHNIQUES = [
        'tissage_main'   => 'Tissage à la main',
        'broderie_main'  => 'Broderie à la main',
        'poterie_tour'   => 'Poterie au tour',
        'zellige_main'   => 'Zellige taillé à la main',
        'tannage_vegetal'=> 'Tannage végétal',
        'marqueterie'    => 'Marqueterie',
    ];

    public static function getRegionLabel(string $slug): string
    {
        return self::REGIONS[$slug] ?? ucfirst($slug);
    }

    public static function getMatiereLabel(string $slug): string
    {
        return self::MATIERES[$slug] ?? ucfirst($slug);
    }

    /**
     * Génère les mots-clés SEO pour un produit artisanal.
     */
    public static function buildSeoKeywords(
        string $category,
        string $region = '',
        string $matiere = '',
        array  $extra = []
    ): string {
        $keywords = [
            ProductCategory::getLabel($category),
            'artisanat marocain',
            'fait main Maroc',
        ];

        if ($region && isset(self::REGIONS[$region])) {
            $keywords[] = 'artisanat ' . self::REGIONS[$region];
        }
        if ($matiere && isset(self::MATIERES[$matiere])) {
            $keywords[] = self::MATIERES[$matiere];
        }

        $keywords = array_merge($keywords, $extra);

        return implode(', ', array_unique($keywords));
    }
}
