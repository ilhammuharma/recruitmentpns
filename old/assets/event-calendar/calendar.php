<?php
###########################################################
/*
GuestBook Script
Copyright (C) 2012 StivaSoft ltd. All rights Reserved.


This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.

For further information visit:
http://www.phpjabbers.com/
info@phpjabbers.com

Version:  1.0
Released: 2013-09-07
*/
###########################################################

error_reporting(0);
include("config.php");

/// get current month and year and store them in $cMonth and $cYear variables
(intval($_REQUEST["month"])>0) ? $cMonth = intval($_REQUEST["month"]) : $cMonth = date("m");
(intval($_REQUEST["year"])>0) ? $cYear = intval($_REQUEST["year"]) : $cYear = date("Y");

// to highlight current day
$tDay = date("d");
$tMonth = date("m");
$tYear = date("Y");

// generate an array with all dates with events
//$sql = "SELECT * FROM ".$SETTINGS["data_table"]." WHERE `event_date` LIKE '".$cYear."-".$cMonth."-%'";
$sql = "SELECT * FROM ".$SETTINGS['data_table']." ORDER BY event_date ASC";
$sql_result = mysql_query ($sql, $connection ) or die ('request "Could not execute SQL query" '.$sql);
while ($row = mysql_fetch_assoc($sql_result)) {
	$events[$row["event_date"]]["title"] = $row["title"];
	$events[$row["event_date"]]["description"] = $row["description"];
}

// calculate next and prev month and year used for next / prev month navigation links and store them in respective variables
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = intval($cMonth)-1;
$next_month = intval($cMonth)+1;

// if current month is December or January month navigation links have to be updated to point to next / prev years
if ($cMonth == 12 ) {
	$next_month = 1;
	$next_year = $cYear + 1;
} elseif ($cMonth == 1 ) {
	$prev_month = 12;
	$prev_year = $cYear - 1;
}

if ($prev_month<10) $prev_month = '0'.$prev_month;
if ($next_month<10) $next_month = '0'.$next_month;
?>
  <table width="100%">
  <tr>
      <td class="mNav"><a href="javascript:LoadMonth('<?php echo $prev_month; ?>', '<?php echo $prev_year; ?>')"><i class="fa fa-chevron-left"></i></a></td>
      <td colspan="5" class="cMonth"><?php echo date("F, Y",strtotime($cYear."-".$cMonth."-01")); ?></td>
      <td class="mNav"><a href="javascript:LoadMonth('<?php echo $next_month; ?>', '<?php echo $next_year; ?>')"><i class="fa fa-chevron-right"></i></a></td>
  </tr>
  <tr>
  	  <td class="wDays">Mg</td>
      <td class="wDays">Sn</td>
      <td class="wDays">Sl</td>
      <td class="wDays">Rb</td>
      <td class="wDays">Km</td>
      <td class="wDays">Jm</td>
      <td class="wDays">Sb</td>
      
  </tr>
<?php 
$first_day_timestamp = mktime(0,0,0,$cMonth,1,$cYear); // time stamp for first day of the month used to calculate 
$maxday = date("t",$first_day_timestamp); // number of days in current month
$thismonth = getdate($first_day_timestamp); // find out which day of the week the first date of the month is
$startday = $thismonth['wday']; // 0 is for Sunday and as we want week to start on Mon we subtract 1

for ($i=0; $i<($maxday+$startday); $i++) {
	
	if (($i % 7) == 0 ) echo "<tr>";
	
	if ($i < $startday) { echo "<td>&nbsp;</td>"; continue; };
	
	$current_day = $i - $startday + 1;
	if ($current_day<10) $current_day = '0'.$current_day;
	if ($tDay == $current_day && $tMonth == $cMonth && $tYear == $cYear) { $tCurrent = "today";} else {$tCurrent = "";}

// set css class name based on number of events for that day
	if (isset($events[$cYear."-".$cMonth."-".$current_day]) && $events[$cYear."-".$cMonth."-".$current_day]<>'') {
	    $css='withevent '.$tCurrent;
	    //$click = "onclick=\"LoadEvents('".$cYear."-".$cMonth."-".$current_day."')\"";
	    $click = ' data-container="body" data-toggle="tooltip" data-placement="top" title="'.$events[$cYear."-".$cMonth."-".$current_day]["title"].'"';
	} else {
	    $css='noevent '.$tCurrent;      
	    $click = '';
	}
	
	echo "<td class='".$css."'".$click.">". $current_day . "</td>";
	
	if (($i % 7) == 6 ) echo "</tr>";
}
?> 
</table>