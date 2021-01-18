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
 * Procurement component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   0.0.12
 */

abstract class ProcurementHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_PROCUREMENT_SUBMENU_TENDERS'),
			'index.php?option=com_procurement',
			$submenu == 'procurements'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_PROCUREMENT_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&view=categories&extension=com_procurement',
			$submenu == 'categories'
		);

		// Set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-procurement ' .
										'{background-image: url(../media/com_procurement/images/small_48x48.png);}');
		if ($submenu == 'categories') 
		{
			$document->setTitle(JText::_('COM_PROCUREMENT_ADMINISTRATION_CATEGORIES'));
		}
	}
}