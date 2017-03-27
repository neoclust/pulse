# -*- coding: utf-8; -*-
#
# (c) 2016 siveo, http://www.siveo.net
#
# This file is part of Pulse 2, http://www.siveo.net
#
# Pulse 2 is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# Pulse 2 is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with Pulse 2; if not, write to the Free Software
# Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
# MA 02110-1301, USA.
"""
Plugin to manage the interface with xmppmaster
"""

import logging
import os,sys
from mmc.plugins.xmppmaster.config import xmppMasterConfig

from pulse2.version import getVersion, getRevision # pyflakes.ignore
import json
# Database
from pulse2.database.xmppmaster import XmppMasterDatabase
from mmc.plugins.msc.database import MscDatabase

from master.lib.utils import name_random
from  xmppmaster import *
from mmc.plugins.xmppmaster.master.agentmaster import XmppSimpleCommand, getXmppConfiguration,\
                                                      callXmppFunction, ObjectXmpp, callXmppPlugin,\
                                                      callInventory, callrestartbymaster,\
                                                      callshutdownbymaster
VERSION = "1.0.0"
APIVERSION = "4:1:3"


logger = logging.getLogger()


# #############################################################
# PLUGIN GENERAL FUNCTIONS
# #############################################################

def getApiVersion():
    return APIVERSION

def dede():
    logging.getLogger().info("test")

def activate():
    """
    Read the plugin configuration, initialize it, and run some tests to ensure
    it is ready to operate.
    """
    logger = logging.getLogger()
    config = xmppMasterConfig("xmppmaster")
    if config.disable:
        logger.warning("Plugin xmppmaster: disabled by configuration.")
        return False
    if not XmppMasterDatabase().activate(config):
        logger.warning("Plugin XmppMaster: an error occurred during the database initialization")
        return False
    return True

# #############################################################
# xmppmaster MAIN FUNCTIONS [HTTP INTERFACE]
# #############################################################
def getlinelogssession(sessionxmpp) :
    return XmppMasterDatabase().getlinelogssession(sessionxmpp)

def getListPackages():
    resultnamepackage = []
    FichList = [ f for f in os.listdir('/var/lib/pulse2/packages/') if os.path.isfile(os.path.join('/var/lib/pulse2/packages/', f, 'xmppdeploy.json')) ]
    for package in FichList:
        with open(os.path.join('/var/lib/pulse2/packages/', package, 'xmppdeploy.json'), "r") as fichier:
            session = json.load(fichier)
            resultnamepackage.append(session['info']['name'])
    return resultnamepackage

def getstepdeployinsession(sessionname):
    return XmppMasterDatabase().getstepdeployinsession(sessionname)

def getPresenceuuid(uuid):
    return XmppMasterDatabase().getPresenceuuid(uuid)

def getGuacamoleRelayServerMachineUuid(uuid):
    return XmppMasterDatabase().getGuacamoleRelayServerMachineUuid(uuid)

def getGuacamoleidforUuid(uuid):
    return XmppMasterDatabase().getGuacamoleidforUuid(uuid)

def getListPresenceAgent():
    return json.dumps(ObjectXmpp().presencedeployment, encoding='latin1')

def getListPresenceMachine():
    return XmppMasterDatabase().getListPresenceMachine()

def getjidMachinefromuuid(uuid):
    return XmppMasterDatabase().getjidMachinefromuuid(uuid)

def getListPresenceRelay():
    return XmppMasterDatabase().getListPresenceRelay()

def deploylog(uuidinventory, nblastline):
    return XmppMasterDatabase().deploylog(uuidinventory, nblastline)

def addlogincommand(login, commandid):
    return XmppMasterDatabase().addlogincommand(login, commandid)

def loginbycommand(commandid):
    return XmppMasterDatabase().loginbycommand(commandid)

def getdeployfromcommandid(command_id, uuid) :
    return XmppMasterDatabase().getdeployfromcommandid(command_id, uuid)

def getlinelogswolcmd(idcommand, uuid):
    return XmppMasterDatabase().getlinelogswolcmd(idcommand, uuid)

def getdeploybyuserlen(login):
    if not login:
        login = None
    return XmppMasterDatabase().getdeploybyuserlen( login)

def getdeploybyuserrecent(  login , state, duree, min , max, filt):
    return XmppMasterDatabase().getdeploybyuserrecent(  login , state, duree, min , max, filt)

def getdeploybyuser( login, numrow, offset):
    if not numrow:
        numrow = None
    if not offset:
        offset = None
    return XmppMasterDatabase().getdeploybyuser( login, numrow, offset)

def getshowmachinegrouprelayserver():
    def Nonevalue(x):
        if x == None:
            return ""
        else:
            return x
    machinelist = XmppMasterDatabase().showmachinegrouprelayserver()
    array=[] 
    for t in machinelist:
        z = [ Nonevalue(x) for x in list(t)]
        ob = {'jid' : z[0], 'type' : z[1], 'os' : z[2], 'rsdeploy' : z[3],'hostname' : z[4] ,'uuid' : z[5],'ip' : z[6],'subnet' : z[7] }
        array.append(ob)
    return array

def getXmppConfiguration():
    return getXmppConfiguration()

def runXmppApplicationDeployment(*args, **kwargs ):
    for count, thing in enumerate(args):
        print '{0}. {1}'.format(count, thing)
    for name, value in kwargs.items():
        print '{0} = {1}'.format(name, value)
    return callXmppFunction(*args, **kwargs )

def CallXmppPlugin(*args, **kwargs ):
    return callXmppPlugin(*args, **kwargs )

def callInventoryinterface(uuid):
    jid = XmppMasterDatabase().getjidMachinefromuuid(uuid)
    if jid != "":
        return callInventory(jid)
    else:
        logging.getLogger().error("for machine %s : jid xmpp missing"%uuid )
        return False

def callrestart(uuid):
    jid = XmppMasterDatabase().getjidMachinefromuuid(uuid)
    if jid != "":
        return callrestartbymaster(jid)
    else:
        logging.getLogger().error("callrestartbymaster for machine %s : jid xmpp missing"%uuid )
        return False

def callshutdown(uuid):
    jid = XmppMasterDatabase().getjidMachinefromuuid(uuid)
    if jid != "":
        return callshutdownbymaster(jid)
    else:
        logging.getLogger().error("callshutdownbymaster for machine %s : jid xmpp missing"%uuid )
        return False

def runXmppCommand(cmd,machine):
    data = {
	"action": "shellcommand",
	"sessionid":name_random(8,"mcc_"),
	"data" : {'cmd' : cmd},
	"base64" :False
    }
    a=XmppSimpleCommand(machine, data , 4)
    d = a.t2.join()
    return a.result

def runXmppScript(cmd,machine):
    data = {
	"action": "shellcommand",
	"sessionid":name_random(8,"mcc_"),
	"data" : {'cmd' : cmd},
	"base64" :False
    }
    a=XmppSimpleCommand(machine, data , 4)
    d = a.t2.join()
    return a.result
