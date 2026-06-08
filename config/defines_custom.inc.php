<?php
/**
 * fahsishop — Override custom (point d'extension PrestaShop)
 *
 * Détection HTTPS derrière un reverse proxy / tunnel (Cloudflare, ngrok…).
 * Quand on accède au site via une URL HTTPS publique qui transmet la
 * requête à Apache en HTTP, ce header permet à PrestaShop de savoir
 * qu'il est en HTTPS — sinon il génère des redirections en boucle.
 */
if (
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
    || (isset($_SERVER['HTTP_CF_VISITOR']) && strpos($_SERVER['HTTP_CF_VISITOR'], 'https') !== false)
) {
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
    $_SERVER['REQUEST_SCHEME'] = 'https';
}

// Si on est derrière le tunnel, le host réel vient du header forwardé
if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && $_SERVER['HTTP_X_FORWARDED_HOST'] !== '') {
    $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_X_FORWARDED_HOST'];
}
