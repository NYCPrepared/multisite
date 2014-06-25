<div class="general_settings metabox-holder tabs-panel" style="min-height:0px;border-bottom:none;display:<?php echo ($a == 'general_settings') ? 'block' : 'none'; ?>;">
<?php if (!is_multisite() or is_super_admin()){ ?>
    <div class="postbox">
        <h3 class="hndle manage-menus"><div id="icon-ms-admin" class="icon32 frm_postbox_icon"><br/></div> <?php _e('Formidable Pro License', 'formidable')?></h3>
        <div class="inside">
            <p class="frm_aff_link">Already signed up? <a href="http://formidablepro.com/knowledgebase/manually-install-formidable-pro/" target="_blank"><?php _e('Click here', 'formidable') ?></a> for installation instructions.</p>
            
            <div style="float:left;width:50%;">      
            <p><?php _e('Ready to take your forms to the next level?<br/>Formidable Pro will help you style forms, manage data, and get reports.', 'formidable') ?></p>
            <?php printf(__('%1$sClick here%2$s to get it now', 'formidable'), '<a href="http://formidablepro.com">', '</a>') ?> &#187;
            </div>
            
            <div class="clear"></div>
        </div>
    </div>
<?php } ?>
</div>