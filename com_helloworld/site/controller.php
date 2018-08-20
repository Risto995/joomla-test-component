<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
/**
 * Hello World Component Controller
 *
 * @since  0.0.1
 */
class HelloWorldController extends JControllerLegacy
{
    /**
     * @param	string	The context for the data
     * @param	int		The user id
     * @param	object
     * @return	boolean
     * @since	1.6
     */
    function onContentPrepareData($context, $data)
    {
        // Check we are manipulating a valid form.
        if (!in_array($context, array('com_users.profile','com_users.registration','com_users.user','com_admin.profile'))){
            return true;
        }
    }

    /**
     * @param	JForm	The form to be altered.
     * @param	array	The associated data for the form.
     * @return	boolean
     * @since	1.6
     */
    function onContentPrepareForm($form, $data)
    {
        if (!($form instanceof JForm)) {
            $this->_subject->setError('JERROR_NOT_A_FORM');
            return false;
        }

        // Check we are manipulating a valid form.
        if (!in_array($form->getName(), array('com_users.profile', 'com_users.registration','com_users.user','com_admin.profile'))) {
            return true;
        }
        if ($form->getName()=='com_users.profile')
        {
            // Add the profile fields to the form.
            JForm::addFormPath(dirname(__FILE__).'/fields');
            $form->loadFile('profile', false);

            // Toggle whether the something field is required.
            if ($this->params->get('profile-require_something', 1) > 0) {
                $form->setFieldAttribute('something', 'required', $this->params->get('profile-require_something') == 2, 'profile5');
            } else {
                $form->removeField('something', 'profile5');
            }
        }

        //In this example, we treat the frontend registration and the back end user create or edit as the same.
        elseif ($form->getName()=='com_users.registration' || $form->getName()=='com_users.user' )
        {
            // Add the registration fields to the form.
            JForm::addFormPath(dirname(__FILE__).'/fields');
            $form->loadFile('profile', false);

            // Toggle whether the something field is required.
            if ($this->params->get('register-require_something', 1) > 0) {
                $form->setFieldAttribute('something', 'required', $this->params->get('register-require_something') == 2, 'profile5');
            } else {
                $form->removeField('something', 'profile5');
            }
        }
    }
}