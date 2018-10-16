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
	<div class="smt-response-list">
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		<div class="smt-owl-carousel-js">
		<div class="owl-carousel owl-theme owl-theme_smt<?if($arParams["SMT_SLIDER_DOTS"] == "Y"):?> owl-theme_smt-dots<?endif?><?if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_PROPERTIES_JSON"]?>'<?endif?>>
		<?endif?>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="smt-response-item">
			<div class="smt-response-item__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="smt-response-item__text">
					<span class="smt-response-item__quote smt-response-item__quote_left">&laquo;</span>
					<?if($arParams["DISPLAY_PICTURE"] == "Y"):?>
					<div class="row">
					<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][0])?>">
						<?if($arParams["DISPLAY_PICTURE"] == "Y" && $arItem["PREVIEW_PICTURE"]["SRC"]):?>
							<?
							$imageLinkClass = array("smt-image", "smt-image-inline-block", "smt-image_hover");
							$linkHref = $arItem["DETAIL_PICTURE"]["SRC"];
							$imageLinkClass[] = "smt-photo-popup-js";
							?>
							<?if($linkHref):?>
								<a class="<?=implode(' ', $imageLinkClass)?>" href="<?=$linkHref?>">
							<?else:?>
								<span class="<?=implode(' ', $imageLinkClass)?>">
							<?endif?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image smt-img-thumbnail">
							<span class="smt-image__over"></span>
							<?if($linkHref):?>
								</a>
							<?else:?>
								</span>
							<?endif?>
						<?endif?>
					</div>
					<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][1])?>">
					<?endif?>
					<div<?if($arParams["HIDE_TEXT"] == "Y"):?> class="smt-read-more-text"<?endif?>>
						<?if(strlen($arItem["DETAIL_TEXT"])>0):?>
							<?if($arItem["DETAIL_TEXT_TYPE"] == 'text'):?>
								<p><?=$arItem["DETAIL_TEXT"]?></p>
							<?else:?>
								<?=$arItem["DETAIL_TEXT"]?>
							<?endif?>
						<?else:?>
							<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
								<p><?=$arItem["PREVIEW_TEXT"]?></p>
							<?else:?>
								<?=$arItem["PREVIEW_TEXT"]?>
							<?endif?>
						<?endif?>
					</div>
					<?if($arParams["DISPLAY_PICTURE"] == "Y"):?>
					</div>
					</div>
					<?endif?>
					<span class="smt-response-item__quote smt-response-item__quote_right">&raquo;</span>
				</div>
				<div class="smt-response-item__content clearfix">
					<div class="smt-response-item__name pull-left">
						<?=$arItem["NAME"]?>
						<span class="smt-response-item__descr">
							<?if($arItem["DISPLAY_PROPERTIES"]["INFO"]["DISPLAY_VALUE"]):?>
								<?=$arItem["DISPLAY_PROPERTIES"]["INFO"]["DISPLAY_VALUE"]?>
							<?endif;?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<?endforeach;?>
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		</div>
		</div>
		<?endif?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
	<div class="smt-widget smt-widget_margin">
		<?=$arResult["NAV_STRING"]?>
	</div>
	<?endif;?>
<?endif;?>