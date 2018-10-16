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
<div class="smt-call-action<?if($arParams["FIXED_BACKGROUND"]):?> smt-call-action_fixed<?endif?>"<?if($arResult["BACKGROUND_IMAGE"]):?> style="background-image:url(<?=$arResult["BACKGROUND_IMAGE"]?>)"<?endif?>>
	<div class="smt-call-action__overlay">
		<div class="smt-call-action__content">
			<div class="smt-call-action__label"><?=$arResult["MESSAGE"]?></div>
			<div class="smt-call-action__button"><a class="<?=implode(' ', $arResult["LINK_CLASS"])?>" href="<?=$arResult["LINK"]?>"><?=$arResult["BUTTON"]?></a></div>
		</div>
	</div>
</div>