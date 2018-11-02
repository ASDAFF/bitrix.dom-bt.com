<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Строительство каркасных домов, домов из бруса в Санкт-Петербурге и Ленинградской области");
$APPLICATION->SetPageProperty("keywords", "евpoпeйcкий дом, брусовые дома недорого, деревянные дома брусовые, дешево брусовые дома, брусовые и каркасные дома, купить брусовой дом, постройка брусового дома, дома из бруса дешево");
$APPLICATION->SetPageProperty("title", "Европейский Дом - Строительство каркасных домов, домов из бруса");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Строительная компания \"Европейский Дом\"");
?><?$APPLICATION->IncludeFile(
	SITE_DIR."smt_include/main.php",
	Array(),
	Array("MODE"=>"html", "SHOW_BORDER"=>false)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>