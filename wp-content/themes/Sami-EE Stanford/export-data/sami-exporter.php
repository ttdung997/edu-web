<?php
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
									
$user_meta_fields = array(	'STT' => 'STT', 'fullname' => 'Họ và tên', 'department' => 'Đơn vị', 'birthday' => 'Ngày tháng năm sinh',
							'home_address' => 'Địa chỉ nhà riêng', 'home_phone' => 'Điện thoại nhà riêng',
							'mobile_phone' => 'Điện thoại di động', 'email' => 'Email', 'homepage' => 'Website cá nhân',
							'select_hocham' => 'Học hàm', 'select_hocvi' => 'Học vị', 'select_chucdanh' => 'Chức danh',
							'text_chucvu' => 'Chức vụ', 'select_danhhieu' => 'Danh hiệu',
							'education_experience' => 'Quá trình học tập', 'employment_experience' => 'Quá trình công tác',
							'faculty_start_time' => 'Ngày về Viện', 'retire_time' => 'Ngày nghỉ hưu',
							'teaching_subject' => 'Môn giảng dạy', 'research_interest' => 'Hướng nghiên cứu',
							'received_award' => 'Thành tích', 'students' => 'Sinh viên, học viên'
						);
						
$publication_fields = array(
							'STT' => 'STT',
							'SAMI_PUBLICATION_publication_title' => 'Tên bài báo', 'SAMI_PUBLICATION_journal_title' => 'Tên tạp chí',
							'SAMI_PUBLICATION_published_year' => 'Năm xuất bản', 'SAMI_PUBLICATION_no_vol_page' => 'Số, tập, trang',
							'SAMI_PUBLICATION_authors' => 'Danh sách tác giả', 'SAMI_PUBLICATION_url' => 'URL', 'author' => 'Người đăng'
							);
							
$conference_fields = array(
							'STT' => 'STT',
							'SAMI_CONFERENCE_report_title' => 'Tên báo cáo', 'SAMI_CONFERENCE_authors' => 'Danh sách tác giả',
							'SAMI_CONFERENCE_conference_title' => 'Tên hội nghị',
							'SAMI_CONFERENCE_location' => 'Địa điểm', 'SAMI_CONFERENCE_held_year' => 'Năm tổ chức',
							'SAMI_CONFERENCE_date_month' => 'Ngày tháng tổ chức', 'SAMI_CONFERENCE_pages' => 'Trang trong kỷ yếu',
							'SAMI_PUBLICATION_url' => 'URL', 'author' => 'Người đăng'
							);							


function sami_export(){
	$ccsve_export_check = isset($_REQUEST['export']) ? $_REQUEST['export'] : '';
	if ($ccsve_export_check == 'yes') {
		$data = isset($_REQUEST['data']) ? $_REQUEST['data'] : '';
		switch ($data){
			case 'project':
				export_project_excel();
				//export_example();
			break;
			
			case 'lecturer':
				$department = isset($_REQUEST['check_department']) ? $_REQUEST['check_department'] : '';
				if (isset($department) && '' != $department){
					//var_dump($_REQUEST['check_department']);
					export_lecturer_excel($department);
				}else{
					header('Location: http://sami.hust.edu.vn/wp-admin/admin.php?page=export-data');
					die();
				}
				//export_lecturer_excel($department);
			break;
			
			case 'post-type':
				$post_type = isset($_REQUEST['post-type']) ? $_REQUEST['post-type'] : '';
				if (isset($post_type) && '' != $post_type){
					if ('project' == $post_type){
						export_project_excel();
					}elseif (('publication' == $post_type) || ('conference' == $post_type)){
						export_pub_excel($post_type);
						//header('Location: http://sami.hust.edu.vn/wp-admin/admin.php?page=export-data');
						//die();
					}
				}
			break;
			
			default:
			break;
		}
		//echo ccsve_generate();
	exit;
	}
}

