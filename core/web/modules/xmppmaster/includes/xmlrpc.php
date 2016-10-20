<?php

/**
 * (c) 2015-2016 Siveo, http://www.siveo.net
 *
 * $Id$
 *
 * This file is part of MMC, http://www.siveo.net
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
//======================================================================
// Main XMPP Master communications functions [HTTP]
//======================================================================
//require_once("modules/xmppmaster/includes/xmlrpc.php");

function xmlrpc_getPresenceuuid($uuid) {
    return xmlCall("xmppmaster.getPresenceuuid", array($uuid));
}

function xmlrpc_getXmppConfiguration() {
    return xmlCall("xmppmaster.getXmppConfiguration", array());
}

function xmlrpc_getGuacamoleRelayServerMachineUuid($uuid) {
    return xmlCall("xmppmaster.getGuacamoleRelayServerMachineUuid", array($uuid));
}

function xmlrpc_getGuacamoleidforUuid($uuid) {
    return xmlCall("xmppmaster.getGuacamoleidforUuid", array($uuid));
}

function xmlrpc_getListPresenceAgent() {
    return xmlCall("xmppmaster.getListPresenceAgent", array());
}

function xmlrpc_getListPackages(){
    return xmlCall("xmppmaster.getListPackages", array());
}

function xmlrpc_getListPresenceMachine() {
    return xmlCall("xmppmaster.getListPresenceMachine", array());
}

function xmlrpc_runXmppCommand($command, $machine){
    return xmlCall("xmppmaster.runXmppCommand", array($command, $machine));
}

function xmlrpc_runXmppScript($command, $machine){
    return xmlCall("xmppmaster.runXmppScript", array($command, $machine));
}

function xmlrpc_runXmppDeployment( $jidrelay, $jidmachine, $name, $time){
    return xmlCall("xmppmaster.runXmppApplicationDeployment", array("applicationdeployment",  $jidrelay, $jidmachine, $name, $time));
}

function xmlrpc_runXmppWol($pluginname, $macadress){
    return xmlCall("xmppmaster.CallXmppPlugin", array($pluginname, array("macadress"=>$macadress)));
}

?>
