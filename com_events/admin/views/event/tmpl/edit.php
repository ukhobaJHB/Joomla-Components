<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_event
 *
 * @copyright   Copyright (C) 2021 Where Is The Beef Media, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.formvalidator');

// The following is to enable setting the permission's Calculated Setting 
// when you change the permission's Setting. 
// The core javascript code for initiating the Ajax request looks for a field
// with id="jform_title" and sets its value as the 'title' parameter to send in the Ajax request
JFactory::getDocument()->addScriptDeclaration('
	jQuery(document).ready(function() {
        greeting = jQuery("#jform_greeting").val();
		jQuery("#jform_title").val(greeting);
	});
');

?>
<form action="<?php echo JRoute::_('index.php?option=com_event&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    
    <input id="jform_title" type="hidden" name="event-message-title"/>

    <div class="form-horizontal">

        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'details')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'details', 
            empty($this->item->id) ? JText::_('New Event') : JText::_('Edit Event')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('Event Details') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('details');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'image', JText::_('Image')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('Image Info') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('image-info');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'params', JText::_('Parameters')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('Event Parameters') ?></legend>
                <div class="row-fluid">
                    <div class="span6">
                        <?php echo $this->form->renderFieldset('params');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>

        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'permissions', JText::_('Permissions')); ?>
            <fieldset class="adminform">
                <legend><?php echo JText::_('Event Permissions') ?></legend>
                <div class="row-fluid">
                    <div class="span12">
                        <?php echo $this->form->renderFieldset('accesscontrol');  ?>
                    </div>
                </div>
            </fieldset>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        
        <!-- <fieldset class="adminform">
            <legend><?php //echo JText::_('COM_PROCUREMENT_PROCUREMENT_DETAILS'); ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php //foreach($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?php //echo $field->label; ?></div>
                            <div class="controls"><?php //echo $field->input; ?></div>
                        </div>
                        // echo $field->renderField();        
                    <?php //endforeach; ?>
                </div>
            </div>
        </fieldset> -->
    </div>
    <input type="hidden" name="task" value="event.edit" />
    <?php echo JHtml::_('form.token'); ?>
</form>