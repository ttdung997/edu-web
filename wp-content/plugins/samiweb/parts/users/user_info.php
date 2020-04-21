<?php
/*
Title: Hồ sơ cá nhân
Order: 10
Tab: Profile
Flow: User Test
*/

global $current_user, $user_id;
$edited_user = new WP_User( $user_id );

$firstname = $edited_user->user_firstname;
$lastname = $edited_user->user_lastname;

$fullname = $firstname . ' ' . $lastname;

$month_list[''] = '';
$day_list[""] = "";
$year_list[""] = "";
$birth_years[''] = '';

for ($i = 1; $i <= 9; $i++){
	$month_list["0$i"] = "Tháng $i";//"0$i";
}
for ($i = 10; $i <= 12; $i++){
	$month_list["$i"] = "Tháng $i";//"$i";
}

for ($i = 1; $i <= 9; $i++){
	$day_list["0$i"] = "0$i";
}

for ($i = 10; $i <= 31; $i++){
	$day_list["$i"] = "$i";
}

$current_year = Date("Y");
for ($i=$current_year; $i >= 1956; $i--){
	$year_list["$i"] = $i;
}

$min_year = 1900;//$current_year - 100;
for ($i=$current_year; $i >= $min_year; $i--){
	$birth_years["$i"] = $i;
}

  piklist('field', array(
    'type' => 'file'
    ,'field' => 'lecturer_image'
    ,'label' => __('Ảnh đại diện')
    ,'description' => 'Được upload tối đa 1 file'
    ,'options' => array(
      'modal_title' => __('Chọn file ảnh')
      ,'button' => __('Chọn ảnh')
    )
    ,'attributes' => array(
      'class' => 'large-text'
    )/*
    ,'validate' => array(
      array(
        'type' => 'limit'
        ,'options' => array(
          'min' => 0
          ,'max' => 1
        )
      )
    )*/
  ));
  
piklist('field', array(
    'type' => 'html'
    ,'label' => 'Họ và tên'
    ,'field' => 'my_field_name' // 'field' is only required for a settings page.
    ,'value' => "<b>$fullname</b>"
    ,'description' => 'Nếu họ tên chưa đúng, vui lòng sang Tab "Tài khoản" để sửa lại'
  ));

/*
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
    ,'value' => ''//date('M d, Y', time())
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  $meta_value = get_user_meta($user_id, 'birthday', true);
  $b_day = date('d', strtotime(str_replace('/', '-', $meta_value)));
  $b_month = date('m', strtotime(str_replace('/', '-', $meta_value)));
  $b_year = date('Y', strtotime(str_replace('/', '-', $meta_value)));
*/
    piklist('field', array(
    'type' => 'group'
    ,'field' => 'date_of_birth'
    ,'label' => 'Ngày tháng năm sinh'
	//,'capability' => 'manage_options'
    ,'fields' => array(
		array(
        'type' => 'select'
        ,'field' => 'day_of_birth'
        ,'label' => 'Ngày'
        ,'columns' => 1
        ,'choices' => $day_list
		,'value' => ''//$b_day
      ),
	  array(
        'type' => 'select'
        ,'field' => 'month_of_birth'
        ,'label' => 'Tháng'
        ,'columns' => 2
        ,'choices' => $month_list
		,'value' => ''//$b_month
      ),
	  array(
        'type' => 'select'
        ,'field' => 'year_of_birth'
        ,'label' => 'Năm'
        ,'columns' => 2
        ,'choices' => $birth_years
		,'value' => ''//$b_year
      )
    )
  )
  );  
  
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

    piklist('field', array(
    'type' => 'group'
    ,'field' => 'faculty_start_time'
    ,'label' => 'Ngày về trường'
    ,'description' => 'Ngày chính thức về trường.'
    ,'fields' => array(
		array(
        'type' => 'select'
        ,'field' => 'faculty_start_day'
        ,'label' => 'Ngày'
        ,'columns' => 2
        ,'choices' => $day_list
      ),
	  array(
        'type' => 'select'
        ,'field' => 'faculty_start_month'
        ,'label' => 'Tháng'
        ,'columns' => 2
        ,'choices' => $month_list
      ),
	  array(
        'type' => 'select'
        ,'field' => 'faculty_start_year'
        ,'label' => 'Năm'
        ,'columns' => 2
        ,'choices' => $year_list
      )
    )
  ));

    piklist('field', array(
    'type' => 'group'
    ,'field' => 'retire_time'
    ,'label' => 'Ngày về hưu'
    ,'description' => 'Ngày tháng năm về hưu.'
    ,'fields' => array(
		array(
        'type' => 'select'
        ,'field' => 'retire_day'
        ,'label' => 'Ngày'
        ,'columns' => 2
        ,'choices' => $day_list
      ),
	  array(
        'type' => 'select'
        ,'field' => 'retire_month'
        ,'label' => 'Tháng'
        ,'columns' => 2
        ,'choices' => $month_list
      ),
	  array(
        'type' => 'select'
        ,'field' => 'retire_year'
        ,'label' => 'Năm'
        ,'columns' => 2
        ,'choices' => $year_list
      )
    )
  )
  );

  piklist('include_user_profile_fields', array(
    'meta_boxes' => array(
      //'Personal Options'
      'Username'
      ,'New Password'
    , 'Đơn vị'
    ,'Taxonomies'
    )
  ));
  
?>
