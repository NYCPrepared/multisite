<?php
/*
 * main class of User Role Editor WordPress plugin
 * Author: Vladimir Garagulya
 * Author email: support@role-editor.com
 * Author URI: https://www.role-editor.com
 * License: GPL v2+
 * 
*/

class User_Role_Editor {
    // common code staff, including options data processor
    protected $lib = null;
    
    // plugin's Settings page reference, we've got it from add_options_pages() call
    protected $setting_page_hook = null;
    // URE's key capability
    public $key_capability = 'not allowed';
	
    // URE pages hook suffixes
    protected $ure_hook_suffixes = null;
    
    /**
     * class constructor
     */
    function __construct($library) {

        // get plugin specific library object
        $this->lib = $library;        
        if ($this->lib->is_pro()) {
         $this->ure_hook_suffixes = array('settings_page_settings-user-role-editor-pro', 'users_page_users-user-role-editor-pro');         
        } else {
         $this->ure_hook_suffixes = array('settings_page_settings-user-role-editor', 'users_page_users-user-role-editor');
        }
        
        // activation action
        register_activation_hook(URE_PLUGIN_FULL_PATH, array($this, 'setup'));

        // deactivation action
        register_deactivation_hook(URE_PLUGIN_FULL_PATH, array($this, 'cleanup'));
        		
        // Who may use this plugin
        $this->key_capability = $this->lib->get_key_capability();
        
        if ($this->lib->multisite) {
            // new blog may be registered not at admin back-end only but automatically after new user registration, e.g. 
            // Gravity Forms User Registration Addon does
            add_action( 'wpmu_new_blog', array($this, 'duplicate_roles_for_new_blog'), 10, 2);                        
        }
        
        if (!is_admin()) {
            return;
        }
        
        add_action('admin_init', array($this, 'plugin_init'), 1);

        // Add the translation function after the plugins loaded hook.
        add_action('plugins_loaded', array($this, 'load_translation'));

        // add own submenu 
        add_action('admin_menu', array($this, 'plugin_menu'));
      		
        if ($this->lib->multisite) {
            // add own submenu 
            add_action('network_admin_menu', array($this, 'network_plugin_menu'));
        }


        // add a Settings link in the installed plugins page
        add_filter('plugin_action_links_'. URE_PLUGIN_BASE_NAME, array($this, 'plugin_action_links'), 10, 1);

        add_filter('plugin_row_meta', array($this, 'plugin_row_meta'), 10, 2);
        
    }
    // end of __construct()

    
  /**
   * Plugin initialization
   * 
   */
  public function plugin_init() {

    global $current_user;

    if (!empty($current_user->ID)) {
      $user_id = $current_user->ID;
    } else {
      $user_id = 0;
    }

    // these filters and actions should prevent editing users with administrator role
    // by other users with 'edit_users' capability
    if (!$this->lib->user_is_admin($user_id)) {
      // Exclude administrator role from edit list.
      add_filter('editable_roles', array($this, 'exclude_admin_role' ) );
      // prohibit any actions with user who has Administrator role
      add_filter('user_has_cap', array($this, 'not_edit_admin' ), 10, 3);
      // exclude users with 'Administrator' role from users list
      add_action('pre_user_query', array($this, 'exclude_administrators' ) );
      // do not show 'Administrator (s)' view above users list
      add_filter('views_users',  array($this, 'exclude_admins_view' ) );            
    }
    
    add_action( 'admin_enqueue_scripts', array($this, 'admin_load_js' ) );
    add_action( 'user_row_actions', array($this, 'user_row'), 10, 2 );
    add_action( 'edit_user_profile', array($this, 'edit_user_profile'), 10, 2 );
    add_filter( 'manage_users_columns', array($this, 'user_role_column'), 10, 1 );
    add_filter( 'manage_users_custom_column', array($this, 'user_role_row'), 10, 3 );
    add_action( 'profile_update', array($this, 'user_profile_update'), 10 );
    add_filter( 'all_plugins', array($this, 'exclude_from_plugins_list' ) );
    
    if ($this->lib->multisite) {          
        add_action( 'wpmu_activate_user', array($this, 'add_other_default_roles'), 10, 1 );
        
        $allow_edit_users_to_not_super_admin = $this->lib->get_option('allow_edit_users_to_not_super_admin', 0);
        if ($allow_edit_users_to_not_super_admin) {
            add_filter( 'map_meta_cap', array($this, 'restore_users_edit_caps'), 1, 4 );
            remove_all_filters( 'enable_edit_any_user_configuration' );
            add_filter( 'enable_edit_any_user_configuration', '__return_true');
            add_filter( 'admin_head', array($this, 'edit_user_permission_check'), 1, 4 );
        }
    } else {
        add_action( 'user_register', array($this, 'add_other_default_roles'), 10, 1 );
        $count_users_without_role = $this->lib->get_option('count_users_without_role', 0);
        if ($count_users_without_role) {
            add_action( 'restrict_manage_users', array($this, 'move_users_from_no_role_button') );
            add_action( 'admin_init', array($this, 'add_css_to_users_page'));
            add_action( 'admin_footer', array($this, 'add_js_to_users_page') );
        }
    }
    
    add_action('wp_ajax_ure_ajax', array($this, 'ure_ajax'));

  }
  // end of plugin_init()
    
  
  public function move_users_from_no_role_button() {
      
      global $wpdb;
      
      if ( stripos($_SERVER['REQUEST_URI'], 'wp-admin/users.php')===false ) {
            return;
      }
      
      $id = get_current_blog_id();
      $blog_prefix = $wpdb->get_blog_prefix($id);
      $query = "select count(ID) from {$wpdb->users} users
                    where not exists (select user_id from {$wpdb->usermeta}
                                          where user_id=users.ID and meta_key='{$blog_prefix}capabilities') or
                          exists (select user_id from {$wpdb->usermeta}
                                    where user_id=users.ID and meta_key='{$blog_prefix}capabilities' and meta_value='a:0:{}')                ;";
      $users_count = $wpdb->get_var($query);
      if ($users_count>0) {
?>          
        &nbsp;&nbsp;<input type="button" name="move_from_no_role" id="move_from_no_role" class="button"
                        value="Without role (<?php echo $users_count;?>)" onclick="ure_move_users_from_no_role_dialog()">
        <div id="move_from_no_role_dialog" class="ure-dialog">
            <div id="move_from_no_role_content" style="padding: 10px;">
                To: <select name="ure_new_role" id="ure_new_role">
                    <option value="no_rights">No rights</option>
                </select><br>    
            </div>                
        </div>
<?php        
      }
      
  }
  // end of move_users_from_no_role()
  
  
  public function add_css_to_users_page() {
      if ( stripos($_SERVER['REQUEST_URI'], 'wp-admin/users.php')===false ) {
            return;
      }
      wp_enqueue_style('wp-jquery-ui-dialog');
      wp_enqueue_style('ure-admin-css', URE_PLUGIN_URL . 'css/ure-admin.css', array(), false, 'screen');
      
  }
  // end of add_css_to_users_page()
  
  
  public function add_js_to_users_page() {
  
      if ( stripos($_SERVER['REQUEST_URI'], 'wp-admin/users.php')===false ) {
            return;
      }
      
      wp_enqueue_script('jquery-ui-dialog', false, array('jquery-ui-core','jquery-ui-button', 'jquery') );
      wp_register_script( 'ure-users-js', plugins_url( '/js/ure-users.js', URE_PLUGIN_FULL_PATH ) );
      wp_enqueue_script ( 'ure-users-js' );      
      wp_localize_script( 'ure-users-js', 'ure_users_data', array(
        'wp_nonce' => wp_create_nonce('user-role-editor'),
        'move_from_no_role_title' => esc_html__('Change role for users without role', 'ure'),
        'no_rights_caption' => esc_html__('No rights', 'ure'),  
        'provide_new_role_caption' => esc_html__('Provide new role', 'ure')
              ));
      
  }
  // end of add_js_to_users_page()
  
  
  public function add_other_default_roles($user_id) {
      
      if (empty($user_id)) {
          return;
      }
      $user = get_user_by('id', $user_id);
      if (empty($user->ID)) {
          return;
      }
      $other_default_roles = $this->lib->get_option('other_default_roles', array());
      if (count($other_default_roles)==0) {
          return;
      }
      foreach($other_default_roles as $role) {
          $user->add_role($role);
      }
      
  }
  // end of add_other_default_roles()
  
  
  /**
   * restore edit_users, delete_users, create_users capabilities for non-superadmin users under multisite
   * (code is provided by http://wordpress.org/support/profile/sjobidoo)
   * 
   * @param type $caps
   * @param type $cap
   * @param type $user_id
   * @param type $args
   * @return type
   */
  public function restore_users_edit_caps($caps, $cap, $user_id, $args) {

        foreach ($caps as $key => $capability) {

            if ($capability != 'do_not_allow')
                continue;

            switch ($cap) {
                case 'edit_user':
                case 'edit_users':
                    $caps[$key] = 'edit_users';
                    break;
                case 'delete_user':
                case 'delete_users':
                    $caps[$key] = 'delete_users';
                    break;
                case 'create_users':
                    $caps[$key] = $cap;
                    break;
            }
        }

        return $caps;
    }
    // end of restore_user_edit_caps()
    
    
    /**
     * Checks that both the editing user and the user being edited are
     * members of the blog and prevents the super admin being edited.
     * (code is provided by http://wordpress.org/support/profile/sjobidoo)
     * 
     */
    function edit_user_permission_check() {
        global $current_user, $profileuser;

        if (is_super_admin()) { // Superadmin may do all
            return;
        }
        
        $screen = get_current_screen();

        get_currentuserinfo();

        if ($screen->base == 'user-edit' || $screen->base == 'user-edit-network') { // editing a user profile
            if (!is_super_admin($current_user->ID) && is_super_admin($profileuser->ID)) { // trying to edit a superadmin while himself is less than a superadmin
                wp_die(esc_html__('You do not have permission to edit this user.'));
            } elseif (!( is_user_member_of_blog($profileuser->ID, get_current_blog_id()) && is_user_member_of_blog($current_user->ID, get_current_blog_id()) )) { // editing user and edited user aren't members of the same blog
                wp_die(esc_html__('You do not have permission to edit this user.'));
            }
        }
    }
    // end of edit_user_permission_check()
    

