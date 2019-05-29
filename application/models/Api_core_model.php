<?php
  
if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

defined('BASEPATH') or exit('Direct access to script is not allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Api_core_model extends CI_Model {
  public function __construct() {
    parent::__construct();
    $this->load->database();
    
  }

 public function get_details($email) {
    return $this->db->get_where('users', array('email' => $email))->row();
  }
  public function register(){
    $name = $this->input->post('name', true);
    $email = $this->input->post('email', true);
    $referer = $this->input->post('referer', true);

    /*$data3 = array('user_email' => $referer, 'amount' =>$bonus_percent, 'growth'=>$bonus_percent, 'release_date'=>$release_date,  'type' => $type, 'bonus_remark'=>'referer bonus', 'trnxcode'=>$code, 'date_created'=>$timee, 'status' =>'pending','last_cash_added'=> $tymee);
     $query3 = $this->db->insert('bonus', $data3);
     */
    if($referer==''){ $referer='kinjuun@gmail.com';}else{
      $referer = $this->db->get_where('users', array('ref_code' => $referer))->row()->email;
    }
    $password = hash('ripemd128', $this->input->post('password', true));
    //$bundle = $this->input->post('bundle', true);
    //$transn_type = $this->input->post('transn_type', true);
     //$email = $email;
    $this->load->helper('string');
    $this->load->library('email');
        $code = random_string('alnum', 8);
        $refcode = random_string('alnum', 8);
        $creted_at = date('Y-m-d H:i:s');
        

$subject = $name.' Verify Your Dizcovery Account ';
$from_name = 'Timchosen From Dizcovery';
// Get full html:
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <!--[if gte mso 9]><xml>
   <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
   </o:OfficeDocumentSettings>
  </xml><![endif]-->
  <!-- fix outlook zooming on 120 DPI windows devices -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
  <title>Welcome to Dizcovery Network</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
table {
  border-spacing: 0;
}
table td {
  border-collapse: collapse;
}
.ExternalClass {
  width: 100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}
.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}
table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}
img {
  -ms-interpolation-mode: bicubic;
}
.yshortcuts a {
  border-bottom: none !important;
}
@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
a[href^="x-apple-data-detectors:"],
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            '.$name.' Welcome to Dizcovery
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550; text-transform: capitalize">We need you to activate your account</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
  Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you can now start earning DIZ tokens when you read, like and share sponsored discoveries.
    <br><br>
    You can follow and keep up with the latest updates via our social channels : 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Join the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO </li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team
</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
            <br><br>
            © Dizcovery Network 2018.
            <br><br>

            You are receiving this email because you opted in on our website. Update your <a href="#" style="color:#aaaaaa">email preferences</a> or <a href="#" style="color:#aaaaaa">unsubscribe</a>.
            <br><br>

            
            <br><br>

          </td>
        </tr>
      </table>
<!--/600px container -->


    </td>
  </tr>
</table>
<!--/100% background wrapper-->

</body>
</html>';
$message = 'Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you can now start earning DIZ tokens when you read, like and share sponsored discoveries.
    <br><br>
    You can follow and keep up with the latest updates via our social channels : 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Join the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO </li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team';
  
  
$url = 'https://api.elasticemail.com/v2/email/send';


//return $this->email->print_debugger();
    $data = array('name' => $name, 'email' => $email, 'referer' => $referer,
     'password' => $password, 'is_blocked'=>'false', 'verify'=>$code, 'ref_code'=>$refcode, 'created_at'=>$creted_at);
    $q = $this->db->insert('users', $data);
    if($q) {

      $this->email->from('noreply@dizcovery.network', 'Timchosen From Dizcovery');
$this->email->to($email);
// $this->email->cc('another@another-example.com');
// $this->email->bcc('them@their-example.com');

$this->email->subject($subject);
$this->email->message($body);

$this->email->send();
return $this->email->print_debugger();
    
// try{
//         $post = array('from' => 'noreply@dizcovery.network',
// 		'fromName' => $from_name,
// 		'apikey' => '2e5eea0d-10b1-4b4f-92b1-3ec647ac839a',
// 		'subject' => $subject,
// 		'to' => $email,
// 		'bodyHtml' => $body,
// 		'bodyText' => $message,
// 		'isTransactional' => false);
		
// 		$ch = curl_init();
// 		curl_setopt_array($ch, array(
//             CURLOPT_URL => $url,
// 			CURLOPT_POST => true,
// 			CURLOPT_POSTFIELDS => $post,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_HEADER => false,
// 			CURLOPT_SSL_VERIFYPEER => false
//         ));
		
//         $result=curl_exec ($ch);
//         curl_close ($ch);
		
//       return  $this->db->query("UPDATE users SET ver_ref='1' WHERE email='$email'");
// }
// catch(Exception $ex){
// 	echo $ex->getMessage();
// }
}
    
    
   
 }



