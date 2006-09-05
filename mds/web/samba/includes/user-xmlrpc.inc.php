<?php
/**
 * (c) 2004-2006 Linbox / Free&ALter Soft, http://linbox.com
 *
 * $Id$
 *
 * This file is part of LMC.
 *
 * LMC is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * LMC is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with LMC; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
?>
<?php

function hasSmbAttr($uid) {
  return xmlCall("samba.isSmbUser",array($uid));
}

function addSmbAttr($uid,$passwd) {
  return xmlCall("samba.addSmbAttr", array($uid,$passwd));
}

function rmSmbAttr($uid) {
  return xmlCall("samba.delSmbAttr", array($uid));
}

function changeSmbAttr($uid, $array) {
    return xmlCall("samba.changeSambaAttributes", array($uid, $array));
}

function isEnabledUser($uid) {
  return xmlCall("samba.isEnabledUser",array($uid));
}

function isLockedUser($uid) {
  return xmlCall("samba.isLockedUser",array($uid));
}

function smbEnableUser($uid) {
        return xmlCall("samba.enableUser",array($uid));
}

function smbDisableUser($uid) {
        return xmlCall("samba.disableUser",array($uid));
}

function smbLockUser($uid) {
        return xmlCall("samba.lockUser",array($uid));
}

function smbUnlockUser($uid) {
        return xmlCall("samba.unlockUser",array($uid));
}

function getSmbStatus() {
        return xmlCall("samba.getSmbStatus",array());
}

function getConnected() {
        return xmlCall("samba.getConnected",array());
}


?>