  /**
   * exclude administrator role from the roles list
   * 
   * @param string $roles
   * @return array
   */
  public function exclude_admin_role($roles) 
  {

    if (isset($roles['administrator'])) {
      unset($roles['administrator']);
    }

    return $roles;
  }
  // end of exclude_admin_role()

  
  /**
     * We have two vulnerable queries with user id at admin interface, which should be processed
     * 1st: http://blogdomain.com/wp-admin/user-edit.php?user_id=ID&wp_http_referer=%2Fwp-admin%2Fusers.php
     * 2nd: http://blogdomain.com/wp-admin/users.php?action=delete&user=ID&_wpnonce=ab34225a78
     * If put Administrator user ID into such request, user with lower capabilities (if he has 'edit_users')
     * can edit, delete admin record
     * This function removes 'edit_users' capability from current user capabilities
     * if request has admin user ID in it
     *
     * @param array $allcaps
     * @param type $caps
     * @param string $name
     * @return array
     */
    public function not_edit_admin($allcaps, $caps, $name) 
    {

        $user_keys = array('user_id', 'user');
        foreach ($user_keys as $user_key) {
            $access_deny = false;
            $user_id = $this->lib->get_request_var($user_key, 'get');
            if (!empty($user_id)) {
                if ($user_id == 1) {  // built-in WordPress Admin
                    $access_deny = true;
                } else {
                    if (!isset($this->lib->user_to_check[$user_id])) {
                        // check if user_id has Administrator role
                        $access_deny = $this->lib->has_administrator_role($user_id);
                    } else {
                        // user_id was checked already, get result from cash
                        $access_deny = $this->lib->user_to_check[$user_id];
                    }
                }
                if ($access_deny) {
                    unset($allcaps['edit_users']);
                }
                break;
            }
        }

        return $allcaps;
    }
    // end of not_edit_admin()

    
    /**
     * add where criteria to exclude users with 'Administrator' role from users list
     * 
     * @global wpdb $wpdb
     * @param  type $user_query
     */
    public function exclude_administrators($user_query) {

        global $wpdb;

        $result = false;
        $links_to_block = array('profile.php', 'users.php');
        foreach ($links_to_block as $key => $value) {
            $result = stripos($_SERVER['REQUEST_URI'], $value);
            if ($result !== false) {
                break;
            }
        }

        if ($result === false) { // block the user edit stuff only
            return;
        }

        // get user_id of users with 'Administrator' role  
        $tableName = (!$this->lib->multisite && defined('CUSTOM_USER_META_TABLE')) ? CUSTOM_USER_META_TABLE : $wpdb->usermeta;
        $meta_key = $wpdb->prefix . 'capabilities';
        $admin_role_key = '%"administrator"%';
        $query = "select user_id
              from $tableName
              where meta_key='$meta_key' and meta_value like '$admin_role_key'";
        $ids_arr = $wpdb->get_col($query);
        if (is_array($ids_arr) && count($ids_arr) > 0) {
            $ids = implode(',', $ids_arr);
            $user_query->query_where .= " AND ( $wpdb->users.ID NOT IN ( $ids ) )";
        }
    }
    // end of exclude_administrators()


