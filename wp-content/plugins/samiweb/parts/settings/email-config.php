<?php
/*
Title: Cấu hình email
Setting: sami-settings
Order: 3
Tab: Cấu hình email
Flow: Setting Workflow
*/

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'pending_notice_email'
    ,'label' => 'Email nhận thông báo có bài viết chờ duyệt'
    ,'description' => "Bắt buộc phải nhập. Bấm vào dấu (+) để thêm địa chỉ email."
    ,'attributes' => array(
      'class' => 'large-text'
    )
    ,'required' => true
    ,'add_more' => true
    ,'validate' => array(
      array(
        'type' => 'email'
      )
      ,array(
        'type' => 'email_domain'
      )
    ) 
    ,'columns' => 12  
  ));
  
  piklist('field', array(
    'type' => 'group'
    ,'label' => 'Cấu hình SMTP Email dùng để gửi email (Hỏi đáp, Thông báo có bài chờ duyệt, v.v.)'
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'smtp_host'
        ,'label' => 'SMTP Host'
		,'value' => "smtp.gmail.com"
		,'description' => 'Ví dụ: smtp.gmail.com'
        ,'columns' => 12,
      )
      ,array(
        'type' => 'text'
        ,'field' => 'smtp_port'
        ,'label' => 'SMTP Port'
		,'value' => "465"
		,'description' => 'Ví dụ: 465'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'email_login'
        ,'label' => 'Tên đăng nhập'
		,'value' => "ami.automailer@gmail.com"
		,'description' => 'Tên đăng nhập của email dùng để gửi thư. Ví dụ: ami.automailer@gmail.com'
        ,'columns' => 12
      )
      ,array(
        'type' => 'text'
        ,'field' => 'email_password'
        ,'label' => 'Mật khẩu'
		,'value' => "sami@123456"
		,'description' => 'Mật khẩu của email gửi thư.'
        ,'columns' => 12
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  ));  
?>
