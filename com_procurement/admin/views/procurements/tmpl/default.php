<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_procurement
 *
 * @copyright   Copyright (C) 2021 Where Is The Beef Media, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\Registry\Registry;

JHtml::_('formbehavior.chosen', 'select');

$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_procurement&view=procurements" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
		<div class="row-fluid">
			<div class="span6">
				<?php echo JText::_('COM_PROCUREMENT_PROCUREMENTS_FILTER'); ?>
				<?php
					echo JLayoutHelper::render(
						'joomla.searchtools.default',
						array('view' => $this)
					);
				?>
			</div>
		</div>
		<table class="table table-striped table-hover">
			<thead>
			<tr>
				<!-- <th width="1%"><?php echo JText::_('COM_PROCUREMENT_NUM'); ?></th> -->
				<th width="2%">
					<?php echo JHtml::_('grid.sort', 'COM_PROCUREMENT_ID', 'id', $listDirn, $listOrder); ?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th width="90%">
					<?php echo JHtml::_('grid.sort', 'COM_PROCUREMENT_PROCUREMENTS_NAME', 'bid_number', $listDirn, $listOrder) ;?>
				</th>
                <th width="30%">
                    <?php echo JText::_('COM_PROCUREMENT_PROCUREMENTS_IMAGE'); ?>
                </th>
                <th width="15%">
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_PROCUREMENT_PUBLISHED', 'published', $listDirn, $listOrder); ?>
				</th>
			</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="5">
						<?php echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php if (!empty($this->items)) : ?>
					<?php foreach ($this->items as $i => $row) :
                        $link = JRoute::_('index.php?option=com_procurement&task=procurement.edit&id=' . $row->id);
                        $row->image = new Registry;
                        $row->image->loadString($row->imageInfo); ?>

						<tr>
							<!-- <td>
								<?php // echo $this->pagination->getRowOffset($i); ?>
							</td> -->
							<td align="center">
								<?php echo $row->id; ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $row->id); ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_PROCUREMENT_EDIT_PROCUREMENT'); ?>">
									<?php echo $row->bid_number; ?>
								</a>
								<div class="small">
									<?php echo JText::_('JCATEGORY') . ': ' . $this->escape($row->category_title); ?>
								</div>
							</td>
                            <td align="center">
                                <?php
                                    $caption = $row->image->get('caption') ? : '' ;
                                    $src = JURI::root() . ($row->image->get('image') ? : '' );
                                    $html = '<p class="hasTooltip" style="display: inline-block" data-html="true" data-toggle="tooltip" data-placement="right" title="<img width=\'100px\' height=\'100px\' src=\'%s\'>">%s</p>';
                                    echo sprintf($html, $src, $caption);  ?>
                            </td>
							<td align="center">
								<?php echo JHtml::_('jgrid.published', $row->published, $i, 'procurements.', true, 'cb'); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
		<input type="hidden" name="task" value=""/>
		<input type="hidden" name="boxchecked" value="0"/>
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>