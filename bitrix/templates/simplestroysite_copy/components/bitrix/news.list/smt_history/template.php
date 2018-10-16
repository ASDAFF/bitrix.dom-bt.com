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
<?if(!empty($arResult["ITEMS"])):?>
<div class="smt-history-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="smt-history-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="smt-history-item__content">
			<div class="smt-history-item__name h2 smt-header"><?=$arItem["NAME"]?></div>
			<div class="smt-history-item__descr">
				<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
					<p><?=$arItem["PREVIEW_TEXT"]?></p>
				<?else:?>
					<?=$arItem["PREVIEW_TEXT"]?>
				<?endif?>
			</div>
		</div>
	</div>
	<?endforeach;?>
</div>
<?endif;?>