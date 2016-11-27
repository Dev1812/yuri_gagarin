<?php
class Controller_Quotes extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('quotes'));
    $param['css'] = array('quotes');
    $param['title'] = $i18n['quotes'];
    $this->view->generate('quotes_view.php', 'template_view.php', $param, $data, $i18n);
  }
  
}