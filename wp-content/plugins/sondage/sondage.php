<?php
# fichier zero.php class Zero_Plugin
/*
Plugin Name: Sondage
Description: Plugin de sondage de satisfaction
*/

class Satisfaction_Plugin
{
    public function __construct()
    {
        include_once plugin_dir_path( __FILE__ ).'/satisfaction.php';
        new Satisfaction();

        register_activation_hook(__FILE__,array('Satisfaction','install'));
        register_deactivation_hook(__FILE__,array('Satisfaction','desactivate'));
        register_uninstall_hook(__FILE__,array('Satisfaction','uninstall'));

        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu() 
    {
        add_menu_page('Configuration du questionnaire', 'Sondage', 'manage_options', 'sondage', array($this, 'menu_html'));
        add_submenu_page('sondage', 'Réinitialisation du questionnaire', 'Réinitialisation','manage_options','reinit',array($this,'menu_html_init'));
    }

    public function menu_html()
    {
        echo '<h1>'.get_admin_page_title().'</h1>';
        echo '<p>Page du plugin Questionnaire !!!</p>';
        echo $this->resume();
    }

    public static function menu_html_init(){
        global $wpdb;
        echo '<h1>Réinitialisation<h1>';
        echo '<p>Cliquer sur le bouton ci-dessous pour remettre à zéro les résultats de votre sondage</p>';
        echo "<form method='POST' action='#'>
        <input type='submit' name='reinit' value='Réinitialiser'>
        </form>
        ";
        if(isset($_POST['reinit'])){
            $query = 'TRUNCATE TABLE '.$wpdb->prefix.'answer;';
            $wpdb->query($query);
            echo "Les résultats de votre sondage ont bien été réinitialisés";
        }
    }

    public static function resume(){
        global $wpdb;
        $query = "SELECT * FROM ".$wpdb->prefix."answer;";
        $results = $wpdb->get_results($query);
        $oui = 0;
        $non = 0;
        foreach($results as $rep){
            if($rep->choice==1)
                $oui++;
            else
                $non++;
        }
        return "Oui : $oui, Non: $non";
    }

}

new Satisfaction_Plugin();