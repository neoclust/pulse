# -*- coding: utf-8; -*-
import base64, json, os, sys
from pulse2.database.xmppmaster import XmppMasterDatabase
import traceback
from utils import name_random

# plugin run wake on lan on mac adress

def action( xmppobject, action, sessionid, data, message, ret, dataobj):
    print "plugin Master wakeonlan"
    try:
        listserverrelay = XmppMasterDatabase().listserverrelay()
        senddataplugin = {'action' : 'wakeonLan',
                        'sessionid': name_random(5, "wakeonLan"),
                        'data' : {'macaddress': data['macadress'] }}
        for serverrelay in listserverrelay:
            xmppobject.send_message(  mto = serverrelay[0],
                                mbody = json.dumps(senddataplugin, encoding='latin1'),
                                mtype = 'chat')
    except:
        traceback.print_exc(file=sys.stdout)