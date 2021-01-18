<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_event
 *
 * @copyright   Copyright (C) 2021 Where Is The Beef Media, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('Event');

// Perform the Request task
$input = JFactory::getApplication()->input;
// $controller->execute($input->getCmd('task'));
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();