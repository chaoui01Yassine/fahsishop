/**
 * Copyright since 2007 fahsishop and Contributors
 * fahsishop is an International Registered Trademark & Property of fahsishop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@fahsishop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade fahsishop to newer
 * versions in the future. If you wish to customize fahsishop for your
 * needs please refer to https://fahsishop.com/ for more information.
 *
 * @author    fahsishop and Contributors <contact@fahsishop.com>
 * @copyright Since 2007 fahsishop and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

// Dependencies

import 'prestakit/dist/js/prestashop-ui-kit';
import 'jquery-ui-dist/jquery-ui';
import 'bootstrap-tokenfield';
import 'eonasdan-bootstrap-datetimepicker';
import 'jwerty';
import 'magnific-popup';
import 'dropzone';
import 'typeahead.js/dist/typeahead.jquery';
import 'typeahead.js/dist/bloodhound.min';
import 'jquery-serializejson';

import '@scss/theme.scss';

// Theme Javascript
import NavBar from '@js/nav_bar';

// this needs to be ported into the UI kit
import '@js/clickable-dropdown';

import '@js/maintenance-page';
import '@js/translation-page/index';

import Header from '@js/header';

import initDatePickers from '@js/app/utils/datepicker';
import initInvalidFields from '@js/app/utils/fields';
import initEmailFields from '@js/app/utils/email-idn';
import initNumberCommaTransformer from '@js/app/utils/number-comma-transformer';
import initPrestashopComponents from '@app/utils/init-components';
import watchSymfonyDebugBar from '@app/utils/watch-symfony-debug-bar';
import '@js/components/header/search-form';

const {$} = window;

// Theme Javascript
window.Dropzone.autoDiscover = false;

new NavBar();
new Header();

$(() => {
  initPrestashopComponents();
  initDatePickers();
  initInvalidFields();
  initEmailFields('input[type="email"]');
  initNumberCommaTransformer('.js-comma-transformer');
  watchSymfonyDebugBar();
});
