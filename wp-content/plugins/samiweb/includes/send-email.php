<?php

// Set content type text/html
//add_filter( 'wp_mail_content_type', 'set_content_type' );
function set_content_type( $content_type ){
	return 'text/html';
}

add_filter( 'wp_mail', 'html_email_encode_body' );
function html_email_encode_body( $mail ) {
  $mail['message'] = esc_html( $mail['message'] );
  return $mail;
}

add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from_name($old) {
	return 'Trung tâm an toàn máy tính';
}

add_filter( 'wp_mail_from', 'my_mail_from' );
function my_mail_from( $email )
{
    return "no-reply@sami.hust.edu.vn";
}

add_action( 'phpmailer_init', 'wpse8170_phpmailer_init' );
function wpse8170_phpmailer_init( PHPMailer $phpmailer ) {
		
    $phpmailer->Host = 'smtp.gmail.com';//'smtp.gmail.com';
    $phpmailer->Port = 465; //465; // could be different
    $phpmailer->Username = 'ttiendung997';//'ami.automailer@gmail.com'; // if required
    $phpmailer->Password = 'bkcsstudent';//'sami@123456'; // if required
    $phpmailer->SMTPAuth = true; // if required
    $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible 
    
	$phpmailer->IsHTML(true);

    $phpmailer->IsSMTP();
}


/* Send email when there is a pending post */

add_action( 'transition_post_status', 'pending_post_status', 10, 3 );

function pending_post_status( $new_status, $old_status, $post ) {
    if ( $new_status === "pending" && $old_status !== "pending" ) {
		$to = '';
	
		$theme_options = get_option('sami-settings');
		$reviewer_emails = $theme_options['pending_notice_email'];
		
		$author = $post->post_author;
		$title = $post->post_title;
		
		$fullname = get_the_author_meta( 'first_name', $author ) . ' ' . get_the_author_meta( 'last_name', $author );
		$edit = get_edit_post_link( $ID, '' );
		$subject = sprintf('Bài chờ duyệt: %s', $title);
		$message = sprintf('Có bài viết đang chờ duyệt.<br /><br /><b>Tên bài viết</b>: %s.<br /><br /><b>Người đăng</b>: %s<br /><br />', $title, $fullname);
		$message .= sprintf('Bấm vào đây để phê duyệt: %s', $edit);
		foreach ($reviewer_emails as $email){
			if ('' == $to){
				$to = $email;
			}else{
				$to .= ', ' . $email;
			}
		}
		
		$header[] = '';
        wp_mail($to, $subject, $message, $header);
    }
}