    /*
     * Exclude view of users with Administrator role
     * 
     */
    public function exclude_admins_view($views) {

        unset($views['administrator']);

        return $views;
    }
    // end of exclude_admins_view()

    
  /**
   * Add/hide edit actions for every user row at the users list
   * 
   * @global type $pagenow
   * @global type $current_user
   * @param string $actions
   * @param type $user
   * @return string
   */
    public function user_row($actions, $user) {

        global $pagenow, $current_user;

        if ($pagenow == 'users.php') {
            if ($current_user->has_cap($this->key_capability)) {
                $actions['capabilities'] = '<a href="' .
                        wp_nonce_url("users.php?page=users-" . URE_PLUGIN_FILE . "&object=user&amp;user_id={$user->ID}", "ure_user_{$user->ID}") .
                        '">' . esc_html__('Capabilities', 'ure') . '</a>';
            }
        }

        return $actions;
    }

    // end of user_row()

  
    /**
   * every time when new blog created - duplicate to it roles from the main blog (1)  
   * @global wpdb $wpdb
   * @global WP_Roles $wp_roles
   * @param int $blog_id
   * @param int $user_id
   *
   */
  public function duplicate_roles_for_new_blog($blog_id) 
  {
  
    global $wpdb, $wp_roles;
    
    // get Id of 1st (main) blog
    $main_blog_id = $this->lib->get_main_blog_id();
    if ( empty($main_blog_id) ) {
      return;
    }
    $current_blog = $wpdb->blogid;
    switch_to_blog( $main_blog_id );
    $main_roles = new WP_Roles();  // get roles from primary blog
    $default_role = get_option('default_role');  // get default role from primary blog
    switch_to_blog($blog_id);  // switch to the new created blog
    $main_roles->use_db = false;  // do not touch DB
    $main_roles->add_cap('administrator', 'dummy_123456');   // just to save current roles into new blog
    $main_roles->role_key = $wp_roles->role_key;
    $main_roles->use_db = true;  // save roles into new blog DB
    $main_roles->remove_cap('administrator', 'dummy_123456');  // remove unneeded dummy capability
    update_option('default_role', $default_role); // set default role for new blog as it set for primary one
    switch_to_blog($current_blog);  // return to blog where we were at the begin
  }
  // end of duplicate_roles_for_new_blog()

  
  /** 
   * Filter out URE plugin from not superadmin users
   * @param type array $plugins plugins list
   * @return type array $plugins updated plugins list
   */
  public function exclude_from_plugins_list($plugins) {
        global $current_user;

        $ure_key_capability = $this->lib->get_key_capability();
        // if multi-site, then allow plugin activation for network superadmins and, if that's specially defined, - for single site administrators too    
        if ($this->lib->user_has_capability($current_user, $ure_key_capability)) {
            return $plugins;
        }

        // exclude URE from plugins list
        foreach ($plugins as $key => $value) {
            if ($key == 'user-role-editor/' . URE_PLUGIN_FILE) {
                unset($plugins[$key]);
                break;
            }
        }

        return $plugins;
    }
    // end of exclude_from_plugins_list()

  
    /**
     * Load plugin translation files - linked to the 'plugins_loaded' action
     * 
     */
    function load_translation() 
    {

        load_plugin_textdomain('ure', '', dirname( plugin_basename( URE_PLUGIN_FULL_PATH ) ) .'/lang');
        
    }
    // end of ure_load_translation()

    
    /**
     * Modify plugin action links
     * 
     * @param array $links
     * @return array
     */
    public function plugin_action_links($links) {

        $settings_link = "<a href='options-general.php?page=settings-" . URE_PLUGIN_FILE . "'>" . esc_html__('Settings', 'ure') . "</a>";
        array_unshift($links, $settings_link);

        return $links;
    }
    // end of plugin_action_links()


