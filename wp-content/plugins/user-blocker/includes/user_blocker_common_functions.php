<?php
/**
 * Add solwin news dashboard
 */
if (!function_exists('latest_news_solwin_feed')) {

    function latest_news_solwin_feed() {
        // Register the new dashboard widget with the 'wp_dashboard_setup' action
        add_action('wp_dashboard_setup', 'solwin_latest_news_with_product_details');
        if (!function_exists('solwin_latest_news_with_product_details')) {

            function solwin_latest_news_with_product_details() {
                add_screen_option('layout_columns', array('max' => 3, 'default' => 2));
                add_meta_box('wp_blog_designer_dashboard_widget', __('News From Solwin Infotech', 'user-blocker'), 'solwin_dashboard_widget_news', 'dashboard', 'normal', 'high');
            }

        }
        if (!function_exists('solwin_dashboard_widget_news')) {

            function solwin_dashboard_widget_news() {
                echo '<div class="rss-widget">'
                . '<div class="solwin-news"><p><strong>Solwin Infotech News</strong></p>';
                wp_widget_rss_output(array(
                    'url' => 'https://www.solwininfotech.com/feed/',
                    'title' => __('News From Solwin Infotech', 'user-blocker'),
                    'items' => 5,
                    'show_summary' => 0,
                    'show_author' => 0,
                    'show_date' => 1
                ));
                echo '</div>';
                $title = $link = $thumbnail = "";
                //get Latest product detail from xml file
                $file = 'https://www.solwininfotech.com/documents/assets/latest_product.xml';
                echo '<div class="display-product">'
                . '<div class="product-detail"><p><strong>' . __('Latest Product', 'user-blocker') . '</strong></p>';
                $response = wp_remote_post($file);
                if (is_wp_error($response)) {
                    $error_message = $response->get_error_message();
                    echo "<p>" . __('Something went wrong', 'user-blocker') . " : $error_message" . "</p>";
                } else {
                    $body = wp_remote_retrieve_body($response);
                    $xml = simplexml_load_string($body);
                    $title = $xml->item->name;
                    $thumbnail = $xml->item->img;
                    $link = $xml->item->link;
                    $allProducttext = $xml->item->viewalltext;
                    $allProductlink = $xml->item->viewalllink;
                    $moretext = $xml->item->moretext;
                    $needsupporttext = $xml->item->needsupporttext;
                    $needsupportlink = $xml->item->needsupportlink;
                    $customservicetext = $xml->item->customservicetext;
                    $customservicelink = $xml->item->customservicelink;
                    $joinproductclubtext = $xml->item->joinproductclubtext;
                    $joinproductclublink = $xml->item->joinproductclublink;
                    echo '<div class="product-name"><a href="' . $link . '" target="_blank">'
                    . '<img alt="' . $title . '" src="' . $thumbnail . '"> </a>'
                    . '<a href="' . $link . '" target="_blank">' . $title . '</a>'
                    . '<p><a href="' . $allProductlink . '" target="_blank" class="button button-default">' . $allProducttext . ' &RightArrow;</a></p>'
                    . '<hr>'
                    . '<p><strong>' . $moretext . '</strong></p>'
                    . '<ul>'
                    . '<li><a href="' . $needsupportlink . '" target="_blank">' . $needsupporttext . '</a></li>'
                    . '<li><a href="' . $customservicelink . '" target="_blank">' . $customservicetext . '</a></li>'
                    . '<li><a href="' . $joinproductclublink . '" target="_blank">' . $joinproductclubtext . '</a></li>'
                    . '</ul>'
                    . '</div>';
                }
                echo '</div></div><div class="clear"></div>'
                . '</div>';
            }

        }
    }

}

/**
 * Add Footer credit link
 */
