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

require_once('CF7DBPlugin.php');
require_once('CFDBView.php');
require_once('CFDBShortCodeContentParser.php');

class CFDBViewShortCodeBuilder extends CFDBView {

    /**
     * @param  $plugin CF7DBPlugin
     * @return void
     */
    function display(&$plugin) {
        if ($plugin == null) {
            $plugin = new CF7DBPlugin;
        }
        $this->pageHeader($plugin);

        $siteUrl = get_option('home');
        $user = wp_get_current_user();
        $userName = $user ? $user->user_login : '';

        // Identify which forms have data in the database
        global $wpdb;
        $tableName = $plugin->getSubmitsTableName();
        $rows = $wpdb->get_results("select distinct `form_name` from `$tableName` order by `form_name`");
        //        if ($rows == null || count($rows) == 0) {
        //            _e('No form submissions in the database', 'contact-form-7-to-database-extension');
        //            return;
        //        }

        // Collect any values in $_REQUEST to pre-populate the page controls
        $postedForm = isset($_REQUEST['form']) ? $_REQUEST['form'] : '';
        $postedEnc = isset($_REQUEST['enc']) ? $_REQUEST['enc'] : '';
        $postedSC = isset($_REQUEST['sc']) ? ('[' . $_REQUEST['sc'] . ']') : '';
        $postedTrans = isset($_REQUEST['trans']) ? ($_REQUEST['trans']) : '';
        $postedShow = isset($_REQUEST['show']) ? ($_REQUEST['show']) : '';
        $postedHide = isset($_REQUEST['hide']) ? ($_REQUEST['hide']) : '';
        $postedRole = isset($_REQUEST['role']) ? ($_REQUEST['role']) : '';
        $postedPermissionmsg = isset($_REQUEST['permissionmsg']) ? ($_REQUEST['permissionmsg']) : '';
        $postedSearch = isset($_REQUEST['search']) ? ($_REQUEST['search']) : '';
        $postedFilter = isset($_REQUEST['filter']) ? ($_REQUEST['filter']) : '';
        $postedTSearch = isset($_REQUEST['tsearch']) ? ($_REQUEST['tsearch']) : '';
        $postedTFilter = isset($_REQUEST['tfilter']) ? ($_REQUEST['tfilter']) : '';
        $postedLimit = isset($_REQUEST['limit']) ? ($_REQUEST['limit']) : '';
        $postedTLimit = isset($_REQUEST['tlimit']) ? ($_REQUEST['tlimit']) : '';

        $postedLimitComponents = explode(',', $postedLimit);
        $postedLimitStart = '';
        $postedLimitNumRows = '';
        switch (count($postedLimitComponents)) {
            case 2:
                $postedLimitStart = $postedLimitComponents[0];
                $postedLimitNumRows = $postedLimitComponents[1];
            break;
            case 1:
                $postedLimitNumRows = $postedLimitComponents[0];
                break;
            default:
                break;
        }

        $postedUnbuffered = isset($_REQUEST['unbuffered']) ? ($_REQUEST['unbuffered']) : '';
        $postedRandom = isset($_REQUEST['random']) ? ($_REQUEST['random']) : '';
        $postedOrderby = isset($_REQUEST['orderby']) ? ($_REQUEST['orderby']) : '';
        $postedTOrderby = isset($_REQUEST['torderby']) ? ($_REQUEST['torderby']) : '';
        $postedHeader = isset($_REQUEST['header']) ? ($_REQUEST['header']) : '';
        $postedHeaders = isset($_REQUEST['headers']) ? ($_REQUEST['headers']) : '';
        $postedItemtitle = isset($_REQUEST['itemtitle']) ? ($_REQUEST['itemtitle']) : '';
        $postedId = isset($_REQUEST['id']) ? ($_REQUEST['id']) : '';
        $postedClass = isset($_REQUEST['class']) ? ($_REQUEST['class']) : '';
        $postedStyle = isset($_REQUEST['style']) ? ($_REQUEST['style']) : '';
        $postedEdit = isset($_REQUEST['edit']) ? ($_REQUEST['edit']) : '';
        $postedDtOptions = isset($_REQUEST['dt_options']) ? ($_REQUEST['dt_options']) : '';
        $postedVar = isset($_REQUEST['var']) ? ($_REQUEST['var']) : '';
        $postedFormat = isset($_REQUEST['format']) ? ($_REQUEST['format']) : '';
        $postedFunction = isset($_REQUEST['function']) ? ($_REQUEST['function']) : '';
        $postedDelimiter = isset($_REQUEST['delimiter']) ? ($_REQUEST['delimiter']) : '';
        $postedFilelinks = isset($_REQUEST['filelinks']) ? ($_REQUEST['filelinks']) : '';
        $postedWpautop = isset($_REQUEST['wpautop']) ? ($_REQUEST['wpautop']) : '';
        $postedStripbr = isset($_REQUEST['stripbr']) ? ($_REQUEST['stripbr']) : '';
        $postedContent = isset($_REQUEST['content']) ? ($_REQUEST['content']) : '';
        $postedContentBefore = '';
        $postedContentAfter = '';
        if ($postedContent) {
            $parser = new CFDBShortCodeContentParser;
            list($postedContentBefore, $postedContent, $postedContentAfter) = $parser->parseBeforeContentAfter($postedContent);
        }

        $postedUrlonly = isset($_REQUEST['urlonly']) ? ($_REQUEST['urlonly']) : '';
        $postedLinktext = isset($_REQUEST['linktext']) ? ($_REQUEST['linktext']) : '';

        $infoImg = $plugin->getPluginFileUrl('/img/info.jpg');
        ?>
    <script type="text/javascript" language="JavaScript">

        var shortCodeDocUrls = {
            '' : 'http://cfdbplugin.com/?page_id=89',
            '[cfdb-html]' : 'http://cfdbplugin.com/?page_id=284',
            '[cfdb-table]' : 'http://cfdbplugin.com/?page_id=93',
            '[cfdb-datatable]' : 'http://cfdbplugin.com/?page_id=91',
            '[cfdb-value]' : 'http://cfdbplugin.com/?page_id=98',
            '[cfdb-count]' : 'http://cfdbplugin.com/?page_id=278',
            '[cfdb-json]' : 'http://cfdbplugin.com/?page_id=96',
            '[cfdb-export-link]' : 'http://cfdbplugin.com/?page_id=419'
        };

        function showHideOptionDivs() {
            var shortcode = jQuery('#shortcode_ctrl').val();
            jQuery('#doc_url_tag').attr('href', shortCodeDocUrls[shortcode]);
            jQuery('#doc_url_tag').html(shortcode + " <?php _e('Documentation', 'contact-form-7-to-database-extension'); ?>");
            switch (shortcode) {
                case "[cfdb-html]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').show();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').hide();
                    break;
                case "[cfdb-table]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').show();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').show();
                    break;
                case "[cfdb-datatable]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').show();
                    jQuery('#dt_options_div').show();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').show();
                    break;
                case "[cfdb-value]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').show();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').hide();
                    break;
                case "[cfdb-count]":
                    jQuery('#show_hide_div').hide();
                    jQuery('#limitorder_div').hide();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').hide();
                    break;
                case "[cfdb-json]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').show();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').show();
                    break;
                case "[cfdb-export-link]":
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').show();
                    jQuery('#headers_div').show();
                    break;
                default:
                    jQuery('#show_hide_div').show();
                    jQuery('#limitorder_div').show();
                    jQuery('#html_format_div').hide();
                    jQuery('#dt_options_div').hide();
                    jQuery('#json_div').hide();
                    jQuery('#value_div').hide();
                    jQuery('#template_div').hide();
                    jQuery('#url_link_div').hide();
                    jQuery('#headers_div').hide();
                    break;
            }
            var exportSelected = jQuery('#export_cntl').val();
            jQuery('#label_export_link').show();
            jQuery('#label_gld_function').hide();
            jQuery('#userpass_span_msg').show();
            jQuery('#gld_userpass_span_msg').hide();
            if (exportSelected) {
                if (exportSelected == 'RSS') {
                    jQuery('#itemtitle_span').show();
                }
                else {
                    jQuery('#itemtitle_span').hide();
                    jQuery('#headers_div').show();
                    if (exportSelected == "GLD") {
                        jQuery('#userpass_span_msg').hide();
                        jQuery('#gld_userpass_span_msg').show();
                        jQuery('#label_export_link').hide();
                        jQuery('#label_gld_function').show();
                    }

                    if (exportSelected == "JSON") {
                        jQuery('#json_div').show();
                    }
                    else {
                        jQuery('#json_div').hide();
                    }
                }
            } else {
                jQuery('#itemtitle_span').hide();
                jQuery('#userpass_span_msg').show();
                jQuery('#gld_userpass_span_msg').hide();
                jQuery('#label_gld_script').hide();
            }
        }

        function getValue(attr, value, errors) {
            if (value) {
                if (errors && value.indexOf('"') > -1) {
                    errors.push('<?php _e('Error: "', 'contact-form-7-to-database-extension'); ?>'
                                        + attr +
                                        '<?php _e('" should not contain double-quotes (")', 'contact-form-7-to-database-extension'); ?>');
                    value = value.replace('"', "'");
                }
                return attr + '="' + value + '"';
            }
            return '';
        }

