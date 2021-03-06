<?php

// namespace ##
namespace Q_GH_Brand_Bar\Theme;

use Q_GH_Brand_Bar\Core\Plugin as Plugin;
use Q_GH_Brand_Bar\Core\Helper as Helper;

/**
 * Template level UI changes
 *
 * @package   Q_GH_Brand_Bar
 */
class Template extends Plugin {

	/**
     * Instatiate Class
     *
     * @since       0.2
     * @return      void
     */
    public function __construct()
    {

    	// styles and scripts ##
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ), 1 );

        // add body class identfier ##
        add_filter( 'body_class', array( $this, 'body_class' ), 1, 1 );

        // add in brand bar ##
        add_action( 'q_action_body_open', array ( $this, 'render' ), 3 );

    }


    /**
     * WP Enqueue Scripts - on the front-end of the site
     *
     * @since       0.1
     * @return      void
     */
    public function wp_enqueue_scripts()
    {

        // only add these scripts on the correct page template ##
        #if ( ! is_page_template( 'template-meet-our-students.php' ) ) { return false; }

        // Register the script ##
        #wp_register_script( 'multiselect-js', QGHBB_URL.'javascript/jquery.multiselect.js', array( 'jquery' ), $this->version, true );
        #wp_enqueue_script( 'multiselect-js' );

        // Register the script ##
        wp_register_script( 'q-gh-brand-bar-js', QGHBB_URL.'javascript/q-gh-brand-bar.js', array( 'jquery' ), $this->version, true );

        // // Now we can localize the script with our data.
        // $translation_array = array(
        //         'ajax_nonce'    => wp_create_nonce( 'q_mos_nonce' )
        //     ,   'ajax_url'      => get_home_url( '', 'wp-admin/admin-ajax.php' )
        //     ,   'saved'         => __( "Saved!", 'q-gh-brand-bar' )
		// 	,   'input_saved'   => __( "Saved", 'q-gh-brand-bar' )
		// 	,   'input_max'		=> __( "Maximum Saved", 'q-gh-brand-bar' ) // text to indicate that max number of students reached ##
        //     ,   'student'       => __( "Student saved", 'q-gh-brand-bar' )
        //     ,   'students'      => __( "Students saved", 'q-gh-brand-bar' )
        //     ,   'error'         => __( "Error", 'q-gh-brand-bar' )
		// 	,   'count_cookie'  => $this->count_cookie() // send cookie count to JS ##
		// 	,   'max_students'  => $this->max_students // max number of students that can be saved ##
        //     ,   'form_id'       => $this->form_id // Gravity Forms ID ##
        // );
        // wp_localize_script( 'q-gh-brand-bar-js', 'q_mos', $translation_array );

        // enqueue the script ##
        wp_enqueue_script( 'q-gh-brand-bar-js' );

        wp_register_style( 'q-gh-brand-bar-css', QGHBB_URL.'css/q-gh-brand-bar.css' );
        wp_enqueue_style( 'q-gh-brand-bar-css' );

    }


    /*
    Add body class to allow each install to be identified uniquely

    @since      0.2
    @return     Array      array of classes passed to method, with any additions
    */
    public function body_class( $classes )
    {

        // let's grab and prepare our site URL ##
        $identifier = strtolower( get_bloginfo( 'name' ) );

        // add our class ##
        $classes[] = 'install-'.str_replace( array( '.', ' '), '-', $identifier );

        // return to filter ##
        return $classes;

    }


	/**
     * Render Brand Bar - called from widget added to theme template
     *
     * @since       0.1
     * @return      HTML
     */
    public static function render()
    {

        // mobile device ##
        #if ( 'handheld' == Helper::get_device() ) {

?>
        <div class="widget widget-brand-bar brand-bar wrapper-outer handheld">
            <ul class="wrapper-inner wrapper-padding">
<?php

                // branches ##
                self::the_branches_link();

                // donate link ##
                self::the_donate_link();

?>
            </ul>
<?php

            // handheld open view ##
            self::the_branches_open();

?>
        </div>
<?php

        // desktop + tablet ##
        #} else {

?>
        <div class="widget widget-brand-bar brand-bar wrapper-outer desktop">
            <ul class="wrapper-inner wrapper-padding">
<?php

                // branches ##
                self::the_branches_link();

                // donate link ##
                self::the_donate_link();

?>
            </ul>
        </div>
<?php

        #}

    }


    
        /**
         * Get GH Branches
         *
         * @since       0.1
         * @return      string   HTML
         */
        public static function the_branches_link()
        {

            // build array of branches ##
            $array = array(

                'Greenheart'    => array (
                        'src'       => 'greenheart'
                    ,   'url'       => 'https://www.greenheart.org/'
                    ,   'alt'       => 'greenheart'
                ),
                'CCI Greenheart'    => array (
                        'src'       => 'greenheart-exchange'
                    ,   'url'       => 'https://www.greenheartexchange.org/'
                    ,   'alt'       => 'exchange'
                ),
                'Greenheart Travel' => array (
                        'src'       => 'greenheart-travel'
                    ,   'url'       => 'https://www.greenhearttravel.org'
                    ,   'alt'       => 'travel'
                ),
                'Greenheart Shop' => array (
                        'src'       => 'greenheart-shop'
                    ,   'url'       => 'http://www.greenheartshop.org'
                    ,   'alt'       => 'shop'
                ),
                'Greenheart Transforms' => array (
                        'src'       => 'greenheart-transforms'
                    ,   'url'       => 'http://www.greenhearttransforms.org'
                    ,   'alt'       => 'transforms'
                ),
                // 'Greenheart Ibiza' => array (
                //         'src'       => 'greenheart-ibiza'
                //     ,   'url'       => 'http://www.greenheartibiza.org'
                //     ,   'alt'       => 'Greenheart Ibiza'
                // ),
                // 'Greenheart Music' => array (
                //         'src'       => 'greenheart-music'
                //     ,   'url'       => 'http://www.greenheartmusic.com'
                //     ,   'alt'       => 'Greenheart Music'
                // )

            );

            // loop em out ##
            foreach ( $array as $branch ) {

?>
            <li class='<?php echo $branch["src"]; ?>'>
                <a href="<?php echo $branch["url"]; ?>" target="_blank" title="<?php echo $branch["alt"]; ?>">
                    <?php echo $branch["alt"]; ?>
                </a>
            </li>
<?php

            } // get more ##


        }


        /**
         * Get Donate Link
         *
         * @since       0.1
         * @return      string   HTML
         */
        public static function the_donate_link()
        {

?>
            <li class="donate">
                <a href="https://greenheart.org/donate" target="_blank" title="<?php _e( "Donate" , 'q-gh-brand-bar' ); ?>">
                    <?php _e( "Donate" , 'q-gh-brand-bar' ); ?>
                </a>
            </li>
<?php

        }


         /**
         * Branches open view
         *
         * @since       0.1
         * @return      string   HTML
         */
        public static function the_branches_open()
        {

?>
            <ul class="branches-open">
                <div class="branches-close"></div>
<?php

                // main GH branches ##
                self::the_branches_link();

                // donate ##
                self::the_donate_link();

                // GH logo ##
?>
                <li class="greenheart"><a href="https://www.greenheart.org" target="_blank" title="Greenheart International"></a></li>
            </ul>
<?php

        }


}