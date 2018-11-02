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
			<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
			<div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>">
			<?endif?>
				<div class="smt-blog-item<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?> smt-blog-item_line<?endif?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?>
					<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
					<?endif?>
					<?
					$linkHref = $arItem["DETAIL_PAGE_URL"];
					$imageLinkClass = array("smt-image", "smt-image-inline-block", "smt-image_hover");
					if($arParams["SMT_LINK_SHOW_MODE"] == "DETAIL_PICTURE") {
						$linkHref = $arItem["DETAIL_PICTURE"]["SRC"];
						$imageLinkClass[] = "smt-photo-popup-js";
					} elseif($arParams["SMT_LINK_SHOW_MODE"] == "PROPERTY_LINK") {
						$linkHref = $arItem["PROPERTIES"]["LINK"]["VALUE"];
					} elseif($arParams["SMT_LINK_SHOW_MODE"] == "LINK" || !$arParams["SMT_LINK_SHOW_MODE"]) {
						$linkHref = $arItem["DETAIL_PAGE_URL"];
					}
					?>
					<?if($arParams["DISPLAY_PICTURE"] == "Y" && $arItem["PREVIEW_PICTURE"]["SRC"]):?>
						<?if($linkHref):?>
							<a class="<?=implode(' ', $imageLinkClass)?>" href="<?=$linkHref?>">
						<?else:?>
							<span class="<?=implode(' ', $imageLinkClass)?>">
						<?endif?>
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image smt-img-thumbnail" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
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
					<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?endif?>
					<div class="smt-blog-item__content">
						<?if($arParams["DISPLAY_NAME"] == "Y"):?>
							<div class="smt-blog-item__name">
								<?if($arParams["SMT_LINK_SHOW_MODE"] == "DETAIL_PICTURE"):?>
									<span class="smt-blog-item__link"><?=$arItem["NAME"]?></span>
								<?else:?>
									<a href="<?=$linkHref?>" class="smt-blog-item__link"><?=$arItem["NAME"]?></a>
								<?endif?>
							</div>
						<?endif?>
						<?if($arParams["DISPLAY_DATE"] == "Y" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
							<div class="smt-blog-item__date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
						<?endif?>
						<?if(!empty($arItem['PROPERTIES'])):?>
							<table class="table">
								<?foreach ($arItem['PROPERTIES'] as $property) { ?>
									<?if (in_array($property['CODE'], $arParams['MAIN_BLOCK_PROPERTY_CODE']) || $arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]) { ?>
										<tr>
											<td><?=$property['NAME']?></td>
											<td><?=(
												is_array($property['VALUE'])
													? implode(' / ', $property['VALUE'])
													: $property['VALUE']
												)?>
												<?if($property["DESCRIPTION"]):?><span class="smt-project-item-descr"><?=$property["~DESCRIPTION"]?></span><?endif?>
												<?if($property["HINT"]):?><span class="smt-project-item-hint"><?=$property["HINT"]?></span><?endif?>
											</td>
										</tr>
									<? } ?>
								<? } ?>
								<? unset($property); ?>
							</table>
						<?endif;?>
						<?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
							<div class="smt-blog-item__text">
								<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
									<p><?=$arItem["PREVIEW_TEXT"]?></p>
								<?else:?>
									<?=$arItem["PREVIEW_TEXT"]?>
								<?endif?>
							</div>
						<?endif;?>
						<?if($arParams['DISPLAY_BUTTON'] == 'Y'):?>
							<div class="smt-blog-item__button">
								<a href="<?=$linkHref?>" class="btn smt-btn smt-btn-sm"><?=GetMessage("SMT_BCSL_BUTTON_LIST")?></a>
							</div>
						<?endif?>
					</div>
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