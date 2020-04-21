<?php
/*
remove_role('subscriber');
remove_role('contributor');
remove_role('author');
remove_role('editor');
remove_role('student-publication-editor');

remove_role( 'editor');
remove_role( 'event-editor' );
remove_role( 'sylabus-editor' );
remove_role( 'template-author' );
remove_role( 'student-publication-author' );
remove_role( 'submit-template-author' );
remove_role( 'seminar-author' );
remove_role( 'content-manager' );
remove_role( 'lecturers' );
remove_role( 'lecturer' );

remove_role( 'seminar-manager');
remove_role( 'student-notice-manager' );
remove_role( 'syllabus-manager' );
remove_role( 'mau-don-manager' );
remove_role( 'bieu-mau-manager' );
remove_role( 'dethi-manager' );
remove_role( 'event-manager' );
remove_role( 'news-manager');
remove_role( 'notice-manager');
remove_role( 'alumni-manager' );
remove_role( 'job-manager' );
remove_role( 'system-manager' );
remove_role( 'content-manager' );
remove_role( 'lecturer-alumni');
remove_role( 'student-list-manager');
remove_role( 'news-contributor');
*/

$lecturer_caps = array( 'read' => true, 'upload_files' => true, 'edit_files' => true,
								'edit_posts' => true, 'delete_posts' => true,
								
								'edit_event' => true, 'edit_events' => true,
								'delete_event' => true, 'delete_events' => true,
								
								'edit_document' => true, 'edit_documents' => true,
								'publish_documents' => true,								
								'edit_published_documents' => true,
								'delete_document' => true, 'delete_documents' => true,
								
								'edit_new' => true, 'edit_news' => true,
								'delete_new' => true, 'delete_news' => true,
								'assign_new_tags' => true,
								
								'edit_project' => true, 'edit_projects' => true,
								'edit_published_projects' => true,
								'delete_project' => true, 'delete_projects' => true, 'delete_published_projects' => true,
								'assign_project_tags' => true, 'publish_projects' => true,							

								'edit_publication' => true, 'edit_publications' => true,
								'edit_published_publications' => true,
								'delete_publication' => true, 'delete_publications' => true, 'delete_published_publications' => true,
								'assign_publication_tags' => true, 'publish_publications' => true,
								
								'edit_conference' => true, 'edit_conferences' => true,
								'edit_published_conferences' => true,
								'delete_conference' => true, 'delete_conferences' => true, 'delete_published_conferences' => true,
								'assign_conference_tags' => true, 'publish_conferences' => true,

								'edit_notification' => true, 'edit_notifications' => true,
								'delete_notification' => true, 'delete_notifications' => true,
								'assign_notification_tags' => true,

								'edit_job' => true, 'edit_jobs' => true,
								'delete_job' => true, 'delete_jobs' => true,
							);

$seminar_caps = array('read' => true, 'upload_files' => true,
								'edit_seminar' => true, 'edit_seminars' => true, 'read_seminar' => false, 'read_others_seminars' => false,
								'publish_seminars' => true,								
								'edit_published_seminars' => true, 'edit_private_seminars' => false,
								'delete_seminar' => true, 'delete_seminars' => true, 'delete_published_seminars' => false,
								'delete_others_seminars' => false, 'delete_private_seminars' => false
					);
$student_caps = array('read' => true, 'upload_files' => true,
								'edit_student' => true, 'edit_students' => true, 'read_student' => false, 'read_others_students' => false,
								'publish_students' => true,								
								'edit_published_students' => true, 'edit_private_students' => false,
								'delete_student' => true, 'delete_students' => true, 'delete_published_students' => false,
								'delete_others_students' => false, 'delete_private_students' => false						
);

$alumni_caps = array('read' => true, 'upload_files' => true,
								'edit_alumni' => true, 'edit_alumnis' => true, 'read_alumni' => false, 'read_others_alumnis' => false,
								'publish_alumnis' => true,								
								'edit_published_alumnis' => true, 'edit_private_alumnis' => false,
								'delete_alumni' => true, 'delete_alumnis' => true, 'delete_published_alumnis' => false,
								'delete_others_alumnis' => false, 'delete_private_alumnis' => false);
								
$mau_don_caps = array('read' => true, 'upload_files' => true,
								'edit_maudon' => true, 'edit_maudons' => true, 'read_maudon' => false, 'read_others_maudons' => false,
								'publish_maudons' => true,								
								'edit_published_maudons' => true, 'edit_private_maudons' => false,
								'delete_maudon' => true, 'delete_maudons' => true, 'delete_published_maudons' => false,
								'delete_others_maudons' => false, 'delete_private_maudons' => false);
