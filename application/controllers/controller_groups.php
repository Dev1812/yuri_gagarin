<?php
class Controller_Groups extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
   // $this->model = new Model_Main;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('groups'));
    $param['css'] = array('groups');
    $param['title'] = $i18n['groups'];
    $this->view->generate('groups_view.php', 'template_view.php', $param, $data, $i18n);
  }
  
}