<?php

function personal_info_page() {
	add_menu_page('Hồ sơ cá nhân', 'Hồ sơ cá nhân', 'lecturer', 'thong-tin-ca-nhan', 'sami_admin_personal_information');
	add_submenu_page( 'thong-tin-ca-nhan', 'Thông tin cá nhân', __('Thông tin cá nhân','sami'), 'lecturer', 'thong-tin-ca-nhan', 'sami_admin_personal_information');
	add_submenu_page( 'thong-tin-ca-nhan', 'Học hàm, học vị, chức danh, chức vụ', __('Học hàm-Học vị-Chức danh','sami'), 'lecturer', 'hoc-ham-hoc-vi', 'sami_admin_title');
	add_submenu_page( 'thong-tin-ca-nhan', 'Quá trình học tập/công tác', __('Quá trình học tập/Công tác','sami'), 'lecturer', 'hoc-tap-cong-tac', 'sami_admin_education_employment');	
	add_submenu_page( 'thong-tin-ca-nhan', 'Môn giảng dạy', __('Môn giảng dạy','sami'), 'lecturer', 'mon-giang-day', 'sami_admin_teaching');
	add_submenu_page( 'thong-tin-ca-nhan', 'Hướng nghiên cứu', __('Hướng nghiên cứu','sami'), 'lecturer', 'huong-nghien-cuu', 'sami_admin_research');
	add_submenu_page( 'thong-tin-ca-nhan', 'Học viên cao học/NCS', __('Học viên cao học/NCS','sami'), 'lecturer', 'hoc-vien-huong-dan', 'sami_admin_students');
}
add_action('admin_menu', 'personal_info_page');

function sami_admin_personal_information() {
	include('personal-information.php');
}

function sami_admin_title() {
	include('title.php');
}

function sami_admin_education_employment() {
	require_once('education-employment.php');
}

function sami_admin_teaching() {
	require_once('teaching.php');
}

function sami_admin_research() {
	require_once('research.php');
}

function sami_admin_students() {
	require_once('students.php');
}
