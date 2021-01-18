<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_procurement
 *
 * @copyright   Copyright (C) 2021 Where Is The Beef Media, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
/**
 * Form Rule class for the Joomla Framework.
 */
class JFormRuleGreeting extends JFormRule
{
	/**
	 * The regular expression.
	 *
	 * @access	protected
	 * @var		string
	 * @since	0.0.11
	 */
	protected $regex = '^[^0-9]+$';
}