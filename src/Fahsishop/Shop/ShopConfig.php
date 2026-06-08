<?php
/**
 * Fahsishop - Site de vêtements et artisanat marocain traditionnel
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright 2026 fahsishop
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace Fahsishop\Shop;

/**
 * Configuration centrale de fahsishop.
 * Centralise les valeurs de marque, SEO et affichage.
 */
class ShopConfig
{
    const SHOP_NAME        = 'fahsishop';
    const SHOP_DOMAIN      = 'fahsishop.com';
    const SHOP_URL         = 'https://fahsishop.com';
    const SHOP_EMAIL       = 'contact@fahsishop.com';
    const SHOP_PHONE       = '';
    const SHOP_COUNTRY     = 'MA';
    const SHOP_CURRENCY    = 'EUR';
    const SHOP_LOCALE_DEFAULT = 'fr-FR';
    const SHOP_LOCALES     = ['fr-FR', 'ar-MA', 'en-US'];

    /** Description courte pour les meta tags */
    const SHOP_DESCRIPTION_SHORT = 'Vêtements & artisanat marocain traditionnel fait main';

    /** Description longue pour la homepage */
    const SHOP_DESCRIPTION_LONG  = 'fahsishop est votre boutique en ligne spécialisée dans les vêtements et l\'artisanat marocain traditionnel. Djellabas, kaftans, babouches, tapis berbères, bijoux, poterie et bien plus — chaque pièce est faite à la main par des artisans marocains.';

    /** Mots-clés SEO principaux */
    const SEO_KEYWORDS = [
        'artisanat marocain',
        'vêtements marocains',
        'djellaba',
        'kaftan',
        'babouches',
        'tapis berbère',
        'bijoux berbères',
        'poterie marocaine',
        'fait main Maroc',
        'artisan marocain',
        'mode marocaine',
        'culture marocaine',
    ];

    /** Réseaux sociaux */
    const SOCIAL = [
        'facebook'  => 'https://facebook.com/fahsishop',
        'instagram' => 'https://instagram.com/fahsishop',
        'tiktok'    => 'https://tiktok.com/@fahsishop',
        'pinterest' => 'https://pinterest.com/fahsishop',
    ];

    /**
     * Retourne la meta description par défaut.
     */
    public static function getDefaultMetaDescription(): string
    {
        return self::SHOP_DESCRIPTION_SHORT . ' | ' . self::SHOP_NAME;
    }

    /**
     * Retourne les keywords SEO sous forme de chaîne.
     */
    public static function getSeoKeywordsString(): string
    {
        return implode(', ', self::SEO_KEYWORDS);
    }

    /**
     * Retourne le title SEO par défaut.
     */
    public static function getDefaultTitle(string $pageName = ''): string
    {
        if ($pageName) {
            return $pageName . ' | ' . self::SHOP_NAME . ' – Artisanat Marocain';
        }
        return self::SHOP_NAME . ' – Vêtements & Artisanat Marocain Traditionnel';
    }
}