    public function plugin_row_meta($links, $file) {

        if ($file == plugin_basename(dirname(URE_PLUGIN_FULL_PATH) .'/'.URE_PLUGIN_FILE)) {
            $links[] = '<a target="_blank" href="http://role-editor.com/changelog">' . esc_html__('Changelog', 'ure') . '</a>';
        }

        return $links;
    }

    // end of plugin_row_meta
    
    
    public function settings_screen_configure() {
        $settings_page_hook = $this->settings_page_hook;
        if (is_multisite()) {
            $settings_page_hook .= '-network';
        }
        $screen = get_current_screen();
        // Check if current screen is URE's settings page
        if ($screen->id != $settings_page_hook) {
            return;
        }
        $screen_help = new Ure_Screen_Help();
        $screen->add_help_tab( array(
            'id'	=> 'general',
            'title'	=> esc_html__('General'),
            'content'	=> $screen_help->get_settings_help('general')
            ));
        if ($this->lib->is_pro() || !$this->lib->multisite) {
            $screen->add_help_tab( array(
                'id'	=> 'additional_modules',
                'title'	=> esc_html__('Additional Modules'),
                'content'	=> $screen_help->get_settings_help('additional_modules')
                ));
        }
        $screen->add_help_tab( array(
            'id'	=> 'default_roles',
            'title'	=> esc_html__('Default Roles'),
            'content'	=> $screen_help->get_settings_help('default_roles')
            ));
        if ($this->lib->multisite) {
            $screen->add_help_tab( array(
                'id'	=> 'multisite',
                'title'	=> esc_html__('Multisite'),
                'content'	=> $screen_help->get_settings_help('multisite')
                ));
        }
    }
    // end of settings_screen_configure()
    
    
    public function plugin_menu() {

        $translated_title = esc_html__('User Role Editor', 'ure');
        if (function_exists('add_submenu_page')) {
            $ure_page = add_submenu_page(
                    'users.php', 
                    $translated_title,
                    $translated_title,
                    $this->key_capability, 
                    'users-' . URE_PLUGIN_FILE, 
                    array($this, 'edit_roles'));
            add_action("admin_print_styles-$ure_page", array($this, 'admin_css_action'));
        }

        if ( !$this->lib->multisite || ($this->lib->multisite && !$this->lib->active_for_network) ) {
            $this->settings_page_hook = add_options_page(
                    $translated_title,
                    $translated_title,
                    $this->key_capability, 
                    'settings-' . URE_PLUGIN_FILE, 
                    array($this, 'settings'));
            add_action( 'load-'.$this->settings_page_hook, array($this,'settings_screen_configure') );
            add_action("admin_print_styles-{$this->settings_page_hook}", array($this, 'admin_css_action'));
        }
    }
    // end of plugin_menu()


