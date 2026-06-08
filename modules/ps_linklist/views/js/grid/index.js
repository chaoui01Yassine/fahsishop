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

import Grid from '@components/grid/grid';
import LinkRowActionExtension from '@components/grid/extension/link-row-action-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import SortingExtension from "@components/grid/extension/sorting-extension";
import PositionExtension from "@components/grid/extension/position-extension";

const $ = window.$;

$(() => {
  let gridDivs = document.querySelectorAll('.js-grid');
  gridDivs.forEach((gridDiv) => {
      const linkBlockGrid = new Grid(gridDiv.dataset.gridId);

      linkBlockGrid.addExtension(new SortingExtension());
      linkBlockGrid.addExtension(new LinkRowActionExtension());
      linkBlockGrid.addExtension(new SubmitRowActionExtension());
      linkBlockGrid.addExtension(new PositionExtension());
  });
});
