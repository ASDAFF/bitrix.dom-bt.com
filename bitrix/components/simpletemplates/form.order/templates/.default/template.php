<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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

$errorFields = array();

if ($arResult["ERRORS"]) {
	foreach($arResult["ERRORS"] as $error) {
		if (preg_match("/'(.*)'/", $error, $match)) {
			foreach ($arResult["PROPERTY_LIST"] as $propertyID) {
				if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"] == $match[1]) {
					$errorFields[] = $propertyID;
				}

				if ($arParams["CUSTOM_TITLE_".$propertyID] == $match[1]) {
					$errorFields[] = $propertyID;
				}
			}
		}
	}
}
?>
<?if (strlen($arResult["MESSAGE"]) > 0):?>
	<?if($arParams["REDIRECT_URL"]):?>
	<script type="text/javascript">
		window.location = '<?=htmlspecialcharsEx($arParams["REDIRECT_URL"])?>';
	</script>
	<?else:?>
		<div class="smt-widget smt-widget_margin">
		<div class="smt-alert smt-alert_info"><?=$arParams["USER_MESSAGE_ADD"]?></div>
		</div>
	<?endif?>
<?endif?>
<div class="smt-form<?if($arParams["SHOW_FORM_BORDER"] == "Y"):?> smt-form_bordered<?endif?>">
<?if ($arResult["ERRORS"]):?>
	<div class="smt-alert smt-alert_warning"><?=GetMessage("SMT_SFOC_FROM_MESSAGE_ERROR")?></div>
<?endif?>
<form class="smt-order-form-ajax" name="iblock_add" action="<?=($arParams["AJAX_URL"])?$arParams["AJAX_URL"].'?AJAX_CALL=Y&AJAX_FORM_ID='.$arParams["FORM_SUFFIX"]:POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
<?=bitrix_sessid_post()?>
<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
	<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
			<?
			$classError = '';
			if (in_array($propertyID, $errorFields)) {
				$classError = ' has-error';
			}
			?>
			<? $label = ''; ?>
			<?if (intval($propertyID) > 0):?>
				<? $label = !empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : $arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?>
			<?else:?>
				<? $label = !empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?>
			<?endif?>
			<? $label = trim($label);?>
			<?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] && $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "L" && $arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C"):?>
				<?if($label):?>
					<label class="text-uppercase" for="smt-order-form-field-<?=$arParams["FORM_SUFFIX"]?>-<?=strtolower($propertyID)?>">
						<?=$label?>
						<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="smt-required-star">*</span><?endif?>
					</label>
				<?endif?>
				<?$checkboxType = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";?>
				<div class="<?=$checkboxType?><?=$classError?><?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_GROUP_CLASS"]):?> <?=implode(' ', $arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_GROUP_CLASS"])?><?endif?>">
					<?include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/properties_view.php");?>
				</div>
			<?else:?>
				<div class="form-group has-feedback<?=$classError?><?if($arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_GROUP_CLASS"]):?> <?=implode(' ', $arResult["PROPERTY_LIST_FULL"][$propertyID]["SMT_ADD_GROUP_CLASS"])?><?endif?>">
					<?if($label):?>
						<label class="text-uppercase" for="smt-order-form-field-<?=$arParams["FORM_SUFFIX"]?>-<?=strtolower($propertyID)?>">
							<?=$label?>
							<?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="smt-required-star">*</span><?endif?>
						</label>
					<?endif?>
					<?include($_SERVER["DOCUMENT_ROOT"]."/".$this->GetFolder()."/properties_view.php");?>
				</div>
			<?endif?>
		<?endforeach;?>
		<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
		<div class="form-group">
			<div class="help-block"><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></div>
			<div>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</div>
		</div>
		<div class="form-group">
			<label class="text-uppercase" for="smt-order-form-field-captcha_word"><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?> <span class="smt-required-star">*</span></label>
			<div><input type="text" class="form-control" name="captcha_word" maxlength="50" value="" id="smt-order-form-field-captcha_word"></div>
		</div>
		<?endif?>
	<?endif?>
	<div class="smt-form__buttons">
		<input type="submit" class="btn btn-block smt-btn smt-btn_shadow text-uppercase" name="iblock_submit_<?=$arParams["FORM_SUFFIX"]?>" value="<?echo htmlspecialcharsEx($_REQUEST['iblock_submit_' . $arParams["FORM_SUFFIX"]])?htmlspecialcharsEx($_REQUEST['iblock_submit_' . $arParams["FORM_SUFFIX"]]):$arParams["CUSTOM_FORM_SUBMIT"];?>" />
	</div>
</form>
</div>