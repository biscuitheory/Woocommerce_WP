<?php
# newsletter.php class Zero_Newsletter
class Satisfaction
{
    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'/sondagewidget.php';

        add_action('widgets_init', function(){register_widget('showQuestion');});
    }

    public static function install()
    {
        global $wpdb;
        $wpdb->query("CREATE TABLE IF NOT EXISTS ".$wpdb->prefix."answer (id int(11) AUTO_INCREMENT PRIMARY KEY, choice tinyint(1), idUser int(11));");
    }

    public static function uninstall()
    {
        global $wpdb;
        $wpdb->query("DROP TABLE IF EXISTS ".$wpdb->prefix."answer;");
    }

}