public function login($email, $password) {

    $query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'is_blocked' => 'false'));

    $result = $query->result();

    if($result) {
      return  true;} 
    else { return false;}
    }




  public function sendmail() {
    $email = $this->input->post('email', true);
    $this->load->helper('string');
    $code = random_string('alnum', 8);
    $data = array('code' => $code, 'user' => $email, 'status' =>'0');
    $this->db->insert('reset_codes', $data);
    $this->load->library('email');
    // $this->email->initialize($config);


    $to = $email;
    $nameto = '';
    $subject = 'Password Recovery for Dizcovery';

    $message = 'Hello dear user, visit https://dizcovery.network/reset and use '.$code.' as your reset code to change your password<br/> <br/> Thank you';
  // Get full html:
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <!--[if gte mso 9]><xml>
   <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
   </o:OfficeDocumentSettings>
  </xml><![endif]-->
  <!-- fix outlook zooming on 120 DPI windows devices -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
  <title>Password Recovery For Dizcovery Network</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
table {
  border-spacing: 0;
}
table td {
  border-collapse: collapse;
}
.ExternalClass {
  width: 100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}
.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}
table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}
img {
  -ms-interpolation-mode: bicubic;
}
.yshortcuts a {
  border-bottom: none !important;
}
@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
a[href^="x-apple-data-detectors:"],
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            Password Recovery For Dizcovery Network
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550; text-transform: capitalize">We heard you lost your password</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
  We heard you lost your password to Dizcovery Network, I and the whole Dizcovery Network Team would like to say how sorry we are. This may not be entirely your fault and we are with you all the way .
  <br><br>

  To begin with, please <a href="https://dizcovery.network/reset"> click here </a> and use the code: '.$code.' to reset your password or visit  https://dizcovery.network/reset in your browser.
  <br><br>
  After you have succeeded in resetting your password, you will be able to login and all things should be back to normal from thence. 
    <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team
</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:4px;padding-right:4px">
            <br><br>
            © Dizcovery Network 2018.
            <br><br>

            You are receiving this email because you opted in on our website. Update your <a href="#" style="color:#aaaaaa">email preferences</a> or <a href="#" style="color:#aaaaaa">unsubscribe</a>.
            <br><br>

            
            <br><br>

          </td>
        </tr>
      </table>
<!--/600px container -->


    </td>
  </tr>
</table>
<!--/100% background wrapper-->

</body>
</html>';

$this->email->from('noreply@dizcovery.network', 'Timchosen From Dizcovery');
$this->email->to($email);
// $this->email->cc('another@another-example.com');
// $this->email->bcc('them@their-example.com');

$this->email->subject($subject);
$this->email->message($body);

$this->email->send();
return $this->email->print_debugger();
   
  }



 public function reset() {
   $code = $this->input->post('code', true);
    $password = hash('ripemd128', $this->input->post('password', true));
$email_query = $this->db->query("SELECT * FROM reset_codes WHERE code='$code'");
    $email_result = $email_query->row_array();
    $email = $email_result['user'];
    
$query = $this->db->query("UPDATE users SET password='$password' WHERE email='$email'");
    if($query) {
      $this->db->query("UPDATE reset_codes SET status='1' WHERE code='$code'");
      return true;} 
      else {return false;}
  }


 public function change_password() {
   $password1 = $this->input->post('password1', true);
   $password2 = $this->input->post('password2', true);
    $password = hash('ripemd128', $this->input->post('password', true));
$email_query = $this->db->query("SELECT * FROM users WHERE password='$password'");
    $email_result = $email_query->row_array();
    $email = $email_result['email'];
    
$query = $this->db->query("UPDATE users SET password='$password1' WHERE email='$email'");
    if($query) {
      return true;} 
      else {return false;}
  }

 public function verify_code() {
   $code = $this->input->post('code', true);
    $password = hash('ripemd128', $this->input->post('password', true));
    $drow = $this->db->get_where('users', array('verify' => $code))->row(); 
    if ($drow) { 
    $user_id = $drow->id;
    $referer = $drow->referer; 
    $rrow = $this->db->get_where('users', array('email' => $referer))->row(); 
    $referer_id = $rrow->id; 


$query = $this->db->query("UPDATE users SET verify='8' WHERE verify='$code'");
    if($query) {
     //  $data = array('user_id' => $user_id, 'amount'=>'62.5', 'remark' =>'Signup Bonus', 'status'=>'1');
     // $query2= $this->db->insert('earnings', $data);
     // $data2 = array('user_id' => $referer_id, 'amount'=>'10.', 'remark' =>'Referer Bonus', 'status'=>'1');
     // $query3= $this->db->insert('earnings', $data2);
      return true;} 
      else {return false;}
    } 
      else {return false;}
  }

 public function get_support_cat() {
    $query = $this->db->get('supportcat');
   return  $query->result_array();
     
  } 