    public function network_plugin_menu() {        
        if (is_multisite()) {
            $translated_title = esc_html__('User Role Editor', 'ure');
            $this->settings_page_hook = add_submenu_page(
                    'settings.php', 
                    $translated_title,
                    $translated_title, 
                    $this->key_capability, 
                    'settings-' . URE_PLUGIN_FILE, 
                    array(&$this, 'settings'));
            add_action( 'load-'.$this->settings_page_hook, array($this,'settings_screen_configure') );
            add_action("admin_print_styles-{$this->settings_page_hook}", array($this, 'admin_css_action'));
        }
        
    }

    // end of network_plugin_menu()

    
    protected function get_settings_action() {

        $action = 'show';
        $update_buttons = array('ure_settings_update', 'ure_addons_settings_update', 'ure_settings_ms_update', 'ure_default_roles_update');
        foreach($update_buttons as $update_button) {
            if (!isset($_POST[$update_button])) {
                continue;
            }
            if (!wp_verify_nonce($_POST['_wpnonce'], 'user-role-editor')) {
                wp_die('Security check failed');
            }
            $action = $update_button;
            break;            
        }

        return $action;

    }
    // end of get_settings_action()

    /**
     * Update General Options tab
     */
    protected function update_general_options() {
        if (defined('URE_SHOW_ADMIN_ROLE') && (URE_SHOW_ADMIN_ROLE == 1)) {
            $show_admin_role = 1;
        } else {
            $show_admin_role = $this->lib->get_request_var('show_admin_role', 'checkbox');
        }
        $this->lib->put_option('show_admin_role', $show_admin_role);

        $caps_readable = $this->lib->get_request_var('caps_readable', 'checkbox');
        $this->lib->put_option('ure_caps_readable', $caps_readable);

        $show_deprecated_caps = $this->lib->get_request_var('show_deprecated_caps', 'checkbox');
        $this->lib->put_option('ure_show_deprecated_caps', $show_deprecated_caps);       
        
        do_action('ure_settings_update1');

        $this->lib->flush_options();
        $this->lib->show_message(esc_html__('User Role Editor options are updated', 'ure'));
        
    }
    // end of update_general_options()

    
    /**
     * Update Additional Modules Options tab
     */
    protected function update_addons_options() {
        
        if (!$this->lib->multisite) {
            $count_users_without_role = $this->lib->get_request_var('count_users_without_role', 'checkbox');
            $this->lib->put_option('count_users_without_role', $count_users_without_role);
        }
        do_action('ure_settings_update2');
        
        $this->lib->flush_options();
        $this->lib->show_message(esc_html__('User Role Editor options are updated', 'ure'));
    }
    // end of update_addons_options()
    
    
    protected function update_default_roles() {
        global $wp_roles;    
        
        // Primary default role
        $primary_default_role = $this->lib->get_request_var('default_user_role', 'post');
        if (!empty($primary_default_role) && isset($wp_roles->role_objects[$primary_default_role]) && $primary_default_role !== 'administrator') {
            update_option('default_role', $primary_default_role);
        }
                
        // Other default roles
        $other_default_roles = array();
        foreach($_POST as $key=>$value) {
            $prefix = substr($key, 0, 8);
            if ($prefix!=='wp_role_') {
                continue;
            }
            $role_id = substr($key, 8);
            if ($role_id!=='administrator' && isset($wp_roles->role_objects[$role_id])) {
                $other_default_roles[] = $role_id;
            }            
        }  // foreach()
        $this->lib->put_option('other_default_roles', $other_default_roles, true);
        
        $this->lib->show_message(esc_html__('Default Roles are updated', 'ure'));
    }
    // end of update_default_roles()
    
    
    protected function update_multisite_options() {
        if (!$this->lib->multisite) {
            return;
        }

        $allow_edit_users_to_not_super_admin = $this->lib->get_request_var('allow_edit_users_to_not_super_admin', 'checkbox');
        $this->lib->put_option('allow_edit_users_to_not_super_admin', $allow_edit_users_to_not_super_admin);        
        
        do_action('ure_settings_ms_update');

        $this->lib->flush_options();
        $this->lib->show_message(esc_html__('User Role Editor options are updated', 'ure'));
        
    }
    // end of update_multisite_options()
    