$bieu_mau_caps = array('read' => true, 'upload_files' => true,
								'edit_bieumau' => true, 'edit_bieumaus' => true, 'read_bieumau' => false, 'read_others_bieumaus' => false,
								'publish_bieumaus' => true,								
								'edit_published_bieumaus' => true, 'edit_private_bieumaus' => false,
								'delete_bieumau' => true, 'delete_bieumaus' => true, 'delete_published_bieumaus' => false,
								'delete_others_bieumaus' => false, 'delete_private_bieumaus' => false);
$syllabus_caps = array('read' => true, 'upload_files' => true,
								'edit_syllabus' => true, 'edit_syllabuses' => true, 'read_syllabus' => false, 'read_others_syllabuses' => false,
								'publish_syllabuses' => true,								
								'edit_published_syllabuses' => true, 'edit_private_syllabuses' => false,
								'delete_syllabus' => true, 'delete_syllabuses' => true, 'delete_published_syllabuses' => false,
								'delete_others_syllabuses' => false, 'delete_private_syllabuses' => false);
$de_thi_caps = array('read' => true, 'upload_files' => true,
								'edit_dethi' => true, 'edit_dethis' => true, 'read_dethi' => false, 'read_others_dethis' => false,
								'publish_dethis' => true,								
								'edit_published_dethis' => true, 'edit_private_dethis' => false,
								'delete_dethi' => true, 'delete_dethis' => true, 'delete_published_dethis' => false,
								'delete_others_dethis' => false, 'delete_private_dethis' => false);
								
$event_caps = array('read' => true, 'upload_files' => true, 'manage_event' => true,
								'edit_event' => true, 'edit_events' => true, 'read_event' => true, 'read_others_events' => true,
								'publish_events' => true, 'edit_others_events' => true,							
								'edit_published_events' => true, 'edit_private_events' => true,
								'delete_event' => true, 'delete_events' => true, 'delete_published_events' => true,
								'delete_others_events' => true, 'delete_private_events' => true);

$content_manager_caps = array('read' => true,
							  'manage_page' => true,
							 
							 'edit_pages' => true, 'edit_private_pages' => true, 'edit_published_pages' => true,
							 'publish_pages' => true,
							 'edit_others_pages' => true, 'read_private_pages' => true,
							 
							 'delete_pages' => true, 'delete_others_pages' => true,
							 'delete_private_pages' => true, 'delete_published_pages' => true);
							 
$content_manager_caps = array_merge($content_manager_caps, $seminar_caps, $student_caps, $alumni_caps,
								   $mau_don_caps, $bieu_mau_caps, $syllabus_caps, $de_thi_caps);


$news_contributor_caps = array( 'read' => true, 'upload_files' => true,
								
								'edit_event' => true, 'edit_events' => true, 'read_event' => false, 'read_others_events' => false,
								'edit_published_events' => false, 'edit_private_events' => false,
								'delete_event' => true, 'delete_events' => true, 'delete_published_events' => false,
								'delete_others_events' => false, 'delete_private_events' => false ,
								
								'edit_new' => true, 'edit_news' => true, 'read_new' => false, 'read_others_news' => false,
								'edit_published_news' => false, 'edit_private_news' => false,
								'delete_new' => true, 'delete_news' => true, 'delete_published_news' => false,
								'delete_others_news' => false, 'delete_private_news' => false,
								'assign_new_tags' => true,

								'edit_notification' => true, 'edit_notifications' => true, 'read_notification' => false, 'read_others_notifications' => false,
								'edit_published_notifications' => false, 'edit_private_notifications' => false,
								'delete_notification' => true, 'delete_notifications' => true, 'delete_published_notifications' => false,
								'delete_others_notifications' => false, 'delete_private_notifications' => false,
								'assign_notification_tags' => true,

								'edit_job' => true, 'edit_jobs' => true, 'read_job' => false, 'read_others_jobs' => false,
								'edit_published_jobs' => false, 'edit_private_jobs' => false,
								'delete_job' => true, 'delete_jobs' => true, 'delete_published_jobs' => false,
								'delete_others_jobs' => false, 'delete_private_jobs' => false,
							);
							
