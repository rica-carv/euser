<?php
if (!defined('e107_INIT')) { exit; }

//e107::css('phil_lis', 'phillis.css');
//e107::css('phil', 'phil.css');
//e107::css('url', '../phil/dialog/dialog_box.css');

$PHILLIS_TEMPLATE['start'] = "
<div class='table-responsive' id='pclis'>
    <table class='table table-striped table-condensed table-hover border'>
    	<colgroup>
            <col style='width:12%'>
			<col style='width:22%'>
			<col style='width:22%'>
			<col style='width:22%'>
			<col style='width:22%'>
       </colgroup>
       <thead>
            <tr>
                <th></th>
                <th colspan=2 class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_112}</th>
                <th colspan=2 class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_113}</th>
            </tr>
            <tr class='border-left'>
                <th>{LAN=LAN_PLUGIN_PHILLIS_111}</th>
                <th class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_82} <i>({LAN=LAN_PLUGIN_PHILLIS_100})</i></th>
                <th class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_83} <i>({LAN=LAN_PLUGIN_PHILLIS_100})</i></th>
                <th class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_82} <i>({LAN=LAN_PLUGIN_PHILLIS_100})</i></th>
                <th class='text-center'>{LAN=LAN_PLUGIN_PHILLIS_83} <i>({LAN=LAN_PLUGIN_PHILLIS_100})</i></th>
            </tr>
</thead><tbody class='border-left'>";

$PHILLIS_WRAPPER['PHLIS_MAINLINECLASS'] = "class='{---}'";
$PHILLIS_WRAPPER['PHLIS_LISTDATA: n&date'] = $PHILLIS_WRAPPER['PHLIS_LISTDATA: u&date'] = $PHILLIS_WRAPPER['PHLIS_LISTDATA: o&date'] = $PHILLIS_WRAPPER['PHLIS_LISTDATA: s&date'] = " <i class='small'>({---})</i>";
//$PHILLIS_WRAPPER['PHLIS_LISTDATA:n'] = "{---} <i>({PHLIS_LISTDATA: n&date})</i>";
/*
$PHILLIS_WRAPPER['PHLIS_LISTDATA:n'] = "{---} <i>()</i>";
$PHILLIS_WRAPPER['PHLIS_LISTDATA:u'] = "{---} <i>({PHLIS_LISTDATA: u&date})</i>";
$PHILLIS_WRAPPER['PHLIS_LISTDATA:o'] = "{---} <i>({PHLIS_LISTDATA: o&date})</i>";
$PHILLIS_WRAPPER['PHLIS_LISTDATA:s'] = "{---} <i>({PHLIS_LISTDATA: s&date})</i>";
*/
$PHILLIS_TEMPLATE['item'] = "
<tr {PHLIS_MAINLINECLASS}>
    <td>
        {PHLIS_USERNAME}
    </td>
    <td class='text-center'>
        {PHLIS_LISTDATA:n}{PHLIS_LISTDATA: n&date}
    </td>
    <td class='text-center'>
        {PHLIS_LISTDATA:u}{PHLIS_LISTDATA: u&date}
    </td>
    <td class='text-center'>
        {PHLIS_LISTDATA:o}{PHLIS_LISTDATA: o&date}
    </td>
    <td class='text-center'>
        {PHLIS_LISTDATA:s}{PHLIS_LISTDATA: s&date}
    </td>
</tr>";

$PHILLIS_TEMPLATE['end'] = "</tbody></table></div>";

$PHILLIS_WRAPPER['NEXTPREV'] = "<tr><td class='text-center' colspan='6'>{---}</td></tr>";