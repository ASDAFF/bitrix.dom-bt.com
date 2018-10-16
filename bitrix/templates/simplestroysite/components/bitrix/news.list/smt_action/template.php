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
	<?if($arParams["DISPLAY_TOP_PAGER"] && $arResult["NAV_STRING"]):?>
		<div class="smt-widget smt-widget_margin">
			<?=$arResult["NAV_STRING"]?>
		</div>
	<?endif;?>
	<div class="smt-blog-list">
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		<div class="smt-owl-carousel-js">
		<div class="owl-carousel owl-theme owl-theme_smt<?if($arParams["SMT_SLIDER_DOTS"] == "Y"):?> owl-theme_smt-dots<?endif?><?if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_PROPERTIES_JSON"]?>'<?endif?>>
		<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
		<div class="row smt-auto-clear">
		<?endif?>
		<? $count = 0; ?>
		<? if(!$arParams["LINE_ELEMENT_COUNT"]) $arParams["LINE_ELEMENT_COUNT"] = 2; ?>
		<? $lineCount = $arParams["LINE_ELEMENT_COUNT"]; ?>
		<? $rowLineCount = 12/$arParams["LINE_ELEMENT_COUNT"]; ?>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<?if($arParams["SMT_SLIDER"] == "Y"):?>
			<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?><div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>"><?endif?>
			<?
			$linkHref = $arItem["DETAIL_PAGE_URL"];
			$imageLinkClass = array("smt-image", "smt-image-inline-block", "smt-image_hover");
			if($arParams["SMT_LINK_SHOW_MODE"] == "DETAIL_PICTURE") {
				$linkHref = $arItem["DETAIL_PICTURE"]["SRC"];
				$imageLinkClass[] = "smt-photo-popup-js";
			} elseif($arParams["SMT_LINK_SHOW_MODE"] == "PROPERTY_LINK") {
				$linkHref = $arItem["PROPERTIES"]["LINK"]["VALUE"];
			} elseif($arParams["SMT_LINK_SHOW_MODE"] == "LINK") {
				$linkHref = $arItem["DETAIL_PAGE_URL"];
			} elseif($arParams["SMT_LINK_SHOW_MODE"] == "NONE" || !$arParams["SMT_LINK_SHOW_MODE"]) {
				$linkHref = '';
			}
			?><a class="smt-banner" href="<?=$linkHref?>" style="<?if($arParams["DISPLAY_PICTURE"] == "Y" && $arItem["PREVIEW_PICTURE"]["SRC"]):?>background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)<?endif?>">
				<div class="smt-banner__content">
					<div class="smt-banner__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?if($arParams["DISPLAY_NAME"] == "Y"):?><?=$arItem["NAME"]?><?endif?>
						<?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?><?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?><?=$arItem["PREVIEW_TEXT"]?><?else:?><?=$arItem["PREVIEW_TEXT"]?><?endif?><?endif;?>
					</div>
				</div></a>
			<?if($arParams["SMT_SLIDER"] == "Y"):?>
			<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
			</div>
			<?endif?>
			<? $count +=1; ?>
			<?if($count%$lineCount == 0):?>
			<?endif;?>
		<?endforeach;?>
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		</div>
		</div>
		<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
		</div>
		<?endif?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
		<div class="smt-widget smt-widget_margin">
			<?=$arResult["NAV_STRING"]?>
		</div>
	<?endif;?>
<?endif;?>
<?if($arParams["DISPLAY_DESCRIPTION"] == "Y"):?>
	<?
	$arSection = array();
	if (is_array($arResult["SECTION"]["PATH"]) && (count($arResult["SECTION"]["PATH"]) > 0)) {
		$arSection = end($arResult["SECTION"]["PATH"]);
	}
	?>
	<?if(isset($arSection["DESCRIPTION"]) && (strlen($arSection["DESCRIPTION"]) > 0)):?>
		<div class="smt-widget smt-widget_margin">
			<?if($arSection["DESCRIPTION_TYPE"] == 'text'):?>
				<p><?=$arSection["DESCRIPTION"]?></p>
			<?else:?>
				<?=$arSection["DESCRIPTION"]?>
			<?endif?>
		</div>
	<?endif?>
<?endif?>