<?php
	$department_terms = get_terms('department');
?>
<div class="wrap">
	<h2>Xuất dữ liệu ra file Excel</h2>
    <form class="personal_profile" name="oscimp_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="user_info_hidden" value="Y">
		<div class="submit">  
			<a href="options-general.php?page=export-data&export=yes&data=project" class="button button-primary button-large">Xuất danh sách đề tài</a> 
		</div>
		<div>
			<h3>Chọn danh sách cán bộ cần xuất dữ liệu</h3>
			<form id="department-form" method="GET">
				<input type="hidden" name="export" value="yes" />
				<input type="hidden" name="data" value="lecturer" />
			<?php
				foreach ($department_terms as $term){
			?>
				<div style="dipsplay: block; clear: both; margin-bottom: 10px;"><input type="checkbox" name="check_department[]" value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></div>
			<?php
				}
			?>
				<input type="submit" value="Xuất danh sách cán bộ" class="button button-primary button-large" style="margin-top: 5px;">
			</form>
		</div>
    </form>  
</div>

<script> 

   function DoPost(){
	  //alert("Hello world");
      document.getElementById("department-form").submit();
   }

</script>