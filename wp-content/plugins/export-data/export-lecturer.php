<?php
$department = isset($_REQUEST['check_department']) ? $_REQUEST['check_department'] : '';

$project_custom_fields = array('SAMI_PROJECTS_name', 'SAMI_PROJECTS_code', 'project-type', 'project_role', 'SAMI_PROJECTS_start_year',
								'SAMI_PROJECTS_end_year', 'author');
$project_custom_fields_name = array('STT' => 'STT',
									'SAMI_PROJECTS_name' => 'Tên đề tài', 'SAMI_PROJECTS_code' => 'Mã đề tài',
									'project-type' => 'Loại đề tài',  'author' => 'Tác giả', 'project_role' => 'Vai trò',
									'SAMI_PROJECTS_start_year' => 'Năm bắt đầu',
									'SAMI_PROJECTS_end_year' => 'Năm kết thúc',
									'SAMI_PROJECTS_key_members' => 'Các thành viên chính');
									
$custom_fields_names = array('Tên đề tài', 'Mã đề tài',
									'Loại đề tài', 'Vai trò',
									'Năm bắt đầu',
									'Năm kết thúc', 'Tác giả');
									

export_project_excel();
function export_project_excel(){
	global $project_custom_fields;
	global $project_custom_fields_name;
	global $custom_fields_names;

	// Get the custom post type that is being exported
	$ccsve_generate_post_type = 'project';
	// Get the custom fields (for the custom post type) that are being exported
	$ccsve_generate_custom_fields = get_option('ccsve_custom_fields');
	// Query the DB for all instances of the custom post type
	$ccsve_generate_query = get_posts(array('post_type' => 'project', 'post_status' => 'publish', 'posts_per_page' => -1));
	// Count the number of instances of the custom post type
	$ccsve_count_posts = count($ccsve_generate_query);
	
	// Build an array of the custom field values
	$ccsve_generate_value_arr = array();
	$i = 0; 
	
	foreach ($ccsve_generate_query as $post): setup_postdata($post);	
			// get the custom field values for each instance of the custom post type 
		     $ccsve_generate_post_values = get_post_custom($post->ID);
			 //var_dump($project_custom_fields);
		  
		  //foreach ($project_custom_fields as $key) {
		  foreach ($project_custom_fields_name as $key => $val){
			  switch ($key){
				  case 'STT':
					  $ccsve_generate_value_arr[$key][$i] = $i + 1;
				  break;
				  case 'project-type':
						 $terms = get_the_terms($post->ID, $key);
						foreach ($terms as $term){
							$term_name = $term->name;
							$term_id = $term->term_id;
						}
						$ccsve_generate_value_arr[$key][$i] = $term_name;
						//var_dump($term_name);
				  break;
				  case 'project_role':
						$terms = get_the_terms($post->ID, $key);
						foreach ($terms as $term){
							$term_name = $term->name;
							$term_id = $term->term_id;
						}
						$ccsve_generate_value_arr[$key][$i] = $term_name;						
				  break;
				  case 'author':
					  $author_id=$post->post_author;
					  $first_name = get_the_author_meta('first_name');
					  $last_name = get_the_author_meta('last_name');
							  
					  $full_name = "$first_name $last_name";
					  $ccsve_generate_value_arr[$key][$i] =	$full_name;			  
				  break;
				  default:
						 $ccsve_generate_value_arr[$key][$i] = get_post_meta($post->ID, $key, true);
				  break;
			  }

		  }
		  //var_dump($ccsve_generate_value_arr);
		  
		$i++;
		 
	endforeach;

	// create a new array of values that reorganizes them in a new multidimensional array where each sub-array contains all of the values for one custom post instance
	$ccsve_generate_value_arr_new = array();
	
	foreach($ccsve_generate_value_arr as $value) {
		   $i = 0;
		   while ($i <= ($ccsve_count_posts-1)) {
			 $ccsve_generate_value_arr_new[$i][] = $value[$i];
			$i++;
		}
	}
	
	//var_dump($ccsve_generate_value_arr_new);

	// build a filename based on the post type and the data/time
	$project_filename = 'Project-SAMI-'.date('d-m-Y - H.i.s').'.xlsx';
	
	//output the headers for the CSV file
    require_once("phpexcel/Classes/PHPExcel.php");

    $objPHPExcel = new PHPExcel();          

    $objPHPExcel->setActiveSheetIndex(0);
    $sheet = $objPHPExcel->getActiveSheet();
    $row = '1';
    $col = "A";

    foreach($project_custom_fields_name as $key => $value) {
        $sheet->setCellValue($col.$row, $value);
		$sheet->getStyle($col.$row)->getFont()->setBold(true);
        $col++;
    }

	$row += 1;
	
	foreach ( $ccsve_generate_value_arr_new as $data ) {
		$col = "A";
		foreach ($data as $field_value){
			$sheet->setCellValue($col.$row, $field_value);
			$col++;
		}
		$row += 1;
	}
	$objPHPExcel->setActiveSheetIndex(0);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	ob_end_clean();
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, charset=utf-8;");

	header('Content-Disposition: attachment;filename="'.$project_filename.'"');
	
	//$objWriter->setOffice2003Compatibility(true);
	$objWriter->save('php://output');
}