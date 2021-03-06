<?php
/*
This file is part of wTorrent.

wTorrent is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

wTorrent is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

Modified version of class done by David Marco Martinez
*/

error_reporting(E_ALL & ~E_DEPRECATED);  // changing it from E_ALL, ticket: #414
// Record the start time of execution
$mtime = microtime( true );
// Start php session BEFORE ANY output
session_start();
// Load conf
if (is_readable('conf/user.conf.php') && is_readable('conf/system.conf.php')) {
  require_once( 'conf/user.conf.php' );
  require_once( 'conf/system.conf.php' );
} else {
  echo "One of the required configuration files is not readable, please check permissions or run <a href=\"install.php\">install.php</a> to set up wTorrent";
}

// Build the base of the app
$web = Web::getClass( 'ListT' );
// Page specific operations and display
$web->display( 'index' );

// Record end time
$ftime = microtime( true );
$total = $ftime -$mtime;
//echo "total: " . $total . 's<br />';
// If end time is shorter than 0.5 segons sleep untill then
if($total < MIN_TIME) {
	usleep(floor((MIN_TIME - $total)*1000000));
	//echo 'lost time: ' . (MIN_TIME - $total) . 's<br />';
}
// REAL end time (Should be about MIN_TIME + 0.1s)
$fftime = microtime( true );
$total = $fftime - $mtime;
?>
