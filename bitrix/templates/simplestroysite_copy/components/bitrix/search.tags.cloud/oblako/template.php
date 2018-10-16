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

if($arParams["SHOW_CHAIN"] != "N" && !empty($arResult["TAGS_CHAIN"])):
?>
<noindex>
	<div class="search-tags-chain" <?=$arParams["WIDTH"]?>><?
		foreach ($arResult["TAGS_CHAIN"] as $tags):
			?><a href="<?=$tags["TAG_PATH"]?>" rel="nofollow"><?=$tags["TAG_NAME"]?></a> <?
			?>[<a href="<?=$tags["TAG_WITHOUT"]?>" class="search-tags-link" rel="nofollow">x</a>]  <?
		endforeach;?>
	</div>

</noindex>
<?
endif;

if(is_array($arResult["SEARCH"]) && !empty($arResult["SEARCH"])):
?>

<noindex>
<span class="smt-header-center" style="font-weight: bold;">ПОПУЛЯРНЫЕ КАТЕГОРИИ:</span>
	<div style="clear:both;"></div>
	<div id="sll" class="search-tags-cloud" <?=$arParams["WIDTH"]?>><?
		foreach ($arResult["SEARCH"] as $key => $res)
		{
		?><a href="<?=$res["URL"]?>" style="font-size: <?=$res["FONT_SIZE"]?>px; color: #<?=$res["COLOR"]?>;" rel="nofollow"><?=$res["NAME"]?></a> <?
		}
	?></div>
	<div style="clear:both;"></div>
<div id="sl">Показать все</div>
<script>
$("#sl").click(function () {
$("#sll").fadeToggle("slow");
});
</script>
</noindex>
<?
else:
	echo GetMessage('SEARCH_NOTHING_TO_FOUND');
endif;
?>