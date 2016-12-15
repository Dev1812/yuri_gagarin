<?php
class Controller_Questbook extends Controller {
    
  public function __construct() {
    $this->i18n = new i18n;
    $this->view = new View;
    $this->model = new Model_Questbook;
    $this->security = new Security;
    $this->captcha = new Captcha;
    $this->security->setSessionName('questbook_hash');
  }

  public function action_index() {
    $i18n = $this->i18n->get(array('questbook'));
    $param['css'] = array('questbook');
    $param['js'] = array('questbook');
    $param['title'] = $i18n['questbook'];
    $data['messages'] = $this->model->getMessages();
    $data['form_hash'] = $this->security->getCSRFToken();
    $this->view->generate('questbook_view.php', 'template_view.php', $param, $data, $i18n);
  }

  public function action_a_add_msg() {
    if(!$this->captcha->checkCode($_POST['captcha'])) {
      //Incorrect Captha Code
      $data['ajax'] = array('err'=>true,'err_msg'=>$this->i18n->get('captcha_error'),'js'=>'updateCaptcha("captcha_img");ge("captcha_code").focus()');
    } elseif(!$this->security->checkCSRFToken($_POST['form_hash'])) {
      //Incorrect Form Hash
      $data['ajax'] = array('err'=>true,'err_msg'=>'<div class="form_msg_title">'.$this->i18n->get('unknown_error').'</div>');
    } else {
      //All is correct, calling addMsg Method
      $data['ajax'] = $this->model->addMsg($_POST['firstname'], $_POST['message']);
    }
    $this->view->generate(null, 'ajax/questbook/add_msg.php', null, $data, $i18n);
  }
  
  public function action_a_get_more() {
    $data['ajax'] = $this->model->getMessages($_GET['offset']);
    $this->view->generate(null, 'ajax/questbook/get_more.php', null, $data);
  }
}