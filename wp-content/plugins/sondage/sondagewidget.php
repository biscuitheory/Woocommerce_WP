<?php
# newsletterwidget.php contenant la classe Zero_Newsletter_Widget /// QuestionWidget.php chez Lysa
class showQuestion extends WP_Widget
{
    public function __construct()
        {
            parent::__construct('idShowQuestion', 'Réaliser un sondage', array('description' => 'Un formulaire de sondage'));

        }

        public function widget($args, $instance) 
        {
            global $wpdb;

            $table =$wpdb->prefix.'answer';
            $idUser = get_current_user_id();
            if(isset($_POST['oui'])){
                $wpdb->insert( $table, array('idUser'=>$idUser, 'choice'=>1));
            }
            if(isset($_POST['non'])){
                $wpdb->insert( $table, array('idUser'=>$idUser, 'choice'=>0));
            }

            echo "<form action='' method='post'>
                <h1>".$instance['question']."</h1>
                <input type='checkbox' name='oui' id='oui'/> Oui 
                <input type='checkbox' name='non' id='non'/> Non <br/>
                <input type='submit'/>
            </form>";
        }

        public function form($instance)
        {
            $question = isset($instance['question']);
            $id = $this->get_field_id('question');
            $name = $this->get_field_name('question');
            echo "<p>Nom de la question <input type='text' id=$id name='".$name."' value='".$question."'></p>";
        }
}