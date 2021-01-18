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
 * Procurement View
 *
 * @since  0.0.1
 */
class ProcurementViewProcurement extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $script;
	protected $canDo;
	/**
	 * View form
	 *
	 * @var         form
	 */
	// protected $form = null;

	/**
	 * Display the Procurement view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		// Get the Data
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');

		// What Access Permissions does this user have? What can (s)he do?
		$this->canDo = JHelperContent::getActions('com_procurement', 'procurement', $this->item->id);

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			// JError::raiseError(500, implode('<br />', $errors));

			// return false;
			throw new Exception(implode("\n", $errors), 500);
		}


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
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$input = JFactory::getApplication()->input;

		// Hide Joomla Administrator Main menu
		$input->set('hidemainmenu', true);

		$isNew = ($this->item->id == 0);

		JToolBarHelper::title($isNew ? JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENT_NEW')
		                             : JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENT_EDIT'), 'procurement');
		// Build the actions for new and existing records.
		if ($isNew)
		{
			// For new records, check the create permission.
			if ($this->canDo->get('core.create')) 
			{
				JToolBarHelper::apply('procurement.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('procurement.save', 'JTOOLBAR_SAVE');
				JToolBarHelper::custom('procurement.save2new', 'save-new.png', 'save-new_f2.png',
				                       'JTOOLBAR_SAVE_AND_NEW', false);
			}
			JToolBarHelper::cancel('procurement.cancel', 'JTOOLBAR_CANCEL');
		}
		else
		{
			if ($this->canDo->get('core.edit'))
			{
				// We can save the new record
				JToolBarHelper::apply('procurement.apply', 'JTOOLBAR_APPLY');
				JToolBarHelper::save('procurement.save', 'JTOOLBAR_SAVE');
 
				// We can save this record, but check the create permission to see
				// if we can return to make a new one.
				if ($this->canDo->get('core.create')) 
				{
					JToolBarHelper::custom('procurement.save2new', 'save-new.png', 'save-new_f2.png',
					                       'JTOOLBAR_SAVE_AND_NEW', false);
				}
			}
			if ($this->canDo->get('core.create')) 
			{
				JToolBarHelper::custom('procurement.save2copy', 'save-copy.png', 'save-copy_f2.png',
				                       'JTOOLBAR_SAVE_AS_COPY', false);
			}
			JToolBarHelper::cancel('procurement.cancel', 'JTOOLBAR_CLOSE');
		}

		// if ($isNew)
		// {
		// 	$title = JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENT_NEW');
		// }
		// else
		// {
		// 	$title = JText::_('COM_PROCUREMENT_MANAGER_PROCUREMENT_EDIT');
		// }

		// JToolbarHelper::title($title, 'procurement');
		// JToolbarHelper::save('procurement.save');
		// JToolbarHelper::cancel(
		// 	'procurement.cancel',
		// 	$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
		// );
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		
		JHtml::_('behavior.framework');
		JHtml::_('behavior.formvalidator');

		$isNew = ($this->item->id < 1);
		$document = JFactory::getDocument();
		$document->setTitle($isNew ? JText::_('COM_PROCUREMENT_PROCUREMENT_CREATING') :
                JText::_('COM_PROCUREMENT_PROCUREMENT_EDITING'));
		$document->addScript(JURI::root() . $this->script);
		$document->addScript(JURI::root() . "/administrator/components/com_procurement"
		                                  . "/views/procurement/submitbutton.js");
		JText::script('COM_PROCUREMENT_PROCUREMENT_ERROR_UNACCEPTABLE');
	}
}