add_role( 'lecturer', 'Giảng viên' , $lecturer_caps);
add_role( 'news-contributor', 'Đăng tin tức, thông báo, sự kiện (Cần phê duyệt)', $news_contributor_caps );
add_role( 'news-manager', 'Duyệt tin tức, thông báo, sự kiện' );
add_role( 'seminar-manager', 'Phụ trách seminar (Không cần phê duyệt)', $seminar_caps);
add_role( 'syllabus-manager', 'Đăng đề cương môn học (Không cần phê duyệt)', $syllabus_caps );
add_role( 'mau-don-manager', 'Đăng mẫu đơn (Không cần phê duyệt)', $mau_don_caps );
add_role( 'bieu-mau-manager', 'Đăng biểu mẫu (Không cần phê duyệt)', $bieu_mau_caps );
add_role( 'dethi-manager', 'Đăng đề thi các môn (Không cần phê duyệt)', $de_thi_caps );
add_role( 'student-notice-manager', 'Đăng thông báo sinh viên (Không cần phê duyệt)', $student_caps );
add_role( 'alumni-manager', 'Đăng tin tức, thông báo cựu sinh viên (Không cần phê duyệt)', $alumni_caps );
add_role( 'student-list-manager', 'Quản lý danh sách Nghiên cứu sinh, học viên Thạc sĩ (Không cần phê duyệt)');
//add_role( 'lecturer-alumni', 'Cựu giáo chức');
add_role( 'content-manager', 'Quản trị nội dung', $content_manager_caps );

    // gets the administrator role
    $content_manager = get_role( 'content-manager' );
	
	$content_manager->add_cap(  'edit_files' );
	$content_manager->add_cap(  'edit_posts' );
	$content_manager->add_cap(  'delete_posts' );
	$content_manager->add_cap(  'delete_others_posts' );
	$content_manager->add_cap(  'edit_others_posts' );

	$content_manager->add_cap( 'manage_qa_faqs' );
    $content_manager->add_cap( 'edit_qa_faqs' ); 
    $content_manager->add_cap( 'edit_qa_faqss' ); 
    $content_manager->add_cap( 'edit_others_qa_faqss' ); 
    $content_manager->add_cap( 'publish_qa_faqss' );
    $content_manager->add_cap( 'edit_published_qa_faqss' ); 
    $content_manager->add_cap( 'read_qa_faqs' ); 
    $content_manager->add_cap( 'read_private_qa_faqss' ); 
    $content_manager->add_cap( 'delete_qa_faqs' );
    $content_manager->add_cap( 'delete_published_qa_faqss' );
    $content_manager->add_cap( 'delete_others_qa_faqss' );
    
    $content_manager->add_cap( 'manage_qa_faqs_tags' );
    $content_manager->add_cap( 'edit_qa_faqs_tags' );
    $content_manager->add_cap( 'delete_qa_faqs_tags' );
    $content_manager->add_cap( 'assign_qa_faqs_tags' );
	
	$content_manager->add_cap( 'manage_options' );
	
	$content_manager->add_cap( 'edit_users' );
	$content_manager->add_cap( 'list_users' );
	$content_manager->add_cap( 'add_users' );
	$content_manager->add_cap( 'create_users' );
	$content_manager->add_cap( 'delete_users' );
	
	$content_manager->add_cap( 'manage_danh-sach-giang-vien' ); 
    $content_manager->add_cap( 'edit_giangvien' ); 
    $content_manager->add_cap( 'edit_giangviens' ); 
    $content_manager->add_cap( 'edit_others_giangviens' ); 
    $content_manager->add_cap( 'publish_giangviens' );
    $content_manager->add_cap( 'edit_published_giangviens' ); 
    $content_manager->add_cap( 'read_giangvien' ); 
    $content_manager->add_cap( 'read_private_giangviens' ); 
    $content_manager->add_cap( 'delete_giangvien' );
    $content_manager->add_cap( 'delete_published_giangviens' );
    $content_manager->add_cap( 'delete_others_giangviens' );	
	
	// gets the administrator role
    // gets the administrator role
    $admins = get_role( 'administrator' );

    $admins->add_cap( 'edit_giangvien' ); 
    $admins->add_cap( 'edit_giangviens' ); 
    $admins->add_cap( 'edit_others_giangviens' ); 
    $admins->add_cap( 'publish_giangviens' );
    $admins->add_cap( 'edit_published_giangviens' ); 
    $admins->add_cap( 'read_giangvien' ); 
    $admins->add_cap( 'read_private_giangviens' ); 
    $admins->add_cap( 'delete_giangvien' );
    $admins->add_cap( 'delete_published_giangviens' );
    $admins->add_cap( 'delete_others_giangviens' );	
?>