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
<?if(!empty($arResult["SECTIONS"])):?>
<?$countSection = 0;?>
	<ul class="nav nav-tabs smt-nav-tabs smt-nav-tabs_colored" role="tablist">
	<?foreach($arResult["SECTIONS"] as $count=>$arSection):?>
		<li<?if($count==0):?> class="active"<?endif?> role="presentation"><a href="#smt-tab-<?=$arSection["ID"]?>" data-toggle="tab" aria-controls="smt-tab-<?=$arSection["ID"]?>" role="tab"><?=$arSection["NAME"]?></a></li>
	<?endforeach?>
	</ul>
	<div class="tab-content smt-tab-content smt-tab-content_padding">
	<?foreach($arResult["SECTIONS"] as $count=>$arSection):?>
		<?
		$this->AddEditAction('section_'.$arSection['ID'], $arSection['ADD_ELEMENT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_ADD"), array('ICON' => 'bx-context-toolbar-create-icon'));
		$this->AddEditAction('section_'.$arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
		$this->AddDeleteAction('section_'.$arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BPS_SECTION_DELETE_CONFIRM')));
		?>
	<div class="tab-pane fade<?if($count==0):?> active in<?endif?>" role="tabpanel" id="smt-tab-<?=$arSection["ID"]?>">
		<?if($arParams["SECTION_DISPLAY_NAME"] == "Y"
			|| $arParams['SECTION_DISPLAY_PREVIEW_TEXT'] == 'Y'
			|| $arParams['SECTION_DISPLAY_DESCRIPTION'] == 'Y'
			|| $arParams['SECTION_DISPLAY_PICTURE'] == 'Y'):?>
		<div class="smt-widget smt-widget_margin">
			<?if($arParams["SECTION_DISPLAY_NAME"] == "Y"):?>
			<h2 class="<?if(strlen($arParams["SECTION_ADDITIONAL_CLASS"])>0):?><?=$arParams["SECTION_ADDITIONAL_CLASS"]?><?else:?>h2 smt-header smt-header-underline-left<?endif?>">
				<?if($arParams["SECTION_DISPLAY_LINK"] == "Y"):?>
				<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["NAME"]?></a>
				<?else:?>
				<?=$arSection["NAME"]?>
				<?endif?>
			</h2>
			<?endif?>
			<?if($arParams["SECTION_DISPLAY_PICTURE"] == "Y" && ($arParams['SECTION_DISPLAY_PREVIEW_TEXT'] == 'Y' || $arParams['SECTION_DISPLAY_DESCRIPTION'] == 'Y')):?>
			<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
			<?endif;?>
			<?if($arParams["SECTION_DISPLAY_PICTURE"] == "Y"):?>
				<?if($arParams["SECTION_DISPLAY_LINK"] == "Y"):?>
					<a class="smt-image smt-image_hover" href="<? echo $arSection['SECTION_PAGE_URL']; ?>">
				<?endif?>
				<img src="<? echo ($arSection['PREVIEW_PICTURE']['SRC'])?$arSection['PREVIEW_PICTURE']['SRC']:$arSection['PICTURE']['SRC']; ?>" alt="" class="smt-image__image smt-img-thumbnail">
				<span class="smt-image__over"></span>
				<?if($arParams["SECTION_DISPLAY_LINK"] == "Y"):?>
					</a>
				<?endif?>
			<?endif?>
			<?if($arParams["SECTION_DISPLAY_PICTURE"] == "Y" && ($arParams['SECTION_DISPLAY_PREVIEW_TEXT'] == 'Y' || $arParams['SECTION_DISPLAY_DESCRIPTION'] == 'Y')):?>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-10 col-lg-10">
			<?endif;?>
			<?if($arParams['SECTION_DISPLAY_PREVIEW_TEXT'] == 'Y'):?>
				<?
				if(strlen($arSection['UF_PREVIEW_TEXT']) > 0) {
					?><? echo $arSection['UF_PREVIEW_TEXT']; ?><?
				}
				?>
			<?endif?>
			<?if($arParams['SECTION_DISPLAY_DESCRIPTION'] == 'Y'):?>
				<?
				if ('' != $arSection['DESCRIPTION']) {
					?>
					<?if($arSection["DESCRIPTION_TYPE"] == 'text'):?>
						<p><? echo $arSection['DESCRIPTION']; ?></p>
					<?else:?>
						<? echo $arSection['DESCRIPTION']; ?>
					<?endif?>
					<?
				}
				?>
			<?endif?>
			<?if($arParams["SECTION_DISPLAY_PICTURE"] == "Y" && ($arParams['SECTION_DISPLAY_PREVIEW_TEXT'] == 'Y' || $arParams['SECTION_DISPLAY_DESCRIPTION'] == 'Y')):?>
			</div>
			</div>
			<?endif;?>
		</div>
		<?endif?>
		<?if(!empty($arSection["ITEMS"])):?>
		<div class="panel-group smt-panel-group smt-panel-group_left" id="<?=$this->GetEditAreaId('section_'.$arSection['ID']);?>">
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
			<?foreach($arSection["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<?if($arParams["SMT_SLIDER"] == "Y"):?>
				<?elseif($arParams["LINE_ELEMENT_COUNT"] > 1):?>
					<div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>">
				<?endif?>
				<div class="panel smt-panel-primary" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="panel-heading">
						<div class="panel-title"><a name="smt-accordion-primary-item-<?=$arItem['ID']?>"></a><a data-toggle="collapse" href="#smt-accordion-primary-item-<?=$arItem['ID']?>"><?=$arItem["NAME"]?></a></div>
					</div>
					<div class="panel-collapse collapse" id="smt-accordion-primary-item-<?=$arItem['ID']?>">
						<div class="panel-body">
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
									<?if($arParams["DISPLAY_PICTURE"] == "Y"):?>
										<a class="<?=implode(' ', $imageLinkClass)?>" href="<?=$linkHref?>">
											<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="smt-image__image">
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
										</a>
									<?endif?>
									<?if($arParams["LINE_ELEMENT_COUNT"] == 1):?>
								</div>
								<div class="<?=implode(' ', $arResult["LINE_ELEMENT_GRID"][1])?>">
									<?endif?>
									<div class="smt-blog-item__content">
										<?if($arParams["DISPLAY_DATE"] == "Y" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
											<div class="smt-blog-item__date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
										<?endif?>
										<?if($arParams["DISPLAY_NAME"] == "Y"):?>
											<div class="smt-blog-item__name">
												<?if($arParams["SMT_LINK_SHOW_MODE"] == "DETAIL_PICTURE" || $arParams["SMT_LINK_SHOW_MODE"] == "NONE"):?>
													<span class="smt-blog-item__link"><?=$arItem["NAME"]?></span>
												<?else:?>
													<a href="<?=$linkHref?>" class="smt-blog-item__link"><?=$arItem["NAME"]?></a>
												<?endif?>
											</div>
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
					</div>
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
		<?endif?>
	</div>
	<?$countSection += 1;?>
	<?endforeach;?>
	</div>
<?endif?>