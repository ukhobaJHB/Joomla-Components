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
 * Event component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   0.0.1
 */

abstract class EventHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('Events'),
			'index.php?option=com_event',
			$submenu == 'events'
		);

		JHtmlSidebar::addEntry(
			JText::_('Categories'),
			'index.php?option=com_categories&view=categories&extension=com_event',
			$submenu == 'categories'
		);

		// Set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-event ' .
										'{background-image: url(../media/com_event/images/small_48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('Events - Categories'));
		}
	}
}