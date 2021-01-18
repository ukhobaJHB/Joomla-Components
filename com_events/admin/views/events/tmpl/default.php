<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_event
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
<form action="index.php?option=com_event&view=events" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
		<div class="row-fluid">
			<div class="span6">
				<?php echo JText::_('Filters'); ?>
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
				<th width="1%"><?php echo JText::_(' '); ?></th>
				<th width="2%">
					<?php echo JHtml::_('grid.sort', 'ID', 'id', $listDirn, $listOrder); ?>
				</th>
				<th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
				</th>
				<th width="30%">
					<?php echo JHtml::_('grid.sort', 'Title', 'title', $listDirn, $listOrder) ;?>
				</th>
                <th width="30%">
                    <?php echo JHtml::_('grid.sort', 'Description', 'description', $listDirn, $listOrder); ?>
                </th>
                <th width="15%">
					<?php echo JHtml::_('grid.sort', 'Starting', 'start_time', $listDirn, $listOrder) ;?>
				</th>
                <th width="15%">
					<?php echo JHtml::_('grid.sort', 'Ending', 'end_time', $listDirn, $listOrder) ;?>
				</th>
				<th width="5%">
					<?php echo JHtml::_('grid.sort', 'Published', 'published', $listDirn, $listOrder); ?>
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
                        $link = JRoute::_('index.php?option=com_event&task=event.edit&id=' . $row->id);
                        $row->image = new Registry;
                        $row->image->loadString($row->imageInfo); ?>

						<tr>
							<!-- <td>
								<?php // echo $this->pagination->getRowOffset($i); ?>
							</td> -->
							<td><?php echo JText::_('#'); ?></td>
							<td align="center">
								<?php echo $row->id; ?>
							</td>
							<td>
								<?php echo JHtml::_('grid.id', $i, $row->id); ?>
							</td>
							<td>
								<a href="<?php echo $link; ?>" title="<?php echo JText::_('Edit Event'); ?>">
									<?php echo $row->title; ?>
								</a>
								<div class="small">
									<?php 
										if ($this->escape($row->category_title) !== ''){
											echo JText::_('JCATEGORY') . ': ' . $this->escape($row->category_title);
										} 
									?>
								</div>
							</td>
							<td align="center">
								<?php echo JText::_($row->description); ?>
							</td>
							<td align="center">
								<?php echo JText::_($row->start_time); ?>
							</td>
							<td>
								<?php echo JText::_($row->end_time); ?>
							</td>
							<td align="center">
								<?php echo JHtml::_('jgrid.published', $row->published, $i, 'events.', true, 'cb'); ?>
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