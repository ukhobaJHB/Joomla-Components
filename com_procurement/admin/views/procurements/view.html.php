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
 * Procurements View
 *
 * @since  0.0.1
 */
class ProcurementViewProcurements extends JViewLegacy
{

	/**
	 * Display the Procurement view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */

	function display($tpl = null)
	{
		
		// Get application
		$app = JFactory::getApplication();
		$context = "procurement.list.admin.procurement";
		// Get data from the model
		$this->items			= $this->get('Items');
		$this->pagination		= $this->get('Pagination');
		$this->state			= $this->get('State');
		$this->filter_order 	= $app->getUserStateFromRequest($context.'filter_order', 'filter_order', 'greeting', 'cmd');
		$this->filter_order_Dir = $app->getUserStateFromRequest($context.'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		// Get data from the model
		// $this->items		= $this->get('Items');
		// $this->pagination	= $this->get('Pagination');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = JHelperContent::getActions('com_procurement');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			// JError::raiseError(500, implode('<br />', $errors));

			// return false;
			throw new Exception(implode("\n", $errors), 500);
		}
		
		// Set the submenu
		ProcurementHelper::addSubmenu('procurements');

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   0.0.8
	 */
	protected function addToolBar()
	{
		// require_once JPATH_COMPONENT . '/helpers/procurement.php';
		$title = JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENTS');

		if ($this->pagination->total)
		{
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}
		// JToolbarHelper::title(JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENTS'));
		JToolBarHelper::title($title, 'procurement');

		if ($this->canDo->get('core.create')) 
		{
			JToolBarHelper::addNew('procurement.add', 'JTOOLBAR_NEW');
		}
		if ($this->canDo->get('core.edit')) 
		{
			JToolBarHelper::editList('procurement.edit', 'JTOOLBAR_EDIT');
		}
		if ($this->canDo->get('core.delete')) 
		{
			JToolBarHelper::deleteList('', 'procurements.delete', 'JTOOLBAR_DELETE');
		}
		if ($this->canDo->get('core.admin')) 
		{
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_procurement');
		}

		// JToolbarHelper::addNew('procurement.add');
		// JToolbarHelper::editList('procurement.edit');
		// JToolbarHelper::deleteList('', 'procurements.delete');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_PROCUREMENT_ADMINISTRATION'));
	}
}