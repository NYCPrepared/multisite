<?php
/*
    "Contact Form to Database" Copyright (C) 2011-2012 Michael Simpson  (email : michael.d.simpson@gmail.com)

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

require_once('ExportBase.php');
require_once('CFDBExport.php');

class ExportToHtmlTemplate extends ExportBase implements CFDBExport {

    /**
     * @param $formName string
     * @param $options array of option_name => option_value
     * @return void|string
     */
    public function export($formName, $options = null) {
        $this->setOptions($options);
        $this->setCommonOptions(true);

        $filelinks = '';
        $wpautop = false;
        $stripBR = false;
        if ($this->options && is_array($this->options)) {
            if (isset($this->options['filelinks'])) {
                $filelinks = $this->options['filelinks'];
            }
            if (isset($this->options['wpautop'])) {
                $wpautop = $this->options['wpautop'] == 'true';
            }
            if (isset($this->options['stripbr'])) {
                $stripBR = $this->options['stripbr'] == 'true';
            }
        }

        // Security Check
        if (!$this->isAuthorized()) {
            $this->assertSecurityErrorMessage();
            return;
        }

        // Headers
        $this->echoHeaders('Content-Type: text/html; charset=UTF-8');


        if (empty($options) || !isset($options['content'])) {
            return;
        }

        if ($this->isFromShortCode) {
            ob_start();
        }

        // Get the data
        $submitTimeKeyName = 'Submit_Time_Key';
        $this->setDataIterator($formName, $submitTimeKeyName);


        $matches = array();
        preg_match_all('/\$\{([^}]+)\}/', $options['content'], $matches);

        $colNamesToSub = array();
        $varNamesToSub = array();
        if (!empty($matches) && is_array($matches[1])) {
            foreach ($matches[1] as $aSubVar) {
                // Each is expected to be a name of a column
                if (in_array($aSubVar, $this->dataIterator->displayColumns)) {
                    $colNamesToSub[] = $aSubVar;
                    $varNamesToSub[] = '${' . $aSubVar . '}';
                }
                else if ($aSubVar == 'submit_time') {
                    $colNamesToSub[] = 'submit_time';
                    $varNamesToSub[] = '${submit_time}';
                }
            }
        }


        // WordPress likes to wrap the content in <br />content<p> which messes up things when
        // you are putting
        //   <tr><td>stuff<td></tr>
        // as the content because it comes out
        //   <br /><tr><td>stuff<td></tr><p>
        // which messed up the table html.
        // So we try to identify that and strip it out.
        // This is related to http://codex.wordpress.org/Function_Reference/wpautop
        // see also http://wordpress.org/support/topic/shortcodes-are-wrapped-in-paragraph-tags?replies=4
        if (!$wpautop) {
            //echo 'Initial: \'' . htmlentities($options['content']) . '\'';
            if (substr($options['content'], 0, 6) == '<br />' &&
                substr($options['content'], -3, 3) == '<p>') {
                $options['content'] = substr($options['content'], 6, strlen($options['content']) - 6 - 3);
            }
            if (substr($options['content'], 0, 4) == '</p>' &&
                substr($options['content'], -3, 3) == '<p>') {
                $options['content'] = substr($options['content'], 4, strlen($options['content']) - 4 - 3);
            }
            //echo '<br/>Stripped: \'' . htmlentities($options['content']) . '\'';
        }

        if ($stripBR) {
            // Strip out BR tags presumably injected by wpautop
            $options['content'] = str_replace('<br />', '', $options['content']);
        }

        // Evaluation IF-expressions
        // todo: modify $options['content']

        while ($this->dataIterator->nextRow()) {
            // Evaluation IF-expressions
            // todo: modify $options['content']

            if (empty($colNamesToSub)) {
                // Process nested short codes
                echo do_shortcode($options['content']);
            }
            else {
                $fields_with_file = null;
                if ($filelinks != 'name' &&
                    isset($this->dataIterator->row['fields_with_file']) &&
                    $this->dataIterator->row['fields_with_file'] != null) {
                    $fields_with_file = explode(',', $this->dataIterator->row['fields_with_file']);
                }
                $replacements = array();
                foreach ($colNamesToSub as $aCol) {
                    if ($fields_with_file && in_array($aCol, $fields_with_file)) {
                        switch ($filelinks) {
                            case 'url':
                                $replacements[] = $this->plugin->getFileUrl($this->dataIterator->row[$submitTimeKeyName], $formName, $aCol);
                                break;
                            case 'link':
                                $replacements[] =
                                        '<a href="' .
                                        $this->plugin->getFileUrl($this->dataIterator->row[$submitTimeKeyName], $formName, $aCol) .
                                        '">' .
                                        htmlentities($this->dataIterator->row[$aCol], null, 'UTF-8') .
                                        '</a>';
                                break;
                            case 'image':
                            case 'img':
                                $replacements[] =
                                        '<img src="' .
                                        $this->plugin->getFileUrl($this->dataIterator->row[$submitTimeKeyName], $formName, $aCol) .
                                        '" alt="' .
                                        htmlentities($this->dataIterator->row[$aCol], null, 'UTF-8') .
                                        '" />';
                                break;
                            case 'name':
                            default:
                                $replacements[] = htmlentities($this->dataIterator->row[$aCol], null, 'UTF-8');
                        }
                    }
                    else {
                        $replacements[] = htmlentities($this->dataIterator->row[$aCol], null, 'UTF-8');
                    }
                }
                // Preserve line breaks in the field
                foreach ($replacements as $i => $repl) {
                    $replacements[$i] = nl2br($replacements[$i]); // preserve line breaks
                }
                // Process nested short codes
                echo do_shortcode(str_replace($varNamesToSub, $replacements, $options['content']));
            }
        }

        if ($this->isFromShortCode) {
            // If called from a shortcode, need to return the text,
            // otherwise it can appear out of order on the page
            $output = ob_get_contents();
            ob_end_clean();
            return $output;
        }

    }


}
