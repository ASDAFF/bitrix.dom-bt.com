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

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/colors.css',
    'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>
<?$APPLICATION->IncludeComponent(
    "underware:catalog.filter",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "IBLOCK_TYPE" => "smt_company",
        "IBLOCK_ID" => "14",
        "FILTER_NAME" => "arrFilter",
        "PROPERTY_CODE" => array(
            0 => "POP_CATS",
            1 => "",
        ),
        "PROPERTY_AREA_BUILDING_VALUE" => array(
            0 => "20",
            1 => "42",
            2 => "44",
            3 => "",
        ),
        "AREA_BUILDING_SORT" => "3",
        "PROPERTY_SIZE_VALUE" => array(
            0 => "4,0 х 4,0",
            1 => "4,0 х 5,0",
            2 => "4,0 х 6,0",
            3 => "",
        ),
        "SIZE_SORT" => "2",
        "NUMBER_WIDTH" => "20",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "PROPERTY_TYPE" => "",
        "PROPERTY_FLOORS_VALUE" => array(
            0 => "75",
            1 => "76",
            2 => "77",
            3 => "78",
            4 => "",
        ),
        "FLOORS_SORT" => "8",
        "PROPERTY_WC_VALUE" => array(
            0 => "1",
            1 => "2",
            2 => "",
        ),
        "WC_SORT" => "4",
        "PROPERTY_BEDROOMS_VALUE" => array(
            0 => "1",
            1 => "2",
            2 => "3",
            3 => "4",
            4 => "",
        ),
        "BEDROOMS_SORT" => "6",
        "PROPERTY_POP_CATS_VALUE" => array(
            0 => "80",
            1 => "81",
            2 => "82",
            3 => "83",
            4 => "84",
            5 => "85",
            6 => "86",
            7 => "87",
            8 => "88",
            9 => "89",
            10 => "90",
            11 => "91",
            12 => "92",
            13 => "93",
            14 => "94",
            15 => "95",
            16 => "96",
            17 => "97",
            18 => "98",
            19 => "99",
            20 => "100",
            21 => "101",
            22 => "102",
            23 => "103",
            24 => "104",
            25 => "105",
            26 => "106",
            27 => "107",
            28 => "108",
            29 => "109",
            30 => "110",
            31 => "111",
            32 => "112",
            33 => "113",
            34 => "114",
            35 => "115",
            36 => "116",
            37 => "117",
            38 => "118",
            39 => "119",
            40 => "120",
            41 => "121",
            42 => "122",
            43 => "123",
            44 => "124",
            45 => "125",
            46 => "126",
            47 => "127",
            48 => "128",
            49 => "129",
            50 => "130",
            51 => "131",
            52 => "132",
            53 => "133",
            54 => "134",
            55 => "135",
            56 => "136",
            57 => "137",
            58 => "138",
            59 => "139",
            60 => "140",
            61 => "141",
            62 => "142",
            63 => "143",
            64 => "144",
            65 => "145",
            66 => "146",
            67 => "147",
            68 => "148",
            69 => "149",
            70 => "150",
            71 => "151",
            72 => "152",
            73 => "153",
            74 => "154",
            75 => "155",
            76 => "156",
            77 => "157",
            78 => "158",
            79 => "159",
            80 => "160",
            81 => "161",
            82 => "162",
            83 => "163",
            84 => "164",
            85 => "165",
            86 => "166",
            87 => "167",
            88 => "168",
            89 => "169",
            90 => "170",
            91 => "171",
            92 => "172",
            93 => "173",
            94 => "174",
            95 => "175",
            96 => "176",
            97 => "177",
            98 => "178",
            99 => "179",
            100 => "180",
            101 => "181",
            102 => "182",
            103 => "183",
            104 => "184",
            105 => "185",
            106 => "186",
            107 => "",
        ),
        "POP_CATS_SORT" => "1"
    ),
    false
);?>
<div class="bx-filter <?=$templateData["TEMPLATE_CLASS"]?> <?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL") echo "bx-filter-horizontal"?>">
    <div class="bx-filter-section">
        <div class="row"><div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> bx-filter-title"><span class="smt-header-underline-center" style="color:#fff; background-color: #1fa0da;padding: 14px;margin-left: -15px;margin-bottom: 0px;display: inline-block;margin-top: -15px;"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></span></div></div>
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
            <?foreach($arResult["HIDDEN"] as $arItem):?>
                <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
            <?endforeach;?>
            <div class="row">
                <?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
                {
                    $key = $arItem["ENCODED_ID"];
                    if(isset($arItem["PRICE"])):
                        if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                            continue;

                        $precision = 2;
                        if (Bitrix\Main\Loader::includeModule("currency"))
                        {
                            $res = CCurrencyLang::GetFormatDescription($arItem["VALUES"]["MIN"]["CURRENCY"]);
                            $precision = $res['DECIMALS'];
                        }
                        ?>
                        <div class="col-md-4 bx-filter-parameters-box bx-active">
                            <span class="bx-filter-container-modef"></span>
                            <div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)"><span><?=$arItem["NAME"]?> <i data-role="prop_angle" class="fa fa-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>"></i></span></div>
                            <div class="bx-filter-block" data-role="bx_filter_block">
                                <div class="row bx-filter-parameters-box-container">
                                    <div class="col-lg-4 col-xs-6 bx-filter-parameters-box-container-block bx-left">

                                        <div class="bx-filter-input-container">
                                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                                            <input
                                                class="min-price"
                                                type="text"
                                                placeholder="кв.м."
                                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6 bx-filter-parameters-box-container-block bx-right">

                                        <div class="bx-filter-input-container">

                                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                                            <input
                                                class="max-price"
                                                type="text"
                                                placeholder="кв.м."
                                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                                size="5"
                                                onkeyup="smartFilter.keyup(this)"
                                            />
                                        </div>
                                    </div>

                                    <div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
                                        <div class="bx-ui-slider-track" id="drag_track_<?=$key?>">
                                            <?
                                            $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                                            $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                            $price1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                            $price2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                            $price3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                            $price4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                            $price5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                            ?>
                                            <div class="bx-ui-slider-part p1"><span><?=$price1?></span></div>
                                            <div class="bx-ui-slider-part p2"><span><?=$price2?></span></div>
                                            <div class="bx-ui-slider-part p3"><span><?=$price3?></span></div>
                                            <div class="bx-ui-slider-part p4"><span><?=$price4?></span></div>
                                            <div class="bx-ui-slider-part p5"><span><?=$price5?></span></div>

                                            <div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
                                            <div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
                                            <div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
                                            <div class="bx-ui-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0%; right: 0%;">
                                                <a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
                                                <a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?
                    $arJsParams = array(
                        "leftSlider" => 'left_slider_'.$key,
                        "rightSlider" => 'right_slider_'.$key,
                        "tracker" => "drag_tracker_".$key,
                        "trackerWrap" => "drag_track_".$key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                        "precision" => $precision,
                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                    );
                    ?>
                        <script type="text/javascript">
                            BX.ready(function(){
                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                            });
                        </script>
                    <?endif;
                }

                //not prices
                $ii == 1;
                foreach($arResult["ITEMS"] as $key=>$arItem)
                {
                if(
                    empty($arItem["VALUES"])
                    || isset($arItem["PRICE"])
                )
                    continue;

                if (
                    $arItem["DISPLAY_TYPE"] == "A"
                    && (
                        $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                    )
                )
                    continue;
                ?>
                <?php if (($arItem["DISPLAY_TYPE"] == "A") || ($arItem["DISPLAY_TYPE"] == "CHECKBOX")) { ?>
                <div class="col-xs-12 col-md-9 bx-filter-parameters-box bx-active">
                    <?} else { ?>



                    <? if  ( $ii == 1 ) {?> <div class="checkcolumn  col-md-3 bx-filter-parameters-box bx-active"> <? $ll="12"; }
                        if  ( $ii == 2 ) { $ll="3"; }
                        if  ( $ii == 3 ) { $ll="3"; }
                        if  ( $ii == 4 ) { $ll="3"; }
                        ?>
                        <!-- блок с параметрами -->
                        <div class="col-md-<? echo $ll; ?> bx-filter-parameters-box bx-active">
                            <? } ?>
                            <span class="bx-filter-container-modef"></span>
                            <div class="bx-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)">
							<span class="bx-filter-parameters-box-hint"><?=$arItem["NAME"]?>
                                <?if ($arItem["FILTER_HINT"] <> ""):?>
                                    <i id="item_title_hint_<?echo $arItem["ID"]?>" class="fa fa-question-circle"></i>
                                    <script type="text/javascript">
										new top.BX.CHint({
                                            parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
                                            show_timeout: 10,
                                            hide_timeout: 200,
                                            dx: 2,
                                            preventHide: true,
                                            min_width: 250,
                                            hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
                                        });
									</script>
                                <?endif?>
                                <i data-role="prop_angle" class="fa fa-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>"></i>
							</span>
                            </div>

                            <div class="bx-filter-block" data-role="bx_filter_block">
                                <div class="row bx-filter-parameters-box-container">
                                    <?
                                    $arCur = current($arItem["VALUES"]);
                                    switch ($arItem["DISPLAY_TYPE"])
                                    {
                                    case "A"://NUMBERS_WITH_SLIDER
                                        ?>
                                        <script>
                                            $(document).on('click', '.lisel li', function(){
                                                $('.lisel li').removeClass('active');
                                                $(this).addClass('active');
                                                xmin = $(this).attr('data-min');
                                                xmax = $(this).attr('data-max');
                                                $('.mimimi').val(xmin);
                                                $('.mamama').val(xmax);
                                                //$('.mamama').click();
                                                //$('.mamama').click();
                                                $('.mimimi').trigger('keyup');
                                                $('.mamama').trigger('keyup');
                                            });
                                        </script>
                                        <div class="col-md-4 col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                            <div class="bx-filter-input-container">
                                                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>

                                                <input
                                                    class="min-price mimimi"
                                                    type="text"
                                                    placeholder="м2"
                                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-6 bx-filter-parameters-box-container-block bx-right">

                                            <div class="bx-filter-input-container">
                                                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                                                <input
                                                    class="max-price mamama"
                                                    type="text"
                                                    placeholder="м2"
                                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div>
                                        </div>

                                        <!--									<div class="col-xs-10 col-xs-offset-1 bx-ui-slider-track-container">
										<div class="bx-ui-slider-track" id="drag_track_<?=$key?>"> -->
                                    <?
                                    $precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
                                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                    $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                    $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                    $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                    $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                    $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                    ?>
                                        <!--											<div class="bx-ui-slider-part p1"><span><?=$value1?></span></div>
											<div class="bx-ui-slider-part p2"><span><?=$value2?></span></div>
											<div class="bx-ui-slider-part p3"><span><?=$value3?></span></div>
											<div class="bx-ui-slider-part p4"><span><?=$value4?></span></div>
											<div class="bx-ui-slider-part p5"><span><?=$value5?></span></div>

											<div class="bx-ui-slider-pricebar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
											<div class="bx-ui-slider-pricebar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
											<div class="bx-ui-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
												<a class="bx-ui-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
												<a class="bx-ui-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
											</div>
										</div>
									</div> -->

                                        <ul class="lisel">
                                            <li data-min="0" data-max="100"> до 100 м<sup>2</sup> </li>
                                            <li data-min="100" data-max="150"> 100 -150 м<sup>2</sup> </li>
                                            <li data-min="150" data-max="200"> 150 -200 м<sup>2</sup> </li>
                                            <li data-min="200" data-max="<?=$value5?>"> более 200 м<sup>2</sup> </li>
                                        </ul>
                                    <?
                                    $arJsParams = array(
                                        "leftSlider" => 'left_slider_'.$key,
                                        "rightSlider" => 'right_slider_'.$key,
                                        "tracker" => "drag_tracker_".$key,
                                        "trackerWrap" => "drag_track_".$key,
                                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
                                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                        "precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
                                        "colorUnavailableActive" => 'colorUnavailableActive_'.$key,
                                        "colorAvailableActive" => 'colorAvailableActive_'.$key,
                                        "colorAvailableInactive" => 'colorAvailableInactive_'.$key,
                                    );
                                    ?>
                                        <script type="text/javascript">
                                            BX.ready(function(){
                                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                            });
                                        </script>
                                    <?
                                    break;
                                    case "B"://NUMBERS
                                    ?>
                                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                                            <div class="bx-filter-input-container">
                                                <input
                                                    class="min-price"
                                                    type="text"
                                                    name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                                            <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                                            <div class="bx-filter-input-container">
                                                <input
                                                    class="max-price"
                                                    type="text"
                                                    name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                                    id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                                    value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                                    size="5"
                                                    onkeyup="smartFilter.keyup(this)"
                                                />
                                            </div>
                                        </div>
                                    <?
                                    break;
                                    case "G"://CHECKBOXES_WITH_PICTURES
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="bx-filter-param-btn-inline">
                                                <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                                    <input
                                                        style="display: none"
                                                        type="checkbox"
                                                        name="<?=$ar["CONTROL_NAME"]?>"
                                                        id="<?=$ar["CONTROL_ID"]?>"
                                                        value="<?=$ar["HTML_VALUE"]?>"
                                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                    />
                                                    <?
                                                    $class = "";
                                                    if ($ar["CHECKED"])
                                                        $class.= " bx-active";
                                                    if ($ar["DISABLED"])
                                                        $class.= " disabled";
                                                    ?>
                                                    <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                        <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                    <?endif?>
												</span>
                                                    </label>
                                                <?endforeach?>
                                            </div>
                                        </div>
                                    <?
                                    break;
                                    case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="bx-filter-param-btn-block">
                                                <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                                    <input
                                                        style="display: none"
                                                        type="checkbox"
                                                        name="<?=$ar["CONTROL_NAME"]?>"
                                                        id="<?=$ar["CONTROL_ID"]?>"
                                                        value="<?=$ar["HTML_VALUE"]?>"
                                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                    />
                                                    <?
                                                    $class = "";
                                                    if ($ar["CHECKED"])
                                                        $class.= " bx-active";
                                                    if ($ar["DISABLED"])
                                                        $class.= " disabled";
                                                    ?>
                                                    <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="bx-filter-param-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                        <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                    <?endif?>
												</span>
                                                        <span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif;?></span>
                                                    </label>
                                                <?endforeach?>
                                            </div>
                                        </div>
                                    <?
                                    break;
                                    case "P"://DROPDOWN
                                    $checkedItemExist = false;
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="bx-filter-select-container">
                                                <div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                                                    <div class="bx-filter-select-text" data-role="currentOption">
                                                        <?
                                                        foreach ($arItem["VALUES"] as $val => $ar)
                                                        {
                                                            if ($ar["CHECKED"])
                                                            {
                                                                echo $ar["VALUE"];
                                                                $checkedItemExist = true;
                                                            }
                                                        }
                                                        if (!$checkedItemExist)
                                                        {
                                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="bx-filter-select-arrow"></div>
                                                    <input
                                                        style="display: none"
                                                        type="radio"
                                                        name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                                        id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                        value=""
                                                    />
                                                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                                        <input
                                                            style="display: none"
                                                            type="radio"
                                                            name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                                            id="<?=$ar["CONTROL_ID"]?>"
                                                            value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                        />
                                                    <?endforeach?>
                                                    <div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none;">
                                                        <ul>
                                                            <li>
                                                                <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                </label>
                                                            </li>
                                                            <?
                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                $class = "";
                                                                if ($ar["CHECKED"])
                                                                    $class.= " selected";
                                                                if ($ar["DISABLED"])
                                                                    $class.= " disabled";
                                                                ?>
                                                                <li>
                                                                    <label for="<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" data-role="label_<?=$ar["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')"><?=$ar["VALUE"]?></label>
                                                                </li>
                                                            <?endforeach?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?
                                    break;
                                    case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="bx-filter-select-container">
                                                <div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                                                    <div class="bx-filter-select-text fix" data-role="currentOption">
                                                        <?
                                                        $checkedItemExist = false;
                                                        foreach ($arItem["VALUES"] as $val => $ar):
                                                            if ($ar["CHECKED"])
                                                            {
                                                                ?>
                                                                <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                            <?endif?>
                                                                <span class="bx-filter-param-text">
																<?=$ar["VALUE"]?>
															</span>
                                                                <?
                                                                $checkedItemExist = true;
                                                            }
                                                        endforeach;
                                                        if (!$checkedItemExist)
                                                        {
                                                            ?><span class="bx-filter-btn-color-icon all"></span> <?
                                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="bx-filter-select-arrow"></div>
                                                    <input
                                                        style="display: none"
                                                        type="radio"
                                                        name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                                        id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                        value=""
                                                    />
                                                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                                                        <input
                                                            style="display: none"
                                                            type="radio"
                                                            name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                                            id="<?=$ar["CONTROL_ID"]?>"
                                                            value="<?=$ar["HTML_VALUE_ALT"]?>"
                                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                        />
                                                    <?endforeach?>
                                                    <div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
                                                        <ul>
                                                            <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                                <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                                                    <span class="bx-filter-btn-color-icon all"></span>
                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                </label>
                                                            </li>
                                                            <?
                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                $class = "";
                                                                if ($ar["CHECKED"])
                                                                    $class.= " selected";
                                                                if ($ar["DISABLED"])
                                                                    $class.= " disabled";
                                                                ?>
                                                                <li>
                                                                    <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
                                                                        <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                            <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                                                        <?endif?>
                                                                        <span class="bx-filter-param-text">
																	<?=$ar["VALUE"]?>
																</span>
                                                                    </label>
                                                                </li>
                                                            <?endforeach?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?
                                    break;
                                    case "K"://RADIO_BUTTONS
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="radio">
                                                <label class="bx-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="bx-filter-input-checkbox">
													<input
                                                        type="radio"
                                                        value=""
                                                        name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                        id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                                        onclick="smartFilter.click(this)"
                                                    />
													<span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
                                                </label>
                                            </div>
                                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                                <div class="radio">
                                                    <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
                                                            type="radio"
                                                            value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                            name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                            onclick="smartFilter.click(this)"
                                                        />
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif;?></span>
													</span>
                                                    </label>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                    <?
                                    break;
                                    case "U"://CALENDAR
                                    ?>
                                        <div class="col-xs-12">
                                            <div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
                                                    <?$APPLICATION->IncludeComponent(
                                                        'bitrix:main.calendar',
                                                        '',
                                                        array(
                                                            'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                            'SHOW_INPUT' => 'Y',
                                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                            'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                                            'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                            'SHOW_TIME' => 'N',
                                                            'HIDE_TIMEBAR' => 'Y',
                                                        ),
                                                        null,
                                                        array('HIDE_ICONS' => 'Y')
                                                    );?>
                                                </div></div>
                                            <div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
                                                    <?$APPLICATION->IncludeComponent(
                                                        'bitrix:main.calendar',
                                                        '',
                                                        array(
                                                            'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                                            'SHOW_INPUT' => 'Y',
                                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                            'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                                            'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                            'SHOW_TIME' => 'N',
                                                            'HIDE_TIMEBAR' => 'Y',
                                                        ),
                                                        null,
                                                        array('HIDE_ICONS' => 'Y')
                                                    );?>
                                                </div></div>
                                        </div>
                                    <?
                                    break;
                                    default://CHECKBOXES
                                    ?>
                                        <div class="col-xs-12">
                                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                                <div class="checkbox">
                                                    <label data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="bx-filter-input-checkbox">
														<input
                                                            type="checkbox"
                                                            value="<? echo $ar["HTML_VALUE"] ?>"
                                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                            onclick="smartFilter.click(this)"
                                                        />
														<span class="bx-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                            endif;?></span>
													</span>
                                                    </label>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                    <?
                                    }
                                    ?>
                                </div>
                                <div style="clear: both"></div>
                            </div>
                        </div>
                        <?

                        if ($ii == 1) { echo '</div>';}
                        $ii++;

                        }
                        ?>

                    </div><!--//row-->
                    <div class="row">
                        <div class="col-xs-12 bx-filter-button-box">
                            <div class="bx-filter-block">
                                <div class="bx-filter-parameters-box-container">
                                    <?/*<input
								class="btn smt-btn pull-right"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>*/?>
                                    <input
                                        class="btn smt-btn-border pull-left"
                                        type="submit"
                                        id="del_filter"
                                        name="del_filter"
                                        value="x <?=GetMessage("CT_BCSF_DEL_FILTER")?>"
                                    />
                                    <div class="bx-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
                                        <?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
                                        <span class="arrow"></span>
                                        <br/>
                                        <a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clb"></div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>
<script>
    $(document).ready(function () {
        $('#modef a').on('click', function () {
            var filter_height = $('#rg_filter_height').height() - 85;
            var destination = $('#rg_filter_scroll').offset().top;
            $('html').animate({scrollTop: destination - filter_height - 62}, 1100);
        });
    });
</script>