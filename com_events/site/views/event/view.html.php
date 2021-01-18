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
 * HTML View class for the Event Component
 *
 * @since  0.0.1
 */
class EventViewEvent extends JViewLegacy
{

	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		// $this->items		= $this->get('Items');

		// // Assign data to the view
		$this->items 		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');

			return false;
		}

		// Display the view
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		
		$document = JFactory::getDocument();
		$document->addScript(JURI::root() . "components/com_event/models/calendar/js/vanilla-calendar.js");
		$document->addStyleSheet(JURI::root() . "components/com_event/models/calendar/css/vanilla-calendar.css");
		$document->addScript(JURI::root() . "components/com_event/models/event.js");
		$document->addStyleSheet(JURI::root() . "components/com_event/models/event.css");
	}
}