/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

jQuery(document).ready(function ($) {
  var homesliderConfig = {
    speed: 500,            // Integer: Speed of the transition, in milliseconds
    timeout: $('.homeslider-container').data('interval'), // Integer: Time between slide transitions, in milliseconds
    nav: true,             // Boolean: Show navigation, true or false
    random: false,          // Boolean: Randomize the order of the slides, true or false
    pause: $('.homeslider-container').data('pause'), // Boolean: Pause on hover, true or false
    maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
    namespace: "homeslider",   // String: Change the default namespace used
    before: function(){},   // Function: Before callback
    after: function(){}     // Function: After callback
  };

  $(".rslides").responsiveSlides(homesliderConfig);

});
