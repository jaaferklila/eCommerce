<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>"enctype="multipart/form-data">
	<input type="file" name="cc">
	
<input type="submit" name="">
</form>
<?php

echo $_FILES['cc'];