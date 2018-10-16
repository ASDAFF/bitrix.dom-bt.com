<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>
<script>
	$('#<?=$arParams["ID"]?>').spectrum({
		showInput: true,
		showPalette: true,
		hideAfterPaletteSelect: true,
		chooseText: '<?=GetMessage("SMT_TEMPLATE_SPECTRUM_COLORPICKER_BUTTON_OK")?>',
		cancelText: '<?=GetMessage("SMT_TEMPLATE_SPECTRUM_COLORPICKER_BUTTON_CANCEL")?>',
		preferredFormat: "hex",
		palette: <?=$arResult["PALETTE_JSON"]?>
	});
</script>