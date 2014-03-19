// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('contact_form7_ui');
	tinymce.create('tinymce.plugins.contact_form7_ui', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');

			ed.addCommand('mcecontact_form7_ui', function() {
				ed.windowManager.open({
					file : ajaxurl + '?action=orbsius_ui_contact_form7_ajax_render_popup_content', // wp admin ajax variable
					width : 600 + ed.getLang('contact_form7_ui.delta_width', 0),
					height : 400 + ed.getLang('contact_form7_ui.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url // Plugin absolute URL
				});
			});

			// Register example button
			ed.addButton('contact_form7_ui', {
				title : 'Contact Form 7 UI',
				cmd : 'mcecontact_form7_ui',
				image : url + '/icon.png'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('contact_form7_ui', n.nodeName == 'IMG');
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'Contact Form 7 UI',
					author 	  : 'Svetoslav Marinov',
					authorurl : 'http://orbisius.com',
					infourl   : 'http://club.orbisius.com/products/wordpress-plugins/contact-form-7-ui/',
					version   : "1.0.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('contact_form7_ui', tinymce.plugins.contact_form7_ui);
})();
