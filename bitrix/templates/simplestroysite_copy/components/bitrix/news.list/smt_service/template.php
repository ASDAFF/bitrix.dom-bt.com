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
<div class="smt-news-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="smt-news-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<div class="smt-news">
			<div class="container-fluid container-fluid_no-padding">
				<div class="row">
					<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
					<div class="col-md-2">
						<img
							class="smt-img-thumbnail-left"
							src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
							height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
							alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						/>
					</div>
					<?endif?>
					<div class="col-md-10">
						<div class="smt-news__link-content"><a class="smt-news__link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
						<div class="smt-news__text clearfix">
							<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
								<p><?=$arItem["PREVIEW_TEXT"]?></p>
							<?else:?>
								<?=$arItem["PREVIEW_TEXT"]?>
							<?endif?>
							<div class="smt-widget">
								<div class="smt-widget__content">
									<a class="btn smt-btn-border smt-btn-sm" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=GetMessage("SMT_NLSC_LINK_DETAIL")?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
		<div class="smt-news-list__pagination smt-news-list__pagination_center">
			<?=$arResult["NAV_STRING"]?>
		</div>
	<?endif;?>
</div>
<?endif;?>