public function sendSupport(){
    $subject = strtoupper($this->input->post('subject', true));
    $message = $this->input->post('message', true);
    $email = $this->input->post('email', true);
    $cat = $this->input->post('category', true);
    //$date = time();
    $error = array();
    $file = $_FILES['proof']['name'];
    if(!empty($file)) {

    $validextensions = array("jpeg", "jpg", "png"); //Extensions which are allowed
      $ext = explode('.', basename($file)); //explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable
        $target_dir = './proofs/';
        $target_file = $target_dir . basename(str_replace(' ', '-', $file));      
        if(!in_array($file_extension, $validextensions)) {
            $error[] = 'File extension is invalid';
        }
        if(count($error) == 0) {
          if(!move_uploaded_file($_FILES['proof']['tmp_name'], $target_file)) { die("File not uploaded"); }
          }else {foreach ($error as $errors) { echo '<div class="alert alert-danger">'.$errors.'</div>';}
        }
      }//if (!empty($file));

    $data = array('subject' => $subject, 'email' => $email, 'category' => $cat, 'message' =>$message, 'evidence'=>$file);
     $query = $this->db->insert('support', $data);
      if($query) {return true;} else {return false;}
  }


public function send_support_reply(){
    $message = $this->input->post('message', true);
    $email = $this->session->userdata('email');
    $r_id= $this->input->post('replyid', true);
    //$date = time();
    $error = array();
    $file = $_FILES['proof']['name'];
    if(!empty($file)) {

    $validextensions = array("jpeg", "jpg", "png"); //Extensions which are allowed
      $ext = explode('.', basename($file)); //explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable
        $target_dir = './proofs/';
        $target_file = $target_dir . basename(str_replace(' ', '-', $file));      
        if(!in_array($file_extension, $validextensions)) {
            $error[] = 'File extension is invalid';
        }
        if(count($error) == 0) {
          if(!move_uploaded_file($_FILES['proof']['tmp_name'], $target_file)) { die("File not uploaded"); }
          }else {foreach ($error as $errors) { echo '<div class="alert alert-danger">'.$errors.'</div>';}
        }
      }//if (!empty($file));

    $data = array('sender_email' => $email, 'reciever_email'=>'admin', 'reply' =>$message, 'reply_id'=>$r_id, 'evidence'=>$file);
     $query = $this->db->insert('support_replies', $data);
      if($query) {return true;} else {return false;}
  }





public function get_support_history($email) {
   $this->db->order_by('id','DESC');
    return $this->db->get_where('support', array('email' => $email))->result_array();

  } 


  public function get_support_reply($id) {
    $query = $this->db->query("UPDATE support_replies SET read_status='1' WHERE reply_id='$id'");
    //$result = $query->result();
    return $this->db->get_where('support_replies', array('reply_id' => $id))->result_array();
  
  } 
  
  
  
   
   public function resendmail() {
    $email_query = $this->db->query("SELECT * FROM users WHERE verify !='8' and ver_ref='4' LIMIT 0, 100 ");
    $emailResult = $email_query->result_array();
    $this->load->helper('string');
    $this->load->library('email');
 
	foreach($emailResult as $row) {
	$name = $row['name'];
	$email = $row['email'];
	$code = $row['verify'];

$subject = $name.' Verify Your Dizcovery Account ';
$from_name = 'Timchosen From Dizcovery';
// Get full html:
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <!--[if gte mso 9]><xml>
   <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
   </o:OfficeDocumentSettings>
  </xml><![endif]-->
  <!-- fix outlook zooming on 120 DPI windows devices -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
  <title>Welcome to Dizcovery Network</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
table {
  border-spacing: 0;
}
table td {
  border-collapse: collapse;
}
.ExternalClass {
  width: 100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}
.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}
table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}
img {
  -ms-interpolation-mode: bicubic;
}
.yshortcuts a {
  border-bottom: none !important;
}
@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
a[href^="x-apple-data-detectors:"],
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            '.$name.' Welcome to Dizcovery
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550; text-transform: capitalize">We need you to activate your account</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
  Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you will recieve $50 worth of Dizcovery Network Coins and can start refering others while you earn referal bonuses. 
    <br><br>
    In order to recieve your tokens after the ICO, make sure you have: 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Joined the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO  and comment on or share the bounty post</li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team
