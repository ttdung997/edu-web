<?php
/*
Title: Học viên Thạc sĩ và Tiến sĩ
Order: 70
Tab: Profile
Flow: User Test
*/

piklist('field', array(
    'type' => 'editor'
    ,'field' => 'students'
    ,'label' => 'Học viên Tiến sĩ, Cao học'
    ,'description' => 'Thông tin học viên Tiến sĩ, Thạc sĩ đã và đang hướng dẫn. Thông tin tìm học viên.'
    ,'options' => array (
      'media_buttons' => true
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
  ));

?>
