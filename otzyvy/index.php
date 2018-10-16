<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отзывы клиентов");
?>Вы можете оставить отзывы о нашей компании здесь, используя форму ниже<br>
<?$APPLICATION->IncludeComponent(
	"khayr:main.comment",
	"feedback",
	Array(
		"ACTIVE_DATE_FORMAT" => "d-m-Y",
		"ADDITIONAL" => array(),
		"ALLOW_RATING" => "N",
		"AUTH_PATH" => "/auth/",
		"CAN_MODIFY" => "Y",
		"COMPONENT_TEMPLATE" => "feedback",
		"COUNT" => "30",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"JQUERY" => "N",
		"LEGAL" => "Y",
		"LEGAL_TEXT" => "Я согласен с правилами размещения сообщений на сайте.",
		"LOAD_AVATAR" => "N",
		"LOAD_DIGNITY" => "N",
		"LOAD_FAULT" => "N",
		"LOAD_MARK" => "N",
		"MAX_DEPTH" => "2",
		"MODERATE" => "N",
		"NON_AUTHORIZED_USER_CAN_COMMENT" => "Y",
		"OBJECT_ID" => "1",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"REQUIRE_EMAIL" => "Y",
		"USE_CAPTCHA" => "Y"
	)
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>