    public function settings() {
        if (!current_user_can($this->key_capability)) {
            esc_html__( 'You do not have sufficient permissions to manage options for User Role Editor.', 'ure' );
        }
        $action = $this->get_settings_action();
        switch ($action) {
            case 'ure_settings_update':
                $this->update_general_options();
                break;
            case 'ure_addons_settings_update':
                $this->update_addons_options();
                break;
            case 'ure_settings_ms_update':
                $this->update_multisite_options();
                break;
            case 'ure_default_roles_update':
                $this->update_default_roles();
            case 'show':
            default:                
            ;
        } // switch()
                        
        if (defined('URE_SHOW_ADMIN_ROLE') && (URE_SHOW_ADMIN_ROLE == 1)) {
            $show_admin_role = 1;
        } else {
            $show_admin_role = $this->lib->get_option('show_admin_role', 0);
        }
        $caps_readable = $this->lib->get_option('ure_caps_readable', 0);
        $show_deprecated_caps = $this->lib->get_option('ure_show_deprecated_caps', 0);
                
        if ($this->lib->multisite) {
            $allow_edit_users_to_not_super_admin = $this->lib->get_option('allow_edit_users_to_not_super_admin', 0);
        } else {
            $count_users_without_role = $this->lib->get_option('count_users_without_role', 0);
        }
        
        $this->lib->get_default_role();
        $this->lib->editor_init1();
        $this->lib->role_edit_prepare_html(0);
        
        $ure_tab_idx = $this->lib->get_request_var('ure_tab_idx', 'int');
                
        do_action('ure_settings_load');        

        if ($this->lib->multisite && is_network_admin()) {
            $link = 'settings.php';
        } else {
            $link = 'options-general.php';
        }
        
        $license_key_only = $this->lib->multisite && is_network_admin() && !$this->lib->active_for_network;

        
        require_once(URE_PLUGIN_DIR . 'includes/settings-template.php');
    }
    // end of settings()


    public function admin_css_action() {

        wp_enqueue_style('wp-jquery-ui-dialog');         
        if (stripos($_SERVER['REQUEST_URI'], 'settings-user-role-editor')!==false) {
            wp_enqueue_style('ure-jquery-ui-tabs', URE_PLUGIN_URL . 'css/jquery-ui-1.10.4.custom.min.css', array(), false, 'screen');
        }
        wp_enqueue_style('ure-admin-css', URE_PLUGIN_URL . 'css/ure-admin.css', array(), false, 'screen');
    }
    // end of admin_css_action()
    
    
    // call roles editor page
    public function edit_roles() {

        global $current_user;

        if (!empty($current_user)) {
            $user_id = $current_user->ID;
        } else {
            $user_id = false;
        }
        $ure_key_capability = $this->lib->get_key_capability();
        if (!$this->lib->user_has_capability($current_user, $ure_key_capability)) {
            die(esc_html__('Insufficient permissions to work with User Role Editor', 'ure'));
        }

        $this->lib->editor();
    }
    // end of edit_roles()
	
   
	// move old version option to the new storage 'user_role_editor' option, array, containing all URE options
	private function convert_option($option_name) {
		
		$option_value = get_option($option_name, 0);
		delete_option($option_name);
		$this->lib->put_option( $option_name, $option_value );
		
	}

