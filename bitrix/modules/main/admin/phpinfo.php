<?
require_once(dirname(__FILE__)."/../include/prolog_admin_before.php");
if(!$USER->CanDoOperation('edit_php'))
{
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
}
else
{
	phpinfo();
}
?>