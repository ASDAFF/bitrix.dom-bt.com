<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");
?><?$APPLICATION->IncludeFile(
	SITE_DIR."smt_include/contact.php",
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER"=>false)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>