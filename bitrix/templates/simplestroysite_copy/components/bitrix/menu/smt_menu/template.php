<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if (!empty($arResult)):
?><ul class="smt-menu-main<?=' ' . $arParams["SMT_ADD_CLASS"]?> smt-menu-main_right"><?
$previousLevel = 0;
foreach($arResult as $arItem):?><?
	if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?><?
		echo str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?><?
	endif?><?
	if ($arItem["IS_PARENT"]):?><?
		if ($arItem["DEPTH_LEVEL"] == 1):
		?><li class="smt-menu-main__item<?if($arItem["SELECTED"]):?> current<?endif?>"><?
			?><a href="<?=$arItem["LINK"]?>" class="smt-menu-main__link smt-menu-main__link_has-submenu<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>"><?=$arItem["TEXT"]?></a><?
			?><ul class="smt-menu-main__list"><?
		else:
			?><li class="smt-menu-main__item<?if ($arItem["SELECTED"]):?> current<?endif?>"><?
				?><a href="<?=$arItem["LINK"]?>" class="smt-menu-main__link smt-menu-main__link_has-submenu<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>"><?=$arItem["TEXT"]?></a><?
				?><ul class="smt-menu-main__list"><?
			endif;
	else:
		if ($arItem["PERMISSION"] > "D"):
			if ($arItem["DEPTH_LEVEL"] == 1):
				?><li class="smt-menu-main__item<?if($arItem["SELECTED"]):?> current<?endif?>"><?
					?><a href="<?=$arItem["LINK"]?>" class="smt-menu-main__link<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>"><?=$arItem["TEXT"]?></a><?
				?></li><?
			else:
				?><li class="smt-menu-main__item<?if($arItem["SELECTED"]):?> current<?endif?>"><?
					?><a href="<?=$arItem["LINK"]?>" class="smt-menu-main__link<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>"><?=$arItem["TEXT"]?></a><?
				?></li><?
			endif;
		else:
			if ($arItem["DEPTH_LEVEL"] == 1):
				?><li class="smt-menu-main__item<?if($arItem["SELECTED"]):?> current<?endif?>"><a href="" class="smt-menu-main__link<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li><?
			else:
				?><li class="smt-menu-main__item<?if($arItem["SELECTED"]):?> current<?endif?>"><a href="" class="smt-menu-main__link<?if($arItem["SELECTED"]):?> smt-menu-main__link_active<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li><?
			endif;
		endif;
	endif;
	$previousLevel = $arItem["DEPTH_LEVEL"];
endforeach;

if ($previousLevel > 1):
	echo str_repeat("</ul></li>", ($previousLevel-1) );
endif;
?></ul><?
else:
endif?>