	/**
	 *  execute on plugin activation
	 */
	function setup() {
		
		$this->convert_option('ure_caps_readable');				
		$this->convert_option('ure_show_deprecated_caps');
		$this->convert_option('ure_hide_pro_banner');		
		$this->lib->flush_options();
		
		$this->lib->make_roles_backup();

		do_action('ure_activation');
  
	}
	// end of setup()

 
    /**
     * Unload WP TechGoStore theme JS and CSS to exclude compatibility issues with URE
     */
    protected function unload_techgostore($hook_suffix) {
                
        if (!defined('THEME_SLUG') || THEME_SLUG!=='techgo_') {
            return;
        }  
        
        if ( !in_array($hook_suffix, $this->ure_hook_suffixes) && !in_array($hook_suffix, array('users.php', 'profile.php')) ) {
            return;
        }
        wp_deregister_script('jqueryform');
        wp_deregister_script('tab');
        wp_deregister_script('shortcode_js');
        wp_deregister_script('fancybox_js');
        wp_deregister_script('bootstrap-colorpicker');
        wp_deregister_script('logo_upload');
        wp_deregister_script('js_wd_menu_backend');
        
        wp_deregister_style('config_css');
        wp_deregister_style('fancybox_css');
        wp_deregister_style('colorpicker');
        wp_deregister_style('font-awesome');
        wp_deregister_style('css_wd_menu_backend');
    }

// end of unload_techgostore()

/**
  * Load plugin javascript stuff
  * 
  * @param string $hook_suffix
  */
 public function admin_load_js($hook_suffix){
              
     $this->unload_techgostore($hook_suffix);
	if (in_array($hook_suffix, $this->ure_hook_suffixes)) {
    wp_enqueue_script('jquery-ui-dialog', false, array('jquery-ui-core','jquery-ui-button', 'jquery') );
    wp_enqueue_script('jquery-ui-tabs', false, array('jquery-ui-core', 'jquery') );
    wp_register_script( 'ure-js', plugins_url( '/js/ure-js.js', URE_PLUGIN_FULL_PATH ) );
    wp_enqueue_script ( 'ure-js' );
    wp_localize_script( 'ure-js', 'ure_data', array(
        'wp_nonce' => wp_create_nonce('user-role-editor'),
        'page_url' => URE_WP_ADMIN_URL . URE_PARENT .'?page=users-'.URE_PLUGIN_FILE,  
        'is_multisite' => is_multisite() ? 1 : 0,  
        'select_all' => esc_html__('Select All', 'ure'),
        'unselect_all' => esc_html__('Unselect All', 'ure'),
        'reverse' => esc_html__('Reverse', 'ure'),  
        'update' => esc_html__('Update', 'ure'),
        'confirm_submit' => esc_html__('Please confirm permissions update', 'ure'),
        'add_new_role_title' => esc_html__('Add New Role', 'ure'),
        'rename_role_title' => esc_html__('Rename Role', 'ure'),
        'role_name_required' => esc_html__(' Role name (ID) can not be empty!', 'ure'),  
        'role_name_valid_chars' => esc_html__(' Role name (ID) must contain latin characters, digits, hyphens or underscore only!', 'ure'), 
        'numeric_role_name_prohibited' => esc_html__(' WordPress does not support numeric Role name (ID). Add latin characters to it.', 'ure'), 
        'add_role' => esc_html__('Add Role', 'ure'),
        'rename_role' => esc_html__('Rename Role', 'ure'),
        'delete_role' => esc_html__('Delete Role', 'ure'),
        'cancel' =>  esc_html__('Cancel', 'ure'),  
        'add_capability' => esc_html__('Add Capability', 'ure'),
        'delete_capability' => esc_html__('Delete Capability', 'ure'),
        'reset' => esc_html__('Reset', 'ure'),  
        'reset_warning' => esc_html__('DANGER! Resetting will restore default settings from WordPress Core.','ure')."\n\n".
                           esc_html__('If any plugins have changed capabilities in any way upon installation (such as S2Member, WooCommerce, and many more), those capabilities will be DELETED!', 'ure')."\n\n" .
                           esc_html__('For more information on how to undo changes and restore plugin capabilities go to', 'ure')."\n".
                           'http://role-editor.com/how-to-restore-deleted-wordpress-user-roles/'."\n\n".
                           esc_html__('Continue?', 'ure'),  
        'default_role' => esc_html__('Default Role', 'ure'),    
        'set_new_default_role' => esc_html__('Set New Default Role', 'ure'),
        'delete_capability' => esc_html__('Delete Capability', 'ure'),
        'delete_capability_warning' => esc_html__('Warning! Be careful - removing critical capability could crash some plugin or other custom code', 'ure'),
        'capability_name_required' => esc_html__(' Capability name (ID) can not be empty!', 'ure'),    
        'capability_name_valid_chars' => esc_html__(' Capability name (ID) must contain latin characters, digits, hyphens or underscore only!', 'ure'),    
    ) );
    // load additional JS stuff for Pro version, if exists
    do_action('ure_load_js');
    
	}
  
}
// end of admin_load_js()


