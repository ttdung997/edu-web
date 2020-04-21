<?php
/*
Title: Hướng nghiên cứu
Capability:
Order: 50
*/

piklist('field', array(
    'type' => 'editor'
    ,'field' => 'research_interest'
    ,'label' => 'Hướng nghiên cứu'
    ,'description' => 'Thông tin về hướng nghiên cứu đang thực hiện.'
    ,'options' => array (
      'media_buttons' => true
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
  ));

?>
