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
$this->setFrameMode(true);?>
<div class="smt-widget">
	<div class="smt-call-action-button">
		<?if($arParams["ICON"]):?>
		<div class="smt-call-action-button__icon"><span class="<?=$arParams["ICON"]?>"></span></div>
		<?endif;?>
		<?if($arParams["IMAGE"]):?>
			<div class="smt-call-action-button__icon"><img src="<?=$arParams["IMAGE"]?>" alt=""></div>
		<?endif;?>
		<div class="smt-call-action-button__content">
			<div class="container_flex-sm container_middle">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
						<div class="smt-call-action-button__label"><?=$arResult["MESSAGE"]?></div>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<div class="smt-call-action-button__button">
							<a class="<?=implode(' ', $arResult["LINK_CLASS"])?>" href="<?=$arResult["LINK"]?>"><?=$arResult["BUTTON"]?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>