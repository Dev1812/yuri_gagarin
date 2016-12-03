<?php
class Controller_Photos extends Controller {
    
  function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
  }

  function action_index() {
    $i18n = $this->i18n->get(array('photos'));
    $param['css'] = array('photos', 'photo_layer');
    $param['js'] = array('photo_layer');
    $param['title'] = $i18n['photos'];
    $data = array('photo_layer' => true);
    $this->view->generate('photos_view.php', 'template_view.php', $param, $data, $i18n);
  }
  
}