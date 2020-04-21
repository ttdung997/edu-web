<?php
	$department_terms = get_terms('department');
?>
<div class="wrap">
	<h2>Xuất dữ liệu ra file Excel</h2>
	<!--
	<div class="submit">  
		<a href="options-general.php?page=export-data&export=yes&data=project" class="button button-primary button-large">Xuất danh sách đề tài</a> 
	</div>
	-->
	<div>
		<h3>Chọn loại dữ liệu cần kết xuất ra Excel</h3>
		<form id="export-post-form" method="GET">
			<input type="hidden" name="export" value="yes" />
			<input type="hidden" name="data" value="post-type" />
			<div style="display: block; clear: both; margin-bottom: 10px;" ><input type="radio" name="post-type" value="project" checked style="margin-right: 5px;">Danh sách Đề tài</div>
			<div style="display: block; clear: both; margin-bottom: 10px;" ><input type="radio" name="post-type" value="publication" style="margin-right: 5px;">Danh sách Bài báo (Journal paper)</div>
			<div style="display: block; clear: both; margin-bottom: 10px;" ><input type="radio" name="post-type" value="conference" style="margin-right: 5px;">Danh sách Báo cáo hội nghị (Conference paper)</div>
			<input type="submit" value="Xuất dữ liệu" class="button button-primary button-large" style="margin-top: 5px;">
		</form>
	</div>
	<br />
	
	<div>
		<h3>Chọn danh sách cán bộ cần xuất dữ liệu</h3>
		<h4>Để nút bấm có hiệu lực, phải chọn ít nhất một đơn vị</h4>
		<form id="department-form" method="GET">
			<input type="hidden" name="export" value="yes" />
			<input type="hidden" name="data" value="lecturer" />
		<?php
			foreach ($department_terms as $term){
		?>
			<div style="display: block; clear: both; margin-bottom: 10px;"><input type="checkbox" name="check_department[]" value="<?php echo $term->term_id; ?>" style="margin-right: 5px;" class="department_checkbox"><?php echo $term->name; ?></div>
		<?php
			}
		?>
			<input id="department_submit" type="submit" value="Xuất danh sách cán bộ" class="button button-primary button-large" style="margin-top: 5px;">
		</form>
	</div>
</div>

<script type="text/javascript" > 
var $submit = jQuery('#department_submit');
$checkbox = jQuery('.department_checkbox');

$submit.prop('disabled', true);

$checkbox.on('click', function(){
    if (jQuery("input:checkbox:checked").length > 0) {
        $submit.removeAttr('disabled');
    }else{
        $submit.prop('disabled', true);
    }
});
</script>