function export_pub_excel($post_type){
	if (('publication' != $post_type) && ('conference' != $post_type)) return;
	
	global $publication_fields;
	global $conference_fields;
	$file_prefix = '';
	$meta_fields = '';
	
	if ('publication' == $post_type){
		$meta_fields = $publication_fields;
		$file_prefix = 'JournalPaper';
	}
	else{
		$meta_fields = $conference_fields;
		$file_prefix = 'ConferencePaper';
	}
	
	$file_name = $file_prefix . '-SAMI-'.date('d-m-Y - H.i.s').'.xlsx';
	require_once("phpexcel/Classes/PHPExcel.php");
	
	$objPHPExcel = new PHPExcel();          

    $objPHPExcel->setActiveSheetIndex(0);
    $sheet = $objPHPExcel->getActiveSheet();
    $row = '1';
    $col = "A";
	
	foreach($meta_fields as $key => $value) {
        $sheet->setCellValue($col.$row, $value);
		$sheet->getStyle($col.$row)->getFont()->setBold(true);
        $col++;
    }

	$row += 1;
	
	$args = array('post_type' => $post_type, 'posts_per_page' => -1);
	$my_posts = new WP_Query($args);
	$i = 0;
	if ($my_posts->have_posts()) : while ($my_posts->have_posts()) : $my_posts->the_post();
		global $post;
		$col = "A";
		$i ++;
		foreach ($meta_fields as $key => $value){
			switch ($key){
				case 'STT':
					 $sheet->setCellValue($col.$row, $i);
				break;
				case 'author':
					$author_id=$post->post_author;
					$first_name = get_the_author_meta('first_name');
					$last_name = get_the_author_meta('last_name');
						  
					$full_name = "$first_name $last_name";
					$sheet->setCellValue($col.$row, $full_name);				
				break;
				default:
					$meta_value = get_post_meta($post->ID, $key, true);
					$sheet->setCellValue($col.$row, $meta_value);
				break;
			}
			$col ++;
		}
		$row ++;
	endwhile;
	endif;
	
	$objPHPExcel->setActiveSheetIndex(0);
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	ob_end_clean();
	
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, charset=utf-8;");

	header('Content-Disposition: attachment;filename="'.$file_name.'"');
	
	//$objWriter->setOffice2003Compatibility(true);
	$objWriter->save('php://output');
	exit;
}

