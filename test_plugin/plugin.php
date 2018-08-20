<?php
// no direct access
defined('_JEXEC') or die;

use \Joomla\CMS\Access\Access;

class plgUserPlugin extends JPlugin
{
    /**
     * Load the language file on instantiation. Note this is only available in Joomla 3.1 and higher.
     * If you want to support 3.0 series you must override the constructor
     *
     * @var    boolean
     * @since  3.1
     */
    protected $autoloadLanguage = true;

    /**
     * @param array $oldUser
     * @param bool $isNew
     * @param array $newUser
     */
    function onUserBeforeSave($oldUser, $isNew, $newUser)
    {
        $users = Access::getUsersByGroup(1);

        foreach ($users as $user) {
            var_dump($user);
        }
    }

    /**
     * @param    string    The context for the data
     * @param    int        The user id
     * @param    object
     * @return    boolean
     * @since    1.6
     */
    function onContentPrepareData($context, $data)
    {
        // Check we are manipulating a valid form.
        if (!in_array($context, array('com_users.profile', 'com_users.registration', 'com_users.user', 'com_admin.profile'))) {
            return true;
        }

        $userId = isset($data->id) ? $data->id : 0;

        // Load the profile data from the database.
        $db = JFactory::getDbo();
        $db->setQuery(
            'SELECT profile_key, profile_value FROM #__user_profiles' .
            ' WHERE user_id = ' . (int)$userId .
            ' AND profile_key LIKE \'profile5.%\'' .
            ' ORDER BY ordering'
        );
        $results = $db->loadRowList();

        // Check for a database error.
        if ($db->getErrorNum()) {
            $this->_subject->setError($db->getErrorMsg());
            return false;
        }

        // Merge the profile data.
        $data->profile5 = array();
        foreach ($results as $v) {
            $k = str_replace('profile5.', '', $v[0]);
            $data->profile5[$k] = json_decode($v[1], true);
        }

        return true;
    }

    /**
     * Plugin method with the same name as the event will be called automatically.
     */
    function onContentPrepareForm($form, $data)
    {
        $lang = JFactory::getLanguage();
        $lang->load('test_plugin', JPATH_ADMINISTRATOR);

        if (!($form instanceof JForm)) {
            $this->_subject->setError('JERROR_NOT_A_FORM');
            return false;
        }
        // Check we are manipulating a valid form.
        if (!in_array($form->getName(), array('com_users.profile', 'com_users.registration', 'com_users.user', 'com_admin.profile'))) {
            return true;
        }

        if ($form->getName() === 'com_users.profile') {
            // Add the profile fields to the form.
            JForm::addFormPath(dirname(__FILE__) . '/fields');
            $form->loadFile('newsletter_subscription', false);

            $form->setFieldAttribute('newsletter_subscription', 'required', true, 'basic');

        } //In this example, we treat the frontend registration and the back end user create or edit as the same.
        elseif (in_array($form->getName(), ['com_users.registration', 'com_users.user'])) {
            // Add the registration fields to the form.
            JForm::addFormPath(dirname(__FILE__) . '/fields');
            $form->loadFile('newsletter_subscription', false);

            $form->setFieldAttribute('newsletter_subscription', 'required', true, 'basic');

        }
    }
}

?>

