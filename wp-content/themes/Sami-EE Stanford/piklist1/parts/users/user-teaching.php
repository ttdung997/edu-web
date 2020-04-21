<?php
/*
Title: Môn giảng dạy
Capability:
Order: 40
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
