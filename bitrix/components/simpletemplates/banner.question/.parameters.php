<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"PARAMETERS" => array(

		"MESSAGE" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_MESSAGE"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"BUTTON" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_BUTTON"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"LINK" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_LINK"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"ICON" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_ICON"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"IMAGE" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_IMAGE"),
			"TYPE" => "FILE",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"LINK_CLASS" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_LINK_CLASS"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"BACKGROUND_IMAGE" => Array(
			"NAME"=>GetMessage("SMT_SBQC_PARAMETERS_BACKGROUND_IMAGE"),
			"TYPE" => "STRING",
			"DEFAULT"=>'',
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"FIXED_BACKGROUND" => array(
			"NAME" => GetMessage("SMT_SBQC_PARAMETERS_FIXED_BACKGROUND"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"" => "",
				"Y" => GetMessage('SMT_SBQC_PARAMETERS_FIXED_BACKGROUND_VALUE_Y'),
			),
			"DEFAULT" => "",
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

		"POPUP" => array(
			"NAME" => GetMessage("SMT_SBQC_PARAMETERS_POPUP"),
			"TYPE" => "LIST",
			"VALUES" => array(
				"" => "",
				"Y" => GetMessage('SMT_SBQC_PARAMETERS_POPUP_VALUE_Y'),
			),
			"DEFAULT" => "",
			"PARENT" => "ADDITIONAL_SETTINGS",
		),

	)
);
?>
