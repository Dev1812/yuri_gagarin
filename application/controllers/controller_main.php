<?php
class Controller_Main extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('welcome'));
    $param['css'] = array('index');
    $param['title'] = $i18n['welcome'];
    $this->view->generate('main_view.php', 'template_view.php', $param, $data, $i18n);
  }
  
}