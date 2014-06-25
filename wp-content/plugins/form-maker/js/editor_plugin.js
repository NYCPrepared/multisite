(function() {
    tinymce.create('tinymce.plugins.Form_Maker_mce', {
 
        init : function(ed, url){
			
			ed.addCommand('mceForm_Maker_mce', function() {
				ed.windowManager.open({
					file : ((ajaxurl.indexOf("://") != -1) ? ajaxurl:(location.protocol+'//'+location.host+ajaxurl))+"?action=formmakerwindow",
					width : 400 + ed.getLang('Form_Maker_mce.delta_width', 0),
					height : 250 + ed.getLang('Form_Maker_mce.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});
            ed.addButton('Form_Maker_mce', {
            title : 'Insert Form_Maker',
			cmd : 'mceForm_Maker_mce',
            });
        }
    });
 
    tinymce.PluginManager.add('Form_Maker_mce', tinymce.plugins.Form_Maker_mce);
 
})();