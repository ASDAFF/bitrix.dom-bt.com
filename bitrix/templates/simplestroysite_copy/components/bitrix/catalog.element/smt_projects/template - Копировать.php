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
<div class="smt-widget smt-widget_margin">
    <div class="row">
        <?if($arResult["DETAIL_PICTURE"] || $arResult['GALLERY1'] || $arResult['GALLERY2']):?>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
            <?if($arParams["SMT_SLIDER"] == "Y"):?>
            <div class="smt-owl-carousel-js smt-photo-gallery-js">
                <div class="owl-carousel owl-theme owl-theme_smt owl-theme_smt-dots<?if($arParams["SMT_SLIDER_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_PROPERTIES_JSON"]?>'<?endif?>>
                    <?if($arResult["DETAIL_PICTURE"]["SRC"] && $arResult["PREVIEW_PICTURE"]["SRC"]):?>
                        <a class="smt-image smt-image-inline-block" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
                            <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер1';?>
                            <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                            <span class="smt-image__over"></span>
                            <?if($arResult["PROPERTIES"]["LABEL"]["VALUE"]):?>
                                <div class="smt-image-box-inline-label"><?=$arResult["PROPERTIES"]["LABEL"]["VALUE"]?></div>
                            <?endif;?>
                        </a>
                    <?endif?>
                    <?if($arResult['GALLERY1']):?>
                        <?foreach ($arResult['GALLERY1'] as $arItemGallery):?>
                            <a class="smt-image" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
	                            <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер2';?>
                                <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                                <span class="smt-image__over"></span>
                                <?if($arResult["PROPERTIES"]["LABEL"]["VALUE"]):?>
                                    <div class="smt-image-box-inline-label"><?=$arResult["PROPERTIES"]["LABEL"]["VALUE"]?></div>
                                <?endif;?>
                            </a>
                        <?endforeach;?>
                    <?endif?>
                </div>
            </div>
            <?else:?>
            <div class="smt-photo-gallery-js">
                <?if($arResult["DETAIL_PICTURE"]["SRC"] && $arResult["PREVIEW_PICTURE"]["SRC"]):?>
                <a class="smt-image smt-image-inline-block" href="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>">
	                <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер3';?>
                    <img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                    <span class="smt-image__over"></span>
                </a>
                <?endif?>
                <?if($arResult['GALLERY1']):?>
                    <?foreach ($arResult['GALLERY1'] as $arItemGallery):?>
                        <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
	                        <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер4';?>
                            <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                            <span class="smt-image__over"></span>
                        </a>
                    <?endforeach;?>
                <?endif?>
            </div>
            <?endif?>
            <?if($arResult['GALLERY2']):?>
                <?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/project_gallery_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?>
                <?if($arParams["SMT_SLIDER_GALLERY"] == "Y"):?>
                    <div class="smt-owl-carousel-js smt-photo-gallery-js">
                        <div class="owl-carousel owl-theme owl-theme_smt owl-theme_smt-dots<?if($arParams["SMT_SLIDER_GALLERY_VERTICAL_ALIGN"] == "Y"):?> owl-carousel-centered<?endif?>"<?if($arResult["SMT_SLIDER_GALLERY_PROPERTIES_JSON"]):?> data-owl-options='<?=$arResult["SMT_SLIDER_GALLERY_PROPERTIES_JSON"]?>'<?endif?>>
                            <?foreach ($arResult['GALLERY2'] as $arItemGallery):?>
                                <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
	                                <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер5';?>
                                    <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                                    <span class="smt-image__over"></span>
                                </a>
                            <?endforeach;?>
                        </div>
                    </div>
                <?else:?>
                    <div class="smt-photo-gallery-js">
                        <?foreach ($arResult['GALLERY2'] as $arItemGallery):?>
                            <a class="smt-image smt-image-inline-block" href="<?=$arItemGallery["DETAIL_PICTURE"]["SRC"]?>">
	                            <?php $wsalt = ($arResult["PROPERTIES"]["LABEL"]["VALUE"]) ? $arResult["PROPERTIES"]["LABEL"]["VALUE"] : 'слайдер6';?>
                                <img src="<?=$arItemGallery["PREVIEW_PICTURE"]["SRC"]?>" class="smt-image__image" alt="<?=$wsalt?>">
                                <span class="smt-image__over"></span>
                            </a>
                        <?endforeach;?>
                    </div>
                <?endif?>
            <?endif?>
        </div>
        <?endif?>
        <?if($arResult["DETAIL_PICTURE"] || $arResult['GALLERY1']):?>
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-6">
        <?else:?>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?endif?>
        <?if($arParams["DISPLAY_NAME"] == "Y"):?>
            <div class="h2 smt-header smt-header-underline-left"><?=$arResult["NAME"]?></div>
        <?endif?>
        <?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
            <?if($arResult["PREVIEW_TEXT_TYPE"] == 'text'):?>
                <?if(strlen($arResult["PREVIEW_TEXT"]) > 0):?>
                <p><?=$arResult["PREVIEW_TEXT"]?></p>
                <?endif?>
            <?else:?>
                <?=$arResult["PREVIEW_TEXT"]?>
            <?endif?>
        <?endif?>
        <?if($arParams["DISPLAY_DESCRIPTION"] == "Y"):?>
            <?if($arResult["DETAIL_TEXT_TYPE"] == 'text'):?>
                <?if(strlen($arResult["DETAIL_TEXT"]) > 0):?>
                <p><?=$arResult["DETAIL_TEXT"]?></p>
                <?endif?>
            <?else:?>
                <?=$arResult["DETAIL_TEXT"]?>
            <?endif?>
        <?endif?>
        <?if($arResult["PROPERTIES"]["PRICE_TEXT"]["VALUE"]):?>
            <div class="h2 smt-header smt-header-underline-left">
                <?$property = $arResult['DISPLAY_PROPERTIES']["PRICE_TEXT"];?>
                <?if(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "HTML"):?>
                    <?=$property['DISPLAY_VALUE']?>
                <?elseif(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "TEXT"):?>
                    <?=$property['VALUE']["TEXT"]?>
                <?else:?>
                    <?=(
                    is_array($property['VALUE'])
                        ? implode(' / ', $property['VALUE'])
                        : $property['VALUE']
                    )?>
                <?endif;?>
                <?unset($property);?>
            </div>
        <?elseif($arResult["PROPERTIES"]["PRICE"]["VALUE"]):?>
            <div class="h2 smt-header smt-header-underline-left">
            <?if($arResult["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"]):?>
                <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
                <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
            <?else:?>
                <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                <span class="smt-price"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arResult["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
            <?endif;?>
            </div>
        <?endif;?>
        <?if(!empty($arParams['BUTTON_LIST'])):?>
            <div class="smt-widget smt-widget_margin">
                <div class="row">
                <?foreach ($arParams['BUTTON_LIST'] as $code=>$value):?>
                    <?if(strlen($value) > 0):?>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <a data-object-id="<?=$arResult["ID"]?>" href="<?=isset($arParams['BUTTON_LIST_HREF_' . $code])?$arParams['BUTTON_LIST_HREF_' . $code]:""?>" class="<?=isset($arParams['BUTTON_LIST_CLASS_' . $code])?$arParams['BUTTON_LIST_CLASS_' . $code]:""?>"><?=htmlspecialcharsbx($value)?></a>
                        </div>
                    <?endif?>
                <?endforeach?>
                </div>
            </div>
        <?endif;?>
        <?if(!empty($arResult['PROPERTIES'])):?>
            <table class="table">
                <?foreach ($arResult['PROPERTIES'] as $property) { ?>
                    <?if (in_array($property['CODE'], $arParams['MAIN_BLOCK_PROPERTY_CODE']) || $arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']]) { ?>
                    <tr>
                        <td><?=$property['NAME']?></td>
                        <td><?=(
                            is_array($property['VALUE'])
                                ? implode(' / ', $property['VALUE'])
                                : $property['VALUE']
                            )?>
                            <?if($property["DESCRIPTION"]):?><span class="smt-project-item-descr"><?=$property["~DESCRIPTION"]?></span><?endif?>
                            <?if($property["HINT"]):?><span class="smt-project-item-hint"><?=$property["HINT"]?></span><?endif?>
                        </td>
                    </tr>
                    <? } ?>
                <? } ?>
                <? unset($property); ?>
            </table>
        <?endif;?>
        <?if(!empty($arParams['TABS_LIST'])):?>
        <div class="smt-widget smt-widget_margin">
            <ul class="nav nav-tabs smt-nav-tabs smt-nav-tabs_colored" role="tablist">
            <?foreach ($arParams['TABS_LIST'] as $code=>$value):?>
                <?if(strlen($value) > 0):?>
                <li<?if($code==0):?> class="active"<?endif?> role="presentation"><a href="#smt-tab-<?=$code?>" data-toggle="tab" aria-controls="smt-tab-<?=$code?>" role="tab"><?=htmlspecialcharsbx($value)?></a></li>
                <?endif?>
            <?endforeach?>
            </ul>
            <div class="tab-content smt-tab-content">
            <?foreach ($arParams['TABS_LIST'] as $code=>$value):?>
                <?if(strlen($value) > 0):?>
                <div class="tab-pane fade<?if($code==0):?> active in<?endif?>" role="tabpanel" id="smt-tab-<?=$code?>">
                    <?if($arParams['TABS_LIST_ITEM_' . $code]):?>
                        <?if($arParams['TABS_LIST_ITEM_' . $code] == 'SMT_DETAIL_TEXT'):?>
                            <?if(strlen($arResult["DETAIL_TEXT"])>0):?>
                                <?if($arResult["DETAIL_TEXT_TYPE"] == 'text'):?>
                                    <p><?=$arResult["DETAIL_TEXT"]?></p>
                                <?else:?>
                                    <?=$arResult["DETAIL_TEXT"]?>
                                <?endif?>
                            <?else:?>
                                <?if($arResult["PREVIEW_TEXT_TYPE"] == 'text'):?>
                                    <p><?=$arResult["PREVIEW_TEXT"]?></p>
                                <?else:?>
                                    <?=$arResult["PREVIEW_TEXT"]?>
                                <?endif?>
                            <?endif?>
                        <?endif?>
                        <?if(strlen($arParams['TABS_LIST_INCLUDE_' . $code]) > 0):?>
                            <?$APPLICATION->IncludeFile(
                                $arParams['TABS_LIST_INCLUDE_' . $code],
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        <?elseif(strlen($arParams['TABS_LIST_ITEM_' . $code]) > 0 && isset($arResult['PROPERTIES'][$arParams['TABS_LIST_ITEM_' . $code]])):?>
                            <?$property = $arResult['DISPLAY_PROPERTIES'][$arParams['TABS_LIST_ITEM_' . $code]];?>
                            <?if(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "HTML"):?>
                                <?=$property['DISPLAY_VALUE']?>
                            <?elseif(isset($property['VALUE']["TYPE"]) && $property['VALUE']["TYPE"] == "TEXT"):?>
                                <p><?=$property['VALUE']["TEXT"]?></p>
                            <?else:?>
                                <?=(
                                is_array($property['VALUE'])
                                    ? implode(' / ', $property['VALUE'])
                                    : $property['VALUE']
                                )?>
                            <?endif;?>
                            <?unset($property);?>
                        <?endif?>
                    <?endif?>
                </div>
                <?endif;?>
            <?endforeach?>
            </div>
        </div>
        <?endif;?>
        </div>
    </div>
</div>
<?$this->SetViewTarget('smt_footer');?>
<div class="smt-popup mfp-hide" id="smt-popup-order">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_order_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_order.php",
                Array("OBJECT_ID" => $arResult["ID"]),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>
<div class="smt-popup mfp-hide" id="smt-popup-consult">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_consult_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_consult.php",
                Array("OBJECT_ID" => $arResult["ID"]),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>
<?$this->EndViewTarget();?>