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
 * Catégories produits spécifiques à l'artisanat et vêtements marocains.
 */
class ProductCategory
{
    // ── Vêtements traditionnels ──────────────────────────────────────────────
    const DJELLABA        = 'djellaba';
    const KAFTAN          = 'kaftan';
    const TAKCHITA        = 'takchita';
    const JABADOR         = 'jabador';
    const HAIK            = 'haik';
    const BURNOUS         = 'burnous';

    // ── Chaussures ──────────────────────────────────────────────────────────
    const BABOUCHES       = 'babouches';
    const BELGHA          = 'belgha';

    // ── Accessoires ─────────────────────────────────────────────────────────
    const CEINTURE        = 'ceinture-brodee';
    const FOULARD         = 'foulard';
    const CHECHE          = 'cheche';
    const SAC_BERBERE     = 'sac-berbere';

    // ── Artisanat ────────────────────────────────────────────────────────────
    const ZELLIGE         = 'zellige';
    const POTERIE         = 'poterie';
    const TAPIS           = 'tapis-berbere';
    const CUIR            = 'maroquinerie';
    const BIJOUX          = 'bijoux-berberes';
    const BOUGIES         = 'bougies-artisanales';
    const VANNERIE        = 'vannerie';

    /** @var array Toutes les catégories avec libellés FR */
    private static array $labels = [
        self::DJELLABA    => 'Djellaba',
        self::KAFTAN      => 'Kaftan',
        self::TAKCHITA    => 'Takchita',
        self::JABADOR     => 'Jabador',
        self::HAIK        => 'Haïk',
        self::BURNOUS     => 'Burnous',
        self::BABOUCHES   => 'Babouches',
        self::BELGHA      => 'Belgha',
        self::CEINTURE    => 'Ceinture brodée',
        self::FOULARD     => 'Foulard',
        self::CHECHE      => 'Chèche',
        self::SAC_BERBERE => 'Sac berbère',
        self::ZELLIGE     => 'Zellige',
        self::POTERIE     => 'Poterie',
        self::TAPIS       => 'Tapis berbère',
        self::CUIR        => 'Maroquinerie',
        self::BIJOUX      => 'Bijoux berbères',
        self::BOUGIES     => 'Bougies artisanales',
        self::VANNERIE    => 'Vannerie',
    ];

    public static function getLabel(string $slug): string
    {
        return self::$labels[$slug] ?? ucfirst(str_replace('-', ' ', $slug));
    }

    public static function all(): array
    {
        return self::$labels;
    }

    public static function getVetements(): array
    {
        return array_filter(
            self::$labels,
            fn($k) => in_array($k, [self::DJELLABA, self::KAFTAN, self::TAKCHITA, self::JABADOR, self::HAIK, self::BURNOUS]),
            ARRAY_FILTER_USE_KEY
        );
    }

    public static function getArtisanat(): array
    {
        return array_filter(
            self::$labels,
            fn($k) => in_array($k, [self::ZELLIGE, self::POTERIE, self::TAPIS, self::CUIR, self::BIJOUX, self::BOUGIES, self::VANNERIE]),
            ARRAY_FILTER_USE_KEY
        );
    }
}
