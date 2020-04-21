<?php
/*
Title: Môn giảng dạy
Order: 50
Tab: Profile
Flow: User Test
*/

piklist('field', array(
    'type' => 'editor'
    ,'field' => 'teaching_subject'
    ,'label' => 'Môn giảng dạy'
    ,'description' => 'Thông tin về hướng nghiên cứu đang thực hiện.'
    ,'options' => array (
      'media_buttons' => true
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
    ,'attribute' => array('class' => 'teaching-subject')
  ));

?>
