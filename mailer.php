<?php
/* if ($_POST['code'] != date('d.m.Y') . 'text8989') { */
if ($_POST) {
  if ($_POST['code'] != 'text8989') {
    exit;
  }
  $form_type = htmlspecialchars($_POST["form_type"]);

  if ( !empty($_POST["city"]) ) {
    return true;
  }


  $json = array();

  function mime_header_encode($str, $data_charset, $send_charset) {
    if($data_charset != $send_charset)
    $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
    return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
  }

  class TEmail {
    public $from_email;
    public $from_name;
    public $to_email;
    public $to_name;
    public $subject;
    public $data_charset='UTF-8';
    public $send_charset='windows-1251';
    public $body='';
    public $type='text/plain';

    function send(){
      $dc=$this->data_charset;
      $sc=$this->send_charset;
      $enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
      $enc_subject=mime_header_encode($this->subject,$dc,$sc);
      $enc_from=mime_header_encode($this->from_name,$dc,$sc).' <'.$this->from_email.'>';
      $enc_body=$dc==$sc?$this->body:iconv($dc,$sc.'//IGNORE',$this->body);
      $headers='';
      $headers.="Mime-Version: 1.0\r\n";
      $headers.="Content-type: text/html; charset=".$sc."\r\n";
      $headers.="From: ".$enc_from."\r\n";
      return mail($enc_to,$enc_subject,$enc_body,$headers);
    }

  }

  $message_body = "";

  if ( $form_type == 'bottom-order' ) {

    /*
    * Новая заявка внизу страницы
    */
    $form_title = "Новый заказ!";
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);

    $message_body='
      <tr>
        <td colspan="2" style="padding: 10px 0;">
          <div style="font: normal 26px Arial;">' . $form_title . '</div>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Имя</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $name . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Имя</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $phone . '</span>
        </td>
      </tr>
    ';

  } else if ( $form_type == 'order' ) {

    /*
    * Новая заявка на конкретный товар
    */
    $form_title = "Заказ на Бинокля";
    $name = htmlspecialchars($_POST["name"]);
    $adress = htmlspecialchars($_POST["adress"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $item = htmlspecialchars($_POST["item"]);

    $message_body='
      <tr>
        <td colspan="2" style="padding: 10px 0;">
          <div style="font: normal 26px Arial;">' . $form_title . '</div>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Имя</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $name . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Адрес</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $adress . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Телефон</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $phone . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Товар</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $item . '</span>
        </td>
      </tr>
    ';

  } else if ( $form_type == 'callback' ) {

    /*
    * Новая заявка на конкретный товар
    */
    $form_title = "Заказ обратного звонка БИНОКЛЬ!";
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);

    $message_body='
      <tr>
        <td colspan="2" style="padding: 10px 0;">
          <div style="font: normal 26px Arial;">' . $form_title . '</div>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Имя</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $name . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Телефон</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $phone . '</span>
        </td>
      </tr>
    ';

  } else if ( $form_type == 'contact' ) {

    /*
    * Со страницы "Контакты"
    */
    $form_title = "Новое сообщение из раздела «Контакты»";
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $text = htmlspecialchars($_POST["text"]);

    $message_body='
      <tr>
        <td colspan="2" style="padding: 10px 0;">
          <div style="font: normal 26px Arial;">' . $form_title . '</div>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Имя</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $name . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Телефон</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $phone . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Email</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $email . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding: 10px 0; padding-right: 30px;" valign="top">
          <span style="font: bold 10px Arial;">Сообщение</span>
        </td>
        <td style="padding: 10px 0;" valign="top">
          <span>' . $text . '</span>
        </td>
      </tr>
    ';

  } else {

    die();

  }

  $message_start = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml>
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body>
  <div style="max-width: 850px; padding: 20px; display: block;"><div style="border: 5px solid #de4667; padding: 40px;"><table cellspacing="2" cellpadding="2" border="0" style="text-align: left;">';
  $message_content = $message_body;
  $message_end = '</table></div></div></body></html>';
  $message = $message_start . $message_content . $message_end;

  $emailgo= new TEmail;
  $emailgo->from_email= 'info@rose34.ru';
  $emailgo->from_name= 'Робот Иван';
  $emailgo->to_email= '6aa999@gmail.com';
  //$emailgo->to_name= '';
  $emailgo->subject= $form_title;
  $emailgo->body= $message;
  
  if ( $emailgo->send() ) {
    $json['error'] = 0; 
  } else {
    $json['error'] = 1;
  }

  echo json_encode($json);

} else {

  echo 'GET LOST!';

}

?>