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
<?if (!empty($arResult)):?>
<ul class="smt-list smt-list_menu smt-menu-left smt-menu-left_show-current<?if($arParams["DROPDOWN_MENU"]):?> smt-main-left_js-smart<?endif?>">
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
	<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
<?endif?>
<?if ($arItem["IS_PARENT"]):?>
	<li<?if($arItem["SELECTED"]):?> class="current"<?endif?>><a class="smt-list__link<?if($arItem["SELECTED"]):?> current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
	<ul>
<?else:?>
	<li<?if($arItem["SELECTED"]):?> class="current"<?endif?>><a class="smt-list__link<?if($arItem["SELECTED"]):?> current<?endif?>" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
<?endif?>
<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
<?endforeach?>
<?if ($previousLevel > 1):?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>
</ul>
<?$this->SetViewTarget('smt_sidebar');?> smt-widget_margin<?$this->EndViewTarget();?>
<?endif?>
