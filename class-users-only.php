<?php

/**
 * Users Only Class
 *
 * @package     Users_Only
 * @author      Gagan <me@gagan.pro>
 */

/**
 * Description of Users_Only class
 *
 * @package     Users_Only
 * @author      Gagan <me@gagan.pro>
 */
class Users_Only {

    /**
     * Instance of this class.
     *
     * @since 1.0
     * 
     * @var object
     */
    protected static $instance = null;

    public function __construct() {
        if (!is_admin()) {
            add_action('init', array($this, 'login_check'));
        }
    }

    /**
     * Checks if the user is logged in, if not, then redirects the user to the login page.
     *
     * @since 1.0
     * 
     */
    public function login_check() {
        //Making sure to load the check only on the frontend that is accessible directly
        if (!is_user_logged_in()&&!$this->is_login_page()) {
            wp_redirect(wp_login_url($this->current_page_url()));
        }
    }
    
    /**
     * Return whether the current page is login page or not.
     *
     * @since 1.0
     * 
     * @return bool TRUE if its the login page, FALSE if its not the login page.
     */
    public function is_login_page() {
        return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
    }

    
    /**
     * Returns the current page's URL.
     *
     * @since 1.0
     * 
     * @return string Current URL.
     */
    public function current_page_url() {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"])) {
            if ($_SERVER["HTTPS"] == "on") {
                $pageURL .= "s";
            }
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    /**
     * Return an instance of this class.
     *
     * @since 1.0
     * 
     * @return object A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
