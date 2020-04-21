<?php
/*
Title: Các thành tích, giải thưởng đã đạt được
Order: 40
Tab: Profile
Flow: User Test
*/
  
  piklist('field', array(
    'type' => 'editor'
    ,'field' => 'received_award'
    ,'label' => 'Các thành tích đã đạt được'
    ,'options' => array (
      'media_buttons' => false
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
  ));
?>
