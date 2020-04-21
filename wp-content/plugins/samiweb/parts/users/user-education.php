<?php
/*
Title: Quá trình học tập và công tác
Order: 30
Tab: Profile
Flow: User Test
*/

piklist('field', array(
    'type' => 'editor'
    ,'field' => 'education_experience'
    ,'label' => 'Quá trình học tập'
    ,'options' => array (
      'media_buttons' => true
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
  ));

piklist('field', array(
    'type' => 'editor'
    ,'field' => 'employment_experience'
    ,'label' => 'Quá trình công tác'
    ,'options' => array (
      'media_buttons' => true
      ,'teeny' => true
      ,'textarea_rows' => 5
      ,'drag_drop_upload' => true
    )
  ));

?>
