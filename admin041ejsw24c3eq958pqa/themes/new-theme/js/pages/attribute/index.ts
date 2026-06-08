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

import Grid from '@components/grid/grid';
import SortingExtension from '@components/grid/extension/sorting-extension';
import FiltersResetExtension from '@components/grid/extension/filters-reset-extension';
import ReloadListActionExtension from '@components/grid/extension/reload-list-extension';
import SubmitRowActionExtension from '@components/grid/extension/action/row/submit-row-action-extension';
import SubmitBulkExtension from '@components/grid/extension/submit-bulk-action-extension';
import BulkActionCheckboxExtension from '@components/grid/extension/bulk-action-checkbox-extension';
import ExportToSqlManagerExtension from '@components/grid/extension/export-to-sql-manager-extension';
import FiltersSubmitButtonEnablerExtension from '@components/grid/extension/filters-submit-button-enabler-extension';
import PositionExtension from '@components/grid/extension/position-extension';

const {$} = window;

$(() => {
  const grid = new Grid('attribute');

  grid.addExtension(new ExportToSqlManagerExtension());
  grid.addExtension(new ReloadListActionExtension());
  grid.addExtension(new SortingExtension());
  grid.addExtension(new FiltersResetExtension());
  grid.addExtension(new SubmitRowActionExtension());
  grid.addExtension(new SubmitBulkExtension());
  grid.addExtension(new BulkActionCheckboxExtension());
  grid.addExtension(new FiltersSubmitButtonEnablerExtension());
  grid.addExtension(new PositionExtension(grid));
});
