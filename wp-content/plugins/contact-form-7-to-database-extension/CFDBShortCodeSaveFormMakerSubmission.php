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

require_once('ShortCodeLoader.php');

class CFDBShortCodeSaveFormMakerSubmission extends ShortCodeLoader {

    const FORM_TITLE_FIELD = 'form_title';
    const DEFAULT_FORM_TITLE = 'Form Maker';


    /**
     * @param $atts array (associative) of shortcode inputs
     * @param $content string inner content of short code
     * @return string shortcode content
     */
    public function handleShortcode($atts, $content = null) {
//        echo '<pre>';
//        print_r($_POST);
//        echo "\n";
//        print_r($_FILES);
//        echo '</pre>';

        if (is_array($_POST) && !empty($_POST)) {
            $title = isset($_POST[self::FORM_TITLE_FIELD]) ? $_POST[self::FORM_TITLE_FIELD] : self::DEFAULT_FORM_TITLE;
            $posted_data = array();
            $uploaded_files = array();

            // Get posted values
            foreach ($_POST as $key => $val) {
                $posted_data[$key] = $val;
            }


            // Deal with upload files
            // $_FILES = Array (
            //    [your-upload] => Array
            //        (
            //            [name] => readme.txt
            //            [type] => text/plain
            //            [tmp_name] => /tmp/php3tQ1zg
            //            [error] => 0
            //            [size] => 1557
            //        )
            //)
            if (is_array($_FILES) && !empty($_FILES)) {
                foreach ($_FILES as $key => $file) {
                    if (is_uploaded_file($file['tmp_name'])) {
                        $posted_data[$key] = $file['name'];
                        $uploaded_files[$key] = $file['tmp_name'];
                    }
                }
            }


            // Prepare data structure for call to hook
            $data = (object)array('title' => $title,
                    'posted_data' => $posted_data,
                    'uploaded_files' => $uploaded_files);

            // Call hook to submit data
            do_action_ref_array('cfdb_submit', array(&$data));
        }
    }

}