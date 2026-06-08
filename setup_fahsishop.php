<?php
/**
 * Script d'installation complet fahsishop
 * - Langues : FR, NL, EN, AR, ES
 * - Transporteurs
 * - Paiements
 * - Détection automatique de langue
 */

define('_PS_ADMIN_DIR_', __DIR__ . '/admin041ejsw24c3eq958pqa');
require_once __DIR__ . '/config/config.inc.php';

$context = Context::getContext();
$id_shop = (int)Configuration::get('PS_SHOP_DEFAULT');
$id_lang_fr = 1;

echo "=== Setup fahsishop ===\n\n";

// ══════════════════════════════════════════════════════════════
// 1. LANGUES
// ══════════════════════════════════════════════════════════════
echo "[1/4] Installation des langues...\n";

$languages = [
    'en' => ['name' => 'English (English)', 'locale' => 'en-US', 'language_code' => 'en-us', 'iso_code' => 'en', 'date_format_lite' => 'm/d/Y', 'date_format_full' => 'm/d/Y H:i:s', 'is_rtl' => 0],
    'nl' => ['name' => 'Nederlands (Dutch)', 'locale' => 'nl-NL', 'language_code' => 'nl-nl', 'iso_code' => 'nl', 'date_format_lite' => 'd/m/Y', 'date_format_full' => 'd/m/Y H:i:s', 'is_rtl' => 0],
    'es' => ['name' => 'Español (Spanish)', 'locale' => 'es-ES', 'language_code' => 'es-es', 'iso_code' => 'es', 'date_format_lite' => 'd/m/Y', 'date_format_full' => 'd/m/Y H:i:s', 'is_rtl' => 0],
    'ar' => ['name' => 'عربي (Arabic)', 'locale' => 'ar-MA', 'language_code' => 'ar', 'iso_code' => 'ar', 'date_format_lite' => 'd/m/Y', 'date_format_full' => 'd/m/Y H:i:s', 'is_rtl' => 1],
];

$lang_ids = ['fr' => $id_lang_fr];

