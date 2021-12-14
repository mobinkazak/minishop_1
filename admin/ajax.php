<?php 
require_once '../loader.php';
$task=$backend->safeString($backend->post('task'));

if ($task=="getSubCat") {
	$id=$backend->toInt($backend->post('id'));
	$res=$backend->getParentCategoryList($id);
	?>

	<?php
	if ($res->num_rows > 0) {
		?>
	<option value="-1">زیر دسته ای مورد نظر را انتخاب کنید</option>

		<?php
		while ($row=$backend->getRow($res)) {

			?>
			<option value="<?php print $row['id'] ?>"><?php print $row['title']; ?></option>
			<?php
		}
	}else{
		?>
		<option value="-1">موردی برای فیلتر کردن یافت نشد</option>
		<?php
		
	}
}