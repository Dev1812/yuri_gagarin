<?php
class Controller_Questbook extends Controller {
    
  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Questbook;
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('questbook'));
    $param['css'] = array('questbook');
    $param['title'] = $i18n['questbook'];
    $data['messages'] = $this->model->getMessages();
    $this->view->generate('questbook_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_a_add_msg() {
    $data['add_msg'] = $this->model->addMsg($_POST['firstname'], $_POST['message']);
    $this->view->generate(null, '/ajax/questbook/add_msg.php', null, $data, $i18n);
  }
  
}