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

JFormHelper::loadFieldClass('list');

/**
 * Procurement Form Field class for the Procurement component
 *
 * @since  0.0.1
 */
class JFormFieldProcurement extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var         string
	 */
	protected $type = 'Procurement';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return  array  An array of JHtml options.
	 */
	protected function getOptions()
	{
		$db    = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select(
			'#__procurement.id as id,
			bid_number,
			bid_description,
			download_link,
			closing_date,
			brief_date,
			awarded_to,
			bid_amount,
			bbbee_level,
			total_points,
			#__categories.title as category,
			catid'
		);
		$query->from('#__procurement');
		$query->leftJoin('#__categories on catid=#__categories.id');
		// Retrieve only published items
		$query->where('#__procurement.published = 1');
		$db->setQuery((string) $query);
		$tenders = $db->loadObjectList();
		$options  = array();

		if ($tenders)
		{
			foreach ($tenders as $tender)
			{
				$options[] = JHtml::_('select.option', $tender->bid_number, $tender->bid_description .
										$tender->closing_date, $tender->download_link, $tender->brief_date, $tender->awarded_to, .
										$tender->bid_amount, $tender->bbbee_level, $tender->total_points, .
										($tender->catid ? ' (' . $tender->category . ')' : ''));
			}
		}

		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}