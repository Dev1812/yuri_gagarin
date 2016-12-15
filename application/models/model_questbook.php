<?php
class Model_Questbook extends Model {

  const MIN_FIRSTNAME = 3;
  const MAX_FIRSTNAME = 21;

  const MIN_MESSAGE = 3;
  const MAX_MESSAGE = 147;

  public $max_rows = 10;
  public $captcha;
  public $database;
  public $date;
  public $i18n;

  public function __construct() {
    $this->database = DataBase::connect();
    $this->date = new Date;
    $this->i18n = new i18n;  
  }

  public function addMsg($firstname, $message) {
    $firstname_length = mb_strlen($firstname);
    $message_length = mb_strlen($message);

    if($firstname_length < self::MIN_FIRSTNAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_firstname'));
    } elseif($firstname_length > self::MAX_FIRSTNAME) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('long_firstname'));
    } elseif(!preg_match('/^[a-zа-яё]{2,}$/ui', $firstname)) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('incorrect_firstname'));    
    }

    if($message_length < self::MIN_MESSAGE) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('short_msg'));
    } elseif($message_length > self::MAX_MESSAGE) {
      return array('err'=>true,'err_msg'=>$this->i18n->get('long_msg'));
    }
    
    $ts = time();
    $add_msg = $this->database->prepare("INSERT INTO `questbook`(`id`, `owner_name`, `date_created`, `text`) VALUES('',:owner_name,:date_created,:_text)");
    $add_msg->execute(array(':owner_name' => $firstname,
    	                    ':date_created' => $ts,
    	                    ':_text' => $message));
    return array('err'=>false,'msg_id'=>$this->database->lastInsertId(),'firstname'=>$firstname,'date_created'=> $this->date->parseTimestamp($ts),'text'=>$message);
  }


  public function getMessages($offset = 0){
    $offset = intval($offset);
    $has_more = false;
    $get_message = $this->database->prepare("SELECT `id`, `owner_name`, `date_created`, `text` FROM `questbook` ORDER BY `id` DESC LIMIT :offset, :max_rows");
    $get_message->bindParam(':offset', $offset, PDO::PARAM_INT);
    $get_message->bindParam(':max_rows', $this->max_rows,  PDO::PARAM_INT);
    $get_message->execute();

    while($row = $get_message->fetch(PDO::FETCH_ASSOC)) {
      $row['date'] = $this->date->parseTimestamp($row['date_created']);
      $arr[] = $row;
    }

    if(count($arr) >= $this->max_rows) {
      $has_more = true;
    }

    $offset = $offset + $this->max_rows;
    return array('err'=>false,'messages'=>$arr,'has_more'=>$has_more,'offset'=>$offset);
  }
}
?>