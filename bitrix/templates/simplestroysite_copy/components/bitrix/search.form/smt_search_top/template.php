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
<div class="smt-navbar-search-form collapse smt-navbar-search-form_js-icon" id="smt-navbar-search-form">
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="form-inline smt-navbar-search-form__form">
		<div class="form-group smt-navbar-search-form__group">
			<input class="form-control smt-navbar-search-form__input" type="text" name="q" value="" size="15" maxlength="50" placeholder="<?=GetMessage("BSF_T_SEARCH_PLACEHOLDER");?>" />
		</div>
		<input class="btn smt-btn smt-navbar-search-form__button" name="s" type="submit" value="<?=GetMessage("BSF_T_SEARCH_BUTTON");?>" />
	</form>
</div>