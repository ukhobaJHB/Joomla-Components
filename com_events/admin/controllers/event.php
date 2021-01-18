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

/**
 * Event Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_event
 * @since       0.0.1
 */
class EventControllerEvent extends JControllerForm
{
	/**
	* Implement to allowAdd or not
	*
	* Not used at this time (but you can look at how other components use it....)
	* Overwrites: JControllerForm::allowAdd
	*
	* @param array $data
	* @return bool
	*/
	protected function allowAdd($data = array())
	{
		return parent::allowAdd($data);
	}
	/**
	* Implement to allow edit or not
	* Overwrites: JControllerForm::allowEdit
	*
	* @param array $data
	* @param string $key
	* @return bool
	*/
	protected function allowEdit($data = array(), $key = 'id')
	{
		$id = isset( $data[ $key ] ) ? $data[ $key ] : 0;
		if( !empty( $id ) )
		{
			return JFactory::getUser()->authorise( "core.edit", "com_event.event." . $id );
		}
	}
}