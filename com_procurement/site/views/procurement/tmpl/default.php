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
?>

<h1>
    <?php echo  JText::_('Tenders');//echo $this->item->greeting.(($this->item->category and $this->item->params->get('show_category')) ? (' ('.$this->item->category.')') : ''); ?>
</h1>

<div class='tab'>
    <button class='tablinks' id='opentab' onclick='openTab(event, "Open")'>Current Open Tenders</button>
    <button class='tablinks' onclick='openTab(event, "Expired")'>Expired Tenders</button>
    <button class='tablinks' onclick='openTab(event, "Awarded")'>Awarded Tenders</button>
    <button class='tablinks' onclick='openTab(event, "Register")'>Bid Closing Register</button>
    <button class='tablinks' onclick='openTab(event, "Recieved")'>Bid Recieved</button>
</div>

<div id='Open' class='tabcontent'>
    <script type="text/javascript">
        document.getElementById('Open').style.display = 'block';
        document.getElementById('opentab').className += ' active';
    </script>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Number'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Service'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Closing Date'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Downloads'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('COMPULSORY BRIEFING SESSION'); ?></th>
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
				<?php foreach ($this->items as $i => $row) : ?>
                    <?php
                        $timeStr = str_replace("Time:", "", $row->closing_date);
                        $timeStr = str_replace("time:", "", $timeStr);
                        $time = strtotime($timeStr);
                        if ($time > strtotime("now")): ?>

                        <tr>
                            <td align="center">
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_number;  ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_description; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->closing_date; ?>
                            </td>
                            <td align="center">
                                <?php // echo JText::_('something'); ?>
                                <?php if (substr( $row->download_link, 0, 26 ) === "https://freedompark.co.za/"){
                                    echo "<a href='" . $row->download_link . "' download>Download Required Files</a>";
                                }else{
                                    echo $row->download_link;
                                } ?>
                            </td>
                            <td align="center">
                                <?php echo $row->brief_date; ?>
                                <!-- <?php // echo $row->id; ?> -->
                            </td>
                        </tr>
                    <?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
    </table>
</div>

<div id='Expired' class='tabcontent'>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Number'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Closing Date'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Description'); ?></th>
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
				<?php foreach ($this->items as $i => $row) : ?>
                    <?php
                        $timeStr = str_replace("Time:", "", $row->closing_date);
                        $timeStr = str_replace("time:", "", $timeStr);
                        $time = strtotime($timeStr);
                        echo gettype($row->awarded_to) . "<br>";
                        if ($time <= strtotime("now") and $row->awarded_to == "-"): ?>

                        <tr>
                            <td align="center">
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_number;  ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->closing_date; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_description; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
    </table>
</div>

<div id='Awarded' class='tabcontent'>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Number'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Description'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Bid Awarded To'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Amount Of Bid'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('BBBEE Level Contributor'); ?></th>
                <th style='border: 1px solid black;'><?php echo JText::_('Total Points'); ?></th>
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
				<?php foreach ($this->items as $i => $row) : ?>
                    <?php
                        $timeStr = str_replace("Time:", "", $row->closing_date);
                        $timeStr = str_replace("time:", "", $timeStr);
                        $time = strtotime($timeStr);
                        if ($row->awarded_to != '-'): ?>

                        <tr>
                            <td align="center">
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_number;  ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_description; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->awarded_to; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bid_amount; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->bbbee_level; ?>
                            </td>
                            <td>
                                <?php //echo JText::_('something'); ?>
                                <?php echo $row->total_points; ?>
                            </td>
                        </tr>
                    <?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
    </table>
</div>

<div id='Register' class='tabcontent'></div>

<div id='Recieved' class='tabcontent'></div>

<div>
    <hr/>
    <p>&nbsp;</p>

    <p><strong>SERVICE PROVIDER TO COMPLY WITH FREEDOM PARK COVID-19 MEASURES BEFORE ENTERING THE SITE </strong></p>
    <p><strong>&nbsp;</strong></p>

    <p>Each Tender shall be enclosed in a sealed envelope, bearing the correct identification details and shall be placed in the tender box located at</p>
    <p>Freedom Park Administration Building between 08h00am to 16h00 pm</p>
    <p>Cnr Koch & 7<sup>th</sup> Avenue</p>
    <p>SALVOKOP</p>
    <p>PRETORIA, 0001</p>
    <p>&nbsp;</p>
    <p>Supply Chain enquiries: <em>Moloko Moroko 012&nbsp;336 4191 </em>or <a href="mailto:Moloko@freedompark.co.za">Moloko@freedompark.co.za</a></p>
    <p>Bids should remain valid for a period of 120 days after the closing date</p>
    <p>Bids received after the closing date and time will not be considered. Freedom Park does not bind itself to accept the lowest or any other bid in whole or in part</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>

<!-- <?php
    /* $src = $this->item->imageDetails['image'];
    if ($src)
    {
        $html = '<figure>
                    <img src="%s" alt="%s" >
                    <figcaption>%s</figcaption>
                </figure>';
        $alt = $this->item->imageDetails['alt'];
        $caption = $this->item->imageDetails['caption'];
        echo sprintf($html, $src, $alt, $caption);
    } */
?> -->