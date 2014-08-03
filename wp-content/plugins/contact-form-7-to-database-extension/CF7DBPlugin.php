<?php
/*
    "Contact Form to Database" Copyright (C) 2011-2014 Michael Simpson  (email : michael.d.simpson@gmail.com)

    This file is part of Contact Form to Database.

    Contact Form to Database is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Contact Form to Database is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database.
    If not, see <http://www.gnu.org/licenses/>.
*/

require_once('CF7DBPluginLifeCycle.php');
require_once('CFDBShortcodeTable.php');
require_once('CFDBShortcodeDataTable.php');
require_once('CFDBShortcodeValue.php');
require_once('CFDBShortcodeCount.php');
require_once('CFDBShortcodeJson.php');
require_once('CFDBShortcodeHtml.php');
require_once('CFDBShortcodeExportUrl.php');
require_once('CFDBShortCodeSavePostData.php');
require_once('CFDBShortCodeSaveFormMakerSubmission.php');
require_once('CFDBDeobfuscate.php');

/**
 * Implementation for CF7DBPluginLifeCycle.
 */

class CF7DBPlugin extends CF7DBPluginLifeCycle {

    public function getPluginDisplayName() {
        return 'Contact Form to DB Extension';
    }

    protected function getMainPluginFileName() {
        return 'contact-form-7-db.php';
    }

