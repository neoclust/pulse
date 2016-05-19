TFTP Setup
==========

Bootloader and kernel are served to the client with TFTP protocol.
We recommend using the atftpd server as it supports multicast..

You must configure the TFTP server to use as base directory::

   /var/lib/pulse2/imaging

.. Note:: don't use inetd.

Then check the configuration::

    # atftp localhost
    tftp> get /bootloader/pxelinux.0
    tftp> quit
    # rm pxelinux.0
