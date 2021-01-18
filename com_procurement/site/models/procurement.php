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
 * Procurement Model
 *
 * @since  0.0.1
 */
class ProcurementModelProcurement extends JModelList
{
	// /**
	//  * @var object item
	//  */
	// protected $item;

	// /**
	//  * Method to auto-populate the model state.
	//  *
	//  * This method should only be called once per instantiation and is designed
	//  * to be called on the first call to the getState() method unless the model
	//  * configuration flag to ignore the request is set.
	//  *
	//  * Note. Calling getState in this method will result in recursion.
	//  *
	//  * @return	void
	//  * @since	2.5
	//  */
	// protected function populateState()
	// {
	// 	// Get the message id
	// 	$jinput = JFactory::getApplication()->input;
	// 	$id     = $jinput->get('id', 1, 'INT');
	// 	$this->setState('message.id', $id);

	// 	// Load the parameters.
	// 	$this->setState('params', JFactory::getApplication()->getParams());
	// 	parent::populateState();
	// }
	// /**
	//  * @var array messages
	//  */
	// protected $messages;

	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  JTable  A JTable object
	 *
	 * @since   1.6
	 */
	// public function getTable($type = 'Procurement', $prefix = 'ProcurementTable', $config = array())
	// {
	// 	return JTable::getInstance($type, $prefix, $config);
	// }

	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	// public function getItem()
	// {
	// 	if (!isset($this->item)) 
	// 	{
	// 		$id    = $this->getState('message.id');
	// 		$db    = JFactory::getDbo();
	// 		$query = $db->getQuery(true);
	// 		$query->select('p.greeting, p.image as image, c.title as category')
	// 			  ->from('#__procurement as p')
	// 			  ->leftJoin('#__categories as c ON p.catid=c.id')
	// 			  ->where('p.id=' . (int)$id);
	// 		$db->setQuery((string)$query);
		
	// 		if ($this->item = $db->loadObject()) 
	// 		{
	// 			// // Load the JSON string
	// 			// $params = new JRegistry;
	// 			// $params->loadString($this->item->params, 'JSON');
	// 			// $this->item->params = $params;

	// 			// // Merge global params with item params
	// 			// $params = clone $this->getState('params');
	// 			// $params->merge($this->item->params);
	// 			// $this->item->params = $params;

	// 			// Convert the JSON-encoded image info into an array
	// 			$image = new JRegistry;
	// 			$image->loadString($this->item->image, 'JSON');
	// 			$this->item->imageDetails = $image;
	// 		}
	// 	}
	// 	return $this->item;
	// }

	public function getListQuery(){

		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('*')
			  ->from($db->quoteName('#__procurement'));

		return $query;

	}

	/**
	 * Method to get the script that have to be included on the form
	 *
	 * @return string	Script files
	 */
}