    public function getOptionMetaData() {
        return array(
            //'_version' => array('Installed Version'), // For testing upgrades
            //'Donated' => array(__('I have donated to this plugin', 'contact-form-7-to-database-extension'), 'false', 'true'),
            'IntegrateWithCF7' => array(__('Capture form submissions from Contact Form 7 Plugin', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'IntegrateWithFSCF' => array(__('Capture form submissions from Fast Secure Contact Form Plugin', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'IntegrateWithJetPackContactForm' => array(__('Capture form submissions from JetPack Contact Form', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'IntegrateWithGravityForms' => array(__('Capture form submissions from Gravity Forms', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'CanSeeSubmitData' => array(__('Can See Submission data', 'contact-form-7-to-database-extension'),
                                        'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone'),
            'CanSeeSubmitDataViaShortcode' => array(__('Can See Submission when using shortcodes', 'contact-form-7-to-database-extension'),
                                                    'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone'),
            'CanChangeSubmitData' => array(__('Can Edit/Delete Submission data', 'contact-form-7-to-database-extension'),
                                           'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone'),
            'FunctionsInShortCodes' => array(__('Allow Any Function in Short Codes', 'contact-form-7-to-database-extension') .
                    ' <a target="_blank" href="http://cfdbplugin.com/?page_id=1073">' . __('(Creates a security hole)', 'contact-form-7-to-database-extension') . '</a>', 'false', 'true'),
            'AllowRSS' => array(__('Allow RSS URLs', 'contact-form-7-to-database-extension') .
                    ' <a target="_blank" href="http://cfdbplugin.com/?p=918">' . __('(Creates a security hole)', 'contact-form-7-to-database-extension') . '</a>', 'false', 'true'),
            'Timezone' => array(__('Timezone to capture Submit Time. Blank will use WordPress Timezone setting. <a target="_blank" href="http://www.php.net/manual/en/timezones.php">Options</a>', 'contact-form-7-to-database-extension')),
            'MaxRows' => array(__('Maximum number of rows to retrieve from the DB for the Admin display', 'contact-form-7-to-database-extension')),
            'MaxVisibleRows' => array(__('#Rows (of maximum above) visible in the Admin datatable', 'contact-form-7-to-database-extension')),
            'UseDataTablesJS' => array(__('Use Javascript-enabled tables in Admin Database page', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'ShowLineBreaksInDataTable' => array(__('Show line breaks in submitted data table', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'UseCustomDateTimeFormat' => array(__('Use Custom Date-Time Display Format (below)', 'contact-form-7-to-database-extension'), 'true', 'false'),
            'SubmitDateTimeFormat' => array('<a target="_blank" href="http://php.net/manual/en/function.date.php">' . __('Date-Time Display Format', 'contact-form-7-to-database-extension') . '</a>'),
            'ShowFileUrlsInExport' => array(__('Export URLs instead of file names for uploaded files', 'contact-form-7-to-database-extension'), 'false', 'true'),
            'NoSaveFields' => array(__('Do not save <u>fields</u> in DB named (comma-separated list, no spaces)', 'contact-form-7-to-database-extension')),
            'NoSaveForms' => array(__('Do not save <u>forms</u> in DB named (comma-separated list, no spaces)', 'contact-form-7-to-database-extension')),
            'SaveCookieData' => array(__('Save Cookie Data with Form Submissions', 'contact-form-7-to-database-extension'), 'false', 'true'),
            'SaveCookieNames' => array(__('Save only cookies in DB named (comma-separated list, no spaces, and above option must be set to true)', 'contact-form-7-to-database-extension')),
            'ShowQuery' => array(__('Show the query used to display results', 'contact-form-7-to-database-extension'), 'false', 'true'),
            'DropOnUninstall' => array(__('Drop this plugin\'s Database table on uninstall', 'contact-form-7-to-database-extension'), 'false', 'true'),
            //'SubmitTableNameOverride' => array(__('Use this table to store submission data rather than the default (leave blank for default)', 'contact-form-7-to-database-extension'))
        );
    }

    protected function getOptionValueI18nString($optionValue) {
        switch ($optionValue) {
            case 'true':
                return __('true', 'contact-form-7-to-database-extension');
            case 'false':
                return __('false', 'contact-form-7-to-database-extension');

            case 'Administrator':
                return __('Administrator', 'contact-form-7-to-database-extension');
            case 'Editor':
                return __('Editor', 'contact-form-7-to-database-extension');
            case 'Author':
                return __('Author', 'contact-form-7-to-database-extension');
            case 'Contributor':
                return __('Contributor', 'contact-form-7-to-database-extension');
            case 'Subscriber':
                return __('Subscriber', 'contact-form-7-to-database-extension');
            case 'Anyone':
                return __('Anyone', 'contact-form-7-to-database-extension');
        }
        return $optionValue;
    }

    public function upgrade() {
        global $wpdb;
        $upgradeOk = true;
        $savedVersion = $this->getVersionSaved();
        if (!$savedVersion) {
            // Was some code here from pre-version 1.2 that I removed b/c it is very old and not relevant.

            // A user reported an issue where the saved version in the DB would get cleared out
            // after using the plugin for a week or so. Weird and not reproducible. But the problem is that
            // it would make it re-run through the upgrades below even though they need not be applied.
            // the ALTER TABLE statements would fail and product errors on the page.
            // Without solving the underlying problem, I'm going to have upgrade actions be skipped
            // in the case where no version is recorded in the DB.
        } else {

            if ($this->isVersionLessThan($savedVersion, '2.4.1')) {
                if ($this->isVersionLessThan($savedVersion, '2.2')) {
                    if ($this->isVersionLessThan($savedVersion, '2.0')) {
                        if ($this->isVersionLessThan($savedVersion, '1.8')) {
                            if ($this->isVersionLessThan($savedVersion, '1.4.5')) {
                                if ($this->isVersionLessThan($savedVersion, '1.3.1')) {
                                    // Version 1.3.1 update
                                    $tableName = $this->getSubmitsTableName();
                                    $wpdb->show_errors();
                                    $upgradeOk &= false !== $wpdb->query("ALTER TABLE `$tableName` ADD COLUMN `field_order` INTEGER");
                                    $upgradeOk &= false !== $wpdb->query("ALTER TABLE `$tableName` ADD COLUMN `file` LONGBLOB");
                                    $upgradeOk &= false !== $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `submit_time_idx` ( `submit_time` )");
                                    $wpdb->hide_errors();
                                }

                                // Version 1.4.5 update
                                if (!$this->getOption('CanSeeSubmitDataViaShortcode')) {
                                    $this->addOption('CanSeeSubmitDataViaShortcode', 'Anyone');
                                }

                                // Misc
                                $submitDateTimeFormat = $this->getOption('SubmitDateTimeFormat');
                                if (!$submitDateTimeFormat || $submitDateTimeFormat == '') {
                                    $this->addOption('SubmitDateTimeFormat', 'Y-m-d H:i:s P');
                                }

                            }
                            // Version 1.8 update
                            if (!$this->getOption('MaxRows')) {
                                $this->addOption('MaxRows', '100');
                            }
                            $tableName = $this->getSubmitsTableName();
                            $wpdb->show_errors();
                            /* $upgradeOk &= false !== */
                            $wpdb->query("ALTER TABLE `$tableName` MODIFY COLUMN submit_time DECIMAL(16,4) NOT NULL");
                            /* $upgradeOk &= false !== */
                            $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `form_name_idx` ( `form_name` )");
                            /* $upgradeOk &= false !== */
                            $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `form_name_field_name_idx` ( `form_name`, `field_name` )");
                            $wpdb->hide_errors();
                        }

                        // Version 2.0 upgrade
                        $tableName = $this->getSubmitsTableName();
                        $oldTableName = $this->prefixTableName('SUBMITS');
                        @$wpdb->query("RENAME TABLE `$oldTableName` TO `$tableName`");
                    }

                    // Version 2.2 upgrade
                    $tableName = $this->getSubmitsTableName();
                    $wpdb->query("ALTER TABLE `$tableName` DROP INDEX `form_name_field_name_idx`");
                    $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `field_name_idx` ( `field_name` )");
                }

                // Version 2.4.1 upgrade
                $tableName = $this->getSubmitsTableName();
                $oldTableName = strtolower($tableName);
                $wpdb->query("RENAME TABLE '$oldTableName' TO '$tableName'");
            }

        }

        // Post-upgrade, set the current version in the options
        $codeVersion = $this->getVersion();
        if ($upgradeOk && $codeVersion && $savedVersion != $codeVersion) {
            $this->saveInstalledVersion($codeVersion);
        }
    }

    /**
     * Called by install()
     * You should: Prefix all table names with $wpdb->prefix
     * Also good: additionally use the prefix for this plugin:
     * $table_name = $wpdb->prefix . $this->prefix('MY_TABLE');
     * @return void
     */
    protected function installDatabaseTables() {
        global $wpdb;
        $tableName = $this->getSubmitsTableName();
        $wpdb->show_errors();
        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
            `submit_time` DECIMAL(16,4) NOT NULL,
            `form_name` VARCHAR(127) CHARACTER SET utf8,
            `field_name` VARCHAR(127) CHARACTER SET utf8,
            `field_value` LONGTEXT CHARACTER SET utf8,
            `field_order` INTEGER,
            `file` LONGBLOB)");
        $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `submit_time_idx` ( `submit_time` )");
        $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `form_name_idx` ( `form_name` )");
        $wpdb->query("ALTER TABLE `$tableName` ADD INDEX `field_name_idx` ( `field_name` )");
        $wpdb->hide_errors();
    }


    /**
     * Called by uninstall()
     * You should: Prefix all table names with $wpdb->prefix
     * Also good: additionally use the prefix for this plugin:
     * $table_name = $wpdb->prefix . $this->prefix('MY_TABLE');
     * @return void
     */
    protected function unInstallDatabaseTables() {
        if ('true' == $this->getOption('DropOnUninstall', 'false')) {
            global $wpdb;
            $tableName = $this->getSubmitsTableName();
            $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
            //        $tables = array('SUBMITS');
            //        foreach ($tables as $aTable) {
            //            $tableName = $this->prefixTableName($aTable);
            //            $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
            //        }
        }
    }

    protected function initOptions() {
        // By default ignore CF7 metadata fields
        $this->addOption('NoSaveFields', '/.*wpcf7.*/,_wpnonce');
    }

    public function add_wpcf7_noSaveFields() {
        $nsfArray = explode(',', $this->getOption('NoSaveFields',''));
        $wpcf7Fields = array('/.*wpcf7.*/', '_wpnonce');
        foreach ($wpcf7Fields as $aWpcf7) {
           if (!in_array($aWpcf7, $nsfArray)) {
               $nsfArray[] = $aWpcf7;
           }
        }
        $this->updateOption('NoSaveFields', implode(',', $nsfArray));
    }

    public function delete_wpcf7_fields($formName) {
        global $wpdb;
        $wpdb->query($wpdb->prepare(
            'delete from `' . $this->getSubmitsTableName() .
                    "` where `form_name` = '%s' and `field_name` in ('_wpcf7', '_wpcf7_version', '_wpcf7_unit_tag', '_wpnonce', '_wpcf7_is_ajax_call', '_wpcf7_captcha_challenge_captcha')",
            $formName));
    }

    public function addActionsAndFilters() {
        // Admin notices
        add_action('admin_notices', array(&$this, 'addAdminNotices'));

        // Add the Admin Config page for this plugin

        // Add Config page as a top-level menu item on the Admin page
        add_action('admin_menu', array(&$this, 'createAdminMenu'));

        // Add Database Options page
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));

        // Hook into Contact Form 7 when a form post is made to save the data to the DB
        if ($this->getOption('IntegrateWithCF7', 'true') == 'true') {
            add_action('wpcf7_before_send_mail', array(&$this, 'saveCF7FormData'));
            //add_action('wpcf7_posted_data', array(&$this, 'saveCF7FormData'));
        }

        // Hook into Fast Secure Contact Form
        if ($this->getOption('IntegrateWithFSCF', 'true') == 'true') {
            add_action('fsctf_mail_sent', array(&$this, 'saveFormData'));
            add_action('fsctf_menu_links', array(&$this, 'fscfMenuLinks'));
        }

        // Hook into JetPack Contact Form
        if ($this->getOption('IntegrateWithJetPackContactForm', 'true') == 'true') {
            add_action('grunion_pre_message_sent', array(&$this, 'saveJetPackContactFormData'), 10, 3);
        }

        // Hook into Gravity Forms
        if ($this->getOption('IntegrateWithGravityForms', 'true') == 'true') {
            add_action('gform_after_submission', array(&$this, 'saveGravityFormData'), 10, 2);
        }

        // Have our own hook to receive form submissions independent of other plugins
        add_action('cfdb_submit', array(&$this, 'saveFormData'));

        // Register Export URL
        add_action('wp_ajax_nopriv_cfdb-export', array(&$this, 'ajaxExport'));
        add_action('wp_ajax_cfdb-export', array(&$this, 'ajaxExport'));

        // Register Get File URL
        add_action('wp_ajax_nopriv_cfdb-file', array(&$this, 'ajaxFile'));
        add_action('wp_ajax_cfdb-file', array(&$this, 'ajaxFile'));

        // Register Get Form Fields URL
        add_action('wp_ajax_nopriv_cfdb-getFormFields', array(&$this, 'ajaxGetFormFields'));
        add_action('wp_ajax_cfdb-getFormFields', array(&$this, 'ajaxGetFormFields'));

        // Register Validate submit_time value (used in short code builder page)
        add_action('wp_ajax_nopriv_cfdb-validate-submit_time', array(&$this, 'ajaxValidateSubmitTime'));
        add_action('wp_ajax_cfdb-validate-submit_time', array(&$this, 'ajaxValidateSubmitTime'));

        // Login via Ajax instead of login form
        add_action('wp_ajax_nopriv_cfdb-login', array(&$this, 'ajaxLogin'));
        add_action('wp_ajax_cfdb-login', array(&$this, 'ajaxLogin'));

        // Shortcode to add a table to a page
        $sc = new CFDBShortcodeTable();
        $sc->register(array('cf7db-table', 'cfdb-table')); // cf7db-table is deprecated

        // Shortcode to add a DataTable
        $sc = new CFDBShortcodeDataTable();
        $sc->register('cfdb-datatable');

        // Shortcode to add a JSON to a page
        $sc = new CFDBShortcodeJson();
        $sc->register('cfdb-json');

        // Shortcode to add a value (just text) to a page
        $sc = new CFDBShortcodeValue();
        $sc->register('cfdb-value');

        // Shortcode to add entry count to a page
        $sc = new CFDBShortcodeCount();
        $sc->register('cfdb-count');

        // Shortcode to add values wrapped in user-defined html
        $sc = new CFDBShortcodeHtml();
        $sc->register('cfdb-html');

        // Shortcode to generate Export URLs
        $sc = new CFDBShortcodeExportUrl();
        $sc->register('cfdb-export-link');

        // Shortcode to save data from non-CF7/FSCF forms
        $sc = new CFDBShortCodeSavePostData();
        $sc->register('cfdb-save-form-post');

        // Shortcode to save data Form Maker submissions
        $sc = new CFDBShortCodeSaveFormMakerSubmission();
        $sc->register('cfdb-save-form-maker-post');
    }

    public function ajaxLogin() {
        // Login the user
        $key = '3M#v$-.u';
        $creds = array();
        $user = null;
        $password = null;

        if (!empty($_REQUEST['l'])) {
            $userPass = CFDBDeobfuscate::deobfuscateHexString($_REQUEST['l'], $key);
            $userPass = explode('/', $userPass, 2);
            $count = count($userPass);
            if ($count >= 1) {
                $user = $userPass[0];
                if ($count > 1) {
                    $password = $userPass[1];
                }
            }
        }
        if (!$user) {
            $user = !empty($_REQUEST['username']) ? $_REQUEST['username'] : null;
        }
        if (!$password) {
            $password = !empty($_REQUEST['password']) ? $_REQUEST['password'] : null;
        }

        $creds['user_login'] = $user;
        $creds['user_password'] = $password;
        $creds['remember'] = !empty($_REQUEST['rememberme']) ? $_REQUEST['rememberme'] : null;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            echo $user->get_error_message();
            die;
        }
        wp_set_current_user($user->ID);

        // User is logged in. Now do the requested action
        if (!empty($_REQUEST['cfdb-action'])) {
            switch ($_REQUEST['cfdb-action']) {
                case 'cfdb-export':
                    if (!$this->canUserDoRoleOption('CanSeeSubmitData')) {
                        echo '<strong>ERROR</strong>: user ' . $_REQUEST['username'] . ' is not authorized to export CFDB data';
                        die;
                    }
                    $this->ajaxExport();
                    break;

                default:
                    break;
            }
        }
        die;
    }

    public function ajaxExport() {
        require_once('CF7DBPluginExporter.php');
        CF7DBPluginExporter::doExportFromPost();
        die();
    }

    public function ajaxFile() {
        require_once('CFDBDie.php');
        if (!$this->canUserDoRoleOption('CanSeeSubmitData') &&
            !$this->canUserDoRoleOption('CanSeeSubmitDataViaShortcode')) {
            CFDBDie::wp_die(__('You do not have sufficient permissions to access this page.', 'contact-form-7-to-database-extension'));
        }
        $submitTime = $_REQUEST['s'];
        $formName = $_REQUEST['form'];
        $fieldName = $_REQUEST['field'];
        if (!$submitTime || !$formName || !$fieldName) {
            CFDBDie::wp_die(__('Missing form parameters', 'contact-form-7-to-database-extension'));
        }
        $fileInfo = (array)$this->getFileFromDB($submitTime, $formName, $fieldName);
        if ($fileInfo == null) {
            CFDBDie::wp_die(__('No such file.', 'contact-form-7-to-database-extension'));
        }

        require_once('CFDBMimeTypeExtensions.php');
        $mimeMap = new CFDBMimeTypeExtensions();
        $mimeType = $mimeMap->get_type_by_filename($fileInfo[0]);
        if ($mimeType) {
            header('Content-Type: ' . $mimeType);
            header("Content-Disposition: inline; filename=\"$fileInfo[0]\"");
        }
        else {
            header("Content-Disposition: attachment; filename=\"$fileInfo[0]\"");
        }

        echo($fileInfo[1]);
        die();
    }

    public function ajaxGetFormFields() {
        if (!$this->canUserDoRoleOption('CanSeeSubmitData') || !isset($_REQUEST['form'])) {
            die();
        }
        header('Content-Type: application/json; charset=UTF-8');
        header("Pragma: no-cache");
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
        global $wpdb;
        $tableName = $this->getSubmitsTableName();
        $formName = $_REQUEST['form'];
        $rows = $wpdb->get_results("SELECT DISTINCT `field_name` FROM `$tableName` WHERE `form_name` = '$formName' ORDER BY field_order");
        $fields = array();
        if (!empty($rows)) {
            $fields[] = 'Submitted';
            foreach ($rows as $aRow) {
                $fields[] = $aRow->field_name;
            }
            $fields[] = 'submit_time';
        }
        echo json_encode($fields);
        die();
    }

    public function ajaxValidateSubmitTime() {
        header('Content-Type: text/plain; charset=UTF-8');
        header("Pragma: no-cache");
        header("Expires: Thu, 01 Jan 1970 00:00:00 GMT");
        $submitTime = $_REQUEST['submit_time'];

        $invalid = false;
        $time = $submitTime;
        if (!is_numeric($submitTime)) {
            if (version_compare(phpversion(), '5.1.0') == -1) {
                $invalid = -1;
            }
            $this->setTimezone();
            $time = strtotime($submitTime);
        }
        if ($invalid === $time) {
            _e('Invalid: ', 'contact-form-7-to-database-extension');
        }
        else {
            _e('Valid: ', 'contact-form-7-to-database-extension');
        }

        echo "'$submitTime' = $time";

        if ($invalid !== $time) {
            echo " = " . $this->formatDate($time);
        }
        die();
    }

    public function addSettingsSubMenuPage() {
//        $this->requireExtraPluginFiles();
//        $displayName = $this->getPluginDisplayName();
//        add_submenu_page('wpcf7', //$this->getDBPageSlug(),
//                         $displayName . ' Options',
//                         __('Database Options', 'contact-form-7-to-database-extension'),
//                         'manage_options',
//                         get_class($this) . 'Settings',
//                         array(&$this, 'settingsPage'));
    }


    /**
     * Function courtesy of Mike Challis, author of Fast Secure Contact Form.
     * Displays Admin Panel links in FSCF plugin menu
     * @return void
     */
    public function fscfMenuLinks() {
        $displayName = $this->getPluginDisplayName();
        echo '
        <p>
      ' . $displayName .
                ' | <a href="admin.php?page=' . $this->getDBPageSlug() . '">' .
                __('Database', 'contact-form-7-to-database-extension') .
                '</a>  | <a href="admin.php?page=CF7DBPluginSettings">' .
                __('Database Options', 'contact-form-7-to-database-extension') .
                '</a>  | <a href="admin.php?page=' . $this->getShortCodeBuilderPageSlug() . '">' .
                __('Build Short Code', 'contact-form-7-to-database-extension') .
                '</a> | <a href="http://cfdbplugin.com/">' .
                __('Reference', 'contact-form-7-to-database-extension') . '</a>
       </p>
      ';
    }

    /**
     * Callback from Contact Form 7. CF7 passes an object with the posted data which is inserted into the database
     * by this function.
     * @param $cf7 WPCF7_ContactForm
     * @return bool
     */
    public function saveCF7FormData($cf7) {
        if (!isset($cf7->posted_data) && class_exists('WPCF7_Submission')) {
            // Contact Form 7 version 3.9 removed $cf7->posted_data and now
            // we have to retrieve it from an API
            $submission = WPCF7_Submission::get_instance();
            if ($submission) {
                $data = array();
                $data['title'] = $cf7->title();
                $data['posted_data'] = $submission->get_posted_data();
                $data['uploaded_files'] = $submission->uploaded_files();
                $this->saveFormData((object) $data);
            }
        } else {
            $this->saveFormData($cf7);
        }
        return true;
    }

    /**
     * Callback for saving form data. Originally based on Contact Form 7's callback object
     * with submission data in $cf7->posted_data. However that has changed over time.
     * FSCF sends an object matching this data structure. Other form plugins have their data
     * transformed into the expected data structure via other callbacks in this class
     * @param $cf7 WPCF7_ContactForm|object the former when coming from CF7, the latter $fsctf_posted_data object variable
     * @return bool
     */
    public function saveFormData($cf7) {
        try {
            $time = function_exists('microtime') ? microtime(true) : time();
            $time = number_format($time, 4, '.', ''); // Bug fix: on some systems microtime is in scientific notation when converted to string
            $ip = (isset($_SERVER['X_FORWARDED_FOR'])) ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

            // Set up to allow all this data to be filtered
            $cf7->submit_time = $time;
            $cf7->ip = $ip;
            $user = null;
            if (function_exists('is_user_logged_in') && is_user_logged_in()) {
                $current_user = wp_get_current_user(); // WP_User
                $user = $current_user->user_login;
            }
            $cf7->user = $user;
            try {
                $newCf7 = apply_filters('cfdb_form_data', $cf7);
                if ($newCf7 && is_object($newCf7)) {
                    $cf7 = $newCf7;
                    $time = $cf7->submit_time;
                    $ip = $cf7->ip;
                    $user = $cf7->user;
                }
                else {
                    //error_log('CFDB Error: No or invalid value returned from "cfdb_form_data" filter: ' .
                    //        print_r($newCf7, true));
                    // Returning null from cfdb_form_data is a way to stop from saving the form
                    return true;
                }
            }
            catch (Exception $ex) {
                error_log(sprintf('CFDB Error: %s:%s %s  %s', $ex->getFile(), $ex->getLine(), $ex->getMessage(), $ex->getTraceAsString()));
            }

            // Get title after applying filter
            if (isset($cf7->title)) {
                $title = $cf7->title;
            } else {
                $title = 'Unknown';
            }
            $title = stripslashes($title);

            if ($this->fieldMatches($title, $this->getNoSaveForms())) {
                return true; // Don't save in DB
            }

            $tableName = $this->getSubmitsTableName();
            $parametrizedQuery = "INSERT INTO `$tableName` (`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`) VALUES (%s, %s, %s, %s, %s)";
            $parametrizedFileQuery = "INSERT INTO `$tableName` (`submit_time`, `form_name`, `field_name`, `field_value`, `field_order`, `file`) VALUES (%s, %s, %s, %s, %s, %s)";
            $order = 0;
            $noSaveFields = $this->getNoSaveFields();
            $foundUploadFiles = array();
            global $wpdb;

//            $hasDropBox = $this->getOption('dropbox');
//            if ($hasDropBox) {
//                require_once('CFDBShortCodeSavePostData.php');
//            }
            foreach ($cf7->posted_data as $name => $value) {
                $nameClean = stripslashes($name);
                if ($this->fieldMatches($nameClean, $noSaveFields)) {
                    continue; // Don't save in DB
                }

                $value = is_array($value) ? implode($value, ', ') : $value;
                $valueClean = stripslashes($value);

                // Check if this is a file upload field
                $didSaveFile = false;
                if ($cf7->uploaded_files && isset($cf7->uploaded_files[$nameClean])) {
                    $foundUploadFiles[] = $nameClean;
                    $filePath = $cf7->uploaded_files[$nameClean];
                    if ($filePath) {
                        $content = file_get_contents($filePath);
                        $didSaveFile = $wpdb->query($wpdb->prepare($parametrizedFileQuery,
                            $time,
                            $title,
                            $nameClean,
                            $valueClean,
                            $order++,
                            $content));
                        if (!$didSaveFile) {
                            error_log("CFDB Error: could not save uploaded file, field=$nameClean, file=$filePath");
                        }
                    }
                }
                if (!$didSaveFile) {
                    $wpdb->query($wpdb->prepare($parametrizedQuery,
                        $time,
                        $title,
                        $nameClean,
                        $valueClean,
                        $order++));
                }
            }

            // Since Contact Form 7 version 3.1, it no longer puts the names of the files in $cf7->posted_data
            // So check for them only only in $cf7->uploaded_files
            // Update: This seems to have been reversed back to the original in Contact Form 7 3.2 or 3.3
            if ($cf7->uploaded_files && is_array($cf7->uploaded_files)) {
                foreach ($cf7->uploaded_files as $field => $filePath) {
                    if (!in_array($field, $foundUploadFiles) &&
                            $filePath &&
                            !$this->fieldMatches($field, $noSaveFields)) {
                        $fileName = basename($filePath);
                        $content = file_get_contents($filePath);
                        $didSaveFile = $wpdb->query($wpdb->prepare($parametrizedFileQuery,
                            $time,
                            $title,
                            $field,
                            $fileName,
                            $order++,
                            $content));
                        if (!$didSaveFile) {
                            error_log("CFDB Error: could not save uploaded file, field=$field, file=$filePath");
                        }
                    }
                }
            }

            // Save Cookie data if that option is true
            if ($this->getOption('SaveCookieData', 'false') == 'true' && is_array($_COOKIE)) {
                $saveCookies = $this->getSaveCookies();
                foreach ($_COOKIE as $cookieName => $cookieValue) {
                    if (empty($saveCookies) || $this->fieldMatches($cookieName, $saveCookies)) {
                        $wpdb->query($wpdb->prepare($parametrizedQuery,
                            $time,
                            $title,
                            'Cookie ' . $cookieName,
                            $cookieValue,
                            $order++));
                    }
                }
            }

            // If the submitter is logged in, capture his id
            if ($user) {
                $order = ($order < 9999) ? 9999 : $order + 1; // large order num to try to make it always next-to-last
                $wpdb->query($wpdb->prepare($parametrizedQuery,
                                            $time,
                                            $title,
                                            'Submitted Login',
                                            $user,
                                            $order));
            }

            // Capture the IP Address of the submitter
            $order = ($order < 10000) ? 10000 : $order + 1; // large order num to try to make it always last
            $wpdb->query($wpdb->prepare($parametrizedQuery,
                                        $time,
                                        $title,
                                        'Submitted From',
                                        $ip,
                                        $order));

        }
        catch (Exception $ex) {
            error_log(sprintf('CFDB Error: %s:%s %s  %s', $ex->getFile(), $ex->getLine(), $ex->getMessage(), $ex->getTraceAsString()));
        }

        // Indicate success to WordPress so it continues processing other unrelated hooks.
        return true;
    }

    /**
     * @param $fieldName string
     * @param $patternsArray array
     * @return boolean true if $fieldName is in $patternsArray or matches any element of it that is a regex
     */
    public function fieldMatches($fieldName, $patternsArray) {
        if (is_array($patternsArray)) {
            foreach($patternsArray as $pattern) {
                if ($fieldName == $pattern) {
                    return true;
                }
                if (strncmp($pattern, '/', 1)  == 0) {
                    if (@preg_match($pattern , $fieldName)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param $post_id int
     * @param $all_values array
     * @param $extra_values array
     * @return bool
     */
    public function saveJetPackContactFormData($post_id, $all_values, $extra_values) {

//        error_log('POST=' . print_r($_POST, true));
//        error_log('$all_values=' . print_r($all_values, true));
//        error_log('$extra_values=' . print_r($extra_values, true));

        $title = 'JetPack Contact Form';
        if (isset($_POST['contact-form-id'])) {
            $title .= ' ' . $_POST['contact-form-id'];
            //$all_values['contact-form-id'] = $_POST['contact-form-id'];
        }
        else {
            $title .= ' ' . $post_id;
        }

        $all_values['post_id'] = $post_id;
        $data = (object)  array(
            'title' => $title,
            'posted_data' => $all_values,
            'uploaded_files' => null);
        return $this->saveFormData($data);
    }

    /**
     * http://www.gravityhelp.com/documentation/page/Gform_after_submission
     * @param $entry Entry Object The entry that was just created.
     * http://www.gravityhelp.com/documentation/page/Entry_Object
     * @param $form Form Object The current form
     * http://www.gravityhelp.com/documentation/page/Form_Object
     * @return bool
     */
    public function saveGravityFormData($entry, $form) {

        //error_log('Form Definition: ' . print_r($form, true)); // debug
        //error_log('Entry Definition: ' . print_r($entry, true)); // debug

        $postedData = array();
        $uploadFiles = array();

        // Iterate through the field definitions and get their values
        if (! is_array($form['fields'])) {
            return true;
        }
        foreach ($form['fields'] as $field) {
            if (! is_array($field)) {
                continue;
            }
            $fieldName = $field['label'];

            if (!empty($field['inputs']) && is_array($field['inputs'])) {
                // This is a multi-input field

                if ($field['type'] == 'checkbox') {
                    $values = array();
                    foreach ($field['inputs'] as $input) {
                        $inputId = strval($input['id']); // Need string value of number like '1.3'
                        if (! empty($entry[$inputId])) {
                            $values[] = $entry[$inputId];
                        }
                    }
                    $postedData[$fieldName] = implode(',', $values);
                }
                else {
                    foreach ($field['inputs'] as $input) {
                        $inputId = strval($input['id']); // Need string value of number like '1.3'
                        $label = $input['label']; // Assumption: all inputs have diff labels
                        $effectiveFieldName = $fieldName;
                        if (!empty($label)) {
                            $effectiveFieldName = $fieldName . ' ' . $label;
                        }
                        $postedData[$effectiveFieldName] = $entry[$inputId];
                    }
                }
            }
            else {
                $fieldId = $field['id'];
                switch ($field['type']) {
                    case 'list' :
                        // List - value is serialized array
                        $valueArray = @unserialize($entry[$fieldId]);
                        if (is_array($valueArray)) {
                            $postedData[$fieldName] = implode(',',$valueArray);
                        }
                        else {
                            $postedData[$fieldName] = $entry[$fieldId];
                        }
                        break;

                    case 'fileupload':
                        // File Upload - value is file URL
                        // http://<SITE>/wp-content/uploads/gravity_forms/<PATH>/<FILE>
                        $url = $entry[$fieldId];
                        $fileName = basename($url);
                        $postedData[$fieldName] = $fileName;

                        $filePath = ABSPATH . substr($url, strlen(get_site_url()));
                        $uploadFiles[$fieldName] = $filePath;
                        break;

                    default:
                        $postedData[$fieldName] = $entry[$fieldId];
                        break;
                }

            }
        }

        // Other form metadata
        $paymentMetaData = array(
            //'currency',
            'payment_status', 'payment_date',
            'transaction_id', 'payment_amount', 'payment_method',
            'is_fulfilled', 'transaction_type');
        foreach ($paymentMetaData as $pmt) {
            $hasPaymentInfo = false;
            if (! empty($entry[$pmt])) {
                $postedData[$pmt] = $entry[$pmt];
                $hasPaymentInfo = true;
            }
            if ($hasPaymentInfo && ! empty($entry['currency'])) {
                // It seems currency is always set but only meaningful
                // if the other payment info is set.
                $postedData['currency'] = $entry['currency'];
            }
        }


        $data = (object)  array(
            'title' => $form['title'],
            'posted_data' => $postedData,
            'uploaded_files' => $uploadFiles);
        return $this->saveFormData($data);
    }

    /**
     * @param  $time string form submit time
     * @param  $formName string form name
     * @param  $fieldName string field name (should be an upload file field)
     * @return array of (file-name, file-contents) or null if not found
     */
    public function getFileFromDB($time, $formName, $fieldName) {
        global $wpdb;
        $tableName = $this->getSubmitsTableName();
        $parametrizedQuery = "SELECT `field_value`, `file` FROM `$tableName` WHERE `submit_time` = %F AND `form_name` = %s AND `field_name` = '%s'";
        $rows = $wpdb->get_results($wpdb->prepare($parametrizedQuery, $time, $formName, $fieldName));
        if ($rows == null || count($rows) == 0) {
            return null;
        }

        return array($rows[0]->field_value, $rows[0]->file);
    }

    /**
     * Install page for this plugin in WP Admin
     * @return void
     */
    public function createAdminMenu() {
        $displayName = $this->getPluginDisplayName();
        $roleAllowed = $this->getRoleOption('CanSeeSubmitData');
        if (!$roleAllowed) {
            $roleAllowed = 'administrator';
        }
        $menuSlug = $this->getDBPageSlug();

        //create new top-level menu
        add_menu_page($displayName,
                        __('Contact Form DB', 'contact-form-7-to-database-extension'),
                      $this->roleToCapability($roleAllowed),
                      $menuSlug, //$this->getDBPageSlug(),
                      array(&$this, 'whatsInTheDBPage'));

        // Needed for dialog in whatsInTheDBPage
        if (strpos($_SERVER['REQUEST_URI'], $this->getDBPageSlug()) !== false) {
            $pluginUrl = $this->getPluginFileUrl() . '/';
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-dialog');
            wp_enqueue_script('CF7DBdes', $pluginUrl . 'des.js');

            wp_enqueue_style('jquery-ui.css', $pluginUrl . 'jquery-ui/jquery-ui-1.8.21.custom.css');

            // Datatables http://www.datatables.net
            if ($this->getOption('UseDataTablesJS', 'true') == 'true') {
//                wp_enqueue_style('datatables-demo', 'http://www.datatables.net/release-datatables/media/css/demo_table.css');
//                wp_enqueue_script('datatables', 'http://www.datatables.net/release-datatables/media/js/jquery.dataTables.js', array('jquery'));
                wp_enqueue_style('datatables-demo', $pluginUrl .'DataTables/media/css/demo_table.css');
                wp_enqueue_script('datatables', $pluginUrl . 'DataTables/media/js/jquery.dataTables.min.js', array('jquery'));

                if ($this->canUserDoRoleOption('CanChangeSubmitData')) {
                    do_action_ref_array('cfdb_edit_enqueue', array());
                }

                // Would like to add ColReorder but it causes slowness and display issues with DataTable footer
                //wp_enqueue_style('datatables-ColReorder', $pluginUrl .'DataTables/extras/ColReorder/media/css/ColReorder.css');
                //wp_enqueue_script('datatables-ColReorder', $pluginUrl . 'DataTables/extras/ColReorder/media/js/ColReorder.min.js', array('datatables', 'jquery'));
            }
        }

        if (strpos($_SERVER['REQUEST_URI'], $this->getShortCodeBuilderPageSlug()) !== false) {
            wp_enqueue_script('jquery');
            $pluginUrl = $this->getPluginFileUrl() . '/';
            wp_enqueue_script('CF7DBdes', $pluginUrl . 'des.js');
        }

//        // Put page under CF7's "Contact" page
//        add_submenu_page('wpcf7',
//                         $displayName . ' Submissions',
//                         __('Database', 'contact-form-7-to-database-extension'),
//                         $this->roleToCapability($roleAllowed),
//                         $this->getDBPageSlug(),
//                         array(&$this, 'whatsInTheDBPage'));

        add_submenu_page($menuSlug,
                         $displayName . ' Short Code Builder',
                         __('Short Code', 'contact-form-7-to-database-extension'),
                         $this->roleToCapability($roleAllowed),
                         $this->getShortCodeBuilderPageSlug(),
                         array(&$this, 'showShortCodeBuilderPage'));

        if ($this->isEditorActive()) {
            add_submenu_page($menuSlug,
                    $displayName . ' Import',
                __('Import', 'contact-form-7-to-database-extension'),
                $this->roleToCapability($this->getRoleOption('CanChangeSubmitData')),
                    get_class($this) . 'Import',
                array(&$this, 'showShortImportCsvPage'));
        }

        add_submenu_page($menuSlug,
                         $displayName . ' Options',
                         __('Options', 'contact-form-7-to-database-extension'),
                         'manage_options',
                         get_class($this) . 'Settings',
                         array(&$this, 'settingsPage'));


//        // Put page under CF7's "Contact" page
//        add_submenu_page('wpcf7',
//                         $displayName . ' Short Code Builder',
//                         __('Database Short Code', 'contact-form-7-to-database-extension'),
//                         $this->roleToCapability($roleAllowed),
//                         $this->getSortCodeBuilderPageSlug(),
//                         array(&$this, 'showShortCodeBuilderPage'));
    }

    /**
     * @return string WP Admin slug for page to view DB data
     */
    public function getDBPageSlug() {
        return get_class($this) . 'Submissions';
    }

    public function getShortCodeBuilderPageSlug() {
        return get_class($this) . 'ShortCodeBuilder';
    }

    public function showShortCodeBuilderPage() {
        require_once('CFDBViewShortCodeBuilder.php');
        $view = new CFDBViewShortCodeBuilder;
        $view->display($this);
    }

    public function showShortImportCsvPage() {
        require_once('CFDBViewImportCsv.php');
        $view = new CFDBViewImportCsv;
        $view->display($this);
    }

    /**
     * Display the Admin page for this Plugin that show the form data saved in the database
     * @return void
     */
    public function whatsInTheDBPage() {
        if (isset($_REQUEST['form_name']) && isset($_REQUEST['submit_time'])) {
            require_once('ExportEntry.php');
            $exp = new ExportEntry();
            $exp->export($_REQUEST['form_name'], array('submit_time' => $_REQUEST['submit_time']));

        } else {
            require_once('CFDBViewWhatsInDB.php');
            $view = new CFDBViewWhatsInDB;
            $view->display($this);
        }
    }

    static $checkForCustomDateFormat = true;
    static $customDateFormat = null;
    static $dateFormat = null;
    static $timeFormat = null;

    /**
     * Format input date string
     * @param  $time int same as returned from PHP time()
     * @return string formatted date according to saved options
     */
    public function formatDate($time) {
        // This method gets executed in a loop. Cache some variable to avoid
        // repeated get_option calls to the database
        if (CF7DBPlugin::$checkForCustomDateFormat) {
            if ($this->getOption('UseCustomDateTimeFormat', 'true') == 'true') {
                CF7DBPlugin::$customDateFormat = $this->getOption('SubmitDateTimeFormat', 'Y-m-d H:i:s P');
            }
            else {
               CF7DBPlugin::$dateFormat = get_option('date_format');
               CF7DBPlugin::$timeFormat = get_option('time_format');
            }
            $this->setTimezone();
            CF7DBPlugin::$checkForCustomDateFormat = false;
        }

        // Support Shamsi(Jalali) dates by looking for a plugin that can produce the correct text for the date
        if (!function_exists('is_plugin_active') && @file_exists(ABSPATH . 'wp-admin/includes/plugin.php')) {
            include_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }
        if (function_exists('is_plugin_active')) {
            // See if wp-parsidate is active and if so, have it convert the date
            // using its 'parsidate' function
            if (is_plugin_active('wp-parsidate/wp-parsidate.php')) {
                if (function_exists('parsidate')) {
                    if (CF7DBPlugin::$customDateFormat) {
                        return parsidate(CF7DBPlugin::$customDateFormat, $time);
                    }
                    else {
                        return parsidate(CF7DBPlugin::$dateFormat . ' ' . CF7DBPlugin::$timeFormat, $time);
                    }
                }
            }
            // See if wp-jalali is active and if so, have it convert the date
            // using its 'jdate' function
            else if (is_plugin_active('wp-jalali/wp-jalali.php')) {
                $jDateFile = WP_PLUGIN_DIR . '/wp-jalali/inc/jalali-core.php';
                if(@file_exists($jDateFile)) {
                    include_once($jDateFile);
                    if (function_exists('jdate')) {
                        //return jdate('l, F j, Y');
                        if (CF7DBPlugin::$customDateFormat) {
                            return jdate(CF7DBPlugin::$customDateFormat, $time);
                        }
                        else {
                            return jdate(CF7DBPlugin::$dateFormat . ' ' . CF7DBPlugin::$timeFormat, $time);
                        }
                    }
                }
            }
        }

        if (CF7DBPlugin::$customDateFormat) {
            return date(CF7DBPlugin::$customDateFormat, $time);
        }
        else {
            return date_i18n(CF7DBPlugin::$dateFormat . ' ' . CF7DBPlugin::$timeFormat, $time);
        }
    }

    /**
     * @param  $submitTime string PK for form submission
     * @param  $formName string
     * @param  $fieldName string
     * @return string URL to download file
     */
    public function getFileUrl($submitTime, $formName, $fieldName) {
        return sprintf('%s?action=cfdb-file&s=%s&form=%s&field=%s',
                       admin_url('admin-ajax.php'),
                       $submitTime,
                       urlencode($formName),
                       urlencode($fieldName));
    }

    public function getFormFieldsAjaxUrlBase() {
        return admin_url('admin-ajax.php') . '?action=cfdb-getFormFields&form=';
    }

    public function getValidateSubmitTimeAjaxUrlBase() {
        return admin_url('admin-ajax.php') . '?action=cfdb-validate-submit_time&submit_time=';
    }

    /**
     * @return array of string
     */
    public function getNoSaveFields() {
        return preg_split('/,|;/', $this->getOption('NoSaveFields'), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @return array of string
     */
    public function getNoSaveForms() {
        return preg_split('/,|;/', $this->getOption('NoSaveForms'), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @return array of string
     */
    public function getSaveCookies() {
        return preg_split('/,|;/', $this->getOption('SaveCookieNames'), -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * @return string
     */
    public function getSubmitsTableName() {
        //        $overrideTable = $this->getOption('SubmitTableNameOverride');
        //        if ($overrideTable && "" != $overrideTable) {
        //            return $overrideTable;
        //        }
        //return strtolower($this->prefixTableName('SUBMITS'));
        global $wpdb;
        return $wpdb->prefix . strtolower($this->prefix('SUBMITS'));
    }

    /**
     * @return string URL to the Plugin directory. Includes ending "/"
     */
    public function getPluginDirUrl() {
        //return WP_PLUGIN_URL . '/' . str_replace(basename(__FILE__), '', plugin_basename(__FILE__));
        return $this->getPluginFileUrl('/');
    }


    /**
     * @param string $pathRelativeToThisPluginRoot points to a file with relative path from
     * this plugin's root dir. I.e. file "des.js" in the root of this plugin has
     * url = $this->getPluginFileUrl('des.js');
     * If it was in a sub-folder "js" then you would use
     *    $this->getPluginFileUrl('js/des.js');
     * @return string full url to input file
     */
    public function getPluginFileUrl($pathRelativeToThisPluginRoot = '') {
        return plugins_url($pathRelativeToThisPluginRoot, __FILE__);
    }


    /**
     * @return string URL of the language translation file for DataTables oLanguage.sUrl parameter
     * or null if it does not exist.
     */
    public function getDataTableTranslationUrl() {
        $url = null;
        $locale = get_locale();
        $i18nDir = dirname(__FILE__) . '/dt_i18n/';

        // See if there is a local file
        if (is_readable($i18nDir . $locale . '.json')) {
            $url = $this->getPluginFileUrl() . "/dt_i18n/$locale.json";
        }
        else {
            // Pull the language code from the $local string
            // which is expected to look like "en_US"
            // where the first 2 or 3 letters are for lang followed by '_'
            $lang = null;
            if (substr($locale, 2, 1) == '_') {
                // 2-letter language codes
                $lang = substr($locale, 0, 2);
            }
            else if (substr($locale, 3, 1) == '_') {
                // 3-letter language codes
                $lang = substr($locale, 0, 3);
            }
            if ($lang && is_readable($i18nDir . $lang . '.json')) {
                $url = $this->getPluginFileUrl() . "/dt_i18n/$lang.json";
            }
        }
        return $url;
    }

    public function setTimezone() {
        $timezone = trim($this->getOption('Timezone'));
        if (empty($timezone)) {
            $timezone = get_option('timezone_string');
        }
        if (!empty($timezone)) {
            date_default_timezone_set($timezone);
        }
    }

    /**
     * @return boolean Is the CFDB Editor extension installed?
     */
    public function isEditorInstalled() {
        return get_option('CFDBEditPlugin__installed', false) == true;
    }


    /**
     * @return string|null get the CFDB Editor extension version string.
     * return null if not installed
     */
    public function getEditorSavedVersion() {
        return get_option('CFDBEditPlugin__version', null);
    }

    /**
     * @return array of CFDB Editor plugin data, see: http://codex.wordpress.org/Function_Reference/get_plugin_data
     */
    public function getEditorPluginData() {
            $editPluginFile = WP_PLUGIN_DIR .
                    '/contact-form-to-database-extension-edit/contact-form-to-database-extension-edit.php';
            if(@file_exists($editPluginFile)) {
                $pluginData = get_plugin_data($editPluginFile);
                if (is_array($pluginData)) {
                    return $pluginData;
            }
        }
        return array();
    }

    /**
     * @return bool if CFDB Editor extension plugin is activated
     */
    public function isEditorActive() {
        $editPluginFile = 'contact-form-to-database-extension-edit/contact-form-to-database-extension-edit.php';
        return function_exists('is_plugin_active') && is_plugin_active($editPluginFile);
    }


    public function addAdminNotices() {
        if (!$this->isEditorActive()) {
            return;
        }
        $requiredEditorVersion = '1.3.1';
        $editorData = $this->getEditorPluginData();
        if (isset($editorData['Version'])) {
            if (version_compare($editorData['Version'], $requiredEditorVersion) == -1) {
                ?>
                <div id="message" class="error">Plugin <strong>Contact Form to DB Extension Edit</strong> should be updated.
                    <a target="_cfdbeditupgrade" href="http://cfdbplugin.com/?page_id=939">Get the upgrade</a><br/>
                    Current version: <?php echo $editorData['Version']; ?>, Needed version: <?php echo $requiredEditorVersion; ?>
                </div>
            <?php
            }
        }
    }

    /**
     * @return array of form names that have data in the DB
     */
    public function getForms() {
        global $wpdb;
        $forms = array();
        $tableName = $this->getSubmitsTableName();
        $formsFromQuery = $wpdb->get_results("select distinct `form_name` from `$tableName` order by `form_name`");
        foreach ($formsFromQuery as $aRow) {
            $forms[] = $aRow->form_name;
        }
        return $forms;
    }

}
