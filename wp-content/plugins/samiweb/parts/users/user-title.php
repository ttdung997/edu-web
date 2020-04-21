<?php
/*
Title: Học hàm-Học vị-Chức danh-Chức vụ
Order: 20
Tab: Profile
Flow: User Test
*/

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_hocham'
    ,'label' => 'Học hàm'
    ,'description' => 'GS, PGS'
    ,'choices' => array(
    	'NONE' => '--'
      ,'GS' => 'Giáo sư'
      ,'PGS' => 'Phó giáo sư'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_hocvi'
    ,'label' => 'Học vị'
    ,'description' => 'TSKH, TS, ThS'
    ,'choices' => array(
    	'NONE' => '--'
      ,'TSKH' => 'Tiến sĩ khoa học'
      ,'TS' => 'Tiến sĩ'
      ,'ThS' => 'Thạc sĩ'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));
  
  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_chucdanh'
    ,'label' => 'Chức danh'
    ,'description' => 'GVCC, GVC, GV'
    ,'choices' => array(
    	'NONE' => '--'
      ,'GV' => 'Giảng viên'
      ,'GVC' => 'Giảng viên chính'
      ,'GVCC' => 'Giảng viên cao cấp'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  )); 
  
  piklist('field', array(
    'type' => 'select'
    ,'field' => 'select_danhhieu'
    ,'label' => 'Danh hiệu'
    ,'description' => 'Nhà giáo nhân dân, nhà giáo ưu tú'
    ,'choices' => array(
    	'NONE' => '--'
      ,'NGND' => 'Nhà giáo nhân dân'
      ,'NGUT' => 'Nhà giáo ưu tú'
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));  
  
  piklist('field', array(
    'type' => 'text'
    ,'field' => 'text_chucvu'
    ,'label' => 'Chức vụ'
    ,'description' => 'Viện trưởng, Viện phó, Trưởng bộ môn, Trưởng bộ phận, v.v.'
    ,'attributes' => array(
      'class' => 'regular-text'
    )
  ));   
?>