<?
	if ( ! defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true){
		die();
	}
	/** @var array $arCurrentValues */
	use Bitrix\Main\Loader;
	use Bitrix\Iblock;

	if ( ! Loader::includeModule("iblock")){
		return;
	} ?>

<? $catalogIncluded = Loader::includeModule('catalog');
	$iblockExists   = ( ! empty($arCurrentValues['IBLOCK_ID']) && (int) $arCurrentValues['IBLOCK_ID'] > 0);

	$arIBlockType             = CIBlockParameters::GetIBlockTypes();
	$araddComponentParameters = array ();
	$arIBlock                 = array ();
	$iblockFilter             = (
	! empty($arCurrentValues['IBLOCK_TYPE'])
		? array ('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
		: array ('ACTIVE' => 'Y')
	);
	$rsIBlock                 = CIBlock::GetList(array ('SORT' => 'ASC'), $iblockFilter);
	while ($arr = $rsIBlock->Fetch()){
		$arIBlock[ $arr['ID'] ] = '[' . $arr['ID'] . '] ' . $arr['NAME'];
	}
	unset($arr, $rsIBlock, $iblockFilter);
	$arProperty_value = array ();
	$arProperty       = array ();
	$arProperty_N     = array ();
	if ($iblockExists){
		$propertyIterator = Iblock\PropertyTable::getList(array (
			'select' => array ('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE'),
			'filter' => array ('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
			'order'  => array ('SORT' => 'ASC', 'NAME' => 'ASC')
		));
		while ($property = $propertyIterator->fetch()){
			$propertyCode = (string) $property['CODE'];
			if ($propertyCode == ''){
				$propertyCode = $property['ID'];
			}
			$propertyName = '[' . $propertyCode . '] ' . $property['NAME'];

			if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE){
				$arProperty[ $propertyCode ] = $propertyName;
			}
			if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER ||
			    $property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_STRING){
				$arProperty_N[ $propertyCode ] = $propertyName;
				$dbResult                      = CIBlockElement::GetList(
					Array ("SORT" => "ASC"),
					Array (
						'IBLOCK_ID'               => $arCurrentValues['IBLOCK_ID'],
						"!PROPERTY_$propertyCode" => false
					),
					false,
					false,
					Array ("ID", "IBLOCK_ID", "PROPERTY_$propertyCode")
				);
				while ($arElements = $dbResult->Fetch()){
					$value = trim((string)$arElements[ "PROPERTY_" . $propertyCode . "_VALUE" ]);
					if ( ! ! $value && strlen($value) < 20 && ! is_array($value)){
						$arProperty_value[ $propertyCode ][ $value ] = $value;
					}
				}

				if ( ! empty($arProperty_value[ $propertyCode ])){
					$arProperty_value[$propertyCode] = array_unique($arProperty_value[$propertyCode]);
					asort($arProperty_value[$propertyCode], SORT_NATURAL);
					if (in_array($propertyCode, $arCurrentValues['PROPERTY_CODE'])){

						$araddComponentParameters[ "PROPERTY_" . $propertyCode . "_VALUE" ] = array (
							"PARENT"            => "DATA_SOURCE",
							"NAME"              => GetMessage("CP_BCF_FIELD_VALUE") . '"' . $property['NAME'] . '"',
							"TYPE"              => "LIST",
							"MULTIPLE"          => "Y",
							"VALUES"            => $arProperty_value[ $propertyCode ],
							"ADDITIONAL_VALUES" => "Y",
						);
						$araddComponentParameters[ $propertyCode . "_SORT" ] = array (
							"PARENT"            => "DATA_SOURCE",
							"NAME"              => 'Сортировка' . '"' . $property['NAME'] . '"',
//							"NAME"              => GetMessage("CP_BCF_FIELD_VALUE") . '"' . $property['NAME'] . '"',
							"TYPE"              => "STRING",
							"DEFAULT" => "1",
						);
					}else{
						unset($arProperty_value[ $propertyCode ]);
						unset($arCurrentValues[ "PROPERTY_" . $propertyCode . "_VALUE" ]);
					}
				}
			}
			if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST){
				$enum_list = CIBlockPropertyEnum::GetList(Array ("SORT" => "ASC", "NAME" => "ASC"), Array (
					"IBLOCK_ID" => $arCurrentValues['IBLOCK_ID'],
					"CODE"      => $propertyCode
				));
				while ($arEnumprop = $enum_list->GetNext()){
					$propertyName  = '[' . $arEnumprop['ID'] . ']' . $arEnumprop['VALUE'];
					$arProperty_value[ $propertyCode ][ $arEnumprop['ID'] ] = $propertyName;
				}
				if (in_array($propertyCode, $arCurrentValues['PROPERTY_CODE'])){
					$araddComponentParameters[ "PROPERTY_" . $propertyCode . "_VALUE" ] = array (
						"PARENT"            => "DATA_SOURCE",
						"NAME"              => GetMessage("CP_BCF_FIELD_VALUE") . '"' . $property['NAME'] . '"',
						"TYPE"              => "LIST",
						"MULTIPLE"          => "Y",
						"VALUES"            => $arProperty_value[ $propertyCode ],
						"ADDITIONAL_VALUES" => "Y",
					);
					$araddComponentParameters[ $propertyCode . "_SORT" ] = array (
						"PARENT"            => "DATA_SOURCE",
						"NAME"              => 'Сортировка' . '"' . $property['NAME'] . '"',
						"TYPE"              => "STRING",
						"DEFAULT" => "1",
					);
				}else{
					unset($arProperty_value[ $propertyCode ]);
					unset($arCurrentValues[ "PROPERTY_" . $propertyCode . "_VALUE" ]);
				}
			}
		}
		unset($propertyCode, $propertyName, $property, $propertyIterator, $arProperty_value);
	}

	$arComponentParameters = array (
		"GROUPS"     => array (
			"PRICES" => array (
				"NAME" => GetMessage("IBLOCK_PRICES"),
			),
		),
		"PARAMETERS" => array (
			"IBLOCK_TYPE"   => array (
				"PARENT"            => "DATA_SOURCE",
				"NAME"              => GetMessage("IBLOCK_TYPE"),
				"TYPE"              => "LIST",
				"ADDITIONAL_VALUES" => "Y",
				"VALUES"            => $arIBlockType,
				"REFRESH"           => "Y",
			),
			"IBLOCK_ID"     => array (
				"PARENT"            => "DATA_SOURCE",
				"NAME"              => GetMessage("IBLOCK_IBLOCK"),
				"TYPE"              => "LIST",
				"ADDITIONAL_VALUES" => "Y",
				"VALUES"            => $arIBlock,
				"REFRESH"           => "Y",
			),
			"FILTER_NAME"   => array (
				"PARENT"  => "DATA_SOURCE",
				"NAME"    => GetMessage("IBLOCK_FILTER_NAME_OUT"),
				"TYPE"    => "STRING",
				"DEFAULT" => "arrFilter",
			),
//			"FIELD_CODE"    => CIBlockParameters::GetFieldCode(
//				GetMessage("IBLOCK_FIELD"),
//				"DATA_SOURCE",
//				array ("SECTION_ID" => true)
//			),
			"PROPERTY_CODE" => array (
				"PARENT"            => "DATA_SOURCE",
				"NAME"              => GetMessage("IBLOCK_PROPERTY"),
				"TYPE"              => "LIST",
				"MULTIPLE"          => "Y",
				"VALUES"            => $arProperty,
				"ADDITIONAL_VALUES" => "Y",
				"REFRESH"           => "Y",
			),
			"CACHE_TIME"    => Array ("DEFAULT" => 36000000),
			"CACHE_GROUPS"  => array (
				"PARENT"  => "CACHE_SETTINGS",
				"NAME"    => GetMessage("CP_BCF_CACHE_GROUPS"),
				"TYPE"    => "CHECKBOX",
				"DEFAULT" => "Y",
			),
			"NUMBER_WIDTH"  => array (
				"PARENT"  => "VISUAL",
				"NAME"    => GetMessage("CP_BCF_NUMBER_VIEW_INIT"),
				"TYPE"    => "STRING",
				"DEFAULT" => "5"
			),
		),
	);
	if ( ! empty($araddComponentParameters)){
		foreach ($araddComponentParameters as $k => $p){
			$arComponentParameters["PARAMETERS"][ $k ] = $p;
		}
		echo '<pre>';
//		var_export($arComponentParameters);
		echo '</pre>';
	}