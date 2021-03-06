<?php

/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007 Mandriva, http://www.mandriva.com/
 *
 * $Id$
 *
 * This file is part of Mandriva Management Console (MMC).
 *
 * MMC is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * MMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with MMC; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
require("modules/pulse2/includes/xmlrpc.inc.php");
require_once("modules/pulse2/includes/utilities.php");

$param = array();
if (isset($_GET['gid'])) {
    $param['gid'] = urlencode($_GET['gid']);
}
if (isset($_GET['groupname'])) {
    $param['groupname'] = urlencode($_GET['groupname']);
}
//if (isset($_GET['request'])) { $param['request'] = $_SESSION['request'];}
/* if (isset($_GET['request'])) {
  $_SESSION['request'] = $_GET['request'];
  } */
if (isset($_GET['equ_bool'])) {
    $param['equ_bool'] = urlencode($_GET['equ_bool']);
}
if (isset($_GET['imaging_server'])) {
    $param['imaging_server'] = urlencode($_GET['imaging_server']);
}

if (displayLocalisationBar() && (isset($_GET['imaging_server']) && $_GET['imaging_server'] == '' || !isset($_GET['imaging_server']))) {
    $ajax = new AjaxFilterLocation(urlStrRedirect("base/computers/ajaxComputersList"), "container", 'location', $param);

    list($list, $values) = getEntitiesSelectableElements(True);
    $ajax->setElements($list);
    $ajax->setElementsVal($values);
    if (!empty($param['gid'])) {
        if (!empty($_SESSION["computers.selected_location." . $param['gid']])) {
            $ajax->setSelected($_SESSION["computers.selected_location." . $param['gid']]);
        }
    } else if (!empty($_SESSION["computers.selected_location"])) {
        $ajax->setSelected($_SESSION["computers.selected_location"]);
    }
} else {
    $ajax = new AjaxFilter(urlStrRedirect("base/computers/ajaxComputersList"), "container", $param);
}

right_top_shortcuts_display();
$ajax->display();
echo "<br /><br /><br /><br />";
$ajax->displayDivToUpdate();
?>
