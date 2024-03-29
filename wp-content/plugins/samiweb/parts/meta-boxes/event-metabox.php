<?php
/*
Title: Thông tin sự kiện
Description: this is the description
Post Type: piklist_demo
Order: 10
Collapse: false
*/
?>

<?php

  piklist('field', array(
    'type' => 'text'
    ,'field' => 'event_name'
    ,'label' => 'Tên sự kiện'
    ,'description' => 'Bắt buộc phải nhập'
    ,'help' => 'Tên sự kiện'
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'Tên sự kiện'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
    ,'required' => true
  ));
  
  piklist('field', array(
    'type' => 'datepicker'
    ,'field' => 'event_date'
    ,'label' => 'Ngày'
    ,'description' => 'Ngày bắt đầu sự kiện'
    ,'options' => array(
      'dateFormat' => 'd/m/yy'
    )
    ,'attributes' => array(
      'size' => 12
    )
    ,'value' => date('M d, Y', time())
    ,'on_post_status' => array(
      'value' => 'lock'
    )
    ,'required' => true
  ));

  piklist('field', array(
    'type' => 'group'
    ,'field' => 'start_time'
    ,'label' => 'Giờ bắt đầu'
    ,'list' => false
    ,'fields' => array(
    	array(
        'type' => 'select'
        ,'field' => 'hour'
        ,'label' => 'Giờ'
        ,'columns' => 2
        ,'choices' => array(
        		'' => '--',
        		'00' => '00',
        		'01' => '01',
        		'02' => '02',
        		'03' => '03',
        		'04' => '04',
        		'05' => '05',
        		'06' => '06',
        		'07' => '07',
        		'08' => '08',
        		'09' => '09',
        		'10' => '10',
        		'11' => '11',
        		'12' => '12',
        		'13' => '13',
        		'14' => '14',
        		'15' => '15',
        		'16' => '16',
        		'17' => '17',
        		'18' => '18',
        		'19' => '19',
        		'20' => '20',
        		'21' => '21',
        		'22' => '22',
        		'23' => '23'
        )
      ),
      array(
        'type' => 'select'
        ,'field' => 'minute'
        ,'label' => 'Phút'
        ,'columns' => 2
        ,'choices' => array(
        		'' => '--',
        		'00' => '00',
        		'15' => '15',
        		'30' => '30',
        		'45' => '45'
        )
      )
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  )); 
  
  piklist('field', array(
    'type' => 'group'
    ,'field' => 'end_time'
    ,'label' => 'Giờ kết thúc'
    ,'list' => false
    ,'fields' => array(
    	array(
        'type' => 'select'
        ,'field' => 'hour'
        ,'label' => 'Giờ'
        ,'columns' => 2
        ,'choices' => array(
        		'' => '--',
        		'00' => '00',
        		'01' => '01',
        		'02' => '02',
        		'03' => '03',
        		'04' => '04',
        		'05' => '05',
        		'06' => '06',
        		'07' => '07',
        		'08' => '08',
        		'09' => '09',
        		'10' => '10',
        		'11' => '11',
        		'12' => '12',
        		'13' => '13',
        		'14' => '14',
        		'15' => '15',
        		'16' => '16',
        		'17' => '17',
        		'18' => '18',
        		'19' => '19',
        		'20' => '20',
        		'21' => '21',
        		'22' => '22',
        		'23' => '23'
        ),
      ),
      array(
        'type' => 'select'
        ,'field' => 'minute'
        ,'label' => 'Phút'
        ,'columns' => 2
        ,'choices' => array(
        		'' => '--',
        		'00' => '00',
        		'15' => '15',
        		'30' => '30',
        		'45' => '45'
        )
      ),
    )
    ,'on_post_status' => array(
        'value' => 'lock'
      )
  )); 
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'event_location'
    ,'label' => 'Địa điểm'
    ,'description' => 'Bắt buộc phải nhập'
    ,'help' => 'Địa điểm diễn ra sự kiện'
    ,'attributes' => array(
      'class' => 'regular-text'
      ,'placeholder' => 'Địa điểm diễn ra sự kiện'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
    ,'required' => true
  ));     
?>