</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
            <br><br>
            © Dizcovery Network 2018.
            <br><br>

            You are receiving this email because you opted in on our website. Update your <a href="#" style="color:#aaaaaa">email preferences</a> or <a href="#" style="color:#aaaaaa">unsubscribe</a>.
            <br><br>

            
            <br><br>

          </td>
        </tr>
      </table>
<!--/600px container -->


    </td>
  </tr>
</table>
<!--/100% background wrapper-->

</body>
</html>';
$message = 'Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you will recieve $10 worth of Dizcovery Network Coins and can start refering others while you earn referal bonuses. 
    <br><br>
    In order to recieve your tokens after the ICO, make sure you have: 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Joined the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO  and comment on or share the bounty post</li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team';
  
  
// $url = 'https://api.elasticemail.com/v2/email/send';


//return $this->email->print_debugger();
    $data = array('name' => $name, 'email' => $email, 'referer' => $referer,
     'password' => $password, 'is_blocked'=>'false', 'verify'=>$code, 'ref_code'=>$refcode, 'created_at'=>$creted_at);
    $q = $this->db->insert('users', $data);
    if($q) {
    
// try{
//         $post = array('from' => 'noreply@dizcovery.network',
// 		'fromName' => $from_name,
// 		'apikey' => '2e5eea0d-10b1-4b4f-92b1-3ec647ac839a',
// 		'subject' => $subject,
// 		'to' => $email,
// 		'bodyHtml' => $body,
// 		'bodyText' => $message,
// 		'isTransactional' => false);
		
// 		$ch = curl_init();
// 		curl_setopt_array($ch, array(
//             CURLOPT_URL => $url,
// 			CURLOPT_POST => true,
// 			CURLOPT_POSTFIELDS => $post,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_HEADER => false,
// 			CURLOPT_SSL_VERIFYPEER => false
//         ));
		
//         $result=curl_exec ($ch);
//         curl_close ($ch);
		
//       return  $this->db->query("UPDATE users SET ver_ref='1' WHERE email='$email'");
// }
// catch(Exception $ex){
// 	echo $ex->getMessage();
// }
// exit;

    $this->email->from('noreply@dizcovery.network', 'Timchosen From Dizcovery');
$this->email->to($email);
// $this->email->cc('another@another-example.com');
// $this->email->bcc('them@their-example.com');

$this->email->subject($subject);
$this->email->message($body);

$this->email->send();
return $this->email->print_debugger();
} } }



 
   public function reverify() {
   $email = $this->session->email;
       $this->load->library('email');


    $query = $this->db->query("SELECT * FROM users WHERE email='$email'");
    $emailResult = $query->row_array();
    
	$name = $emailResult['name'];
	$email = $emailResult['email'];
	$code = $emailResult['verify'];

$subject = $name.' Verify Your Dizcovery Account ';
$from_name = 'Timchosen From Dizcovery';
// Get full html:
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <!--[if gte mso 9]><xml>
   <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
   </o:OfficeDocumentSettings>
  </xml><![endif]-->
  <!-- fix outlook zooming on 120 DPI windows devices -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- So that mobile will display zoomed in -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- enable media queries for windows phone 8 -->
  <meta name="format-detection" content="date=no"> <!-- disable auto date linking in iOS 7-9 -->
  <meta name="format-detection" content="telephone=no"> <!-- disable auto telephone linking in iOS 7-9 -->
  <title>Welcome to Dizcovery Network</title>
  
  <style type="text/css">
body {
  margin: 0;
  padding: 0;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
}
table {
  border-spacing: 0;
}
table td {
  border-collapse: collapse;
}
.ExternalClass {
  width: 100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height: 100%;
}
.ReadMsgBody {
  width: 100%;
  background-color: #ebebeb;
}
table {
  mso-table-lspace: 0pt;
  mso-table-rspace: 0pt;
}
img {
  -ms-interpolation-mode: bicubic;
}
.yshortcuts a {
  border-bottom: none !important;
}
@media screen and (max-width: 599px) {
  .force-row,
  .container {
    width: 100% !important;
    max-width: 100% !important;
  }
}
@media screen and (max-width: 400px) {
  .container-padding {
    padding-left: 12px !important;
    padding-right: 12px !important;
  }
}
.ios-footer a {
  color: #aaaaaa !important;
  text-decoration: underline;
}
a[href^="x-apple-data-detectors:"],
a[x-apple-data-detectors] {
  color: inherit !important;
  text-decoration: none !important;
  font-size: inherit !important;
  font-family: inherit !important;
  font-weight: inherit !important;
  line-height: inherit !important;
}
</style>
</head>

<body style="margin:0; padding:0;" bgcolor="#F0F0F0" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<!-- 100% background wrapper (grey background) -->
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#F0F0F0">
  <tr>
    <td align="center" valign="top" bgcolor="#F0F0F0" style="background-color: #F0F0F0;">

      <br>

      <!-- 600px container (white background) -->
      <table border="0" width="600" cellpadding="0" cellspacing="0" class="container" style="width:600px;max-width:600px">
        <tr>
          <td class="container-padding header" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:bold;padding-bottom:12px;color:#DF4726;padding-left:24px;padding-right:24px">
            '.$name.' Welcome to Dizcovery
          </td>
        </tr>
        <tr>
          <td class="container-padding content" align="left" style="padding-left:24px;padding-right:24px;padding-top:12px;padding-bottom:12px;background-color:#ffffff">
            <br>

<div class="title" style="font-family:Helvetica, Arial, sans-serif;font-size:18px;font-weight:600;color:#374550; text-transform: capitalize">We need you to activate your account</div>
<br>

<div class="body-text" style="font-family:Helvetica, Arial, sans-serif;font-size:14px;line-height:20px;text-align:left;color:#333333">
  Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you will recieve $50 worth of Dizcovery Network Coins and can start refering others while you earn referal bonuses. 
    <br><br>
    In order to recieve your tokens after the ICO, make sure you have: 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Joined the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO  and comment on or share the bounty post</li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team
</div>

          </td>
        </tr>
        <tr>
          <td class="container-padding footer-text" align="left" style="font-family:Helvetica, Arial, sans-serif;font-size:12px;line-height:16px;color:#aaaaaa;padding-left:24px;padding-right:24px">
            <br><br>
            © Dizcovery Network 2018.
            <br><br>

            You are receiving this email because you opted in on our website. Update your <a href="#" style="color:#aaaaaa">email preferences</a> or <a href="#" style="color:#aaaaaa">unsubscribe</a>.
            <br><br>

            
            <br><br>

          </td>
        </tr>
      </table>
<!--/600px container -->


    </td>
  </tr>
</table>
<!--/100% background wrapper-->

</body>
</html>';
$message = 'Hello '.$name.', We are super excited you decided to signup for Dizcovery Network even as we are still in our alpha beta testing stage. This means a whole lot to me and the whole Dizcovery Network Team.
  <br><br>

  In order to ensure that your email account is valid, please <a href="https://dizcovery.network/verify"> click here </a> and use the code: <br><strong> '.$code.' </strong> to verify your account or by visiting  https://dizcovery.network/verify in your browser.
  <br><br>
  After you have activated your account you will recieve $50 worth of Dizcovery Network Coins and can start refering others while you earn referal bonuses. 
    <br><br>
    In order to recieve your tokens after the ICO, make sure you have: 
    <ol>
    <li> <a href="t.me/dizcoveryICO"> Joined the Telegram Group </a> http://t.me/dizcoveryICO </li>
    <li> <a href="twitter.com/dizcoveryICO"> Follow Dizcovery on twitter </a> http://twitter.com/dizcoveryICO and retweet the pinned tweet </li>
    <li> <a href="fb.me/dizcoveryICO"> Like the Facebook Page </a> http://fb.me/dizcoveryICO  and comment on or share the bounty post</li>
    </ol>
        <br><br>
  Warmest Regards,<br><br>
  Timchosen and the Dizcovery Network Team';
  
  
// $url = 'https://api.elasticemail.com/v2/email/send';


//return $this->email->print_debugger();
   $this->email->from('noreply@dizcovery.network', 'Timchosen From Dizcovery');
$this->email->to($email);
// $this->email->cc('another@another-example.com');
// $this->email->bcc('them@their-example.com');

$this->email->subject($subject);
$this->email->message($body);

$this->email->send();
return $this->email->print_debugger(); 

}








}
 ?>