foreach ($languages as $iso => $data) {
    // Check if already exists
    $id_existing = (int)Db::getInstance()->getValue(
        "SELECT id_lang FROM " . _DB_PREFIX_ . "lang WHERE iso_code = '" . $iso . "'"
    );

    if ($id_existing) {
        echo "  - {$data['name']}: déjà installée (id=$id_existing)\n";
        $lang_ids[$iso] = $id_existing;
        // Ensure active
        Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "lang SET active=1 WHERE id_lang=$id_existing");
        continue;
    }

    // Try to download and install via PS
    $result = Language::downloadAndInstallLanguagePack($iso, null, null, false);

    if (!$result || (is_array($result) && isset($result['errors']) && count($result['errors']))) {
        // Fallback: manual DB insert
        Db::getInstance()->execute("
            INSERT INTO " . _DB_PREFIX_ . "lang
            (name, iso_code, locale, language_code, active, date_format_lite, date_format_full, is_rtl)
            VALUES (
                '" . pSQL($data['name']) . "',
                '" . pSQL($iso) . "',
                '" . pSQL($data['locale']) . "',
                '" . pSQL($data['language_code']) . "',
                1,
                '" . pSQL($data['date_format_lite']) . "',
                '" . pSQL($data['date_format_full']) . "',
                " . (int)$data['is_rtl'] . "
            )
        ");
        $id_new_lang = (int)Db::getInstance()->Insert_ID();
        echo "  - {$data['name']}: installée manuellement (id=$id_new_lang)\n";
    } else {
        $id_new_lang = (int)Db::getInstance()->getValue(
            "SELECT id_lang FROM " . _DB_PREFIX_ . "lang WHERE iso_code = '" . $iso . "'"
        );
        echo "  - {$data['name']}: téléchargée et installée (id=$id_new_lang)\n";
    }
    $lang_ids[$iso] = $id_new_lang > 0 ? $id_new_lang : null;

    // Add to shop
    if ($id_new_lang > 0) {
        Db::getInstance()->execute("
            INSERT IGNORE INTO " . _DB_PREFIX_ . "lang_shop (id_lang, id_shop)
            VALUES ($id_new_lang, $id_shop)
        ");
    }
}

// Copy FR lang data to missing translations
foreach ($lang_ids as $iso => $id_lang) {
    if (!$id_lang || $iso === 'fr') continue;

    // Copy category translations
    $cats = Db::getInstance()->executeS("SELECT id_category, name, description, link_rewrite, meta_title, meta_description, meta_keywords FROM " . _DB_PREFIX_ . "category_lang WHERE id_lang=$id_lang_fr");
    foreach ((array)$cats as $cat) {
        Db::getInstance()->execute("INSERT IGNORE INTO " . _DB_PREFIX_ . "category_lang (id_category, id_shop, id_lang, name, description, link_rewrite, meta_title, meta_description, meta_keywords)
            VALUES ({$cat['id_category']}, $id_shop, $id_lang, '" . pSQL($cat['name']) . "', '" . pSQL($cat['description']) . "', '" . pSQL($cat['link_rewrite']) . "', '" . pSQL($cat['meta_title']) . "', '" . pSQL($cat['meta_description']) . "', '" . pSQL($cat['meta_keywords']) . "')");
    }
}
echo "  Traductions de base copiées.\n\n";

// ══════════════════════════════════════════════════════════════
// 2. TRANSPORTEURS
// ══════════════════════════════════════════════════════════════
echo "[2/4] Configuration des transporteurs...\n";

// Delete junk carrier "ff"
Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "carrier SET deleted=1 WHERE name='ff'");

$carriers_to_add = [
    [
        'name'            => 'Colissimo (France/Belgique)',
        'url'             => 'https://www.laposte.fr/outils/suivre-vos-envois?code=@',
        'active'          => 1,
        'shipping_method' => 2, // by price
        'position'        => 1,
        'max_weight'      => 30,
        'delay'           => ['fr'=>'2-3 jours ouvrés','en'=>'2-3 business days','nl'=>'2-3 werkdagen','es'=>'2-3 días laborables','ar'=>'2-3 أيام عمل'],
        'ranges'          => [
            ['from'=>0,  'to'=>50,   'price'=>4.99],
            ['from'=>50, 'to'=>100,  'price'=>6.99],
            ['from'=>100,'to'=>9999, 'price'=>0],  // free above 100€
        ],
    ],
    [
        'name'            => 'DHL Express (International)',
        'url'             => 'https://www.dhl.com/fr-fr/home/tracking.html?tracking-id=@',
        'active'          => 1,
        'shipping_method' => 2,
        'position'        => 2,
        'max_weight'      => 70,
        'delay'           => ['fr'=>'3-5 jours ouvrés','en'=>'3-5 business days','nl'=>'3-5 werkdagen','es'=>'3-5 días laborables','ar'=>'3-5 أيام عمل'],
        'ranges'          => [
            ['from'=>0,  'to'=>100,  'price'=>12.99],
            ['from'=>100,'to'=>250,  'price'=>9.99],
            ['from'=>250,'to'=>9999, 'price'=>0],
        ],
    ],
    [
        'name'            => 'PostNL (Pays-Bas)',
        'url'             => 'https://jouw.postnl.nl/track-and-trace/@',
        'active'          => 1,
        'shipping_method' => 2,
        'position'        => 3,
        'max_weight'      => 20,
        'delay'           => ['fr'=>'3-5 jours ouvrés','en'=>'3-5 business days','nl'=>'1-2 werkdagen','es'=>'3-5 días laborables','ar'=>'3-5 أيام عمل'],
        'ranges'          => [
            ['from'=>0,  'to'=>75,   'price'=>7.99],
            ['from'=>75, 'to'=>9999, 'price'=>0],
        ],
    ],
    [
        'name'            => 'Correos Express (Espagne)',
        'url'             => 'https://www.correos.es/es/es/herramientas/localizador/envios/detalle?codigo=@',
        'active'          => 1,
        'shipping_method' => 2,
        'position'        => 4,
        'max_weight'      => 20,
        'delay'           => ['fr'=>'4-6 jours ouvrés','en'=>'4-6 business days','nl'=>'4-6 werkdagen','es'=>'2-3 días laborables','ar'=>'4-6 أيام عمل'],
        'ranges'          => [
            ['from'=>0,  'to'=>80,   'price'=>8.99],
            ['from'=>80, 'to'=>9999, 'price'=>0],
        ],
    ],
    [
        'name'            => 'Livraison offerte (Maroc)',
        'url'             => '',
        'active'          => 1,
        'shipping_method' => 2,
        'position'        => 5,
        'max_weight'      => 5,
        'is_free'         => 1,
        'delay'           => ['fr'=>'7-14 jours','en'=>'7-14 days','nl'=>'7-14 dagen','es'=>'7-14 días','ar'=>'7-14 يوم'],
        'ranges'          => [
            ['from'=>0, 'to'=>9999, 'price'=>0],
        ],
    ],
];

foreach ($carriers_to_add as $cdata) {
    $existing = (int)Db::getInstance()->getValue(
        "SELECT id_carrier FROM " . _DB_PREFIX_ . "carrier WHERE name='" . pSQL($cdata['name']) . "' AND deleted=0"
    );
    if ($existing) {
        echo "  - {$cdata['name']}: déjà configuré\n";
        continue;
    }

    $isFree = isset($cdata['is_free']) ? 1 : 0;

    Db::getInstance()->execute("
        INSERT INTO " . _DB_PREFIX_ . "carrier
        (id_reference, name, url, active, deleted, shipping_handling, range_behavior,
         is_module, is_free, shipping_external, need_range, shipping_method, position, max_weight)
        VALUES (
            0, '" . pSQL($cdata['name']) . "', '" . pSQL($cdata['url']) . "',
            1, 0, 0, 0, 0, $isFree, 0, 1,
            {$cdata['shipping_method']}, {$cdata['position']}, {$cdata['max_weight']}
        )
    ");
    $id_carrier = (int)Db::getInstance()->Insert_ID();

    // Update id_reference to match id_carrier
    Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "carrier SET id_reference=$id_carrier WHERE id_carrier=$id_carrier");

    // Add delay translations
    foreach ($cdata['delay'] as $iso => $delay_text) {
        $id_l = isset($lang_ids[$iso]) ? $lang_ids[$iso] : null;
        if (!$id_l) continue;
        Db::getInstance()->execute("
            INSERT IGNORE INTO " . _DB_PREFIX_ . "carrier_lang (id_carrier, id_lang, delay)
            VALUES ($id_carrier, $id_l, '" . pSQL($delay_text) . "')
        ");
    }

    // Link to shop
    Db::getInstance()->execute("
        INSERT IGNORE INTO " . _DB_PREFIX_ . "carrier_shop (id_carrier, id_shop)
        VALUES ($id_carrier, $id_shop)
    ");

    // Create price ranges
    foreach ($cdata['ranges'] as $range) {
        Db::getInstance()->execute("
            INSERT INTO " . _DB_PREFIX_ . "range_price (id_carrier, delimiter1, delimiter2)
            VALUES ($id_carrier, {$range['from']}, {$range['to']})
        ");
        $id_range = (int)Db::getInstance()->Insert_ID();

        // Apply to all zones
        $zones = Db::getInstance()->executeS("SELECT id_zone FROM " . _DB_PREFIX_ . "zone WHERE active=1");
        foreach ((array)$zones as $zone) {
            Db::getInstance()->execute("
                INSERT IGNORE INTO " . _DB_PREFIX_ . "delivery (id_carrier, id_range_price, id_range_weight, id_zone, price)
                VALUES ($id_carrier, $id_range, 0, {$zone['id_zone']}, {$range['price']})
            ");
        }
    }

    echo "  - {$cdata['name']}: créé (id=$id_carrier)\n";
}
echo "\n";

// ══════════════════════════════════════════════════════════════
// 3. MOYENS DE PAIEMENT — activer et configurer
// ══════════════════════════════════════════════════════════════
echo "[3/4] Configuration des paiements...\n";

// Ensure payment modules are active and linked to all shops
$payment_modules = ['ps_checkpayment', 'ps_wirepayment', 'ps_cashondelivery'];
foreach ($payment_modules as $mod_name) {
    Db::getInstance()->execute("UPDATE " . _DB_PREFIX_ . "module SET active=1 WHERE name='" . pSQL($mod_name) . "'");

    $id_mod = (int)Db::getInstance()->getValue("SELECT id_module FROM " . _DB_PREFIX_ . "module WHERE name='" . pSQL($mod_name) . "'");
    if ($id_mod) {
        Db::getInstance()->execute("INSERT IGNORE INTO " . _DB_PREFIX_ . "module_shop (id_module, id_shop) VALUES ($id_mod, $id_shop)");
        echo "  - $mod_name: activé\n";
    }
}

// Configure wire payment details
Configuration::updateValue('WIRE_OWNER', 'fahsishop');
Configuration::updateValue('WIRE_DETAILS', 'IBAN: BE00 0000 0000 0000 | BIC: XXXXXXXX');
Configuration::updateValue('WIRE_ADDRESS', 'fahsishop - contact@fahsishop.com');

// Configure check payment
Configuration::updateValue('PS_CHEQUE_NAME', 'fahsishop');
Configuration::updateValue('PS_CHEQUE_ADDRESS', 'contact@fahsishop.com');

// Activate COD for all carriers
$carriers_result = Db::getInstance()->executeS("SELECT id_carrier FROM " . _DB_PREFIX_ . "carrier WHERE active=1 AND deleted=0");
foreach ((array)$carriers_result as $c) {
    Db::getInstance()->execute("INSERT IGNORE INTO " . _DB_PREFIX_ . "module_carrier (id_module, id_reference, id_shop)
        SELECT id_module, {$c['id_carrier']}, $id_shop FROM " . _DB_PREFIX_ . "module WHERE name='ps_cashondelivery'");
}
echo "  - Paiement à la livraison: lié à tous les transporteurs\n\n";

// ══════════════════════════════════════════════════════════════
// 4. DÉTECTION AUTOMATIQUE DE LANGUE PAR PAYS/NAVIGATEUR
// ══════════════════════════════════════════════════════════════
echo "[4/4] Configuration détection automatique de langue...\n";

// Enable browser language detection
Configuration::updateValue('PS_DETECT_LANG', 1);
Configuration::updateValue('PS_DETECT_COUNTRY', 1);

// Map countries to languages
$country_lang_map = [
    // France, Belgique FR, Suisse FR, Maroc, Algérie, Tunisie → FR
    'FR' => 'fr', 'MC' => 'fr', 'CI' => 'fr', 'SN' => 'fr',
    'MA' => 'fr', 'DZ' => 'fr', 'TN' => 'fr',
    // Pays-Bas, Belgique NL → NL
    'NL' => 'nl', 'SR' => 'nl', 'AW' => 'nl',
    // Espagne, Mexique, Amérique Latine → ES
    'ES' => 'es', 'MX' => 'es', 'AR_C' => 'es', 'CO' => 'es', 'PE' => 'es',
    // Pays arabes → AR
    'SA' => 'ar', 'AE' => 'ar', 'QA' => 'ar', 'KW' => 'ar',
    'EG' => 'ar', 'JO' => 'ar', 'LB' => 'ar', 'IQ' => 'ar',
];

foreach ($country_lang_map as $country_iso => $lang_iso) {
    $country_iso = str_replace('_C', '', $country_iso); // clean suffix
    $id_country = (int)Db::getInstance()->getValue(
        "SELECT id_country FROM " . _DB_PREFIX_ . "country WHERE iso_code='" . pSQL($country_iso) . "'"
    );
    $id_target_lang = isset($lang_ids[$lang_iso]) ? $lang_ids[$lang_iso] : $id_lang_fr;

    if ($id_country && $id_target_lang) {
        Db::getInstance()->execute("
            UPDATE " . _DB_PREFIX_ . "country
            SET id_lang=$id_target_lang
            WHERE id_country=$id_country
        ");
    }
}
echo "  - Détection par navigateur: activée\n";
echo "  - Mapping pays → langue: configuré\n\n";

// ══════════════════════════════════════════════════════════════
// 5. CONFIG GÉNÉRALE BOUTIQUE MULTILINGUE
// ══════════════════════════════════════════════════════════════
echo "[5/5] Configuration générale...\n";

// Enable all languages in shop
$all_langs = Db::getInstance()->executeS("SELECT id_lang FROM " . _DB_PREFIX_ . "lang WHERE active=1");
foreach ((array)$all_langs as $l) {
    Db::getInstance()->execute("INSERT IGNORE INTO " . _DB_PREFIX_ . "lang_shop (id_lang, id_shop) VALUES ({$l['id_lang']}, $id_shop)");
}

// Default language stays FR
Configuration::updateValue('PS_LANG_DEFAULT', $id_lang_fr);

// URL rewriting (important for multilingual SEO)
Configuration::updateValue('PS_REWRITING_SETTINGS', 1);

// Activate geolocation module if available
$geomod = (int)Db::getInstance()->getValue("SELECT id_module FROM " . _DB_PREFIX_ . "module WHERE name='ganalytics'");

// Clear all caches
Tools::clearAllCache();
if (method_exists('Tools', 'clearSmartyCache')) {
    Tools::clearSmartyCache();
}

echo "  - Toutes les langues liées à la boutique\n";
echo "  - Langue par défaut: Français\n";
echo "  - URL rewriting: activé\n";
echo "  - Caches vidés\n\n";

echo "==============================================\n";
echo " SETUP TERMINÉ !\n";
echo "==============================================\n";
echo "\nRésumé :\n";

$langs = Db::getInstance()->executeS("SELECT name, iso_code, active FROM " . _DB_PREFIX_ . "lang ORDER BY id_lang");
echo "\nLangues :\n";
foreach ((array)$langs as $l) {
    echo "  " . ($l['active'] ? '✓' : '✗') . " {$l['name']} ({$l['iso_code']})\n";
}

$carriers = Db::getInstance()->executeS("SELECT name, active FROM " . _DB_PREFIX_ . "carrier WHERE deleted=0 ORDER BY position");
echo "\nTransporteurs :\n";
foreach ((array)$carriers as $c) {
    echo "  " . ($c['active'] ? '✓' : '✗') . " {$c['name']}\n";
}

echo "\nPaiements : virement, chèque, paiement à la livraison\n";
echo "\nAccès admin : http://localhost:8000/admin041ejsw24c3eq958pqa/\n";
