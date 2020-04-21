<?php
/*
Title: Thông tin cá nhân
Capability:
Order: 10
*/

global $current_user;
get_currentuserinfo();

$firstname = $current_user->user_firstname;
$lastname = $current_user->user_lastname;

$fullname = $firstname . ' ' . $lastname;

piklist('field', array(
    'type' => 'html'
    ,'label' => 'Họ và tên'
    ,'field' => 'my_field_name' // 'field' is only required for a settings page.
    ,'value' => "<b>$fullname</b>"
    ,'description' => 'Nếu họ tên chưa đúng, vui lòng sang Tab "Tài khoản" để sửa lại'
  ));
  

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'full_name'
    ,'label' => 'Họ và tên'
    ,'value' => 'Nguyễn Thái Bình'
    ,'help' => 'You can easily add tooltips to your fields with the help parameter.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
    ,'conditions' => array(
    		'value' => 'lock'
    )
  ));
  
   
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'birthday'
    ,'label' => 'Ngày tháng năm sinh'
    ,'description' => 'Chỉ dùng cho công tác quản lý của Viện. KHÔNG công khai trên trang cá nhân.'
    ,'options' => array(
      'dateFormat' => 'M d, yy'
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('M d, Y', time())
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));  
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'home_address'
    ,'label' => 'Địa chỉ nhà riêng'
    ,'description' => 'Chỉ dùng cho công tác quản lý của Viện. KHÔNG công khai trên trang cá nhân.'
    ,'placeholder' => 'Địa chỉ nhà riêng'
    ,'help' => 'Chỉ dùng cho công tác quản lý của Viện. KHÔNG công khai trên trang cá nhân.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'home_phone'
    ,'label' => 'Điện thoại nhà riêng'
    ,'description' => 'Chỉ dùng cho công tác quản lý của Viện. KHÔNG công khai trên trang cá nhân.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'mobile_phone'
    ,'label' => 'Điện thoại di động'
    ,'description' => 'Chỉ dùng cho công tác quản lý của Viện. KHÔNG công khai trên trang cá nhân.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'email'
    ,'label' => 'Địa chỉ email'
    ,'description' => 'Nếu nhập vào thì sẽ hiển thị lên trang cá nhân.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
    ,'validate' => array(
      array(
        'type' => 'email'
      )
      ,array(
        'type' => 'email_domain'
      )
    )
  ));
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'homepage'
    ,'label' => 'Website cá nhân'
    ,'description' => 'Nếu nhập vào thì sẽ hiển thị lên trang cá nhân.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
    ,'validate' => array(
		  array(
			 'type' => 'url'
		  	)
	 )
  ));            
?>