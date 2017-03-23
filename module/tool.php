<?php
function safety_check($a) {
	session_start();
	if ($_SESSION['rdept'] != $a) {
		Header("HTTP/1.1 303 See Other");
		Header("Location: ../../index.php");
	}
}
?>