if (!function_exists('ub_footer')) {

    function ub_footer() {
        $screen = get_current_screen();
        if ($screen->id == "toplevel_page_block_user" || $screen->id == "admin_page_block_user_date" || $screen->id == "admin_page_block_user_permenant" || $screen->id == "user-blocker_page_blocked_user_list" || $screen->id == "admin_page_datewise_blocked_user_list" || $screen->id == "admin_page_permanent_blocked_user_list" || $screen->id == "admin_page_all_type_blocked_user_list") {
            add_filter('admin_footer_text', 'ub_remove_footer_admin'); //change admin footer text
        }
    }

}

/**
 * Add rating html at footer of admin
 * @return html rating
 */
if (!function_exists('ub_remove_footer_admin')) {

    function ub_remove_footer_admin() {
        ob_start();
        ?>
        <p id="footer-left" class="alignleft">
            <?php _e('If you like ', 'user-blocker'); ?>
            <a href="https://www.solwininfotech.com/product/wordpress-plugins/user-blocker/" target="_blank"><strong><?php _e('User Blocker', 'user-blocker'); ?></strong></a>
            <?php _e('please leave us a', 'user-blocker'); ?>
            <a class="bdp-rating-link" data-rated="Thanks :)" target="_blank" href="https://wordpress.org/support/plugin/user-blocker/reviews/?filter=5#new-post">&#x2605;&#x2605;&#x2605;&#x2605;&#x2605;</a>
            <?php _e('rating. A huge thank you from Solwin Infotech in advance!', 'user-blocker'); ?>
        </p>
        <?php
        return ob_get_clean();
    }

}

/**
 * Enqueue admin panel required css
 */
if (!function_exists('ub_enqueueStyleScript')) {

    function ub_enqueueStyleScript() {
        global $screen;
        $screen = get_current_screen();
        if (isset($_GET['page']) && ($_GET['page'] == 'all_type_blocked_user_list' || $_GET['page'] == 'permanent_blocked_user_list' || $_GET['page'] == 'datewise_blocked_user_list' || $_GET['page'] == 'blocked_user_list' || $_GET['page'] == 'block_user' || $_GET['page'] == 'block_user_date' || $_GET['page'] == 'block_user_permenant')) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-js', 'http://code.jquery.com/ui/1.11.0/jquery-ui.min.js', 'jquery');
            wp_register_script('timepicker-addon-js', plugins_url() . '/user-blocker/script/jquery-ui-timepicker-addon.js', 'jquery');
            wp_enqueue_script('timepicker-addon-js');
            wp_register_script('timepicker-js', plugins_url() . '/user-blocker/script/jquery.timepicker.js', 'jquery');
            wp_enqueue_script('timepicker-js');
            wp_register_script('datepair-js', plugins_url() . '/user-blocker/script/datepair.js', 'jquery');
            wp_enqueue_script('datepair-js');
            wp_register_script('jquery-ui-sliderAccess', plugins_url() . '/user-blocker/script/jquery-ui-sliderAccess.js', 'jquery');
            wp_enqueue_script('jquery-ui-sliderAccess');
            wp_register_script('admin_script', plugins_url() . '/user-blocker/script/admin_script.js');
            wp_enqueue_script('admin_script');
            wp_register_style('timepicker-css', plugins_url() . '/user-blocker/css/jquery.timepicker.css');
            wp_enqueue_style('timepicker-css');
            wp_register_style('jqueryUI', plugins_url() . '/user-blocker/css/jquery-ui.css');
            wp_enqueue_style('jqueryUI');
            wp_register_style('timepicker-addon-css', plugins_url() . '/user-blocker/css/jquery-ui-timepicker-addon.css');
            wp_enqueue_style('timepicker-addon-css');
            wp_register_style('admin_style', plugins_url() . '/user-blocker/css/admin_style.css');
            wp_enqueue_style('admin_style');
        }
        if ($screen->id == 'dashboard') {
            wp_register_style('admin_style', plugins_url() . '/user-blocker/css/admin_style.css');
            wp_enqueue_style('admin_style');
        }
    }

}

/**
 *
 * @return Loads plugin textdomain
 */
