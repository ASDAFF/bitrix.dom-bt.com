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
<div class="smt-project-list">
        <p>
        <?
        $orderFields = array(
            'name' => 'названию',
            'property_price' => 'цене',
            'property_area_common' => 'площади',
        );
        $currentSortField = $arParams["ELEMENT_SORT_FIELD"];
        if (isset($_GET['sort']) && array_key_exists($_GET['sort'], $orderFields)) {
            $currentSortField = $_GET['sort'];
        }
        $currentSortOrder = 'asc';
        if (isset($_GET['order'])) {
            $currentSortOrder = ($_GET['order'] === 'asc') ? 'asc' : 'desc';
            $inverseSortOrder = ($currentSortOrder === 'asc') ? 'desc' : 'asc';
        }
        $arParams["ELEMENT_SORT_FIELD"] = $currentSortField;
        $arParams["ELEMENT_SORT_ORDER"] = $currentSortOrder;
        ?><ul class="list-inline text-right sort-list-wrapper"><?
            ?><li>Сортировать по:</li><?
            foreach ($orderFields as $key=>$field):
                $isFieldActive = '';
                if ($currentSortField === $key) {
                    $isFieldActive = ' active';
                }
                ?><li><?
                ?><a class="sort-link <?=$isFieldActive?>" href="<?=$APPLICATION->GetCurPageParam(http_build_query(array('sort'=>$key, 'order'=>($isFieldActive)?$inverseSortOrder:'asc')), array('sort', 'order'))?>"><?=$field?></a>&nbsp;<?
                ?><a class="sort-link-arrow <?=($isFieldActive && $currentSortOrder === 'asc')?'active':''; ?>" href="<?=$APPLICATION->GetCurPageParam(http_build_query(array('sort'=>$key, 'order'=>'asc')), array('sort', 'order'))?>"><i class="fa fa-long-arrow-up"></i></a><?
                ?><a class="sort-link-arrow <?=($isFieldActive && $currentSortOrder === 'desc')?'active':''; ?>" href="<?=$APPLICATION->GetCurPageParam(http_build_query(array('sort'=>$key, 'order'=>'desc')), array('sort', 'order'))?>"><i class="fa fa-long-arrow-down"></i></a><?
                ?></li><?
            endforeach;
            ?></ul>
        </p>
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
        <div class="col-xs-12 col-sm-6 col-md-<?=$rowLineCount?> col-lg-<?=$rowLineCount?>"  style="height: 484px;">
        <?endif?>
            <div class="smt-project-item smt-project-item_<?=$arParams["PICTURE_RESOLUTION"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="height: 484px;">
                <div class="smt-project-item__container">
                   <a class="smt-project-item__content" href="<?=$arItem["DETAIL_PAGE_URL"]?>" target="_blank">
                        <?if($arParams["DISPLAY_NAME"] == "Y"):?>
                        <div class="smt-project-item__name"><?=$arItem["NAME"]?></div>
                        <?endif?>
                     </a>
                    <?if($arParams["DISPLAY_PICTURE"] == "Y"):?>
                    <div class="smt-image-box-inline">
                        <a class="smt-image-box-inline__container" href="<?=$arItem["DETAIL_PAGE_URL"]?>" target="_blank">
                            <div class="smt-image-box-inline__inline">
                                <?if($arItem["PREVIEW_PICTURE"]["SRC"]):?>
                                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" class="img-responsive smt-image-box-inline__image">
                                 
                                <div class="smt-image-box-inline__over"></div>
                                    <?if($arItem["PROPERTIES"]["LABEL"]["VALUE"]):?>
                                        <div class="smt-image-box-inline-label"><?=$arItem["PROPERTIES"]["LABEL"]["VALUE"]?></div>
                                    <?endif;?>
                                <?endif?>
                                <div class="kk">Перейти к проекту</div>
                            </div>
                        </a>
                    </div>
                    <?endif?>
                    <a class="smt-project-item__content" href="<?=$arItem["DETAIL_PAGE_URL"]?>" target="_blank">
                        <?if($arParams["DISPLAY_NAME"] == "Y"):?>
                       <!-- <div class="smt-project-item__name"><?//=$arItem["NAME"]?></div> -->
                        <?endif?>
                        <div class="smt-project-item__property">
                            <?if(!empty($arItem['PROPERTIES'])):?>
                                <ul class="list-unstyled mafor">
                                       <li>
                                       <span class="smt-project-item-descr pl1"></span> 
                                       <span class="smt-project-item-hint"><?=$arItem['PROPERTIES']['SIZE']['VALUE']?> м</span>
                                       </li>
                                       <li>
                                       <span class="smt-project-item-descr pl2"></span>
                                       <span class="smt-project-item-hint"><?=$arItem['PROPERTIES']['AREA_COMMON']['VALUE']?> м²</span>
                                       </li>
                                       
                                    <? //foreach ($arItem['PROPERTIES'] as $property) { ?>
                                    
                                       
                                             <li><?//=$property['NAME']?> <?//=( is_array($property['VALUE'])  ? implode(' / ', $property['VALUE']) : $property['VALUE'])?>
                                                <?//if($property["DESCRIPTION"]):?><span class="smt-project-item-descr"><?//=$property["~DESCRIPTION"]?></span><?//endif?>
                                                <?//if($property["HINT"]):?><span class="smt-project-item-hint"><?//=$property["HINT"]?></span><?//endif?>
                                            </li>
                                     <? // } ?>
                                    <? //unset($property); ?>
                                </ul>
                            <?endif;?>
                                <ul class="ccs"><li>Цена от <span class="blty"><?=smtCatalogCurrencyFormat($arItem["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span></span> руб.</li></ul>
                                <!--
                            <?if($arItem["PROPERTIES"]["PRICE_TEXT"]["VALUE"]):?>
                                <?$property = $arItem['DISPLAY_PROPERTIES']["PRICE"];?>
                               
                                
                                <?unset($property);?>
                            <?elseif($arItem["PROPERTIES"]["PRICE"]["VALUE"]):?>
                                <?if($arItem["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"]):?>
                                    
                                    <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                                    <span class="smt-price smt-price_discount"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arItem["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
                                    <span class="smt-price-old"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arItem["PROPERTIES"]["PRICE_DISCOUNT"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
                                <?else:?>
                                    <span class="smt-price-label"><?=$arParams["PRICE_HEADER"]?$arParams["PRICE_HEADER"]:GetMessage("SMT_BPSC_HEADER_PRICE")?></span>
                                    <span class="smt-price"><span class="smt-price-value"><?=smtCatalogCurrencyFormat($arItem["PROPERTIES"]["PRICE"]["VALUE"], $arParams["CURRENCY_DECIMALS"], $arParams["CURRENCY_DECIMALS_POINT"], $arParams["CURRENCY_THOUSANDS_SEP"]);?></span> <span class="smt-price-currency"><?=$arParams["CURRENCY"]?$arParams["CURRENCY"]:GetMessage("SMT_BPSC_HEADER_CURRENCY")?></span></span>
                                <?endif;?>
                            <?endif;?>
                            <?if($arParams["DISPLAY_PREVIEW_TEXT"] == "Y"):?>
                            <div class="smt-project-item__preview-text"><?if($arItem["PREVIEW_TEXT_TYPE"] == 'text'):?>
                                <?=$arItem["PREVIEW_TEXT"]?>
                            <?else:?>
                                <?=$arItem["PREVIEW_TEXT"]?>
                            <?endif?>
                            </div>
                            <?endif?>
                            -->
                        </div>
                    </a>
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
    <?if($arResult["DESCRIPTION"]):?>
        <div class="smt-widget smt-widget_margin">
            <?if($arResult["DESCRIPTION_TYPE"] == 'text'):?>
                <p><?=$arResult["DESCRIPTION"]?></p>
            <?else:?>
                <?=$arResult["DESCRIPTION"]?>
            <?endif?>
        </div>
    <?endif?>
<?endif?>

