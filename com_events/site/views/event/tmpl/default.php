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
?>

<h1>
    <?php echo  JText::_('Events'); ?>
</h1>

<div id="myCalendar" class="vanilla-calendar"></div>

<div id="events">
    <h2>Available Events</>
    <h5 id="events_date"></h5>
</div>

<script>

    today = new Date();
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    document.getElementById("events_date").innerHTML = months[today.getMonth()] + ' ' + today.getUTCDate();

    let calendar = new VanillaCalendar({
        selector: "#myCalendar",
        months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        shortWeekday: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        onSelect: (data, elem) => {
            console.log(data, elem)
            var current_date = new Date(data.date)
            var element = document.getElementById("events")
            document.getElementById("events_date").innerHTML = months[current_date.getMonth()] + ' ' + current_date.getUTCDate();
            element.scrollIntoView(true);
        }
    })
</script>



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