if (!function_exists('load_text_domain_user_blocker')) {

    function load_text_domain_user_blocker() {
        load_plugin_textdomain('user-blocker', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

}

/**
 *
 * @return Display total downloads of plugin
 */
if (!function_exists('get_user_blocker_total_downloads')) {

    function get_user_blocker_total_downloads() {
        // Set the arguments. For brevity of code, I will set only a few fields.
        $plugins = $response = "";
        $args = array(
            'author' => 'solwininfotech',
            'fields' => array(
                'downloaded' => true,
                'downloadlink' => true
            )
        );
        // Make request and extract plug-in object. Action is query_plugins
        $response = wp_remote_post(
                'http://api.wordpress.org/plugins/info/1.0/', array(
            'body' => array(
                'action' => 'query_plugins',
                'request' => serialize((object) $args)
            )
                )
        );
        if (!is_wp_error($response)) {
            $returned_object = unserialize(wp_remote_retrieve_body($response));
            $plugins = $returned_object->plugins;
        } else {
            
        }
        $current_slug = 'user-blocker';
        if ($plugins) {
            foreach ($plugins as $plugin) {
                if ($current_slug == $plugin->slug) {
                    if ($plugin->downloaded) {
                        ?>
                        <span class="total-downloads">
                            <span class="download-number"><?php echo $plugin->downloaded; ?></span>
                        </span>
                        <?php
                    }
                }
            }
        }
    }

}

/**
 * @return Display rating of plugin
 */
$wp_version = get_bloginfo('version');
if ($wp_version > 3.8) {
    if (!function_exists('wp_user_blocker_star_rating')) {

        function wp_user_blocker_star_rating($args = array()) {
            $plugins = $response = "";
            $args = array(
                'author' => 'solwininfotech',
                'fields' => array(
                    'downloaded' => true,
                    'downloadlink' => true
                )
            );
            // Make request and extract plug-in object. Action is query_plugins
            $response = wp_remote_post(
                    'http://api.wordpress.org/plugins/info/1.0/', array(
                'body' => array(
                    'action' => 'query_plugins',
                    'request' => serialize((object) $args)
                )
                    )
            );
            if (!is_wp_error($response)) {
                $returned_object = unserialize(wp_remote_retrieve_body($response));
                $plugins = $returned_object->plugins;
            }
            $current_slug = 'user-blocker';
            if ($plugins) {
                foreach ($plugins as $plugin) {
                    if ($current_slug == $plugin->slug) {
                        $rating = $plugin->rating * 5 / 100;
                        if ($rating > 0) {
                            $args = array(
                                'rating' => $rating,
                                'type' => 'rating',
                                'number' => $plugin->num_ratings,
                            );
                            wp_star_rating($args);
                        }
                    }
                }
            }
        }

    }
}

/**
 * Display html of support section at right side
 */
if (!function_exists('ub_display_support_section')) {

    function ub_display_support_section() {
        ?>
        <div class="td-admin-sidebar">
            <div class="td-help">
                <h2><?php _e('Help to improve this plugin!', 'user-blocker'); ?></h2>
                <div class="help-wrapper">
                    <span><?php _e('Enjoyed this plugin?', 'user-blocker'); ?></span>
                    <span><?php _e(' You can help by', 'user-blocker'); ?>
                        <a href="https://wordpress.org/support/plugin/user-blocker/reviews/?filter=5#new-post" target="_blank">
                            <?php _e(' rating this plugin on wordpress.org', 'user-blocker'); ?>
                        </a>
                    </span>
                    <div class="td-total-download">
                        <?php _e('Downloads:', 'user-blocker'); ?><?php get_user_blocker_total_downloads(); ?>
                        <?php
                        $wp_version = get_bloginfo('version');
                        if ($wp_version > 3.8) {
                            wp_user_blocker_star_rating();
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="useful_plugins">
                <h2><?php _e('Our Other Works', 'wp_blog_designer'); ?></h2>
                <div class="help-wrapper">
                    <div class="pro-content">
                        <strong class="ual_advertisement_legend">Blog Designer Pro</strong>
                        <ul class="advertisementContent">
                            <li><?php _e("30+ Beautiful Blog Templates", 'wp_blog_designer') ?></li>
                            <li><?php _e("5 Unique Timeline Templates", 'wp_blog_designer') ?></li>
                            <li><?php _e("100+ Blog Layout Variations", 'wp_blog_designer') ?></li>
                            <li><?php _e("Single Post Design options", 'wp_blog_designer') ?></li>
                            <li><?php _e("Category, Tag, Author Layouts", 'wp_blog_designer') ?></li>
                            <li><?php _e("Post Type & Taxonomy Filter", 'wp_blog_designer') ?></li>
                            <li><?php _e("800+ Google Font Support", 'wp_blog_designer') ?></li>
                            <li><?php _e("600+ Font Awesome Icons Support", 'wp_blog_designer') ?></li>
                        </ul>
                        <p class="pricing_change">Now only at <ins>$29</ins></p>
                    </div>
                    <div class="pre-book-pro">
                        <a href="https://codecanyon.net/item/blog-designer-pro-for-wordpress/17069678?ref=solwin" target="_blank">
                            <?php _e('Buy Now on Codecanyon', 'wp_blog_designer'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="td-support">
                <h3><?php _e('Need Support?', 'user-blocker'); ?></h3>
                <div class="help-wrapper">
                    <span><?php _e('Check out the', 'user-blocker') ?>
                        <a href="https://wordpress.org/plugins/user-blocker/faq/" target="_blank"><?php _e('FAQs', 'user-blocker'); ?></a>
                        <?php _e('and', 'user-blocker') ?>
                        <a href="https://wordpress.org/support/plugin/user-blocker/" target="_blank"><?php _e('Support Forums', 'user-blocker') ?></a>
                    </span>
                </div>
            </div>
            <div class="td-support">
                <h3><?php _e('Share & Follow Us', 'user-blocker'); ?></h3>
                <div class="help-wrapper">
                    <!-- Twitter -->
                    <div style='display:block;margin-bottom:8px;'>
                        <a href="https://twitter.com/solwininfotech" class="twitter-follow-button" data-show-count="true" data-show-screen-name="true" data-dnt="true">Follow @solwininfotech</a>
                        <script>!function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                if (!d.getElementById(id)) {
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = p + '://platform.twitter.com/widgets.js';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }
                            }(document, 'script', 'twitter-wjs');</script>
                    </div>
                    <!-- Facebook -->
                    <div style='display:block;margin-bottom:10px;'>
                        <div id="fb-root"></div>
                        <script>(function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id))
                                    return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5";
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-href="https://wordpress.org/plugins/user-blocker/" data-layout="button_count"></div>
                    </div>
                    <!-- Google Plus -->
                    <div style='display:block;margin-bottom:8px;'>
                        <!-- Place this tag where you want the +1 button to render. -->
                        <div class="g-plusone" data-href="https://wordpress.org/plugins/user-blocker/"></div>
                        <!-- Place this tag after the last +1 button tag. -->
                        <script type="text/javascript">
                            (function () {
                                var po = document.createElement('script');
                                po.type = 'text/javascript';
                                po.async = true;
                                po.src = 'https://apis.google.com/js/platform.js';
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(po, s);
                            })();
                        </script>
                    </div>
                    <div style='display:block;margin-bottom:8px'>
                        <script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
                        <script type="IN/Share" data-url="https://wordpress.org/plugins/user-blocker/" data-counter="right" data-showzero="true"></script>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

/**
 *
 * @param type $time
 * @return time
 */
if (!function_exists('timeToTwentyfourHour')) {

    function timeToTwentyfourHour($time) {
        if ($time != '') {
            $time = date('H:i:s', strtotime($time));
        }
        return $time;
    }

}

/**
 *
 * @param type $time
 * @return time
 */
if (!function_exists('timeToTwelveHour')) {

    function timeToTwelveHour($time) {
        if ($time != '') {
            $time = date('h:i A', strtotime($time));
        }
        return $time;
    }

}

/**
 *
 * @param type $msg
 * @return text
 */
if (!function_exists('disp_msg')) {

    function disp_msg($msg) {
        $msg = sprintf(__('%s', 'user-blocker'), stripslashes(nl2br($msg)));
        return $msg;
    }

}

/**
 *
 * @param type $day
 * @param type $block_day
 * @return type Get time record
 */
if (!function_exists('get_time_record')) {

    function get_time_record($day, $block_day) {
        if (array_key_exists($day, $block_day)) {
            $from_time = $block_day[$day]['from'];
            $to_time = $block_day[$day]['to'];
            if ($from_time == '') {
                echo __('not set', 'user-blocker');
            } else {
                echo timeToTwelveHour($from_time);
            }
            if ($from_time != '' && $to_time != '') {
                printf(__(' to %s', 'user-blocker'), timeToTwelveHour($to_time));
            }
        } else {
            echo __('not set', 'user-blocker');
        }
    }

}

/**
 * Call Admin Scripts
 */
if (!function_exists('ublk_admin_scripts')) {

    function ublk_admin_scripts() {
        $screen = get_current_screen();
        $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/user-blocker/user_blocker.php', $markup = true, $translate = true);
        $current_version = $plugin_data['Version'];
        $old_version = get_option('ublk_version');
        if ($old_version != $current_version) {
            update_option('is_user_subscribed_cancled', '');
            update_option('ublk_version', $current_version);
        }
        if (get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes') {
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
    }

}

/**
 *
 * @param $actions for take a action for redirection setting
 * @param $plugin_file give path of plugin file
 * @return action for setting link
 */
if (!function_exists('ublk_settings_link')) {

    function ublk_settings_link($actions, $plugin_file) {
        static $plugin;
        if (empty($plugin))
            $plugin = dirname(plugin_basename(__FILE__)) . '/user_blocker.php';
        if ($plugin_file == $plugin) {
            $settings_link = '<a href="' . admin_url('admin.php?page=block_user') . '">' . __('Settings', 'user-blocker') . '</a>';
            array_unshift($actions, $settings_link);
        }
        return $actions;
    }

}

/**
 * Start session if not started
 */
if (!function_exists('ublk_session_start')) {

    function ublk_session_start() {
        if (session_id() == '') {
            session_start();
        }
    }

}

/**
 * Subscribe email form
 */
if (!function_exists('ublk_subscribe_mail')) {

    function ublk_subscribe_mail() {
        $customer_email = get_option('admin_email');
        $current_user = wp_get_current_user();
        $f_name = $current_user->user_firstname;
        $l_name = $current_user->user_lastname;
        if (isset($_POST['sbtEmail'])) {
            $_SESSION['success_msg'] = 'Thank you for your subscription.';
            //Email To Admin
            update_option('is_user_subscribed', 'yes');
            $customer_email = trim($_POST['txtEmail']);
            $customer_name = trim($_POST['txtName']);
            $to = 'plugins@solwininfotech.com';
            $from = get_option('admin_email');
            $headers = "MIME-Version: 1.0;\r\n";
            $headers .= "From: " . strip_tags($from) . "\r\n";
            $headers .= "Content-Type: text/html; charset: utf-8;\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP" . phpversion() . "\r\n";
            $subject = 'New user subscribed from Plugin - User Blocker';
            $body = '';
            ob_start();
            ?>
            <div style="background: #F5F5F5; border-width: 1px; border-style: solid; padding-bottom: 20px; margin: 0px auto; width: 750px; height: auto; border-radius: 3px 3px 3px 3px; border-color: #5C5C5C;">
                <div style="border: #FFF 1px solid; background-color: #ffffff !important; margin: 20px 20px 0;
                     height: auto; -moz-border-radius: 3px; padding-top: 15px;">
                    <div style="padding: 20px 20px 20px 20px; font-family: Arial, Helvetica, sans-serif;
                         height: auto; color: #333333; font-size: 13px;">
                        <div style="width: 100%;">
                            <strong>Dear Admin (User Blocker plugin developer)</strong>,
                            <br />
                            <br />
                            Thank you for developing useful plugin.
                            <br />
                            <br />
                            I <?php echo $customer_name; ?> want to notify you that I have installed plugin on my <a href="<?php echo home_url(); ?>">website</a>. Also I want to subscribe to your newsletter, and I do allow you to enroll me to your free newsletter subscription to get update with new products, news, offers and updates.
                            <br />
                            <br />
                            I hope this will motivate you to develop more good plugins and expecting good support form your side.
                            <br />
                            <br />
                            Following is details for newsletter subscription.
                            <br />
                            <br />
                            <div>
                                <table border='0' cellpadding='5' cellspacing='0' style="font-family: Arial, Helvetica, sans-serif; font-size: 13px;color: #333333;width: 100%;">
                                    <?php if ($customer_name != '') {
                                        ?>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                                Name<span style="float:right">:</span>
                                            </th>
                                            <td style="padding: 8px 5px;">
                                                <?php echo $customer_name; ?>
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr style="border-bottom: 1px solid #eee;">
                                            <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                                Name<span style="float:right">:</span>
                                            </th>
                                            <td style="padding: 8px 5px;">
                                                <?php echo home_url(); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                            Email<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo $customer_email; ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left;width: 120px;">
                                            Website<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo home_url(); ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                            Date<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo date('d-M-Y  h:i  A'); ?>
                                        </td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #eee;">
                                        <th style="padding: 8px 5px; text-align: left; width: 120px;">
                                            Plugin<span style="float:right">:</span>
                                        </th>
                                        <td style="padding: 8px 5px;">
                                            <?php echo 'User Blocker'; ?>
                                        </td>
                                    </tr>
                                </table>
                                <br /><br />
                                Again Thanks you
                                <br />
                                <br />
                                Regards
                                <br />
                                <?php echo $customer_name; ?>
                                <br />
                                <?php echo home_url(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $body = ob_get_clean();
            wp_mail($to, $subject, $body, $headers);
        }
        if (get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes') {
            ?>
            <div id="subscribe_widget_blocker" style="display:none;">
                <div class="subscribe_widget">
                    <h3>Notify to plugin developer and subscribe.</h3>
                    <form class='sub_form' name="frmSubscribe" method="post" action="<?php echo admin_url() . 'admin.php?page=block_user'; ?>">
                        <div class="sub_row"><label>Your Name: </label><input placeholder="Your Name" name="txtName" type="text" value="<?php echo $f_name . ' ' . $l_name; ?>" /></div>
                        <div class="sub_row"><label>Email Address: </label><input placeholder="Email Address" required name="txtEmail" type="email" value="<?php echo $customer_email; ?>" /></div>
                        <input class="button button-primary" type="submit" name="sbtEmail" value="Notify & Subscribe" />
                    </form>
                </div>
            </div>
            <?php
        }
        if (isset($_GET['page'])) {
            if (get_option('is_user_subscribed') != 'yes' && get_option('is_user_subscribed_cancled') != 'yes' && ($_GET['page'] == 'block_user' || $_GET['page'] == 'block_user_date' || $_GET['page'] == 'block_user_permenant' || $_GET['page'] == 'blocked_user_list' || $_GET['page'] == 'datewise_blocked_user_list' || $_GET['page'] == 'permanent_blocked_user_list' || $_GET['page'] == 'all_type_blocked_user_list')) {
                ?>
                <a style="display:none" href="#TB_inline?width=400&height=210&inlineId=subscribe_widget_blocker" class="thickbox" id="subscribe_thickbox"></a>
                <?php
            }
        }
    }

}

/**
 * User cancel subscribe
 */
if (!function_exists('wp_ajax_blocker_close_tab')) {

    function wp_ajax_blocker_close_tab() {
        update_option('is_user_subscribed_cancled', 'yes');
        exit();
    }

}