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
	<div class="smt-gallery-list">
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		<div class="smt-owl-carousel-js">
		<div class="owl-carousel owl-theme owl-theme_smt<?if($arParams["SMT_SLIDER_DOTS"] == "Y"):?> owl-theme_smt-dots<?endif?><?if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_PROPERTIES_JSON"]?>'<?endif?>>
		<?else:?>
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
				<?else:?>
					<div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>">
				<?endif?>
				<div class="smt-gallery-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?$video_link = explode('/',$arItem["PROPERTIES"]['VIDEO_LINK']['VALUE']);?>
<?$linkHref = array_pop($video_link)?>
<iframe class="videoframe" width="100%" src="https://www.youtube.com/embed/<?=$linkHref?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
					<script>
					$(document).ready(function() {
							var $frame = $('.videoframe');
							$frame.height($frame.width()/1.8);
						$(window).resize(function() {
							var $frame = $('.videoframe');
							$frame.height($frame.width()/1.8);
						})
					});

					</script>
					<div class="smt-gallery-item__content">
						<?if($arParams["DISPLAY_NAME"] == "Y"):?>
								<span class="smt-gallery-item__link"><?=$arItem["NAME"]?></span>
						<?endif?>
						<?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
							<span class="smt-gallery-item__descr">
								<?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
									<p><?=$arItem["PREVIEW_TEXT"]?></p>
								<?else:?>
									<?=$arItem["PREVIEW_TEXT"]?>
								<?endif?>
							</span>
						<?endif;?>
					</div>
				</div>
				<?if($arParams["SMT_SLIDER"] == "Y"):?>
				<?else:?>
					</div>
				<?endif?>
				<? $count +=1; ?>
				<?if($count%$lineCount == 0):?>
				<?endif;?>
			
			<?endforeach;?>
			<?if($count%$lineCount != 0):?>
				<?while(($count++)%$lineCount != 0):?>
				<?endwhile;?>
			<?endif;?>
		<?if($arParams["SMT_SLIDER"] == "Y"):?>
		</div></div>
		<?else:?>
		</div>
		<?endif?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
		<div class="smt-widget smt-widget_margin">
			<?=$arResult["NAV_STRING"]?>
		</div>
	<?endif;?>
<?endif?>
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