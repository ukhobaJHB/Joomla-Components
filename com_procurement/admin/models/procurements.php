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
 * ProcurementList Model
 *
 * @since  0.0.1
 */
class ProcurementModelProcurements extends JModelList
{

	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 *
	 * @see     JController
	 * @since   0.0.9
	 */
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'bid_number',
				'closing_date',
				'brief_date',
				'awarded_to',
				'bid_amount',
				'bbbee_level',
				'total_points',
			);
		}

		parent::__construct($config);
	}

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Initialize variables.
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true);

		// Create the base select statement.
		$query->select('a.id as id,
		a.bid_number as bid_number,
		a.bid_description as bid_description,
		a.download_link as download_link,
		a.closing_date as closing_date,
		a.brief_date as brief_date,
		a.awarded_to as awarded_to,
		a.bid_amount as bid_amount,
		a.bbbee_level as bbbee_level,
		a.total_points as total_points, a.published as published, 
		a.image as imageInfo')
                ->from($db->quoteName('#__procurement', 'a'));

		// Join over the categories.
		$query->select($db->quoteName('c.title', 'category_title'))
				->join('LEFT', $db->quoteName('#__categories', 'c') . ' ON c.id = a.catid');

		// Filter: like / search
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			$like = $db->quote('%' . $search . '%');
			$query->where('bid_number LIKE ' . $like . 'OR bid_description LIKE ' . $like);
		}

		// Filter by published state
		$published = $this->getState('filter.published');

		if (is_numeric($published))
		{
			$query->where('a.published = ' . (int) $published);
		}
		elseif ($published === '')
		{
			$query->where('(a.published IN (0, 1))');
		}

		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering', 'id');
		$orderDirn 	= $this->state->get('list.direction', 'asc');

		$query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));
		

		return $query;
	}
}