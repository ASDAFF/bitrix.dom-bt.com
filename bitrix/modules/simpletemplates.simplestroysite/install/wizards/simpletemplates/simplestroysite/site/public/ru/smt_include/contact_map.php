<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	"", 
	array(
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => (isset($arParams["MAP_DATA"]))?$arParams["MAP_DATA"]:"",
		"MAP_HEIGHT" => "360",
		"MAP_ID" => "wrapperMapContacts",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		)
	),
	false
);?>