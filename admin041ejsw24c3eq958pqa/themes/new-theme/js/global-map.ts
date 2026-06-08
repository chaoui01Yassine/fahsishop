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

export default {
  navBar: {
    menuItems: '.main-menu .link-levelone.has_submenu.ul-open',
    menuItemLink: '.nav-bar li.link-levelone.has_submenu > a',
    menuArrow:
      '.nav-bar li.link-levelone.has_submenu a > i.material-icons.sub-tabs-arrow',
    levelOneOpenedList: '.nav-bar li.link-levelone.has_submenu.ul-open',
    levelOneOpenedSubmenu:
      '.nav-bar li.link-levelone.has_submenu.ul-open ul.submenu',
  },
  notifications: {
    ordersNotifications: '#orders-notifications',
    orderNotificationTemplate: '#order-notification-template',
    customersNotifications: '#customers-notifications',
    customerNotificationTemplate: '#customer-notification-template',
    messagesNotifications: '#messages-notifications',
    messageNotificationTemplate: '#message-notification-template',
    total: '#notifications-total',
    element: '.notification-elements',
  },
};