function export_lecturer_excel($department){
	global $user_meta_fields;
	
	$lecturer_filename = 'Lecturer-SAMI-'.date('d-m-Y - H.i.s').'.xlsx';
	require_once("phpexcel/Classes/PHPExcel.php");
	
	$objPHPExcel = new PHPExcel();          

    $objPHPExcel->setActiveSheetIndex(0);
    $sheet = $objPHPExcel->getActiveSheet();
    $row = '1';
    $col = "A";
	
	$hoc_ham_list = array('GS' => 'GS', 'PGS' => 'PGS', 'NONE' => '', 'None' => '');
	$hoc_vi_list = array('TS' => 'TS', 'ThS' => 'ThS', 'TSKH' => 'TSKH', 'NONE' => '', 'None' => '');

    foreach($user_meta_fields as $key => $value) {
        $sheet->setCellValue($col.$row, $value);
		$sheet->getStyle($col.$row)->getFont()->setBold(true);
        $col++;
    }

	$row += 1;	
	
	// Get user from selected departments
	$users = get_objects_in_term( $department, 'department' );
	$i = 0;
	foreach ($users as $user_id){
		$col = "A";
		$i ++;
		foreach($user_meta_fields as $key => $value){
			switch ($key){
				case 'fullname':
					$first_name = get_user_meta($user_id, 'first_name', true);
					$last_name = get_user_meta($user_id, 'last_name', true);
					$full_name = "$first_name $last_name";
					
					$sheet->setCellValue($col.$row, $full_name);
				break;
				case 'select_hocham':
				case 'select_hocvi':
				case 'select_chucdanh':
				case 'select_danhhieu':
					$meta_value = get_user_meta($user_id, $key, true);
					if ('' != $meta_value && strtoupper($meta_value) != "NONE")
					$sheet->setCellValue($col.$row, $meta_value);
				break;
				case 'STT':
					$sheet->setCellValue($col.$row, $i);
				break;
				case 'department':
					$terms = wp_get_object_terms($user_id, 'department', array('fields' => 'all_with_object_id'));
					$term_str = '';
					foreach($terms as $term) {
						if ('' == $term_str){
							$term_str = $term->name;
						}else{
							$term_str = "$term_str, " . $term->name;
						}
					}
					$sheet->setCellValue($col.$row, $term_str);
				break;
				case 'faculty_start_time':
					$faculty_start_time = get_user_meta($user_id, 'faculty_start_time', false);
					$start_date = $faculty_start_time[0];
					$faculty_start_day = $start_date['faculty_start_day'][0];
					$faculty_start_month = $start_date['faculty_start_month'][0];
					$faculty_start_year = $start_date['faculty_start_year'][0];
					
					$start_date = '';
					
					if ('' != $faculty_start_day && '--' != $faculty_start_day){
						$start_date = $faculty_start_day;
					}
					
					if ('' == $start_date){
						$start_date = $faculty_start_month;
					}else{
						$start_date = "$start_date/$faculty_start_month";
					}
					
					if ('' == $start_date){
						$start_date = $faculty_start_year;
					}else{
						$start_date = "$start_date/$faculty_start_year";
					}					
					$sheet->setCellValue($col.$row, $start_date);
				break;
				case 'retire_time':
					$retired_time = get_user_meta($user_id, 'retire_time', false);
					
					$retired_date = $retired_time[0];
					$retire_day = $retired_date['retire_day'][0];
					$retire_month = $retired_date['retire_month'][0];
					$retire_year = $retired_date['retire_year'][0];

					$retired_date = '';
					
					if ('' != $retire_day && '--' != $retire_day){
						$retired_date = $retire_day;
					}
					
					if ('' == $retired_date){
						$retired_date = $retire_month;
					}else{
						$retired_date = "$retired_date/$retire_month";
					}
					
					if ('' == $retired_date){
						$retired_date = $retire_year;
					}else{
						$retired_date = "$retired_date/$retire_year";
					}					
					$sheet->setCellValue($col.$row, $retired_date);
				break;
				case 'birthday':
					$meta_value = get_user_meta($user_id, $key, true);
					$birthday = date('m/d/Y', strtotime(str_replace('/', '-', $meta_value)));
					$sheet->setCellValue($col.$row, $birthday);
				break;
				case 'home_phone':
				case 'mobile_phone':
					$meta_value = get_user_meta($user_id, $key, true);
					//$sheet->getStyle($col.$row)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
					//$sheet->setCellValue($col.$row, $meta_value);				
					$sheet->setCellValueExplicit($col.$row, $meta_value, PHPExcel_Cell_DataType::TYPE_STRING);
				break;
				default:
					$meta_value = get_user_meta($user_id, $key, true);
					//echo "$value: $meta_value<br />";
					$meta_value = preg_replace('/<[^>]*>/', ' ', $meta_value);
					//$sheet->getStyle($col.$row)->getNumberFormat()->setFormatCode( PHPExcel_Style_NumberFormat::FORMAT_TEXT );
					$sheet->setCellValue($col.$row, $meta_value);
					
				break;
			}
			
			//$faculty_start_time = get_user_meta($user_id, 'faculty_start_time', false);
			//$retired_time = get_user_meta($user_id, 'retire_time', false);
			
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

	header('Content-Disposition: attachment;filename="'.$lecturer_filename.'"');
	
	//$objWriter->setOffice2003Compatibility(true);
	$objWriter->save('php://output');
	exit;
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
ob_end_clean();
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