        function pushNameValue(attr, value, array, errors) {
            if (value) {
                if (errors && value.indexOf('"') > -1) {
                    errors.push('<?php _e('Error: "', 'contact-form-7-to-database-extension'); ?>'
                            + attr +
                            '<?php _e('" should not contain double-quotes (")', 'contact-form-7-to-database-extension'); ?>');
                    value = value.replace('"', "'");
                }
                array.push(attr);
                array.push(value);
                return true;
            }
            return false;
        }

        function getValueUrl(attr, value) {
            if (value) {
                return attr + '=' + encodeURIComponent(value)
            }
            return '';
        }


        function join(arr, delim) {
            if (delim == null) {
                delim = ' ';
            }
            var tmp = [];
            for (idx=0; idx<arr.length; idx++) {
                if (arr[idx] != '') {
                    tmp.push(arr[idx]);
                }
            }
            return tmp.join(delim);
        }

        function chopLastChar(text) {
            return text.substr(0, text.length - 1);
        }

        function createShortCodeAndExportLink() {
            var scElements = [];
            var scUrlElements = [];
            var scValidationErrors = [];

            var exportUrlElements = [];
            var exportValidationErrors = [];

            var googleScriptElements = [];
            var googleScriptValidationErrors = [];

            var shortcode = jQuery('#shortcode_ctrl').val();
            if (shortcode == '') {
                jQuery('#shortcode_result_text').html('');
            }
            scElements.push(chopLastChar(shortcode));

            var pushErrorMessagesToAll = function(errMsg) {
                scValidationErrors.push(errMsg);
                exportValidationErrors.push(errMsg);
                googleScriptValidationErrors.push(errMsg);
            };

            var formName = jQuery('#form_name_cntl').val();
            var errMsg;
            if (!formName) {
                errMsg = '<?php _e('Error: no form is chosen', 'contact-form-7-to-database-extension') ?>';
                jQuery('#form_validations_text').html(errMsg);
                pushErrorMessagesToAll(errMsg);
            }
            else {
                jQuery('#form_validations_text').html('');
                scElements.push('form="' + formName + '"');
                scUrlElements.push('form=' + encodeURIComponent(formName));
                exportUrlElements.push('form=' + encodeURIComponent(formName));
                googleScriptElements.push('<?php echo $siteUrl ?>');
                googleScriptElements.push(formName);
                googleScriptElements.push('<?php echo is_user_logged_in() ?
                        wp_get_current_user()->user_login :
                        'user' ?>');
                googleScriptElements.push('&lt;password&gt;');
            }

            var pushValueToAll = function(name, val) {
                scElements.push(getValue(name, val, scValidationErrors));
                scUrlElements.push(getValueUrl(name, val));
                exportUrlElements.push(getValueUrl(name, val));
                pushNameValue(name, val, googleScriptElements, googleScriptValidationErrors);
            };

            var val;
            if (shortcode != '[cfdb-count]') {
                val = jQuery('#show_cntl').val();
                pushValueToAll('show', val);

                val = jQuery('#hide_cntl').val();
                pushValueToAll('hide', val);
            }

            val =  jQuery('#role_cntl').val();
            pushValueToAll('role', val);

            val = jQuery('#permissionmsg_cntl').val();
            pushValueToAll('permissionmsg', val);

            val = jQuery('#trans_cntl').val();
            pushValueToAll('trans', val);


            var handleFilterSearch = function(filterName, filter, searchName, search) {
                if (filter) {
                    pushValueToAll(filterName, filter);
                    if (search) {
                        var errMsg = '<?php _e('Warning: "search" field ignored because FIELD is used (use one but not both)', 'contact-form-7-to-database-extension'); ?>'.replace('FIELD', filterName);
                        pushErrorMessagesToAll(errMsg);
                    }
                }
                else {
                    pushValueToAll(searchName, search);
                }
            };
            var filter = jQuery('#filter_cntl').val();
            var search = jQuery('#search_cntl').val();
            handleFilterSearch('filter', filter, 'search', search);

            var tfilter = jQuery('#tfilter_cntl').val();
            var tsearch = jQuery('#tsearch_cntl').val();
            handleFilterSearch('tfilter', tfilter, 'tsearch', tsearch);


            if (shortcode != '[cfdb-count]') {

                var handleLimit = function (limitName, limitRows, limitStart) {
                    if (limitStart && !limitRows) {
                        errMsg = '<?php _e('Error: "FIELD": if you provide a value for "Start Row" then you must also provide a value for "Num Rows"', 'contact-form-7-to-database-extension'); ?>'.replace('FIELD', limitName);
                        pushErrorMessagesToAll(errMsg);
                    }
                    if (limitRows) {
                        if (!/^\d+$/.test(limitRows)) {
                            errMsg = '<?php _e('Error: "FIELD": "Num Rows" must be a positive integer', 'contact-form-7-to-database-extension'); ?>'.replace('FIELD', limitName);
                            pushErrorMessagesToAll(errMsg);
                        }
                        else {
                            var limitOption = '';
                            var limitOptionUrl = limitName + '=';
                            if (limitStart) {
                                if (!/^\d+$/.test(limitStart)) {
                                    errMsg = '<?php _e('Error: "FIELD": "Start Row" must be a positive integer', 'contact-form-7-to-database-extension'); ?>'.replace('FIELD', limitName);
                                    pushErrorMessagesToAll(errMsg);
                                }
                                else {
                                    limitOption += limitStart + ",";
                                    limitOptionUrl += encodeURIComponent(limitStart + ",");
                                }
                            }
                            limitOption += limitRows;
                            limitOptionUrl += limitRows;
                            scElements.push(limitName + '="' + limitOption + '"');
                            scUrlElements.push(limitOptionUrl);
                            exportUrlElements.push(limitOptionUrl);
                            pushNameValue(limitName, limitOption, googleScriptElements, googleScriptValidationErrors);
                        }
                    }
                };

                var limitRows = jQuery('#limit_rows_cntl').val();
                var limitStart = jQuery('#limit_start_cntl').val();
                handleLimit('limit', limitRows, limitStart);

                var tlimitRows = jQuery('#tlimit_rows_cntl').val();
                var tlimitStart = jQuery('#tlimit_start_cntl').val();
                handleLimit('tlimit', tlimitRows, tlimitStart);



                val = jQuery('#random_cntl').val();
                scElements.push(getValue('random', val, scValidationErrors));
                scUrlElements.push(getValueUrl('random', val));
                pushNameValue("random", val, googleScriptElements, googleScriptValidationErrors);

                if (jQuery('#unbuffered_cntl').is(':checked')) {
                    scElements.push('unbuffered="true"');
                    scUrlElements.push(getValueUrl('unbuffered', 'true'));
                    exportUrlElements.push('unbuffered=true');
                    pushNameValue("unbuffered", "true", googleScriptElements, googleScriptValidationErrors);
                }

                var handleOrderBy = function (name, val) {
                    if (val) {
                        var orderByElem = getValue(name, val, scValidationErrors);
                        var orderByElemUrl = getValueUrl(name, val);
                        var orderByDir = jQuery('#' + name + 'dir_cntl').val();
                        if (orderByDir) {
                            orderBy += ' ' + orderByDir;
                            orderByElem = chopLastChar(orderByElem) + ' ' + orderByDir + '"';
                            orderByElemUrl = orderByElemUrl + encodeURIComponent(' ' + orderByDir);
                        }
                        scElements.push(orderByElem);
                        scUrlElements.push(orderByElemUrl);
                        exportUrlElements.push(orderByElemUrl);
                        pushNameValue(name, orderBy, googleScriptElements, googleScriptValidationErrors);
                    }
                };
                var orderBy = jQuery('#orderby_cntl').val();
                handleOrderBy('orderby', orderBy);

                var torderBy = jQuery('#torderby_cntl').val();
                handleOrderBy('torderby', torderBy);
            }

            var scText;
            switch (shortcode) {
                case '[cfdb-html]':
                    val = jQuery('#filelinks_cntl').val();
                    scElements.push(getValue('filelinks', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('filelinks', val));

                    val = jQuery('#wpautop_cntl').val();
                    scElements.push(getValue('wpautop', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('wpautop', val));

                    val = jQuery('#stripbr_cntl').val();
                    scElements.push(getValue('stripbr', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('stripbr', val));

                    var template = jQuery('#content_cntl').val();
                    var content = template;
                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));
                    scUrlElements.push('enc=HTMLTemplate');
                    scText = join(scElements) + ']' +
                            // Escape html tags for display on page
                            content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                            '[/cfdb-html]';
                    if (template == "") {
                        scValidationErrors.push('<?php _e('Error: [cfdb-html] has empty Template. It will not output anything. ', 'contact-form-7-to-database-extension'); ?>');
                        jQuery('#content_cntl').addClass('validation'); // highlight template area
                    }
                    else {
                        jQuery('#content_cntl').removeClass('validation'); // remove highlight template area
                    }
                    break;
                case '[cfdb-table]':
                    if (!jQuery('#header_cntl').is(':checked')) {
                        scElements.push('header="false"');
                        scUrlElements.push(getValueUrl('header', 'false'));
                        pushNameValue("header", "false", googleScriptElements, googleScriptValidationErrors);
                    }
                    val = jQuery('#headers_cntl').val();
                    scElements.push(getValue('headers', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('headers', val));

                    val = jQuery('#id_cntl').val();
                    scElements.push(getValue('id', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('id', val));

                    val = jQuery('#class_cntl').val();
                    scElements.push(getValue('class', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('class',val));

                    val = jQuery('#style_cntl').val();
                    scElements.push(getValue('style', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('style', val));

                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    var content = '';
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));

                    scUrlElements.push('enc=HTML');
                    scText = join(scElements) + ']';
                    if (content) {
                        // Escape html tags for display on page
                        scText += content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                                        '[/cfdb-table]';
                    }
                    break;
                case '[cfdb-datatable]':
                    if (!jQuery('#header_cntl').is(':checked')) {
                        scElements.push('header="false"');
                        scUrlElements.push(getValueUrl('header', 'false'));
                    }
                    val = jQuery('#headers_cntl').val();
                    scElements.push(getValue('headers', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('headers', val));

                    val = jQuery('#id_cntl').val();
                    scElements.push(getValue('id', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('id', val));

                    val = jQuery('#class_cntl').val();
                    scElements.push(getValue('class', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('class', val));

                    val = jQuery('#style_cntl').val();
                    scElements.push(getValue('style', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('style', val));

                    if (jQuery('#edit_mode_cntl').attr('checked')) {
                        scElements.push('edit="true"');
                        scUrlElements.push('edit=true');
                    }

                    val = jQuery('#dt_options_cntl').val();
                    scElements.push(getValue('dt_options', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('dt_options', val));

                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    var content = '';
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));

                    scUrlElements.push('enc=DT');
                    scText = join(scElements) + ']';
                    if (content) {
                        // Escape html tags for display on page
                        scText += content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                                '[/cfdb-datatable]';
                    }
                    break;
                case '[cfdb-value]':
                    val = jQuery('#function_cntl').val();
                    scElements.push(getValue('function', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('function', val));

                    val = jQuery('#delimiter_cntl').val();
                    scElements.push(getValue('delimiter', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('delimiter', val));

                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    var content = '';
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));

                    scUrlElements.push('enc=VALUE');
                    scText = join(scElements) + ']';
                    if (content) {
                        // Escape html tags for display on page
                        scText += content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                                '[/cfdb-value]';
                    }
                    break;
                case '[cfdb-count]':
                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    var content = '';
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));

                    scUrlElements.push('enc=COUNT');
                    scText = join(scElements) + ']'; // hopLastChar(scElements.join(' ')) + ']';
                    if (content) {
                        // Escape html tags for display on page
                        scText += content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                                '[/cfdb-count]';
                    }
                    break;
                case '[cfdb-json]':
                    if (!jQuery('#header_cntl').is(':checked')) {
                        scElements.push('header="false"');
                        scUrlElements.push(getValueUrl('header', 'false'));
                        pushNameValue("header", "false", googleScriptElements, googleScriptValidationErrors);
                    }
                    val = jQuery('#headers_cntl').val();
                    scElements.push(getValue('headers', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('headers', val));

                    val = jQuery('#var_cntl').val();
                    scElements.push(getValue('var', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('var', val));

                    val = jQuery('#format_cntl').val();
                    scElements.push(getValue('format', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('format', val));

                    var contentBefore = jQuery('#before_cntl').val();
                    var contentAfter = jQuery('#after_cntl').val();
                    var content = '';
                    if (contentBefore) {
                        content = "<?php echo CFDBShortCodeContentParser::BEFORE_START_DELIMITER ?>" + contentBefore + "<?php echo CFDBShortCodeContentParser::BEFORE_END_DELIMITER ?>" + content;
                    }
                    if (contentAfter) {
                        content += "<?php echo CFDBShortCodeContentParser::AFTER_START_DELIMITER ?>" + contentAfter + "<?php echo CFDBShortCodeContentParser::AFTER_END_DELIMITER ?>";
                    }
                    scUrlElements.push('content=' + encodeURIComponent(content));

                    scUrlElements.push('enc=JSON');
                    scText = join(scElements) + ']';
                    if (content) {
                        // Escape html tags for display on page
                        scText += content.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;') +
                                '[/cfdb-json]';
                    }
                    break;
                case '[cfdb-export-link]':
                    val = jQuery('#enc_cntl').val();
                    scElements.push(getValue('enc', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('enc', val));
                    scElements.push(getValue('urlonly', jQuery('#urlonly_cntl').val(), scValidationErrors));
                    scElements.push(getValue('linktext', jQuery('#linktext_cntl').val(), scValidationErrors));

                    if (!jQuery('#header_cntl').is(':checked')) {
                        scElements.push('header="false"');
                        scUrlElements.push(getValueUrl('header', 'false'));
                    }
                    val = jQuery('#headers_cntl').val();
                    scElements.push(getValue('headers', val, scValidationErrors));
                    scUrlElements.push(getValueUrl('headers', val));

                    scText = join(scElements) + ']';
                    break;
                default:
                    scText = shortcode;
                    break;
            }

            var urlBase = '<?php echo admin_url('admin-ajax.php') ?>?action=cfdb-export&';

            if (shortcode) {
                // Output short code text
                var scUrl = urlBase + join(scUrlElements, '&');
                jQuery('#shortcode_result_text').html('<a target="_cfdb_sc_results" href="' + scUrl + '">' + scText + '</a>');

                // Output short code errors
                jQuery('#shortcode_validations_text').html(scValidationErrors.join('<br/>'));
            }
            else {
                // Don't report errors
                jQuery('#shortcode_validations_text').html('');
            }

            // Export link or Google Spreadsheet function call
            var exportSelection = jQuery('#export_cntl').val();
            if (exportSelection) {
                if (exportSelection != 'GLD') {
                    exportUrlElements.push(getValueUrl('enc', exportSelection));
                }
                if (exportSelection == 'RSS') {
                    exportUrlElements.push(getValueUrl('itemtitle', jQuery('#add_itemtitle').val()));
                } else {
                    if (!jQuery('#header_cntl').is(':checked')) {
                        exportUrlElements.push(getValueUrl('header', 'false'));
                        pushNameValue("header", "false", googleScriptElements, googleScriptValidationErrors);
                    }
                    val = jQuery('#headers_cntl').val();
                    exportUrlElements.push(getValueUrl('headers', val, scValidationErrors));
                    pushNameValue("headers", val, googleScriptElements, googleScriptValidationErrors);

                    exportUrlElements.push(getValueUrl('format', jQuery('#format_cntl').val(), scValidationErrors));
                }

                var user = jQuery("#gld_user").val();
                var pass = jQuery("#gld_pass").val();
                var obfuscate = jQuery('#obfuscate_cntl').is(':checked')
                if (user || pass) {
                    if (obfuscate) {
                        var key = '3M#v$-.u';
                        exportUrlElements.push("l=" + encodeURI(printHex(des(key, user + "/" + pass, 1))));
                    } else {
                        exportUrlElements.push("user_login=" + encodeURI(user));
                        exportUrlElements.push("user_password=" + encodeURI(pass));
                    }
                    urlBase = '<?php echo admin_url('admin-ajax.php') ?>?action=cfdb-login&cfdb-action=cfdb-export&';
                    exportValidationErrors.push("<?php _e('Warning: the function includes your WP login information. Avoid sharing it.') ?>");
                }

                // Output
                var exportUrl = urlBase + join(exportUrlElements, '&');
                if (exportSelection == 'GLD') {
                    if (!user || !pass) {
                        exportValidationErrors.push("<?php _e('Error: WP User and Password are required for the Google Spreadsheet to pull data from your WordPress site.') ?>");
                    }
                    if (exportUrl.length > 255) {
                        exportValidationErrors.push("<?php _e('Because the generated URL would be too long, you must use this alternative function and add its script to your Google Spreadsheet') ?>");
                        jQuery('#label_gld_script').show();
                        jQuery('#label_gld_function').hide();
                        jQuery('#export_result_text').html(formName ?
                                ("=cfdbdata(\"" + googleScriptElements.join("\", \"") + "\")") :
                                "");
                    } else {
                        jQuery('#export_result_text').html(formName ?
                                ("<a target='_cfdb_exp_results' href='" + exportUrl + "'>=IMPORTDATA(\"" + exportUrl + "\")</a>") :
                                "");
                    }
                } else {
                    jQuery('#export_result_text').html(formName ? ('<a target="_cfdb_exp_results" href="' + exportUrl + '">' + exportUrl + '</a>') : '');
                }

                // Output export errors
                jQuery('#export_validations_text').html(exportValidationErrors.join('<br/>'));

            } else {
                jQuery('#export_result_text').html('');
                // Don't report errors
                jQuery('#export_validations_text').html('');
            }
        }

        var getFormFieldsUrlBase = '<?php echo $plugin->getFormFieldsAjaxUrlBase() ?>';
        function getFormFields() {
            jQuery('[id^=add]').attr('disabled', 'disabled');
            jQuery('[id^=btn]').attr('disabled', 'disabled');
            var formName = jQuery('#form_name_cntl').val();
            var url = getFormFieldsUrlBase + encodeURIComponent(formName);
            jQuery.ajax({
                dataType: "json",
                url: url,
                async: false,
                success: function(json) {
                    var optionsHtml = '<option value=""></option>';
                    jQuery(json).each(function () {
                        optionsHtml += '<option value="' + this + '">' + this + '</option>';
                    });
                    optionsHtml += '<option value="$_POST(param)">$_POST(param)</option>';
                    optionsHtml += '<option value="$_GET(param)">$_GET(param)</option>';
                    optionsHtml += '<option value="$_COOKIE(param)">$_COOKIE(param)</option>';
                    jQuery('[id^=add]').html(optionsHtml).removeAttr('disabled');
                    jQuery('[id^=btn]').removeAttr('disabled');
                }
            });
        }

        function validateSubmitTime() {
            var url = "<?php echo $plugin->getValidateSubmitTimeAjaxUrlBase() ?>" + jQuery('#filter_val').val();
            jQuery.get(url, function(data) {
                alert(data);
            });
        }

        function showValidateSubmitTimeHelp(show) {
            if (show) {
                jQuery('#span_validate_submit_time').show();
            }
            else {
                jQuery('#span_validate_submit_time').hide();
            }
        }

        function addFieldToShow() {
            var value = jQuery('#show_cntl').val();
            if (value) {
                value += ',';
            }
            jQuery('#show_cntl').val(value + jQuery('#add_show').val());
            createShortCodeAndExportLink();
        }

        function addFieldToHide() {
            var value = jQuery('#hide_cntl').val();
            if (value) {
                value += ',';
            }
            jQuery('#hide_cntl').val(value + jQuery('#add_hide').val());
            createShortCodeAndExportLink();
        }

        function addFieldToOrderBy(field) {
            var value = jQuery('#' + field + '_cntl').val();
            if (value) {
                value += ',';
            }
            jQuery('#' + field + '_cntl').val(value + jQuery('#add_' + field).val());
            createShortCodeAndExportLink();
        }

        function addFieldToFilter(field) {
            var value = jQuery('#' + field + '_cntl').val();
            if (value) {
                value += jQuery('#' + field + '_bool').val();
            }
            value += jQuery('#add_' + field).val() + jQuery('#' + field + '_op').val() + jQuery('#' + field + '_val').val();
            jQuery('#' + field + '_cntl').val(value);
            createShortCodeAndExportLink();
        }

        function addToTrans() {
            var value = jQuery('#trans_cntl').val();
            if (value) {
                value += "&&";
            }
            var field = jQuery('#add_trans').val()
            if (field) {
                value += field;
                value += "="
            }
            value += jQuery('#trans_val').val();
            jQuery('#trans_cntl').val(value);
            createShortCodeAndExportLink();
        }

        function addFieldToHeaders() {
            var col = jQuery('#add_headers').val();
            var disp = jQuery('#headers_val').val();
            if (!col || !disp) {
                return;
            }
            var value = jQuery('#headers_cntl').val();
            if (value) {
                value += ',';
            }
            value += col + '=' + disp;
            jQuery('#headers_cntl').val(value);
            createShortCodeAndExportLink();
        }

        function addFieldToContent() {
            jQuery('#content_cntl').val(jQuery('#content_cntl').val() + '${' + jQuery('#add_content').val() + '}');
        }

        function reset() {
            // Form
            jQuery('#form_name_cntl').val('<?php echo $postedForm ?>');
            getFormFields();

            // Export File
            jQuery('#export_cntl').val('<?php echo $postedEnc ?>');
            jQuery('#add_itemtitle').val('<?php echo $postedItemtitle ?>');

            // Short Code
            jQuery('#shortcode_ctrl').val('<?php echo $postedSC ?>');
            jQuery('#show_cntl').val('<?php echo $postedShow ?>');
            jQuery('#hide_cntl').val('<?php echo $postedHide ?>');
            jQuery('#role_cntl').val('<?php echo $postedRole ?>');
            jQuery('#permissionmsg_cntl').val('<?php echo $postedPermissionmsg ?>');
            jQuery('#trans_cntl').val('<?php echo $postedTrans ?>');
            jQuery('#search_cntl').val('<?php echo $postedSearch ?>');
            jQuery('#filter_cntl').val('<?php echo $postedFilter ?>');
            jQuery('#tsearch_cntl').val('<?php echo $postedTSearch ?>');
            jQuery('#tfilter_cntl').val('<?php echo $postedTFilter ?>');
            jQuery('#limit_rows_cntl').val('<?php echo $postedLimitNumRows ?>');
            jQuery('#limit_start_cntl').val('<?php echo $postedLimitStart ?>');
            jQuery('#random_cntl').val('<?php echo $postedRandom ?>');
            jQuery('#orderby_cntl').val('<?php echo $postedOrderby ?>');
            jQuery('#torderby_cntl').val('<?php echo $postedTOrderby ?>');
            jQuery('#header_cntl').prop("checked", <?php echo $postedHeader == 'false' ? 'false' : 'true' ?>); // default = true
            jQuery('#headers_cntl').val('<?php echo $postedHeaders ?>');
            jQuery('#id_cntl').val('<?php echo $postedId ?>');
            jQuery('#class_cntl').val('<?php echo $postedClass ?>');
            jQuery('#style_cntl').val('<?php echo $postedStyle ?>');
            jQuery('#edit_mode_cntl').prop('checked', <?php echo $postedEdit == 'true' ? 'true' : 'false' ?>); // default = false
            jQuery('#dt_options_cntl').val('<?php echo $postedDtOptions ?>');
            jQuery('#var_cntl').val('<?php echo $postedVar ?>');
            jQuery('#format_cntl').val('<?php echo $postedFormat ?>');
            jQuery('#function_cntl').val('<?php echo $postedFunction ?>');
            jQuery('#delimiter_cntl').val('<?php echo $postedDelimiter ?>');
            jQuery('#filelinks_cntl').val('<?php echo $postedFilelinks ?>');
            jQuery('#wpautop_cntl').val('<?php echo $postedWpautop ?>');
            jQuery('#stripbr_cntl').val('<?php echo $postedStripbr ?>');
            jQuery('#content_cntl').val('<?php echo $postedContent ?>');
            jQuery('#before_cntl').val('<?php echo $postedContentBefore ?>');
            jQuery('#after_cntl').val('<?php echo $postedContentAfter ?>');
            jQuery('#enc_cntl').val('<?php echo $postedEnc ?>');
            jQuery('#urlonly_cntl').val('<?php echo $postedUrlonly ?>');
            jQuery('#linktext_cntl').val('<?php echo $postedLinktext ?>');

            showValidateSubmitTimeHelp(false);
            showHideOptionDivs();
            createShortCodeAndExportLink();
        }

        jQuery.ajaxSetup({
            cache: false
        });

        jQuery(document).ready(function() {
            reset();
            showHideOptionDivs();
            createShortCodeAndExportLink();
            jQuery('#shortcode_ctrl').change(showHideOptionDivs);
            jQuery('#shortcode_ctrl').change(createShortCodeAndExportLink);
            jQuery('select[id$="cntl"]').change(createShortCodeAndExportLink);
            jQuery('input[id$="cntl"]').keyup(createShortCodeAndExportLink);
            jQuery('textarea[id$="cntl"]').keyup(createShortCodeAndExportLink);
            jQuery('#form_name_cntl').change(getFormFields);
            jQuery('#btn_show').click(addFieldToShow);
            jQuery('#btn_hide').click(addFieldToHide);
            jQuery('#btn_orderby').click(function () {
                addFieldToOrderBy('orderby');
            });
            jQuery('#btn_torderby').click(function () {
                addFieldToOrderBy('torderby');
            });
            jQuery('#btn_filter').click(function () {
                addFieldToFilter('filter');
            });
            jQuery('#btn_tfilter').click(function () {
                addFieldToFilter('tfilter');
            });
            jQuery('#btn_trans').click(addToTrans);
            jQuery('#header_cntl').click(createShortCodeAndExportLink);
            jQuery('#unbuffered_cntl').click(createShortCodeAndExportLink);
            jQuery('#edit_mode_cntl').click(createShortCodeAndExportLink);
            jQuery('#btn_headers').click(addFieldToHeaders);
            jQuery('#btn_content').click(function() {
                addFieldToContent();
                createShortCodeAndExportLink();
            });
            jQuery('#enc_cntl').click(createShortCodeAndExportLink);
            jQuery('#urlonly_cntl').click(createShortCodeAndExportLink);
            jQuery('#reset_button').click(reset);
            jQuery('#btn_validate_submit_time').click(validateSubmitTime);
            jQuery('#add_filter').change(function() {
                showValidateSubmitTimeHelp(jQuery('#add_filter').val() == "submit_time");
            });
            jQuery('#export_cntl').change(function() {
                showHideOptionDivs();
                createShortCodeAndExportLink();
            });
            jQuery('#add_itemtitle').change(createShortCodeAndExportLink);
            jQuery('#gld_user').change(createShortCodeAndExportLink);
            jQuery('#gld_user').keyup(createShortCodeAndExportLink);
            jQuery('#gld_pass').change(createShortCodeAndExportLink);
            jQuery('#gld_pass').keyup(createShortCodeAndExportLink);
            jQuery('#obfuscate_cntl').click(createShortCodeAndExportLink);
            jQuery('#form_name_cntl').change(createShortCodeAndExportLink);
        });


    </script>
    <style type="text/css">
        div.shortcodeoptions {
            border: #ccccff groove;
            margin-bottom: 10px;
            padding: 5px;
        }

        div.shortcodeoptions label {
            font-weight: bold;
            font-family: Arial sans-serif;
            margin-top: 5px;
        }

        #shortcode_result_div {
            margin-top: 1em;
        }

        .label_box {
            display: inline-block;
            min-width: 50px;
            padding-left: 2px;
            padding-right: 2px;
            border: 1px;
            margin-right: 5px;
        }

        .generated {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 10px;
            white-space: -moz-pre-wrap;
            white-space: -pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            word-wrap: break-word;
            font-size: larger;
            font-weight: bold;
            font-family: "courier new", monospace;
            background-color: #ffffc3;
        }

        .validation {
            background-color: #ffe200;
            font-style:italic;
        }
    </style>

        <h2><?php _e('Export and Short Code Builder', 'contact-form-7-to-database-extension') ?></h2>
    <?php // FORM  ?>
    <div class="shortcodeoptions" style="margin-top:10px;">
        <div class="label_box"><label for="form_name_cntl"><?php _e('form', 'contact-form-7-to-database-extension') ?></label></div>
        <select name="form_name_cntl" id="form_name_cntl">
            <option value=""><?php _e('* Select a form *', 'contact-form-7-to-database-extension') ?></option>
            <?php foreach ($rows as $aRow) {
            $formName = $aRow->form_name;
            ?>
            <option value="<?php echo $formName ?>"><?php echo $formName ?></option>
            <?php } ?>
        </select>

        <?php // RESET  ?>
        <span style="margin-left:10px">
            <button id="reset_button"><?php _e('Reset', 'contact-form-7-to-database-extension') ?></button>
        </span>

        <div id="form_validations_text" class="validation"></div>
    </div>

    <?php // EXPORT  ?>
    <div class="shortcodeoptions">
        <label for="export_cntl"><?php _e('Export File', 'contact-form-7-to-database-extension') ?></label>
        <select id="export_cntl" name="export_cntl">
            <option value=""></option>
            <option value="CSVUTF8BOM">
                <?php _e('Excel CSV (UTF8-BOM)', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="TSVUTF16LEBOM">
                <?php _e('Excel TSV (UTF16LE-BOM)', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="CSVUTF8">
                <?php _e('Plain CSV (UTF-8)', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="CSVSJIS">
                <?php _e('Excel CSV for Japanese (Shift-JIS)', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="IQY">
                <?php _e('Excel Internet Query', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="GLD">
                <?php _e('Google Spreadsheet Live Data', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="RSS">
                <?php _e('RSS', 'contact-form-7-to-database-extension'); ?>
            </option>
            <option value="JSON">
                <?php _e('JSON', 'contact-form-7-to-database-extension'); ?>
            </option>
        </select>
        <span  id="itemtitle_span">
            <label for="add_itemtitle"><?php _e('Item Title', 'contact-form-7-to-database-extension') ?></label>
            <select name="add_itemtitle" id="add_itemtitle"></select>
        </span>
        <span id="userpass_span">
            <br/>
            <span id="gld_userpass_span_msg">
            <?php _e('Provide a WP login for the Google Spreadsheet to use to connect to your WP site', 'contact-form-7-to-database-extension'); ?>
            </span>
            <span id="userpass_span_msg" style="display: none">
            <?php _e('Optional: provide a WP login for the link to work without being already logged in', 'contact-form-7-to-database-extension'); ?>
            </span>
            <br/>
            <label for="gld_user"><?php _e('WP User', 'contact-form-7-to-database-extension') ?></label>
            <input id="gld_user" type="text" value="<?php echo $userName; ?>"/>
            <label for="gld_pass"><?php _e('WP Password', 'contact-form-7-to-database-extension') ?></label>
            <input id="gld_pass" type="password" value=""/>
            <input id="obfuscate_cntl" type="checkbox" checked/><?php _e('Hide Credentials', 'contact-form-7-to-database-extension') ?>
        </span>

        <div id="export_result_div">
            <span id="label_export_link"><?php _e('Generated Export Link:', 'contact-form-7-to-database-extension'); ?></span>
            <span id="label_gld_function" style="display:none">
                <?php _e('Enter this function into a cell in your Google Spreadsheet:', 'contact-form-7-to-database-extension'); ?>
            </span>
            <span id="label_gld_script" style="display:none">
                <?php _e('Generated Google Spreadsheet Function:', 'contact-form-7-to-database-extension'); ?>
                <?php _e('Replace <strong>&lt;password&gt;</strong> with your <em>WordPress</em> password', 'contact-form-7-to-database-extension'); ?>
                <br/>
                <?php _e('Requires code installed in your Google Spreadsheet script editor.'); ?>
                <a target="code" href="<?php echo $siteUrl ?>/wp-content/plugins/contact-form-7-to-database-extension/CFDBGoogleSSLiveData.php"><?php _e('Get code'); ?></a>.
                <a target="instructions" href="<?php echo $siteUrl ?>/wp-admin/admin-ajax.php?action=cfdb-export&enc=GLD&form=<?php echo $postedForm ?>"><?php _e('See instructions.'); ?></a>
          </span>
            <br/><div class="generated" id="export_result_text"></div>
        </div>
        <div id="export_validations_text" class="validation"></div>
    </div>


    <?php // SHORT CODE  ?>
    <div class="shortcodeoptions">
        <div style="margin-bottom:10px">
            <div class="label_box"><label
                    for="shortcode_ctrl"><?php _e('Short Code', 'contact-form-7-to-database-extension') ?></label>
            </div>
            <select name="shortcode_ctrl" id="shortcode_ctrl">
                <option value=""><?php _e('* Select a short code *', 'contact-form-7-to-database-extension') ?></option>
                <option value="[cfdb-html]">[cfdb-html]</option>
                <option value="[cfdb-table]">[cfdb-table]</option>
                <option value="[cfdb-datatable]">[cfdb-datatable]</option>
                <option value="[cfdb-value]">[cfdb-value]</option>
                <option value="[cfdb-count]">[cfdb-count]</option>
                <option value="[cfdb-json]">[cfdb-json]</option>
                <option value="[cfdb-export-link]">[cfdb-export-link]</option>
            </select>
            <a id="doc_url_tag" target="_docs"
               href="http://cfdbplugin.com/?page_id=89"><?php _e('Documentation', 'contact-form-7-to-database-extension'); ?></a>
            <br/>
        </div>


        <div id="shortcode_result_div">
            <?php _e('Generated Short Code:', 'contact-form-7-to-database-extension'); ?>
            <br/><div class="generated" id="shortcode_result_text"></div>
        </div>
        <div id="shortcode_validations_text" class="validation"></div>
        <span style="font-size: x-small;">
            <a target="_docs"
               href="http://cfdbplugin.com/?page_id=444"><?php _e('(Did you know: you can create your own short code)', 'contact-form-7-to-database-extension'); ?></a>
        </span>

    </div>

    <div id="security_div" class="shortcodeoptions">
        <?php _e('Security', 'contact-form-7-to-database-extension'); ?>
        <div>
            <div class="label_box">
                <label for="role_cntl"><?php _e('role', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#role"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="role_cntl" name="role_cntl">
                <option value=""></option>
                <option value="Administrator"><?php _e('Administrator', 'contact-form-7-to-database-extension') ?></option>
                <option value="Editor"><?php _e('Editor', 'contact-form-7-to-database-extension') ?></option>
                <option value="Author"><?php _e('Author', 'contact-form-7-to-database-extension') ?></option>
                <option value="Contributor"><?php _e('Contributor', 'contact-form-7-to-database-extension') ?></option>
                <option value="Subscriber"><?php _e('Subscriber', 'contact-form-7-to-database-extension') ?></option>
                <option value="Anyone"><?php _e('Anyone', 'contact-form-7-to-database-extension') ?></option>
            </select>
            <div class="label_box">
                <label for="permissionmsg_cntl"><?php _e('permissionmsg', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#permissionmsg"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="permissionmsg_cntl" name="permissionmsg_cntl">
                <option value=""></option>
                <option value="true"><?php _e('true', 'contact-form-7-to-database-extension') ?></option>
                <option value="false"><?php _e('false', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
    </div>
    <?php // SHOW HIDE ?>
    <div id="show_hide_div" class="shortcodeoptions">
        <?php _e('Which fields/columns do you want to display?', 'contact-form-7-to-database-extension'); ?>
        <div>
            <div class="label_box">
                <label for="show_cntl"><?php _e('show', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#show"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_show" id="add_show"></select><button id="btn_show">&raquo;</button>
            <input name="show_cntl" id="show_cntl" type="text" size="100" placeholder="<?php _e('field1,field2,field3', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="hide_cntl"><?php _e('hide', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#hide"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_hide" id="add_hide"></select><button id="btn_hide">&raquo;</button>
            <input name="hide_cntl" id="hide_cntl" type="text" size="100" placeholder="<?php _e('field1,field2,field3', 'contact-form-7-to-database-extension') ?>"/>
        </div>
    </div>
    <?php // SEARCH FILTER  ?>
    <div id="filter_div" class="shortcodeoptions">
        <div><?php _e('Which rows/submissions do you want to display?', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="search_cntl"><?php _e('search', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#search"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="search_cntl" id="search_cntl" type="text" size="30" placeholder="<?php _e('search text', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="filter_cntl"><?php _e('filter', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#filter"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="filter_bool" id="filter_bool">
                <option value="&&">&&</option>
                <option value="||">||</option>
            </select>
            <select name="add_filter" id="add_filter"></select>
            <select name="filter_op" id="filter_op">
                <option value="=">=</option>
                <option value="!=">!=</option>
                <option value=">">></option>
                <option value="<"><</option>
                <option value="<="><=</option>
                <option value="<="><=</option>
                <option value="===">===</option>
                <option value="!==">!==</option>
                <option value="~~">~~</option>
            </select>
            <input name="filter_val" id="filter_val" type="text" size="20" placeholder="<?php _e('value', 'contact-form-7-to-database-extension') ?>"/>
            <button id="btn_filter">&raquo;</button>
            <span id="span_validate_submit_time" style="display:none;">
                <button id="btn_validate_submit_time"><?php _e('Validate submit_time', 'contact-form-7-to-database-extension'); ?></button>
                <a target="_blank" href="http://cfdbplugin.com/?page_id=553"><?php _e('Formats', 'contact-form-7-to-database-extension'); ?></a>
            </span>
            <br/>
            <input name="filter_cntl" id="filter_cntl" type="text" size="100" placeholder="<?php _e('filter expression', 'contact-form-7-to-database-extension') ?>"/>
        </div>
    </div>
    <?php // LIMIT, ORDER BY, RANDOM ?>
    <div id="limitorder_div" class="shortcodeoptions">
        <div>
            <div class="label_box">
                <label for="limit_rows_cntl"><?php _e('limit', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#limit"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <?php _e('Num Rows', 'contact-form-7-to-database-extension') ?> <input name="limit_rows_cntl" id="limit_rows_cntl" type="text" size="10" placeholder="<?php _e('number', 'contact-form-7-to-database-extension') ?>"/>
            <?php _e('Start Row (0)', 'contact-form-7-to-database-extension') ?> <input name="limit_start_cntl" id="limit_start_cntl" type="text" size="10" placeholder="<?php _e('number', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="unbuffered_cntl"><?php _e('unbuffered', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?p=696"><img alt="?" src="<?php echo $infoImg ?>"/></a>
                <input id="unbuffered_cntl" type="checkbox" <?php echo $postedUnbuffered == 'true' ? 'checked' : ''?>/>
            </div>
        </div>
        <div>
            <div class="label_box">
                <label for="random_cntl"><?php _e('random', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#random"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="random_cntl" id="random_cntl" type="text" size="10" placeholder="<?php _e('number', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div id="orderby_div">
            <div class="label_box">
                <label for="orderby_cntl"><?php _e('orderby', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=89#orderby"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_orderby" id="add_orderby"></select><button id="btn_orderby" placeholder="<?php _e('field', 'contact-form-7-to-database-extension') ?>">&raquo;</button>
            <input name="orderby_cntl" id="orderby_cntl" type="text" size="100" placeholder="<?php _e('field1,field2,field3', 'contact-form-7-to-database-extension') ?>"/>
            <select id="orderbydir_cntl" name="orderbydir_cntl">
                <option value=""></option>
                <option value="ASC"><?php _e('ASC', 'contact-form-7-to-database-extension') ?></option>
                <option value="DESC"><?php _e('DESC', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
    </div>
    <?php // HEADERS  ?>
    <div id="headers_div" class="shortcodeoptions">
        <div><?php _e('Table Headers', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <input id="header_cntl" type="checkbox" checked/>
                <label for="header_cntl"><?php _e('Include Header Row', 'contact-form-7-to-database-extension') ?></label>
            </div>
        </div>
        <div>
            <div class="label_box">
                <label for="headers_cntl"><?php _e('headers', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=93#headers"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_headers" id="add_headers"></select>
            <?php _e('display as', 'contact-form-7-to-database-extension') ?>
            <input name="headers_val" id="headers_val" type="text" size="20" placeholder="<?php _e('display value', 'contact-form-7-to-database-extension') ?>"/>
            <button id="btn_headers">&raquo;</button>
            <br/>
            <input name="headers_cntl" id="headers_cntl" type="text" size="100" placeholder="<?php _e('field1=Display Name 1,field2=Display Name 2', 'contact-form-7-to-database-extension') ?>"/>
        </div>
    </div>
    <?php // ID, CLASS, STYLE  ?>
    <div id="html_format_div" class="shortcodeoptions">
        <div><?php _e('HTML Table Formatting', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="id_cntl"><?php _e('id', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=93#id"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="id_cntl" id="id_cntl" type="text" size="10" placeholder="<?php _e('HTML id', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="class_cntl"><?php _e('class', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=93#class"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="class_cntl" id="class_cntl" type="text" size="10" placeholder="<?php _e('HTML class', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="style_cntl"><?php _e('style', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=93#style"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="style_cntl" id="style_cntl" type="text" size="100" placeholder="<?php _e('CSS style', 'contact-form-7-to-database-extension') ?>"/>
        </div>
    </div>
    <?php // DT_OPTIONS  ?>
    <div id="dt_options_div" class="shortcodeoptions">
        <div><?php _e('[cfdb-datatable] Options', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="edit_mode_cntl"><?php _e('edit', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=91#edit"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input type="checkbox" id="edit_mode_cntl" name="edit_mode_cntl" />
        </div>
        <div>
            <div class="label_box">
                <label for="dt_options_cntl"><?php _e('dt_options', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=91#dt_options"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="dt_options_cntl" id="dt_options_cntl" type="text" size="100" placeholder="<?php _e('datatable options (JSON)', 'contact-form-7-to-database-extension') ?>"/>
        </div>
    </div>
    <?php // JSON VAR, FORMAT  ?>
    <div id="json_div" class="shortcodeoptions">
        <div><?php _e('[cfdb-json] Options', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="var_cntl"><?php _e('var', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=96#var"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="var_cntl" id="var_cntl" type="text" size="10" placeholder="<?php _e('JS var name', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="format_cntl"><?php _e('format', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=96#format"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="format_cntl" name="format_cntl">
                <option value=""></option>
                <option value="map"><?php _e('map', 'contact-form-7-to-database-extension') ?></option>
                <option value="array"><?php _e('array', 'contact-form-7-to-database-extension') ?></option>
                <option value="arraynoheader"><?php _e('arraynoheader', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
    </div>
    <?php // VALUE FUNCTION, DELIMITER  ?>
    <div id="value_div" class="shortcodeoptions">
        <div><?php _e('[cfdb-value] Options', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="function_cntl"><?php _e('function', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=98#function"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="function_cntl" name="function_cntl">
                <option value=""></option>
                <option value="min"><?php _e('min', 'contact-form-7-to-database-extension') ?></option>
                <option value="max"><?php _e('max', 'contact-form-7-to-database-extension') ?></option>
                <option value="sum"><?php _e('sum', 'contact-form-7-to-database-extension') ?></option>
                <option value="mean"><?php _e('mean', 'contact-form-7-to-database-extension') ?></option>
                <option value="percent"><?php _e('percent', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
        <div>
            <div class="label_box">
                <label for="delimiter_cntl"><?php _e('delimiter', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=98#delimiter"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="delimiter_cntl" id="delimiter_cntl" type="text" size="10"/>
        </div>
    </div>
    <?php // HTML TEMPLATE  ?>
    <div id="template_div" class="shortcodeoptions">
        <div><?php _e('[cfdb-html] Options', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="filelinks_cntl"><?php _e('filelinks', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#filelinks"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="filelinks_cntl" name="filelinks_cntl">
                <option value=""></option>
                <option value="url"><?php _e('url', 'contact-form-7-to-database-extension') ?></option>
                <option value="name"><?php _e('name', 'contact-form-7-to-database-extension') ?></option>
                <option value="link"><?php _e('link', 'contact-form-7-to-database-extension') ?></option>
                <option value="img"><?php _e('img', 'contact-form-7-to-database-extension') ?></option>
            </select>
            <div class="label_box">
                <label for="stripbr_cntl"><?php _e('stripbr', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#stripbr"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="stripbr_cntl" name="stripbr_cntl">
                <option value=""></option>
                <option value="false"><?php _e('false', 'contact-form-7-to-database-extension') ?></option>
                <option value="true"><?php _e('true', 'contact-form-7-to-database-extension') ?></option>
            </select>
            <div class="label_box">
                <label for="wpautop_cntl" style="text-decoration:line-through;"><?php _e('wpautop', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#wpautop"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="wpautop_cntl" name="wpautop_cntl">
                <option value=""></option>
                <option value="false"><?php _e('false', 'contact-form-7-to-database-extension') ?></option>
                <option value="true"><?php _e('true', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
        <div>
            <div class="label_box">
                <label for="content_cntl"><?php _e('Template', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#template"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_content" id="add_content"></select><button id="btn_content">&raquo;</button><br/>
            <textarea name="content_cntl" id="content_cntl" cols="100" rows="10" placeholder="<?php _e('Per-entry HTML using ${field name} variables', 'contact-form-7-to-database-extension') ?>"></textarea>
        </div>
    </div>
    <?php // URL ENC, URL_ONLY LINK_TEXT      ?>
    <div id="url_link_div" class="shortcodeoptions">
        <div><?php _e('[cfdb-export-link] Options', 'contact-form-7-to-database-extension'); ?></div>
        <div>
            <div class="label_box">
                <label for="enc_cntl"><?php _e('enc', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=419"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="enc_cntl" name="enc_cntl">
                <option value=""></option>
                <option id="CSVUTF8BOM" value="CSVUTF8BOM">
                    <?php _e('Excel CSV (UTF8-BOM)', 'contact-form-7-to-database-extension'); ?>
                </option>
                <option id="TSVUTF16LEBOM" value="TSVUTF16LEBOM">
                    <?php _e('Excel TSV (UTF16LE-BOM)', 'contact-form-7-to-database-extension'); ?>
                </option>
                <option id="CSVUTF8" value="CSVUTF8">
                    <?php _e('Plain CSV (UTF-8)', 'contact-form-7-to-database-extension'); ?>
                </option>
                <option value="CSVSJIS">
                    <?php _e('Excel CSV for Japanese (Shift-JIS)', 'contact-form-7-to-database-extension'); ?>
                </option>
                <option id="IQY" value="IQY">
                    <?php _e('Excel Internet Query', 'contact-form-7-to-database-extension'); ?>
                </option>
            </select>
        </div>
        <div>
            <div class="label_box">
                <label for="urlonly_cntl"><?php _e('urlonly', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=419#urlonly"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select id="urlonly_cntl" name="urlonly_cntl">
                <option value=""></option>
                <option value="true"><?php _e('true', 'contact-form-7-to-database-extension') ?></option>
                <option value="false"><?php _e('false', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
        <div>
            <div class="label_box">
                <label for="linktext_cntl"><?php _e('linktext', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=419#linktext"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="linktext_cntl" id="linktext_cntl" type="text" size="30"/>
        </div>
    </div>
    <?php // BEFORE and AFTER  ?>
    <div id="beforeafter_div" class="shortcodeoptions">
        <div>
            <div class="label_box">
                <label for="before_cntl"><?php _e('Before', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#before"><img alt="?" src="<?php echo $infoImg ?>"/></a><br/>
            </div>
            <br/>
            <textarea name="before_cntl" id="before_cntl" cols="100" rows="5" placeholder="<?php _e('Optional HTML/Javascript before the short code output', 'contact-form-7-to-database-extension') ?>"></textarea>
        </div>
        <div>
            <div class="label_box">
                <label for="after_cntl"><?php _e('After', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=284#after"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <br/>
            <textarea name="after_cntl" id="after_cntl" cols="100" rows="5" placeholder="<?php _e('Optional HTML/Javascript after the short code output', 'contact-form-7-to-database-extension') ?>"></textarea>
        </div>
    </div>
    <?php // TRANS ?>
    <div id="trans_div" class="shortcodeoptions">
        <?php _e('Transform', 'contact-form-7-to-database-extension'); ?>
        <div>
            <div class="label_box">
                <label for="trans_cntl"><?php _e('trans', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=1118#trans"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_trans" id="add_trans"></select>
            <input name="trans_val" id="trans_val" type="text" size="20" placeholder="<?php _e('PHP function or class', 'contact-form-7-to-database-extension') ?>"/>
            <button id="btn_trans">&raquo;</button>
            <br/>
            <input name="trans_cntl" id="trans_cntl" type="text" size="100" placeholder="<?php _e('transform expression', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="tsearch_cntl"><?php _e('tsearch', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=1118#tsearch"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <input name="tsearch_cntl" id="tsearch_cntl" type="text" size="30" placeholder="<?php _e('search text', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="tfilter_cntl"><?php _e('tfilter', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=1118#tfilter"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="tfilter_bool" id="tfilter_bool">
                <option value="&&">&&</option>
                <option value="||">||</option>
            </select>
            <select name="add_tfilter" id="add_tfilter"></select>
            <select name="tfilter_op" id="tfilter_op">
                <option value="=">=</option>
                <option value="!=">!=</option>
                <option value=">">></option>
                <option value="<"><</option>
                <option value="<="><=</option>
                <option value="<="><=</option>
                <option value="===">===</option>
                <option value="!==">!==</option>
                <option value="~~">~~</option>
            </select>
            <input name="tfilter_val" id="tfilter_val" type="text" size="20" placeholder="<?php _e('value', 'contact-form-7-to-database-extension') ?>"/>
            <button id="btn_tfilter">&raquo;</button>
            <span id="span_validate_submit_time" style="display:none;">
                <button id="btn_validate_submit_time"><?php _e('Validate submit_time', 'contact-form-7-to-database-extension'); ?></button>
                <a target="_blank" href="http://cfdbplugin.com/?page_id=553"><?php _e('Formats', 'contact-form-7-to-database-extension'); ?></a>
            </span>
            <br/>
            <input name="tfilter_cntl" id="tfilter_cntl" type="text" size="100" placeholder="<?php _e('filter expression', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div>
            <div class="label_box">
                <label for="tlimit_rows_cntl"><?php _e('tlimit', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=1118#tlimit"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <?php _e('Num Rows', 'contact-form-7-to-database-extension') ?> <input name="tlimit_rows_cntl" id="tlimit_rows_cntl" type="text" size="10" placeholder="<?php _e('number', 'contact-form-7-to-database-extension') ?>"/>
            <?php _e('Start Row (0)', 'contact-form-7-to-database-extension') ?> <input name="tlimit_start_cntl" id="tlimit_start_cntl" type="text" size="10" placeholder="<?php _e('number', 'contact-form-7-to-database-extension') ?>"/>
        </div>
        <div id="torderby_div">
            <div class="label_box">
                <label for="torderby_cntl"><?php _e('torderby', 'contact-form-7-to-database-extension') ?></label>
                <a target="_docs" href="http://cfdbplugin.com/?page_id=1118#torderby"><img alt="?" src="<?php echo $infoImg ?>"/></a>
            </div>
            <select name="add_torderby" id="add_torderby"></select><button id="btn_torderby" placeholder="<?php _e('field', 'contact-form-7-to-database-extension') ?>">&raquo;</button>
            <input name="torderby_cntl" id="torderby_cntl" type="text" size="100" placeholder="<?php _e('field1,field2,field3', 'contact-form-7-to-database-extension') ?>"/>
            <select id="torderbydir_cntl" name="torderbydir_cntl">
                <option value=""></option>
                <option value="ASC"><?php _e('ASC', 'contact-form-7-to-database-extension') ?></option>
                <option value="DESC"><?php _e('DESC', 'contact-form-7-to-database-extension') ?></option>
            </select>
        </div>
    </div>
    <?php

    }
}
