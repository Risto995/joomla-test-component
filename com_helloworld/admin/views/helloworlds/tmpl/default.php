<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('stylesheet', JUri::root() . 'media/com_helloworld/css/cleverreach.css');
JHtml::_('stylesheet', JUri::root() . 'media/com_helloworld/css/cleverreach-welcome.css');
JHtml::_('stylesheet', JUri::root() . 'media/com_helloworld/css/cleverreach-dashboard.css');
JHtml::_('stylesheet', JUri::root() . 'media/com_helloworld/css/cleverreach-icofont.css');
JHtml::_('script', JUri::root() . 'media/com_helloworld/js/cleverreach.welcome.js');
JHtml::_('script', JUri::root() . 'media/com_helloworld/js/cleverreach.dashboard.js');
?>

<div class="cr-loader-big">
    <span class="cr-loader"></span>
</div>

<div class="cr-connecting">
    <span>
        <?php echo JText::_('COM_HELLOWORLD_CONNECTING'); ?>
    </span>
</div>

<div class="cr-content-window-wrapper">
    <div class="cr-content-window">
        <img class="cr-welcome-icon" src="<?php echo JUri::root() .
            'media/com_helloworld/img/icon_' . JText::_('COM_HELLOWORLD_WELCOME_SCREEN_HELLO_ICON') . '.png'; ?>">
        <h3>
            <?php echo JText::_('COM_HELLOWORLD_WELCOME_SCREEN_TITLE'); ?>
        </h3>
        <div class="cr-dashboard-text-wrapper cr-main-text">
            <?php echo JText::_('COM_HELLOWORLD_WELCOME_SCREEN_MESSAGE'); ?>
        </div>
        <div class="cr-action-buttons-wrapper">
            <button class="cr-primary" id="cr-new-account">
                <?php echo JText::_('COM_HELLOWORLD_WELCOME_SCREEN_CREATE_ACCOUNT_BUTTON_TEXT'); ?>
            </button>
            <button class="cr-secondary" id="cr-log-account">
                <?php echo JText::_('COM_HELLOWORLD_WELCOME_SCREEN_LOGIN_BUTTON_TEXT'); ?>
            </button>
        </div>
    </div>
</div>