    protected function is_user_profile_extention_allowed() {
        // Check if we are not at the network admin center
        $result = stripos($_SERVER['REQUEST_URI'], 'network/user-edit.php') == false;
        
        return $result;
    }
    // end of is_user_profile_extention_allowed()


    public function edit_user_profile($user) {

        global $current_user;
        
        if (!$this->is_user_profile_extention_allowed()) {  
            return;
        }
        if (!$this->lib->user_is_admin($current_user->ID)) {
            return;
        }
?>
        <h3><?php _e('User Role Editor', 'ure'); ?></h3>
        <table class="form-table">
        		<tr>
        			<th scope="row"><?php _e('Other Roles', 'ure'); ?></th>
        			<td>
        <?php
        $roles = $this->lib->other_user_roles($user);
        if (is_array($roles) && count($roles) > 0) {
            foreach ($roles as $role) {
                echo '<input type="hidden" name="ure_other_roles[]" value="' . $role . '" />';
            }
        }
        $output = $this->lib->roles_text($roles);
        echo $output . '&nbsp;&nbsp;&gt;&gt;&nbsp;<a href="' . wp_nonce_url("users.php?page=users-".URE_PLUGIN_FILE."&object=user&amp;user_id={$user->ID}", "ure_user_{$user->ID}") . '">' . 
                esc_html__('Edit', 'ure') . '</a>';
        ?>
        			</td>
        		</tr>
        </table>		
        <?php
    }
    // end of edit_user_profile()

    
    /**
     *  add 'Other Roles' column to WordPress users list table
     * 
     * @param array $columns WordPress users list table columns list
     * @return array
     */
    public function user_role_column($columns = array()) {

        $columns['ure_roles'] = esc_html__('Other Roles', 'ure');

        return $columns;
    }
    // end of user_role_column()

    
    /**
     * Return user's roles list for display in the WordPress Users list table
     *
     * @param string $retval
     * @param string $column_name
     * @param int $user_id
     *
     * @return string all user roles
     */
    public function user_role_row($retval = '', $column_name = '', $user_id = 0) 
    {

        // Only looking for User Role Editor other user roles column
        if ('ure_roles' == $column_name) {
            $user = get_userdata($user_id);
            // Get the users roles
            $roles = $this->lib->other_user_roles($user);
            $retval = $this->lib->roles_text($roles);
        }

        // Pass retval through
        return $retval;
    }
    // end of user_role_row()
    

    // save additional user roles when user profile is updated, as WordPress itself doesn't know about them
    public function user_profile_update($user_id) {

        if (!current_user_can('edit_user', $user_id)) {
            return;
        }
        $user = get_userdata($user_id);

        if (isset($_POST['ure_other_roles'])) {
            $new_roles = array_intersect($user->roles, $_POST['ure_other_roles']);
            $skip_roles = array();
            foreach ($new_roles as $role) {
                $skip_roles['$role'] = 1;
            }
            unset($new_roles);
            foreach ($_POST['ure_other_roles'] as $role) {
                if (!isset($skip_roles[$role])) {
                    $user->add_role($role);
                }
            }
        }
                
    }
    // update_user_profile()


    
    public function ure_ajax() {
        
        require_once(URE_PLUGIN_DIR . 'includes/class-ajax-processor.php');
        $ajax_processor = new URE_Ajax_Processor($this->lib);
        $ajax_processor->dispatch();
        
    }
    // end of ure_ajax()
    

    // execute on plugin deactivation
    function cleanup() 
    {
		
    }
    // end of setup()

 
}
// end of User_Role_Editor
