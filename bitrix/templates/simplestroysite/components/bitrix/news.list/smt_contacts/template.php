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
	<div class="smt-cart-list">
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
			<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
			<div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>">
			<?endif?>
				<div class="smt-cart-item smt-cart-item_bordered-full" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?>
					<div class="row">
					<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][0])?>">
					<?endif?>
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
					?>
					<?if($arParams["DISPLAY_PICTURE"] == "Y" && $arItem["PREVIEW_PICTURE"]["SRC"]):?>
						<?if($linkHref):?>
						<a class="<?=implode(' ', $imageLinkClass)?>" href="<?=$linkHref?>">
						<?else:?>
						<span class="<?=implode(' ', $imageLinkClass)?>">
						<?endif?>
							<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image smt-img-thumbnail">
							<span class="smt-image__over"></span>
							<?if($arParams["DISPLAY_IMAGE_NAME"] == "Y" || $arParams["DISPLAY_IMAGE_PREVIEW_TEXT"] == "Y"):?>
								<span class="smt-image__over-text">
									<span class="smt-image-text-over smt-image-text-over_bg smt-image-text-over_center">
										<?if($arParams["DISPLAY_IMAGE_NAME"] == "Y"):?>
											<span class="smt-image-text-over__name"><?=$arItem["NAME"]?></span>
										<?endif?>
										<?if($arParams["DISPLAY_IMAGE_PREVIEW_TEXT"] == "Y"):?>
											<span class="smt-image-text-over__descr">
											<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
												<?=$arItem["PREVIEW_TEXT"]?>
											<?else:?>
												<?=$arItem["PREVIEW_TEXT"]?>
											<?endif?>
											</span>
										<?endif?>
									</span>
								</span>
							<?endif?>
						<?if($linkHref):?>
						</a>
						<?else:?>
						</span>
						<?endif?>
					<?endif?>
					<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?>
					</div>
					<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][1])?>">
					<?endif?>
					<?if($arParams["DISPLAY_DATE"] == "Y" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
						<div class="smt-blog-item__date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
					<?endif?>
					<?if($arParams["DISPLAY_NAME"] == "Y"):?>
						<div class="h3 smt-header smt-header-underline-left">
							<?if($arParams["SMT_LINK_SHOW_MODE"] == "DETAIL_PICTURE" || !$linkHref):?>
								<span><?=$arItem["NAME"]?></span>
							<?else:?>
								<a href="<?=$linkHref?>"><?=$arItem["NAME"]?></a>
							<?endif?>
						</div>
					<?endif?>
					<?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
						<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
							<p><?=$arItem["PREVIEW_TEXT"]?></p>
						<?else:?>
							<?=$arItem["PREVIEW_TEXT"]?>
						<?endif?>
					<?endif;?>
					<?if(!empty($arItem['PROPERTIES'])):?>
						<ul class="list-unstyled">
							<?foreach ($arItem['PROPERTIES'] as $property) { ?>
								<?if (in_array($property['CODE'], $arParams['MAIN_BLOCK_PROPERTY_CODE']) || $arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]) { ?>
									<?if($property['VALUE']):?>
										<?if($property['CODE'] == "EMAIL"):?>
											<li><span class="fa fa-envelope-open-o smt-color-primary"></span> <?=$property['VALUE']?></li>
										<?elseif($property['CODE'] == "PHONE"):?>
											<li><span class="fa fa-phone smt-color-primary"></span> <?=$property['VALUE']?></li>
										<?else:?>
											<li><?=$property['VALUE']?></li>
										<?endif?>
									<?endif?>
								<? } ?>
							<? } ?>
							<? unset($property); ?>
						</ul>
					<?endif;?>
					<?if($arParams['DISPLAY_BUTTON'] == 'Y'):?>
						<div>
							<a href="<?=$linkHref?>" class="btn smt-btn smt-btn-sm smt-map-collapse" data-lat="<?=$arItem["MAP_VALUE"]["LAT"]?>" data-lon="<?=$arItem["MAP_VALUE"]["LON"]?>" data-scale="<?=$arItem["MAP_VALUE"]["SCALE"]?>"><?=GetMessage("SMT_BCSL_BUTTON_LIST_MAP")?></a>
						</div>
					<?endif?>
					<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?>
					</div>
					</div>
					<?endif?>
				</div>
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
<?$this->SetViewTarget('smt_content_after');?>
<?if(!empty($arResult["MAP_DATA"])):?>
<div class="smt-contact-map-wrapper">
<?$APPLICATION->IncludeFile(
	SITE_DIR."smt_include/contact_map.php",
	Array("MAP_DATA" => $arResult["MAP_DATA"]),
	Array("MODE"=>"html")
);?>
</div>
<script>
	$('.smt-cart-item a.smt-map-collapse').click(function(event) {
		event.preventDefault();
		$(this).parent().addClass('active');
		$('html, body').animate({scrollTop: $('.smt-contact-map-wrapper').position().top}, 800);

		if(typeof window.GLOBAL_arMapObjects['wrapperMapContacts'] == "undefined") {
			return;
		} else {
			window.GLOBAL_arMapObjects['wrapperMapContacts'].setCenter([$(this).data("lat"),$(this).data("lon")]).setZoom($(this).data("scale"));
		}
	});
</script>
<?else:?>
<?endif?>
<?$this->EndViewTarget();?>