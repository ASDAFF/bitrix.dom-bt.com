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
<div class="smt-form smt-form_search">
<form class="form-inline" action="<?=$arResult["FORM_ACTION"]?>">
	<div class="form-group">
		<input class="form-control smt-form__search-field" type="text" name="q" value="" size="15" maxlength="50" placeholder="<?=GetMessage("BSF_T_SEARCH_PLACEHOLDER");?>" />
	</div>
	<input class="btn smt-btn smt-form__submit" name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
</form>
</div>