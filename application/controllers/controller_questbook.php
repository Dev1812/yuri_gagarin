<?php
class Controller_Questbook extends Controller {
    
  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('questbook'));
    $param['css'] = array('questbook');
    $param['title'] = $i18n['questbook'];
    $this->view->generate('questbook_view.php', 'template_view.php', $param, $data, $i18n);
  }
  
}