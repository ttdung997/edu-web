<?php
$project_custom_fields = array('SAMI_PROJECTS_name', 'SAMI_PROJECTS_code', 'project-type', 'project_role', 'SAMI_PROJECTS_start_year',
								'SAMI_PROJECTS_end_year', 'author');
$project_custom_fields_name = array('STT' => 'STT',
									'SAMI_PROJECTS_name' => 'Tên đề tài', 'SAMI_PROJECTS_code' => 'Mã đề tài',
									'project-type' => 'Loại đề tài', 'project_role' => 'Vai trò',
									'SAMI_PROJECTS_start_year' => 'Năm bắt đầu',
									'SAMI_PROJECTS_end_year' => 'Năm kết thúc', 'author' => 'Tác giả',
									'SAMI_PROJECTS_key_members' => 'Các thành viên chính');
									
$custom_fields_names = array('Tên đề tài', 'Mã đề tài',
									'Loại đề tài', 'Vai trò',
									'Năm bắt đầu',
									'Năm kết thúc', 'Tác giả');										
function sami_export(){
	$ccsve_export_check = isset($_REQUEST['export']) ? $_REQUEST['export'] : '';
	if ($ccsve_export_check == 'yes') {
		$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';
		switch ($data){
			case 'project':
				//export_project_excel();
				export_example();
			break;
			
			case 'lecturer':
				export_lecturer();
			break;
			
			case 'lecturer-alumni':
				export_lecturer_alumni();
			break;
			
			default:
			break;
		}
		//echo ccsve_generate();
	exit;
	}
}

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

	// build a filename based on the post type and the data/time
	$ccsve_generate_csv_filename = $ccsve_generate_post_type.'-'.date('Ymd_His').'-export.xlsx';
	
	//output the headers for the CSV file
    require_once("phpexcel/Classes/PHPExcel.php");

    $objPHPExcel = new PHPExcel();          

    $objPHPExcel->setActiveSheetIndex(0);
    $sheet = $objPHPExcel->getActiveSheet();
    $row = '1';
    $col = "A";
/*	
    foreach($project_custom_fields_name as $key => $value) {
        //$sheet->setCellValue($col.$row, $value);
		$sheet->setCellValueByColumnAndRow($col, $row, $data);
		$row = $row + 1;
        //$col++;
    }	
*/
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Hello')
				->setCellValue('B2', 'world!')
				->setCellValue('C1', 'Hello')
				->setCellValue('D2', 'world!');
	$row += 1;
	$col = "A";
	
	foreach ( $ccsve_generate_value_arr_new as $data ) {
		//var_dump($data);
	}
	
	//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	//$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
	//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	$objPHPExcel->setActiveSheetIndex(0);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    //header('Cache-Control: max-age=0');
    //$objWriter->save('php://output');
/*	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, charset=utf-8;");
*/
	header('Content-Disposition: attachment;filename="'.$ccsve_generate_csv_filename.'"');
	
	//$objWriter->setOffice2003Compatibility(true);
	$objWriter->save('php://output');
    exit;  	

    // Put the data from the new multi-dimensional array into the stream
    //fputcsv($fh, $data);
}

function export_project(){
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

	// build a filename based on the post type and the data/time
	$ccsve_generate_csv_filename = $ccsve_generate_post_type.'-'.date('Ymd_His').'-export.csv';
	
	//output the headers for the CSV file
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header('Content-Description: File Transfer');
	header("Content-type: text/csv; charset=UTF-8");
	header('Content-Encoding: UTF-8');
	header("Content-Disposition: attachment; filename={$ccsve_generate_csv_filename}");
	header("Expires: 0");
	header("Pragma: public");
 
	//open the file stream
	$fh = @fopen( 'php://output', 'w' );
	
	$BOM = "\xEF\xBB\xBF";
	fwrite($fh, $BOM); // NEW LINE
	
	$headerDisplayed = false;
 
	foreach ( $ccsve_generate_value_arr_new as $data ) {
    // Add a header row if it hasn't been added yet -- using custom field keys from first array
    if ( !$headerDisplayed ) {
        //fputcsv($fh, array_keys($ccsve_generate_value_arr));
		fputcsv($fh, array_values($project_custom_fields_name));
        $headerDisplayed = true;
    }
 
    // Put the data from the new multi-dimensional array into the stream
    fputcsv($fh, $data);
}
// Close the file stream
fclose($fh);
// Make sure nothing else is sent, our file is done
exit;

	}
	
function export_example(){

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once("phpexcel/Classes/PHPExcel.php");


// Create new PHPExcel object
echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");


// Add some data
echo date('H:i:s') , " Add some data" , EOL;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Hello')
            ->setCellValue('B2', 'world!')
            ->setCellValue('C1', 'Hello')
            ->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'Miscellaneous glyphs')
            ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');


$objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);


// Rename worksheet
echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$ccsve_generate_csv_filename = 'project'.'-'.date('Ymd_His').'-export.xlsx';
header('Content-Disposition: attachment;filename="'.$ccsve_generate_csv_filename.'"');
$objWriter->save('php://output');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Save Excel 95 file
echo date('H:i:s') , " Write to Excel5 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;
}