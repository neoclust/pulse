<?php
/**
 * (c) 2004-2007 Linbox / Free&ALter Soft, http://linbox.com
 * (c) 2007-2008 Mandriva, http://www.mandriva.com
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
?>
<h2><?php print _T('Restore files','backuppc'); ?></h2>
<select id="restorehosts">
	<?php
		foreach($_SESSION['backup_hosts'] as $host)
		{
			echo '<option value="'.$host.'">'.$host.'</option>';
		}
	?>
</select>
<input id="btnRestoreDirect1" type="button" value="<?php print _T('To original folder (overwrite)','backuppc'); ?>" class="btnPrimary" />
<input id="btnRestoreDirect2" type="button" value="<?php print _T('To alternate folder','backuppc'); ?>" class="btnPrimary" />

<script type="text/javascript">

jQuery(function(){

    jQuery('input#btnRestoreDirect1').click(function(){
        jQuery('#restoredir').val('/');
        form = jQuery('#restorefiles').serializeArray();
        
        // Test if no checkbox is checked
        if (jQuery('input[type=checkbox]:checked').length == 0)
            {
                alert('You must select at least on file.');
                return;
            }

        //Add hostdest to the queue
        form.push({
				name : 'hostdest',
				value : jQuery('#restorehosts').val()
        });
        form = jQuery.param(form);

        jQuery.ajax({
            type: "POST",
            url: "<?php  echo 'main.php?module=backuppc&submod=backuppc&action=restoreToHost'; ?>",
            data: form,

            success: function(data){
                jQuery('html').append(data);
                setTimeout("refresh();",3000);
        }
        });
        return false;
    });
    
    jQuery('input#btnRestoreDirect2').click(function(){
        jQuery('#restoredir').val('/Restore_<?php print(date('Y-m-d')); ?>');
        form = jQuery('#restorefiles').serializeArray();
        
        // Test if no checkbox is checked
        if (jQuery('input[type=checkbox]:checked').length == 0)
            {
                alert('You must select at least on file.');
                return;
            }

			form.push({
				name : 'hostdest',
				value : jQuery('#restorehosts').val()
        });
        form = jQuery.param(form);

        jQuery.ajax({
            type: "POST",
            url: "<?php  echo 'main.php?module=backuppc&submod=backuppc&action=restoreToHost'; ?>",
            data: form,

            success: function(data){
                jQuery('html').append(data);
                setTimeout("refresh();",3000);
        }
        });
        return false;
    });    

});

</script>