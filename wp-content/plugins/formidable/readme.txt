=== Formidable Forms ===
Contributors: sswells, srwells, jamie.wahlin
Donate link: http://formidablepro.com/donate
Tags: admin, AJAX, captcha, contact, contact form, database, email, feedback, form, forms, javascript, jquery, page, plugin, poll, Post, spam, survey, template, widget, wpmu, form builder
Requires at least: 3.3
Tested up to: 3.8
Stable tag: 1.07.06

Quickly and easily build forms with a simple drag-and-drop interface and in-place editing. 

== Description ==
Quickly and easily build forms with a simple drag-and-drop interface and in-place editing.
There are dozens of form-building plugins out there to create forms, but most are confusing and overly complicated. With Formidable, it is easy to create forms within a simple drag-and-drop interface. You can construct custom forms or generate them from a template. Shortcodes can be used as well as spam catching services.

[View Documentation](http://formidablepro.com/knowledgebase/ "View Documentation")

= Features =
* Save all responses to the database (even in the free version) for future retrieval, reports, and display in [Formidable Pro](http://formidablepro.com/ "Formidable Pro") Learn more at: http://formidablepro.com
* Integrate with reCAPTCHA and Akismet for Spam control (and a math captcha plugin in Pro)
* Shortcode [formidable id=x] for use in pages, posts, or text widgets
* Alternatively use `<?php echo FrmFormsController::show_form(2, $key = '', $title=true, $description=true); ?>` in your template
* Most of the form HTML is customizable on the form settings pages
* Create forms from existing templates or add your own. A contact form template is included.
* Direct links available for previews and emailing surveys with and without integration with your current theme.
* Select an email address to send form responses on the form settings page under the "Emails" tab. This defaults to send to the admin email in your WordPress settings.
* Use default values in form fields with the option to clear when clicked
* PHP ninjas can display data in templates using PHP functions found in the files in formidable/classes/models. However, there is currently no documentation for these functions.
* Pro users can view, add, edit, and delete entries from the back- or front-end

== Installation ==
1. Upload `formidable` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu
3. Go to the Formidable menu and create a new custom form or use the existing Contact Form template.
4. Use shortcode [formidable id=x] in pages, posts, or text widgets.

== Screenshots ==
1. Create beautiful forms without any code.
2. Form creation page
3. Field Options and CSS Layout Classes
4. Field Options for checkbox fields
5. Entry Management page
6. Form Widget

== Frequently Asked Questions ==
= Q. Why aren't I getting any emails? =

A. Try the following steps:

   1. Double check to make sure your email address is present and correct in the "Emails" tab on the form "Settings" page
   2. Make sure you are receiving other emails from your site (ie comment notifications, forgot password...)
   3. Check your SPAM box
   4. Try a different email address.
   5. Install WP Mail SMPT or another similar plugin and configure the SMTP settings
   6. If none of these steps fix the problem, let us know and we'll try to help you find the bottleneck.

= Q. How do I edit the field name? =

A. The field and form names and descriptions are all changed with in-place edit. Just click on the text you would like to change, and it will turn into a text field.

= Q. Why isn't the form builder page working after I updated? =

A. Try clearing your browser cache. As plugin modifications are made, frequent javascript and stylesheet changes are also made. However, the previous versions may be cached so you aren't using the modified files. After clearing your cache and you're still having issues, please let us know.

[See more FAQs](http://formidablepro.com/formidable-faqs/ "Formidable Pro FAQs")

== Changelog ==
= 1.07.06 =
* Return graceful error message if no DOMDocument enabled
* Allow fields to be updated via XML import by field key for non-templates
* Added minimize=1 option to the [formidable] short code to minimize the form HTML to prevent wpautop interference
* Correctly return fallbacks on a couple deprecated functions
* PRO: Allow field keys in the frm-stats shortcode for fieldid=value
* PRO: Fixed attaching file upload to entries when using single files

= 1.07.05 =
* Added XML import/export
* Moved more email settings and bulk form delete to free version
* Added form edit links to admin bar
* Removed .required class from required form inputs to minimize conflicts
* Revert to random entry keys now that data from entries values can be used in filtering views
* Encode email subject with frm_encode_subject hook to prevent encoding
* PRO: Allow entries to be edited via csv import when entry ID is included
* PRO: Expanded conditional logic for email notifications
* PRO: Allow the frm-field-value shortcode to get the entry ID from the URL. [frm-field-value field_id=x entry_id=id]. Replace "id" with the name of the parameter in your URL
* PRO: Added separate set of confirmation options for editing
* PRO: Added option to disable visual tab on each view
* PRO: Added 'action' parameter back to the frm_redirect_url hook
* PRO: Added drafts parameter to view shortcode to show draft entries. [display-frm-data id=40 drafts=1]
* PRO: Switched star ratings to icon font
* PRO: Added multiple="multiple" into multiple file upload fields
* PRO: Allow field keys in the exlude_fields shortcode option
* PRO: Allow updated-at, created-at, updated-by to by used in conditional statements
* PRO: Added update message and button to global default messages
* PRO: Added progress bar to csv import
* PRO: Added frm_csv_line_break filter for changing line breaks in csv export
* PRO: Change the updated_at and updated_by values when a field is changed with the edit field link
* PRO: Fixed adding new conditional logic to newly added notifications
* PRO: Allow "GROUP BY" addition to form in frm_where_filter by rearranging SQL
* PRO: Don't apply custom display filters to single post page
* PRO: Fixed showing only file name in views
* PRO: Removed Pretty Link plugin integration to be placed in an add-on
* PRO: Added delete_link and confirm parameter to formresults shortcode
* PRO: Added entry_id, x_title, y_title, start_date, and tooltip_label to graph shortcode options
* PRO: Allow data from entries fields to be used as x_axis in graphs
* PRO: Allow field keys in graph shortcode
* PRO: Add height and line-height to Global Settings
* PRO: Filter the empty_msg for Views
* PRO: Added draft status to csv export/import
* PRO: Check for valid file type when saving a draft
* PRO: Added sorting on entry listing table for non-post fields
* PRO: Fixed form pagination with errors and no ajax validation
* PRO: Changed image to a link when editing an entry with an image
* PRO: Moved the frm_setup_new_fields_vars hook to fire later when dynamically getting options from a dependent data from entries field
* PRO: Added frm_get_categories hook
* PRO: Added frm_jquery_themes hook for creating custom jQuery calendar themes
* PRO: Added frm_no_data_graph hook for customizing "No Data" message for graphs

= 1.07.04 =
* Minor back-end styling fixes
* PRO: Added frm_show_delete_all hook to hide the "delete all entries" button, and show by default for those with back-end entry editing capabilities
* PRO: Fixed inserting conditional examples from the sidebar box
* PRO: Fixed viewing single post with some view configurations
* PRO: Fixed detailed view for calendar displays when entries are not posts
* PRO: Fixed conditional logic on page load for radio buttons
* PRO: Make sure entries aren't deleted in another form if using the form switcher right after deleting all entries in a form
* PRO: Fixed error when saving a field with conditional logic with no field selected
* PRO: Allow subscribers and below to add custom taxonomies to posts
* PRO: Fixed conditional data from entries fields across multiple pages in an ajax form

= 1.07.03 =
* Removed auto updating from free version
* PRO: Added secondary ordering options in Views
* PRO: Allow newly added custom fields on the "Create posts" tab to be selected from existing options
* PRO: Allow html=1 and show_filename=1 to be used together for showing a filename linking to the file
* PRO: If not using show_filename=1, default to show the file type icon or non-image file types
* PRO: Fixed ordering in a view set to show a single entry
* PRO: Fixed adding new filters to views
* PRO: Allow a low-level user to edit entries submitted by another user when the setting is turned on, even if they have not submitted an entry themselves
* PRO: Fixed data from entries fields across multiple pages
* PRO: Added [updated-by] shortcode for use in views
* PRO: Send the detail page of a view through any set filters
* PRO: In a view, use limit over page size if limit is lower
* PRO: Fixed going backwards in a multi-paged form, when 2 or more pages are skipped at a time

= 1.07.02 =
* Added form switcher to nav and other UI enhancements
* Remove slashes from a single entry retrieved from cache
* Remove slashes added by ajax before saving to db
* Fixed naming so plugin info and change log links are correct on plugins page
* Updated default submit button HTML to include [frmurl] for a dynamic url
* Added nonce fields and checking for increased security
* Switched to placeholder with IE fallback for those using HTML5
* Updated duplicate entry checking for more accuracy
* Improved long form load time and usability
* Added French translation
* Removed unnecessary definitions: FRM_IMAGES_URL, IS_WPMU, FRMPRO_IMAGES_URL
* Dropped support for < jQuery 1.7 (< WP 3.3)
* Added frm_radio_class, frm_checkbox_class, and frm_submit_button_class hooks
* Moved radio and checkbox inputs inside the label tags
* Updated default styling
* Added frm_text_block and frm_clearfix styling classes
* Added force_balance_tags on the in-place-editing fields on the form builder page to prevent issues with adding bad HTML
* PRO: Switch field IDs in email settings in duplicated form
* PRO: Added option to save drafts
* PRO: Added phone format option, including an input mask if format is not a regular expression
* PRO: Added exclude_fields to the form shortcode. Ex [formidable id=2 exclude_fields="25,26"]
* PRO: Added styling reset button on styling page
* PRO: Switch "Custom Display" terminology to "View"
* PRO: Allow any values in the form shortcode to set $_GET values. [formidable id=x get="something"]. Then use [get param="get"] in a field
* PRO: Allow the field value to be used to filter data from entries values in custom displays, statistics, and graphs
* PRO: Increased CSV export efficiency
* PRO: Allow for quotation marks in values used to get stats in the frm-stats shortcode
* PRO: Fixed entry listing widget to get values from stats for more accuracy
* PRO: Updated template export to include all form settings
* PRO: Drop WP_List_Table fallback for < WP 3.1
* PRO: Make custom display pagination unique to allow multiple paginated displays on a single page
* PRO: Remove WPML-related translating options, and move to the add-on
* PRO: Added [entry_count] for use in custom displays
* PRO: Allow a blank option for multiselect data from entries fields when set to autocomplete
* PRO: Adjust imported created and updated times from server setting to UTC
* PRO: Switch time field generation from javascript to php
* PRO: Allow [if created-at less_than="-1 month"]
* PRO: Added frm_default_field_opts hook
* PRO: Added frm_send_to_not_email hook for notifications that are triggered on non-emails
* PRO: Updated file uploading progress bar with frm_uploading_files hook added to text
* PRO: Only show "create entry in form" box if user has permission to create entries
* PRO: Removed icons from error message
* PRO: Fixed collapsable entry list bullets
* PRO: Fixed dependent multi-select data from entries fields on edit
* PRO: Added frm_back_button_class hook
* PRO: Fixed quotation marks in conditional logic
* PRO: Allow filtering by a field value in graphs
* PRO: Make x_axis=created_at work in graphs
* PRO: Added if statements to Default HTML button in email message
* PRO: Added show_filename option to file upload fields
* PRO: Allow dropdown data from entries fields to be set as read only

= 1.07.01 =
* Added for attribute to labels for newly created fields
* Fixed issue with slashes showing in content if retrieved from cache
* Prevent multiple checks for updates when pro is authorized, but free version is installed
* Added frm_form_fields_class hook
* PRO: Fixed days events are shown on the calendar with months starting on Sunday and week start day set to Monday
* PRO: Added option to not load a JQuery UI stylesheet
* PRO: Added "Entry ID" option to the back-end entry search options
* PRO: Added frm_csv_filename hook for changing the csv file name
* PRO: Allow siteurl and sitename in after content box in custom display
* PRO: Allow autocomplete selection to be unselected on front-end
* PRO: Fixed conditional validation for fields in a conditional section heading beyond page 1

= 1.07.0 =
* Submit build form in one input with ajax to prevent max_input_vars limitations
* Load fields on the build page with ajax for long forms and other form builder page optimization
* Added submit button to customizable HTML
* Added clickable styling classes to form builder sidebar
* Create entry key from first required text field
* Set the default name of a field to the field type instead of "Untitled"
* Added minified version of formidable.js
* Added warning message if a non-unique value is added as a field value
* Removed messages for strict standards
* Fixed inline and left labels for checkboxes
* PRO: Added back button on multi-paged forms
* PRO: Added conditional logic on page breaks for skipping pages
* PRO: Added loading indicator by submit button and on dependent data from entries fields
* PRO: Switched out username and passwords for license numbers
* PRO: Updated timestamp in CSV to adjust for WordPress timezone selection
* PRO: Updated value in CSV for file upload fields
* PRO: Include comments in the CSV export
* PRO: Made dynamic default values clickable on form builder page
* PRO: Added column in CSV for value for fields that are set to use separate values
* PRO: Allow for quotation marks in field labels for the CSV export
* PRO: Added frm_import_val hook for CSV importing
* PRO: Removed border styling from the container around radio and checkbox fields
* PRO: Added frm_order_display hook
* PRO: Added utf8 support to sanitize_url=1 option
* PRO: Added "confirm" option to frm-entry-links shortocode that is used before an entry is deleted
* PRO: Copy conditional logic and field calculations into duplicated forms
* PRO: Allow clickable=1 and images to be used with Google formresults shortcode
* PRO: Allow [25 show="user_email"] for data from entries fields to get user info from the user ID from the linked form, and [25 show="30" show_info="user_email"] to get values from a field linked through 2 data from entries fields
* PRO: Allow tags fields to be used with hierarchal taxonomies
* PRO: No longer require fields in a conditionally hidden section heading
* PRO: Added option for frmThemeOverride_frmAfterSubmit function for custom javascript after ajax submit
* PRO: Updated star rating javascript version
* PRO: Check field key when creating a form from a template to see if the trailing "2" can be removed
* PRO: Don't show custom display content for password protected posts until allowed
* PRO: Switch the cancel link to edit link after a form is submitted with in-place-edit and ajax
* PRO: Switched front-end ajax to use hooks (frm_ajax_{controller}_{action})
* PRO: Call ajax later on the init hook to prevent php notices when WooCommerce is active
* PRO: Delete entries on the same page as the frm-entry-links shortcode, and added a confirmation message: confirm="Are you sure?"
* PRO: Correctly check if jQuery on() function exists
* PRO: Fixed calendar display for months starting on Sunday when the week start day is set to Monday
* PRO: Removed "custom display" from the post type options on the "create posts" settings tab
* PRO: Allow multiple values to be imported into an entry via csv in a multi-select dropdown field

= 1.06.11 =
* Added styling classes: two thirds, scroll box, columns (frm_first_two_thirds, frm_last_two_thirds, frm_scroll_box, frm_total, frm_two_col, frm_three_col, frm_four_col, )
* Added container in default html for new check box and radio fields
* PRO: Added a print link on the view entry page in the back-end
* PRO: Added support for category stats in the frm-stats shortcode
* PRO: Allow the edit link to dynamically get the id of the entry when used on a post page. Ex: [frm-entry-edit-link id=current label="Edit" page_id=92]
* PRO: Allow non-admin users to see the user ID drop down in the back-end when they have permission to edit entries from the back-end
* PRO: Added frm_data_sort hook for sorting data from entries options
* PRO: Allow dropdown fields to be selected as the post title
* PRO: Switched data from entries drop downs to use field key in the html id instead of the field id for consistency
* PRO: When importing templates, use the path shown in the box whether it has been saved or not
* PRO: Fixed admin-only fields to still save to created post
* PRO: Fixed issue preventing required multiple file upload fields from being required
* PRO: Updated input mask script to 1.3.1
* PRO: Added hooks for entries in the admin: frm_row_actions, frm_edit_entry_publish_box, frm_show_entry_publish_box, frm_edit_entry_sidebar

= 1.06.10 =
* Allow the usage of any html attributes inside the [input] tag in the customizable HTML
* PRO: Added "Chosen" autocomplete to dropdown fields
* PRO: Added automatic width option to data from entries fields
* PRO: Extended the "admin only" field option to all user roles, or only logged-in or logged-out users
* PRO: Added multiple-select to data from entries dropdowns
* PRO: Added more info to the form settings sidebar
* PRO: Resolved conflict between ajax submit and plugins/themes with whitespace in php files
* PRO: Fixed template export to properly serialize and escape for multiple choice fields

= 1.06.09 =
* DROPPED PHP4 SUPPORT. Do not update if you run PHP4.
* Added the "create template" link into the free version
* Added quotes around the menu position number to minimize menu position conflicts with other plugins
* Moved all stripslashes to the point the data is retrieved from the database
* Switched the field options bulk edit to use the admin ajax url to minimize plugin conflicts
* Changed all occurrences of .live() to .on() for jQuery 1.9 compatibility
* PRO: Added AJAX form submit
* PRO: Dropped Open Flash Chart support due to security vulnerabilities
* PRO: Added multiple option to dropdown fields
* PRO: Added unique error message into global and field settings
* PRO: Added option to limit by ranges in the frm-stats shortcode. Ex: [frm-stats id=50 '-1 month'<45<'-3 days']
* PRO: Automatically strip javascript before displaying entries through a custom display
* PRO: Added striphtml=1 and keepjs=1 options for use in custom displays
* PRO: Added option to get the field description with [125 show="description"]
* PRO: Added separate value column on entries page
* PRO: Added link to delete entry only and leave post
* PRO: Added box for custom css in the styling settings
* PRO: Added buttons to insert default HTML or plain text for those who wish to modify the default message without starting from scratch
* PRO: Added link to uploaded files in the entry edit form
* PRO: Added "like" and "not like" options to the conditional logic for hiding and showing fields
* PRO: Switched section headings to use h3 tags by default instead of h2
* PRO: Migrated "Allow Only One Entry for Each" fields to the unique checkbox on each field
* PRO: Allow for multiple uses of frm-entry-update-field for the same field and entry
* PRO: Allow external short codes in the email recipients box
* PRO: Allow the frm-search shortcode to be used in text widgets
* PRO: Switched conditional fields to show and hide instead of fadeIn and fadeOut
* PRO: Switched rich text fields to default to TinyMCE
* PRO: Correctly send emails to [admin_email], and allow the same email address to receive multiple notifications from the same form
* PRO: Filter shortcodes in success message when the form is limited to one entry per user and editable
* PRO: Correctly show the taxonomy name even if it is not linked to a post
* PRO: Fixed read-only option to work with dropdown fields
* PRO: Fixed post password setting
* PRO: Fixed post content replacement when entry is updated instead of only on creation
* PRO: Fixed frm-stats shortcode to allow field keys when using the value option
* PRO: Fixed custom displays getting used if they are in the trash
* PRO: Fixed custom display pages to not include the unfiltered post content when there are no entries to display
* PRO: Fixed the bulk delete option showing for users without permission to delete in the bulk actions dropdown on the admin entry listing page
* PRO: Fixed the delete link in entry edit links shortcode to prevent it from going to a blank form when using the page_id param
* PRO: Fixed calendar to show the correct number of extra boxes when not starting on Sunday
* PRO: Fixed repeated, inline conditional logic in custom displays
* PRO: Fixed option to copy forms to other sites in multi-site installs, so they will no longer be copied when the box is unchecked 
* PRO: Fixed admin-only fields to not validate for users who can't see the field

= 1.06.08 =
* Changed class names on action links on the form listing table to prevent conflicts with themes and other plugins
* PRO: Filter shortcodes if any in the login message
* PRO: Fixed order of fields shown in default email notification
* PRO: Keep files attached to the post when editing the entry and using multiple file upload option
* PRO: Attach file uploads to WP post even if the upload field is not set as a custom field
* PRO: Fixed bug forcing site name and admin email as the email "from" info when a custom name/email is selected
* PRO: Send a notification even if the notification before it is empty
* PRO: Fixed conditional logic on email notifications to make sure they are stopped when they should be
* PRO: Automatically send emails to the saved value of a field when used in the "Email recipients" box without requiring show=field_value

= 1.06.07 = 
* Added mb_split fallback for servers without mbstring installed
* Changed menu position to prevent override from other plugins and themes
* PRO: Fixed issue with the form shortcode showing if using multiple forms with default values on the same page
* PRO: Fixed javascript error in frm-entry-update-field shortcode
* PRO: Send the "read more" link to the single entry page instead of showing in-place for dynamic displays

= 1.06.06 =
* Removed generic classes from input fields like "text" and "date"
* Correctly jump down to form with error messages
* Added frm_setup_new_entry hook for overriding defaults for all fields in one hook when presenting a blank form
* Added "This field cannot be blank" message to global settings
* Changed substr to mb_substr for language-safe truncation
* WP 3.5 compatibility
* Fixed conflict with W3TC that was adding slashes into options on the form settings page
* Show a message on the form builder page if a reCaptcha is included in the form, but not set up
* Switch from add_object_page to add_menu_page to prevent menu position conflicts
* (Free only) Allow emails to be sent from the admin email instead of forcing an email address from the submitted entry
* PRO: Added multiple-image upload
* PRO: Added unlimited emails per form and conditional routing
* PRO: Use the "customized content" box to save the actual content if no field is selected for the post content
* PRO: Added frm-field-value shortcode to get the value of a field in another form. [frm-field-value field_id=25 user_id=current entry_id=140 ip=1]
* PRO: Added frm-show-entry shortcode to show an entry in the same formats as the default email message. [frm-show-entry id=100 plain_text=1 user_info=1]
* PRO: Added frm_set_get shortcode to artificially set $_GET values for use in custom displays or dynamic defaults values. [frm-set-get any_param="any value" another="value 2"] This can be fetched with [get param="any_param"] [get param="another"]
* PRO: Extended conditional logic for displaying fields to include text, number, email, website, and time fields
* PRO: Added support for the [frm-search] shortcode into the [formresults] table
* PRO: Updated NicEdit
* PRO: If http isn't included in a url or image field, automatically add it during validation
* PRO: Added "wrap" parameter to the frm-graph shortcode to wrap the text in long questions
* PRO: Added localization to custom display calendar to start on day of the week selected in WordPress settings
* PRO: Added entry updated dates to custom display shortcodes
* PRO: Correctly check uniqueness of post fields when there are no other error messages
* PRO: If using a number field with the value "0" that is linked through a data from entries field, show 0 instead of nothing
* PRO: Update for more accurate checking for hierarchal taxonomies when saving posts
* PRO: Evaluate numbers as numeric instead of a string for conditional logic for hiding and showing fields
* PRO: Fix to allow tags fields and other fields in the same form that are mapped to the same taxonomy
* PRO: Fixed conditional logic to work correctly when dependent on the value "0"
* PRO: Fixed display of shortcodes inside the before or after content areas of the custom display if nesting [get param=something]
* PRO: Fixed calculations for multiple-paged calculations with checkbox fields that may not be checked
* PRO: Fixed checkbox fields linked through another field to display properly in a custom display
* PRO: Fixed separate values to work with sending to email addresses
* PRO: Show a max of 500 options in a data from entries field in the admin to prevent server limits from making the form inaccessible
* PRO: Make sure the graphs printed from the reports page are not split when printing
* PRO: Fixed the link to show more text in the custom display to show the text in place or link to the single page correctly depending on the custom display type
* PRO: Removed "just show it" data from entries fields in the email checkbox settings
* PRO: Remove post custom fields from database if blank
* PRO: Fixed frm-stats shortcode to work with post custom fields combined with the value parameter
* PRO: Fixed div nesting issue when using collapsible section headings followed by non-collapsible sections headings
* PRO: Removed separate values checkbox for post status and taxonomy fields
* PRO: Fixed double filtering forms if inserted in the dynamic box of a custom display used for posts
* PRO: Fixed page size and limit overriding single entry displays

= 1.06.05 =
* Fixed WP 3.4 layout issues with missing sidebars
* Added responsive css for WP 3.4 to keep the form builder sidebar box showing on small screens
* Updated the delete option trash can to appear more easily
* Use absolute path for php includes() and requires() to prevent them from using files from other plugins or themes
* Updated translations
* PRO: Prevent wp_redirect from stripping square brackets from urls
* PRO: Fixed calculations for fields hidden in a collapsible section
* PRO: Fixed delete link to work on pages without forms
* PRO: Added support to import checkbox field values in multiple columns

= 1.06.04 =
* Moved form processing to avoid multiple submissions when some plugins are activated and remove the page before redirection
* Removed BuddyPress filters from the email notifications to avoid forcing them to send from noreply@domain.com
* Allow blank required indicator and to email in forms
* Fix to allow access to form, entry, and display pages for WordPress versions < 3.1
* Fixed default checkbox or radio field values for fields with separate option values
* Corrected Arkansas abbreviation in templates and bulk edit options
* Fixed display of radio field values from fields with separate values
* PRO: Added custom display content box into "create posts" settings tab
* PRO: Added options to auto-create fields for post status and post categories/taxonomies
* PRO: Added link to de-authorize a site to use your Pro credentials
* PRO: Added meta box on posts with link to automatically create a form entry linked to the post
* PRO: Hide pro credentials settings form when pro is active
* PRO: Fixed redirect URL to correctly replace shortcodes for forms set to not save any entries
* PRO: Fixed regular dropdown field taxonomies to trigger conditional logic and use the auto width option
* PRO: Allow searching by user login when selecting a user ID field to search by on the admin entries page
* PRO: Updated the auto_id default value to continue functioning correctly even if there are non-numeric values in entries
* PRO: Added an index.php file into the uploads/formidable folder to prevent file browsing for those without an htaccess file
* PRO: Allow field IDs as dynamic default values ie [25]. This will ONLY work when the value has just been posted.
* PRO: Added the display object into the args array to pass to the frm_where_filter hook
* PRO: Allow for negative numbers in calculations
* PRO: Allow for unlimited GET parameter setting in the custom display shortcode. [display-frm-data id=2 whatever=value whatever2=value2]
* PRO: Switched phone field to HTML5 "tel" input type
* PRO: Added a frm_cookie_expiration hook to change the cookie expiration time
* PRO: Added cookie expiration option
* PRO: Added frm_used_dates hook for blocked out dates in unique datepickers
* PRO: Added frm_redirect_url hook
* PRO: Fixed forms submit button labels for forms in add entry mode that follow a form in edit mode on the same page
* PRO: Fixed CSV import for delimiters other than a comma
* PRO: Added three icons to the error icon setting
* PRO: Fixed duplicate deletion messages when using [deletelink] in the form customizable HTML
* PRO: Updated calculations and conditional logic to work across multi-paged forms
* PRO: Added basic support for data from entries csv import 
* PRO: Show image for data from entries fields using upload fields

= 1.06.03 =
* Added option to not store entries in the database from a specific form
* Added option to skip Akismet spam check for logged in users
* The forms, entries, and custom display page columns that are shown and entries per page are now customizable for those running at least v3.1 of WordPress
* Added a css class option to the field options with predefined CSS classes for multi-column forms: frm_first_half, frm_last_half, frm_first_third, frm_third, frm_last_third, frm_first_fourth, frm_fourth, frm_last_fourth, frm_first_inline, frm_inline, frm_last_inline, frm_full, frm_grid_first, frm_grid, frm_grid_odd
* Added the option to add a class to an input. In the customizable HTML, change [input] to [input class="your_class_here"]
* Added "inline" option to label position options to have a label to the left without the width restriction
* Switched the "action" parameter to "frm_action" to prevent conflicts. If no "frm_action" value is present, "action" will still be used
* Updated templates with new styling classes
* Show quotation marks instead of entities in the site name in email notifications
* Added Polish translation
* PRO: Removed a vulnerable Open Flash Charts file. If you do not update, be sure to REMOVE THIS FILE! (pro/js/ofc-library/ofc_upload_image.php)
* PRO: Added option to use a separate value for the radio, checkbox, and select choices
* PRO: Added option to use dynamic default values for radio, checkbox, dropdown, and user ID fields
* PRO: Added option to use Google charts and automatically fall back to them on mobile devices [frm-graph id=x type=bar google=1]
* PRO: Added data from entry field support to graphs
* PRO: Added option to use Google tables for easy pagination and sorting [formresults id=x google=1]
* PRO: Added edit link option to formresults shortcode. [formresults id=x edit_link="Edit" page_id=5]
* PRO: Added date support to built-in calculations for date1-date2 types of calculations
* PRO: Added checking for disabled used dates for fields set as post fields in date picker for dates marked as unique
* PRO: Added not_like, less_than, and greater_than options to conditional custom display statements. Ex [if 25 not_like="hello"]...[/if 25]
* PRO: Allow [if created-at less_than='-1 month'] type of statements in the custom display for date fields, created-at, and updated-at
* PRO: Added option to display the field label in custom displays. Ex [25 show="field_label"]
* PRO: Added option to turn off auto paragraphs for paragraph fields. Ex [25 wpautop=0]
* PRO: Added options to custom display shortcode: [display-frm-data id=5 get="whatever" get_value="value"]. This allows the use of [get param="whatever"] in the custom display. 
* PRO: Updated the frm-entry-links shortcode to use show_delete with type=list
* PRO: Updated custom display where options to fetch entries more accurately when "not like" and "not equal to" are used
* PRO: Fixed image upload naming for uploads with numeric names like 1.png
* PRO: Fixed issue with multiple editable forms on the same page when one is set to only allow one entry per user
* PRO: Added a check for automatically inserted custom displays to make sure we are in the loop to avoid the need for increasing the insert position setting
* PRO: Show the post type label in the post type dropdown instead of the singular label to avoid blank options for custom post types without a singular name defined
* PRO: Switched out the case-sensitive sorting in data from entries fields
* PRO: If a custom display has detail link parameters defined, ONLY allow those parameters
* PRO: Added an input mask option available via the $frm_input_masks global and 'frm_input_masks' hook
* PRO: Added type=maximum and type=minimum to the frm-stats shortcode
* PRO: Month and year dropdowns added to custom display calendar, along with a few styling changes
* PRO: Get the custom display calendar month and day names from WordPress
* PRO: Allow dynamic default values in HTML field type
* PRO: Get post status options from WordPress function instead of a copy
* PRO: Check the default [auto_id] value after submit to make sure it's still unique
* PRO: If the "round" parameter is used in the frm-stats shortcode, floating zeros will be kept
* PRO: If greater than or less than options are used with a number field in a custom display, treat them as numbers instead of regular text
* PRO: Allow user logins for the user_id parameter in the frm-graph, frm-stats, and display-frm-data shortcodes
* PRO: Fixed the date format d-mm-yyyy to work correctly in the date field
* PRO: Added timeout to redirect so users will see the redirect message for a few seconds before being redirected
* PRO: Allow decimal values in graphs instead of forcing integers
* PRO: Updated the time field to use a true select box instead of a text field
* PRO: Removed included swfobject and json2 javascripts to use the included WordPress versions
* PRO: Added 'frm_graph_value' filters to change the value used in the graphs
* PRO: Populate strings to be translated without requiring a visit to the WPML plugin
* PRO: If the where options in a custom display include a GET or POST value that is an array, translate the search to check each value instead of searching for a comma-separated value in one record.
* PRO: Added entry key and entry ID to the where options in custom displays
* PRO: Added HTML classes on the search form, so if themes include styling for the WP search form, it will be applied to the [frm-search] as well
* PRO: Allow multiple data from entries fields to be searched using the frm-search shortcode instead of only one
* PRO: Fixed update checking to not cause a slow down if the formidablepro.com server is down
* PRO: Updated the user_id parameter for the display-frm-data shortcode to be used even if there's no user ID field selected in the where options for that custom display
* PRO: Added DOING_AJAX flags for WPML compatibility
* PRO: Added time_ago=1 option for displaying dates. Ex: [created-at time_ago=1] or [25 time_ago=1]
* PRO: Updated file upload process to change the file path before uploading instead of moving the files afterwards

= 1.06.02 =
* Fixed selection of dropdowns on the form builder page in Chrome
* Added WPML integration. Requires the add-on available from WPML. Pro version includes a quick translation page.
* Added option to use the custom menu name site wide in multi-site installs
* Added 'frm_use_wpautop' filter for disabling all built-in occurrences of auto paragraphs (form description, HTML fields, and displaying paragraph fields)
* Only show the form icon button on the edit post page for users with permission to view forms
* Changed .form-required class to .frm_required_field
* Start with label in edit mode after adding a new field
* Added required indicator to styling
* Don't allow whitespace to pass required field validation
* PRO: Added option to restrict the file types uploaded in file upload fields
* PRO: Added export to XML and export to CSV to bulk action dropdowns
* PRO: Added [user_id] dynamic default value
* PRO: Allow dynamic dates in the frm-graph shortcode. Ex [frm-graph id=x x_axis="created_at" x_start="-1 month"]
* PRO: Added bar_flat to the graphs. Ex [frm-graph id=x type="bar_flat"]
* PRO: Dynamically hide some x-axis labels if there are too many for the width of the graph. Note: Does not work with percentage widths
* PRO: Added the option to select an end date in calendar custom displays for displaying multiple day events
* PRO: Added 'frm_show_entry_dates' filter for customizing which dates an entry should show on
* PRO: Disabled used dates in date picker for dates marked as unique
* PRO: Added option to search by entry creation date on admin entries listing page
* PRO: Added windows-1251 option for CSV export format
* PRO: Added the class parameter to the edit-in-place cancel link
* PRO: Improved CSV import to work better with large files
* PRO: Make a guess at which fields should match up on CSV import
* PRO: Added option to resend the email notifications when entry is updated. (This will be expanded when conditional email routing is added.)
* PRO: Don't send autoresponder message when importing
* PRO: Allow an entry id in the frm-stats shortcode. Ex [frm-stats id=25 entry_id=100]. Display a star vote as stars for a single entry in a custom display with [frm-stats id=25 type=star entry_id=[id]]
* PRO: Allow multiple star ratings for the same field on the same page
* PRO: Fixed post options that would not deselect
* PRO: Fixed issue causing the wrong conditional logic row to sometimes be removed
* PRO: Fixed bug preventing hidden fields from saving as a post field
* PRO: Fixed required tags fields to not return errors when not blank
* PRO: Fixed bug preventing some javascripts and stylesheets from getting loaded on admin pages if the menu title was changed
* PRO: Fixed graphs to show x_axis dates in the correct order if 2011 and 2012 dates are in the same graph
* PRO: Corrected WP multisite table name for the table to copy forms and custom displays
* PRO: Fixed issue with graphs showing in front of dropdown menus in Chrome
* PRO: Fixed bug in custom displays causing the wrong entries to be returned when a post category field is set to NOT show a certain category
* PRO: Fixed bug with multiple paged forms that was sometimes causing the next page to show even if errors were present on previous page
* PRO: Allow entries to be correctly editing from the backend by a user other than the one who created it, when data from entries field options are set to be limited to only the user currently filling out the form
* PRO: Updated conditional logic for those who set up the logic before v1.6 and haven't clicked the update button in their forms
* PRO: Corrected file upload naming for the various sizes of an upload with the same name as an existing upload

= 1.06.01 =
* Added option to customize the admin menu name
* Added instructions to publish forms if no entries exist
* Free only: Fixed form settings page to allow tabs to work
* Free only: Updated styling to align multiple checkboxes/radio buttons when the label is aligned left
* PRO: Fixed issue with the default value getting lost from a hidden field when updating from the form settings page
* PRO: Fixed conditionally hidden fields that are already considered hidden if inside a collapsible section
* PRO: Fixed graphs using x_axis=created_at and user_id=x
* PRO: Fixed multiple paged forms with more than two pages
* PRO: Validate HTML for checkbox taxonomies

= 1.06 =
* User Interface improvements
* Increased security and optimization
* Moved the "automatic width" check box for drop-down select fields to free version
* Moved email "From/Reply to" options to free version
* Fixed form preview page for form templates
* Added German translation  (Andre Lisbert)
* Added ajax to uninstall button
* Correctly filter external shortcodes in the form success message
* Show error messages at the top if they are not for fields in the form (ie Akismet errors)
* Updated bulk edit options to change the dropdown in the form builder at the time the options are submitted
* Fixed default values set to clear on click to work with values that include hard returns
* Free only: Fixed hidden label CSS
* PRO: Extended the conditional field logic
* PRO: Added graphs for fields over time, and other customizing options: x_axis, x_start, x_end, min, max, grid_color, show_key, and include_zero
* PRO: Moved post creation settings from individual fields to the forms settings page
* PRO: Added option in WP 3.3 to use Tiny MCE as the rich text editor
* PRO: Added "format" option to date fields. Example [25 format='Y-m-d']
* PRO: Added star rating option to scale fields
* PRO: Added star type to [frm-stats] shortcode to display the average in star format. Example [frm-stats id=5 type=star]
* PRO: Added option to format individual radio and checkbox fields in one or multiple rows
* PRO: Added server-side validation for dates inserted into date fields
* PRO: Allow multiple fields for the same taxonomy/category
* PRO: Allow a taxonomy/category to be selected for data from entries fields. This makes cascading category fields possible.
* PRO: Added [post_author_email] dynamic default value
* PRO: Added a frm_notification_attachment hook
* PRO: Added clickable and user_id options to the formresults shortcode. ex [formresults id=x clickable=1 user_id=current]
* PRO: Improved field calculations to extract a price from the end of an option
* PRO: Added the option to specify how many decimal places to show, and what characters to use for the decimal and thousands separator. For example, to format USD:
$[25 decimal=2 dec_point='.' thousands_sep=',']
* PRO: Added a message before the user is redirected, along with a filter to change it (frm_redirect_msg).
* PRO: Added a button to delete ALL entries in a form at the bottom of the entries page
* PRO: Added a password field type
* PRO: Conditionally remove HTML5 validation of form if default values are present
* PRO: Added like parameter for inline conditions in custom displays. Example: [if 25 like="hello"]That field said hello[/if 25]
* PRO: Allow fields set as custom post fields to be used for sorting custom displays
* PRO: Updated import to create the posts at the time of import
* PRO: Unattach images from a post if they are replaced
* PRO: Leave the date format in yyyy-dd-mm format in the CSV export
* PRO: Allow importing into checkbox fields
* PRO: Added option to use previously uploaded CSV for import so new upload isn't required when reimporting
* PRO: Added option to change the text on the submit button in the frm-search shortcode. Example [frm-search label="Search"]
* PRO: Fixed bug preventing a field dependent on another data from entries field from updating
* PRO: Fixed bug affecting pages with multiple editable forms on the same page that caused the first form to always be submitted
* PRO: Updated the truncate option to not require full words if truncating 10 or less characters
* PRO: Fixed bug preventing front-end entry deletion when the form was editable and limited to one per user
* PRO: Fixed bug preventing checkbox selections from showing in custom email notifications if a checkbox contained a quotation mark
* PRO: Prevent the uploading files message from showing if no files were selected
* PRO: Check a default value when using dynamic default values in the check box options
* PRO: Fixed bug preventing a newly created post from getting assigned to the user selected in the user ID dropdown if the selected user was not the user submitting the entry or was created with the registration add-on in the same form
* PRO: Fixed bug preventing Data from entries "just show it" fields from showing a value in admin listing and view entry pages
* PRO: Fixed bug causing the options to be empty if the data from entries options are limited to the current user and the form they are pulled from are creating posts
* PRO: Fixed empty results in the [formresults] table for forms that create posts
* PRO: When a blog is deleted in WP multi-site, delete database table rows related to copying forms from that blog
* PRO: Don't strip out desired backslashes 
* PRO: Updated to latest version of datepicker javascript

= 1.05.05 =
* Added Dutch translation (Eric Horstman)
* Fixed "Customize Form HTML" link issues some users were having
* PRO: Load jQuery UI javascript for datepicker
* PRO: Fixed custom display "where" options to work with multiple where rows

= 1.05.04 =
* Bulk edit and add radio, select, and check box choices
* Added option to turn off HTML5 use in front-end forms
* Added option to turn off user tracking
* Scroll field choices in the form edit page if radio, check box, or select fields have more than 10 choices
* Free only: Removed export template link since the functionality behind it is only in Pro version
* PRO: Added CSV entry import
* PRO: Added file icons when editing an entry with a non-image file type attached
* PRO: Added functionality for time fields set as unique so time options will be removed after a date is selected
* PRO: Check wp_query if no matching GET or POST variable in the get shortcode
* PRO: Switch taxonomy lists to links in custom displays
* PRO: Added functionality for a where option to be set to a taxonomy name ie [get param=tag]
* PRO: Added functionality for a taxonomy to work with equals and not_equal in custom displays
* PRO: Removed ajax error checking on the captcha field to fix the incorrect response messages
* PRO: Fixed dependent data from entries fields to show the selected values on validation error and on edit
* PRO: Added `[frm-entry-update-field]` shortcode to update a single field in an entry with an ajax link
* PRO: Added global styling option to set newly-added select fields to an automatic width
* PRO: Fixed calendar to allow fields mapped to a post to be used as the date field
* PRO: Fixed conditionally hidden field options to work with post category and post status fields
* PRO: Fixed custom displays to work automatically with pages instead of just post and custom post types
* PRO: Added functionality to frm-stats shortcode to work with posts and adds where options in key/id=value pairs. ex: [frm-stats id=x 25=hello] where 25 is the field ID and "Hello" is the value the other field in the form should have in order to display
* PRO: Updated datepicker and timepicker to latest versions
* PRO: Fixed bug preventing images for saving correctly if the form is set to create a post and the upload field is not set as a post field
* PRO: Added an "Insert Position" option to the custom display. This will prevent the custom display from being loaded multiple times per page, but will allow users to set when it shows up for themes like Thesis
* PRO: Fixed number field to work with decimals and when ordering descending
* PRO: Added a limit to the number of entries that show in the entry drop-down in places like the custom display page to prevent memory errors
* PRO: Fixed field options to work better with symbols like &reg; in graphs
* PRO: Automatically open collapsible heading if there is an error message inside it
* PRO: Added type=deviation to the frm-stats shortcode. Example: [frm-stats id=x type=deviation]
* PRO: Updated calculations to work with radio, scale, and drop-down fields
* PRO: Fixed default values for check boxes
* PRO: Added CSV export format option
* PRO: Fixed scale field reports to show all options

= 1.05.03 =
* Updated user role options to work more reliably with WP 3.1
* Added functionality for "Fit Select Boxes into SideBar" checkbox and field size in widget in free version
* Moved reCaptcha error message to individual field options
* Updated referring URL and added tracking throughout the visit
* PRO: Added "clickable" option for use in custom displays to make email addresses and URLs into links. ex `[25 clickable=1]`
* PRO: Added option to select the taxonomy type
* PRO: Updated form styling to work better in IE
* PRO: Updated emails to work with Data from entries checkbox fields
* PRO: Updated dependent Data from entries fields to work with checkboxes
* PRO: Adjusted [date] and [time] values to adjust for WordPress timezone settings
* PRO: Updated the way conditionally hidden fields save in the admin to prevent lingering dependencies
* PRO: Fixed link to duplicate entries
* PRO: Updated file upload indicator to show up sooner
* PRO: Added ajax delete to [deletelink] shortcode
* PRO: Updated admin only fields to show for administrators on the front-end
* PRO: Added more attributes to the [display-frm-data] shortcode: limit="5", page_size="5", order_by="rand" or field ID, order="DESC" or "ASC"
* PRO: Fixed custom display bulk delete
* PRO: Updated WPMU copy features to work with WP 3.0+
* PRO: Switched the email "add/or" drop-down to check boxes
* PRO: Added box for message to be displayed if there are no entries for a custom display
* PRO: Added ajax edit options with [frm-entry-edit-link id=x label=Edit cancel=Cancel class='add_classes' page_id= prefix='frm_edit_' form_id=>y]. Also works with [editlink location=front] in custom displays.
* PRO: Moved styling options into a tab on the settings page
* PRO: Added limited "data from entries" options to the custom display "where" row. Entry keys or IDs can be used
* PRO: Added unique validation for fields set as post fields
* PRO: Removed error messages for required fields hidden via the shortcode options
* PRO: Only return [deletelink] if user can delete the entry
* PRO: Added order options to calendar displays
* PRO: Updated custom display ordering to order correctly when using a 12 hour time field
* PRO: Added taxonomy options to the "Tags" field
* PRO: Added HTML escaping to text fields to allow HTML entities to remain as entities when editing
* PRO: Added functionality to use taxonomy fields in where options in custom displays
* PRO: Added option to use [get param=CUSTOM] in custom displays

= 1.05.02 =
* Fixed issue with PHP4 that was causing the field options to get cleared out and only show a "0" or "<" instead of the field
* Prevent javascript from getting loaded twice
* Updated stylesheets for better looking left aligned field labels. In the Pro version, setting the global labels to one location and setting a single field to another will keep the field description and error messages aligned.
* PRO: Fixed issue causing form to be hidden on front-end edit if it was set not to show with the success message
* PRO: Show the linked image instead of the url when a file is linked in a "just show it" data from entries field
* PRO: Added functionality for ordering by post fields in a custom display

= 1.05.01 = 
* PRO: Fix custom display settings for posts

= 1.05.0 =
* Moved a form widget from Pro into the free version
* Updated some templates with fields aligned in a row
* Moved error messages underneath input fields
* Added option to display labels "hidden" instead of just none. This makes aligning fields in a row with only one label easier
* Additional XHTML compliance for multiple forms on one 
* Removed the HTML5 required attribute (temporarily)
* Corrected the label position styling in the regular version
* A little UI clean up
* Added hook for recaptcha customizations
* PRO: Added custom post type support
* PRO: Added hierarchy to post categories
* PRO: Added a loading indicator while files are uploading
* PRO: Added a `[default-message]` shortcode for use in the email message. Now you can add to the default message without completely replacing it 
* PRO: Added default styling to the formresults shortcode, as well as additional shortcode options: `[formresults id=x style=1 no_entries="No Entries Found" fields="25,26,27"]`
* PRO: Added localizations options to calendar
* PRO: Fixed collapsible Section headings to work with updated HTML
* PRO: Added functionality to admin search to check data from entries fields
* PRO: Added start and end time options for time fields
* PRO: Added 'type' to `[frm-graph]` shortcode to force 'pie' or 'bar': `[frm-graph id=x type=pie]`
* PRO: Added post_id option to the `[frm-search]` shortcode. This will set the action link for the search form. Ex: `[frm-search post_id=3]`
* PRO: Fixed `[frm-search]` shortcode for use on dynamic custom displays. If searching on a detailed entry page, the search will return to the listing page.
* PRO: Updated post fields to work in "data from entries" fields

= 1.04.07 =
* Minor bug fixes
* PRO: Fixed bug preventing some hidden field values from being saved
* PRO: Removed PHP warnings some users were seeing on the form entries page

= 1.04.06 =
* Additional back-end XHTML compliance
* PRO: Fixed conditionally hidden fields bug some users were experiencing

= 1.04.05 =
* Added duplicate entry checks
* Added a checkbox to mark fields required
* Moved the duplicate field option into free version
* Show the success message even if the form isn't displayed with it
* Added option to not use dynamic stylesheet loading
* PRO: Added option to resend email notification and autoresponse
* PRO: Fixes for editing forms with unique fields
* PRO: Fixes for editing multi-paged forms with validation errors
* PRO: Fixes for multiple multi-paged form on the same page
* PRO: Added linked fields into the field drop-downs for inserting shortcodes and sending emails
* PRO: Added field calculations
* PRO: Allow hidden fields to be edited from the WordPress admin
* PRO: Allow sections of fields to be hidden conditionally with the Section Header fields
* PRO: Added user_id option to the `[frm-graph]` shortcode
* PRO: Updated the custom display settings interface

= 1.04.04 =
* Switched to the Google version of reCAPTCHA to no longer require an extra plugin. IMPORTANT: Please check that your reCAPTCHAs are still working. If not, you will need to go to http://www.google.com/recaptcha and either migrate your old keys or get new ones.
* Updated Akismet protection to work more accurately
* Added Portuguese translation thanks to Abner Jacobsen. He also pointed out an awesome plugin to help with translating: [Codestyling Localization](http://wordpress.org/extend/plugins/codestyling-localization/ "Codestyling Localization]")
* PRO: Added unique field validation
* PRO: Added admin-only fields
* PRO: Updated javascript for more speed and allow more than two dependent data from entries fields (makes Country/State/Region/City selectors possible if you do the data population)
* PRO: Added success message styling
* PRO: Fix bug preventing all image sizes from getting created
* PRO: Changed the name of the scale field from "10radio" to "scale". This may affect users with add-on plugins using this name
* PRO: Added `[deletelink]` option for use in custom HTML
* PRO: Added `not_equal` parameter for conditionally displaying content. ie `[if XX not_equal="Blah Blah"]stuff[/if XX]`å

= 1.04.03 = 
* Load styling before any forms are loaded
* Fixed in-place edit in IE (finally! Sorry guys!)
* PRO: Include styling on multi-paged forms
* PRO: Allow floating decimals in the number field
* PRO: Don't load jQuery CSS in the admin
* PRO: Moved javascript for hidden fields to the footer (wp_footer)
* PRO: Added field options to the user id and hidden fields

= 1.04.02 = 
* PRO: Fixed drop-down hidden field dependencies
* PRO: Added options to the time field (12 or 24 hours, minute step)

= 1.04.01 =
* Changed the ID of the select, user id, and hidden fields to "field_" plus field key
* Moved the "Edit HTML" button out of the "Advanced Form Options" area
* Only load css when needed
* Jump to form on page after errors
* Added option to use [admin_email] in the "Email Form Responses to" line to save time for those who only want to change their email address in one place.
* Free only: If no email address is inserted, the email will be sent to the admin email
* PRO: Added Time field
* PRO: Added option to use posted data in the redirect URL
* PRO: Added option to set the range for the scale field
* PRO: Added option to attach file uploads to email notifications
* PRO: Only load date javascript when a date field has been loaded
* PRO: Moved file uploads to uploads/formidable
* PRO: Optimized the css file by writing it to uploads/formidable/css instead of loading a php file
* PRO: Added styling for field description, and gradients and shadows on the submit button
* PRO: Updated default values to work with radio, check box, and select fields.
* PRO: Fixed front-end reports to work in IE and Chrome
* PRO: Added option to dynamically get stats for the currently logged-in user with the `[frm-stats]` shortcode ie. `[frm-stats id=x user_id=current]`
* PRO: Added 'round' option to frm-stats to specify the number of decimal places to show ie `[frm-stats id=x round=2]`
* PRO: Added 'response_count' to frm-graph to increase the maximum number of responses for a text field ie `[frm-graph id=x response_count=10]`
* PRO: Added 'truncate' and 'truncate_label' to frm-graph to adjust the number of characters shown for the graph title and the labels of the graph ie `[frm-graph id=x truncate=40 truncate_label=7]`
* PRO: Added fields to the drop-down list for limiting submissions. Now you can "Allow Only One Entry for Each" email address or whatever other field you may have in your form.
* PRO: Change the hidden User ID field to a drop-down for admins editing entries in the back-end
* PRO: Removed the sanitizing from the custom field name to make it possible to use any custom field name desired
* PRO: Update to check for calendar css in the uploads/formidable/css folder before using it from https://ajax.googleapis.com
* PRO: Added options to number field to specify the range and steps used in the HTML5 field
* PRO: More form options are exported in templates 
* PRO: Fixed bug preventing fields with an ' or " from getting copied correctly when duplicating and creating/exporting templates
* PRO: Post categories now work as a drop-down
* PRO: Limit form entries to one per [whatever field here]. For example, only allow one submission per email address.
* Other bug fixes and optimization

= 1.04.0 =
* Added icon link on post/page editor for inserting forms
* Added parameters to show individual radio/checkbox options in the custom HTML using the `[input]` tag. example: `[input opt=1]` where opt is the option order. Also hide the labels with `[input label=0]`. Now grid fields are much easier.
* PRO: Added post integration! Pro forms can now be used for creating and editing posts
* PRO: Added a calendar option to the custom display, allowing entries to be displayed in a monthly calendar
* PRO: Added page_id parameter to `[frm-entry-links]` shortcode to remove the requirement to place entry list on the same page as the form for editing entries
* PRO: Updated email, url, and number fields to use HTML5
* PRO: Updated custom displays to work with the `[frm-search]` shortcode
* PRO: Named submit buttons according the the page break name if using multi-paged forms
* PRO: Added boxes for before/after custom display content box for non-repeating content
* PRO: Use entry values in the success message
* PRO: Switch out the Rich Text Editor for a text box if users are on a mobile device
* PRO: Fixed the confirmation options to work when editing an entry
* PRO: Added default value for [time]
* PRO: Fixed admin search
* PRO: Fixed field drop-down on custom display page to work on the Visual tab

= 1.03.03 =
* Added options to allow users other than admins to access Formidable
* Added uninstall button
* Fixed multiple submissions for pages with multiple forms
* PRO: Added [frm-graph] shortcode for front-end graphical reports! Default values: `[frm-graph id=x include_js=1 colors="#EF8C08,#21759B,#1C9E05" bg_color="#FFFFFF" height=400 width=400]`. Show multiple fields with `[frm-graph id="x,y,z"]`
* PRO: Added "value" parameter to the frm-stats shortcode for counting number of entries with specified value `[frm-stats id=8 value="Hello" type=count]`
* PRO: Added a field drop-down for searching specific fields on the entries page
* PRO: Added option to allow users to edit any entry instead of only their own and other user-role options
* PRO: Added calendar date format option on the Formidable Settings page
* PRO: Changed "entry_id" in the "display-frm-data" to accept multiple entry IDs. ex: `[display-frm-data id=x entry_id="34,35,36"]`
* PRO: Added "equals" option to if statements. ex: `[if 283 equals=hello]show this if the field with id 283 equals hello[/if 283]`

= 1.03.02 =
* Fixed admin pagination to navigate correctly with the arrow
* Fixed most Internet Explorer admin issues
* PRO: Added option to only show certain fields in a shortcode `[formidable id=x fields="field1,field2,field3"]`
* PRO: Added a user_id parameter to the frm-stats shortcode to get only the averages and totals for that user `[frm-stats id=8 user_id=19]`
* PRO: Fixed custom display to correctly show a single entry for all users.
* PRO: Fixed bug that prevented some of the dynamic default values from getting replaced if the was no value to replace it with
* PRO: Fixed bug causing "Array" to be shown in the email notification if more than one check box was selected
* PRO: Fixed "Data from Entries" check box javascript and display on entries page
* PRO: Fixed new fields to default to position set on the Formidable settings
* PRO: Updated country field in the User Information template
* PRO: Fixed hidden field to not lose its value if updated from the admin
* PRO: If using `[frm-entry-links]` with type=collapse, the first year and month now default to open and fixed div uneveness 
* PRO: Corrected values when using a "Data from Entries" drop down from an image url field to show the url
* PRO: Editable 'You have already submitted that form' message
* Other fixes

= 1.03.01 =
* PRO: Fixed auto-update for WP 2.9

= 1.03.0 =
* Added the option of showing the form with the success message or not
* Added settings options for default messages and option to exclude the stylesheet from your header
* PRO: Added auto responder and made the notification email customizable
* PRO: Added options to redirect or render content from another page
* PRO: Added option to only allow only submission per user, IP, or cookie
* PRO: Added option to export a custom template as a PHP file so it can be used on other sites
* PRO: Added option to specify alternate folder from which to import templates
* PRO: Added number field
* PRO: Added auto increment default value `[auto_id start=1]`
* PRO: Added a field width option to the sidebar widget
* PRO: Added a rich text editor to the custom display page
* PRO: Added an edit link shortcode for use in custom displays `[editlink]`
* PRO: Added a drop-down select to insert the field shortcodes for custom displays
* PRO: Added year range option to date fields
* PRO: Fixed bug causing collapsed section to open and immediately close if there are multiple forms on the same page
* PRO: Fixed bug preventing styling options from saving for some users
* PRO: Added styling options: disable submit button styling, field border style and thickness, form border color and thickness, submit button border and background image
* PRO: Added read-only fields with option to enable all fields in the shortcode [formidable id=x readonly=disabled]
* PRO: Added entry_id option to form shortcode `[formidable id=x entry_id=x]`. The entry_id can either be the number of the entry id or use "last" to get the last entry.
* PRO: Added taxonomy support with a tags field
* PRO: Added "where" options to custom displays so only specified entries will be shown.
* PRO: Fixed bug preventing file upload fields from accurately requiring a file
* PRO: Added type=collapsible to the frm-entry-links shortcode for a collapsible archive list
* PRO: Added referrer and user action tracking that is recorded with each entry submitted

= 1.02.01 =
* Emailer now works for everyone! (hopefully)
* Optionally Reset HTML. Just clear out the box for the HTML for that field and hit update.
* PRO: Fixed collapsible section to use correct default HTML. 
* PRO: Only call rich text javascript on entries pages
* PRO: A few small reports modifications. Report for the User ID field will show the percentage of your users who have submitted the form if you are allowing edits with only one submission per user.

= 1.02.0 =
* Updated in-place edit to save more easily and not wipe HTML when editing
* Updated email notifications to hopefully work for more users, send from the first email address submitted in the form, and send one email per email address in the form options
* Changed form to show after being submitted instead of only showing the success message.
* Fixed bug causing newly added fields to be ordered incorrectly when dragged into the form
* Made the field list sticky temporarily until the UI gets further updates
* Fixed quotation marks and apostrophes in form input fields so data won't be lost after them
* Radio buttons and check boxes are now truly required
* PRO: Added a Page Break field for multiple paged forms
* PRO: Added a Rich Text Editor field
* PRO: Added a widget to list entries linking to entry detail page to be used along-side a single custom display
* PRO: Added an option to order entries by ascending or descending in the entry display settings
* PRO: Added front-end pagination for displaying entries
* PRO: Fixed bug with multiple forms on single page causing 2nd form to be hidden when 1st form submitted with errors
* PRO: Updated custom displays for faster front-end loading and more efficiency
* PRO: Added `size` option parameter to file upload shortcodes and `show` parameter to data from entries field for use in custom displays
* PRO: Added customizable HTML for section divider and page break
* PRO: Added page to view entries in a read-only format in the admin

= 1.01.04 =
* Updated in-place edit to work with more characters and function without the save buttons
* Fixed bug causing several form options to be lost when the form name or description was edited without also clicking update for the whole form
* Made more user interface modifications
* PRO: Added dynamic default values for GET/POST variables
* PRO: Added shortcode for fetching field-wide calculations `[frm-stats id=5 type=(count, total, average, or median)]`
* PRO: Added icon link to duplicate an individual field
* PRO: Increased the WPMU efficiency so the templates are only updated if the database version is changed
* PRO: Added functionality to the 'Data From Entries' field to use another observed 'Data From Entries' field to join a third form
* PRO: Fixed admin entry searches to start on first page of results if search was submitted from a higher page

= 1.01.03 =
* Fixed bug preventing field options from showing on a newly-added field
* PRO: Added option to activate Pro sitewide for WPMU
* PRO: Added option to copy forms and entry displays to other blogs in WPMU
* PRO: Fixed checkbox bug when editing an entry

= 1.01.02 =
* Updated the form builder page with a little more simplicity and less clutter
* PRO: Added a warning message if Pro is not activated

= 1.01.01 =
* Fixed bug preventing stylesheet override on individual forms
* PRO: Backed out pretty permalinks 
* PRO: Fixed bug duplicating displayed data

= 1.01.0 =
* Added checkboxes to optionally include default stylesheet
* Completely validated HTML this time (hopefully)
* PRO: Added a FREAKING AWESOME form styling editor
* PRO: Made the link to view entries pretty if default permalinks are not in use
* PRO: Fixed bug preventing external shortcodes from getting replaced when custom displayed data is not inserted automatically
* PRO: Added shortcode for front-end search

= 1.0.12 =
* Validated HTML markup for front-end form
* Simplified the way a default template is created so it will also get updated with any changes
* Really fixed the after HTML field this time
* Changed option to email form to default to admin's email address instead of blank
* PRO: Ability to switch from one field type to another
* PRO: Finished the 'Data from Entries' field
* PRO: Added the first overall report (daily submissions)
* PRO: Added two new form templates (more to come of course)
* PRO: Editable Submit button and Success message for editing entries
* PRO: Added option to sort by most fields when creating/editing the custom display settings

= 1.0.11 =
* Added a selectable shortcode on the forms listing page
* Fixed the before and after HTML fields to display properly
* Added option to clear default text on a textarea (paragraph input)
* Added option for validation to ignore default values

= 1.0.10 =
* Started HTML customization. Will be updated, but for now you can only edit the HTML when editing the form.
* Added 'Settings' link on plugin page

= 1.0.09 =
* Fixes for PHP 4 compatibility

= 1.0.08 =
* Allow required indicator to be blank
* Hide paragraph tags if field description is empty
* General code cleanup

= 1.0.07 =
* Added Akismet integration
* Replaced all instances of `<?` with `<?php`
* Fixed bug preventing multiple forms from showing on the same page

= 1.0.06 =
* Added option to rename submit button
* Added option to customize success message
* Moved default form values from pro to free version
* Added option to clear default text when field is clicked

= 1.0.05 =
* Added loading indicator to required star and when field is added by dragging
* Added confirmation before field is deleted
* Fixed field options for radio buttons to correctly save
* Don't call pluggable.php if functions are already defined (To remove conflict with Role Scoper)
* Added Pro auto-update code for testing

= 1.0.4 =
* Fix captcha for WPMU
* Hide captcha field if WP reCAPTCHA is not installed

= 1.0.3 =
* Allow `<?php echo FrmFormsController::show_form(id, key, title, description);?>` to be used in a template

= 1.0.2 =
* Fixed error on submission from direct link

= 1.0.1 =
* Fixed shortcode for text widget
* Removed extra menu item