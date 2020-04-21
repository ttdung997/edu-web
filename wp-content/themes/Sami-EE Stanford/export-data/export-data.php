<?php
/*
Plugin Name: Export Data
Plugin URI: http://piklist.com
Description: The most powerful framework available for WordPress.
Version: 0.9.4.24
Author: Piklist
Author URI: http://piklist.com
Text Domain: piklist
Domain Path: /languages
License: GPLv2
*/


/*  
  Copyright (c) 2012-2014 Piklist, LLC.
  All rights reserved.

  This software is distributed under the GNU General Public License, Version 2,
  June 1991. Copyright (C) 1989, 1991 Free Software Foundation, Inc., 51 Franklin
  St, Fifth Floor, Boston, MA 02110, USA

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

  *******************************************************************************
  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
  DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
  ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
  ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
  *******************************************************************************
*/

require_once( 'sami-exporter.php' );

function export_data_page() {
	//session_start();
  //if( current_user_can( 'lecturers' ) ) {	
	add_menu_page('Xuất dữ liệu', 'Xuất dữ liệu', 'manage_options', 'export-data', 'export_data_form','');
	//add_submenu_page( 'profile.php', 'Thông tin cá nhân', __('Thông tin cá nhân','jobpress'), 'lecturers', 'my-submenu-handle-contact-info', 'mytheme_admin_contact_info');
	//add_submenu_page( 'my-top-level-handle', 'Học hàm, học vị, chức danh, chức vụ', __('Học hàm, học vị, chức danh, chức vụ','jobpress'), 'lecturers', 'my-submenu-handle-hocham_hocvi-work', 'mytheme_admin_hocham_hocvi');
	//add_submenu_page( 'profile.php', 'Học hàm, học vị, chức danh, chức vụ', __('Học hàm-Học vị-Chức danh','jobpress'), 'lecturers', 'my-submenu-handle-hocham_hocvi-work', 'mytheme_admin_hocham_hocvi');
	//add_submenu_page( 'profile.php', 'Giảng dạy/ hướng nghiên cứu', __('Giảng dạy và hướng nghiên cứu','jobpress'), 'lecturers', 'my-submenu-handle-research-work', 'mytheme_admin_research_work');
	//add_submenu_page( 'profile.php', 'Hướng dẫn NCS', __('Danh sách hướng dẫn NCS','jobpress'), 'lecturers', 'my-submenu-handle-phd-work', 'mytheme_admin_phd');
  //}
}
add_action('admin_menu', 'export_data_page');

function export_data_form() {
	include('export-data-template.php');
}

add_action('init', 'sami_export');