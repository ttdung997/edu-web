<?php

//response generation function
$response = "";

//function to generate response
function my_contact_form_generate_response($type, $message){

	global $response;

	if($type == "success") $response = "<div class='success'>{$message}</div>";
	else $response = "<div class='error'>{$message}</div>";

}
  
//response messages
$not_human       = "Số xác nhận bị sai.";
$missing_content = "Bạn chưa điền đầy đủ thông tin.";
$email_invalid   = "Địa chỉ email không hợp lệ.";
$message_unsent  = "Lỗi khi gửi câu hỏi. Vui lòng thực hiện lại.";
$message_sent    = "Câu hỏi của bạn đã được gửi đi.";
 
//user posted variables
$sender_name = isset($_POST['message_name']) ? $_POST['message_name'] : '';
$sender_email = isset($_POST['message_email']) ? $_POST['message_email'] : '';
$message_subject = isset($_POST['message_subject']) ? $_POST['message_subject'] : '';
$message_text = isset($_POST['message_text']) ? $_POST['message_text'] : '';
$human = isset($_POST['message_human']) ? $_POST['message_human'] : '';
 
//php mailer variables
//$to = get_option('admin_email');



get_header('page');

if (have_posts()) : while (have_posts()) : the_post(); ?>			
<h1 class="article-title"><?php the_title(); ?></h1>
<div class="article-content">
<?php
	$email_arr = rwmb_meta(  'SAMI_CONTACT_FORM_email', true);
	$to = '';
	foreach($email_arr as $email){
		if ('' == $to){
			$to = $email;
		}else{
			$to .= ", $email";
		}
	}
	
	$contact_form_title = get_the_title();
	$message_subject = "[$contact_form_title] $message_subject";
	$email_headers = array();
	//$email_headers[] = "From: Vi <$sender_email>";
	$email_headers[] = "Reply-To: $sender_email";
	$email_headers[] = "Content-type: text/html" ;
	
	$message_text = nl2br($message_text);
	
	$message_text = "<html><body>"
					. "<b>Người hỏi</b>: $sender_name<br /><br />"
					. "<b>Email</b>: $sender_email<br /><br />"
					. "<b>Tiêu đề</b>: $message_subject<br /><br />"
					. "<b>Nội dung</b>:<br />$message_text <br />"
					. "</body></html>";
	  
	if(!$human == 0){
	  if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
	  else {
	  
		$error = 0;
	 
		//validate email
		if(!filter_var($sender_email, FILTER_VALIDATE_EMAIL)){
			my_contact_form_generate_response("error", $email_invalid);
			$error = 1;
		}
		
		//validate presence of name and message
		if(empty($sender_name) || empty($message_text) || empty($message_subject)){
		  my_contact_form_generate_response("error", $missing_content);
			$error = 1;
		}
		if (0 == $error){
			remove_filter( 'wp_mail', 'html_email_encode_body' );
			$sent = wp_mail($to, $message_subject, $message_text, $email_headers);
		
			if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
			else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
		}
	  }
	}
	else if (isset($_POST['submitted']) && $_POST['submitted']) my_contact_form_generate_response("error", $missing_content);
?>

<style type="text/css">
  .error{
    padding: 5px 9px;
    border: 1px solid red;
    color: red;
    border-radius: 3px;
  }
 
  .success{
    padding: 5px 9px;
    border: 1px solid green;
    color: green;
    border-radius: 3px;
  }
 
  form span{
    color: red;
  }
  
	input, textarea {
	border: 1px solid #ddd;
	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.4);
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.4);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.4);
	}
	
	#sami-contact-form .button{
		background-color: #8C1515;
		color: #fff;
	}
	.contact-form-field{margin-top: 10px;}
</style>
 
<div id="respond">
  <?php echo $response; ?>
  <form action="<?php the_permalink(); ?>" method="post" id="sami-contact-form">
    <div class="contact-form-field"><label for="name">Họ và tên: <span>*</span> <br><input type="text" name="message_name" value="<?php echo isset($_POST['message_name']) ? esc_attr($_POST['message_name']) : ''; ?>" size="30" maxlength="200" style="max-width: 100%! important"></label></div>
    <div class="contact-form-field"><label for="message_email">Email: <span>*</span> <br><input type="text" name="message_email" value="<?php echo isset($_POST['message_email']) ? esc_attr($_POST['message_email']) : ''; ?>" size="30" maxlength="200" style="max-width: 100%! important"></label></div>
    <div class="contact-form-field"><label for="message_subject">Tiêu đề: <span>*</span> <br><input type="text" name="message_subject" value="<?php echo isset($_POST['message_subject']) ? esc_attr($_POST['message_subject']) : ''; ?>" size="30" maxlength="200" style="max-width: 100%! important"></label></div>
    <div class="contact-form-field"><label for="message_text">Nội dung: <span>*</span></label> <br><textarea type="text" name="message_text" rows="8" style="width: 100%! important; font-weight: normal; display: inline;"><?php echo isset($_POST['message_text']) ? stripslashes(esc_textarea($_POST['message_text'])) : ''; ?></textarea></div>
    <div class="contact-form-field"><label for="message_human">Xác nhận: <span>*</span></label> <br><input type="text" style="width: 60px;" name="message_human"> + 3 = 5</label></p>
    <input type="hidden" name="submitted" value="1" class="button" label="Gửi">
    <div><input type="submit" class="btn btn-default button" value="Gửi"></div>
  </form>
</div>

</div>
<?php
endwhile;
else : ?>

<p><?php _e("Không tồn tại form liên hệ."); ?></p>

<?php endif; ?>
		
	
<?php
	get_footer('page');
?>
