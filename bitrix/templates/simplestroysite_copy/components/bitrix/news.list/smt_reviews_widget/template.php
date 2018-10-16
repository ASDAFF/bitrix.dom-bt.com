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
<div class="smt-owl-carousel-js">
	<div class="owl-carousel owl-theme owl-theme_smt" data-owl-options='{"nav": false, "dots": true}'>
		<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="smt-response-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="smt-response-item__link">
				<div class="smt-response-item__text">
					<span class="smt-response-item__quote smt-response-item__quote_left">&laquo;</span>
					<div class="smt-read-more-text">
						<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
							<p><?=$arItem["PREVIEW_TEXT"]?></p>
						<?else:?>
							<?=$arItem["PREVIEW_TEXT"]?>
						<?endif?>
					</div>
					<span class="smt-response-item__quote smt-response-item__quote_right">&raquo;</span>
				</div>
				<div class="smt-response-item__content clearfix">
					<div class="smt-response-item__name pull-left">
						<?=$arItem["NAME"]?>
						<span class="smt-response-item__descr"><?=$arItem["PROPERTIES"]["INFO"]["VALUE"]?></span>
					</div>
				</div>
			</a>
		</div>
		<?endforeach;?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
			<div class="smt-widget__pagination smt-widget__pagination_center smt-widget__pagination_border">
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
	</div>
</div>
<?endif;?>