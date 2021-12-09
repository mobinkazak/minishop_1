<?php 
require_once '../loader.php';
$task=$backend->safeString($backend->post('task'));

if ($task=="getSubCat") {
	$id=$backend->toInt($backend->post('id'));
	$res=$backend->getParentCategoryList($id);
	while ($row=$backend->getRow($res)) {
		?>
		<option value="<?php print $row['id'] ?>"><?php print $row['title']; ?></option>
		<?php
	}
}