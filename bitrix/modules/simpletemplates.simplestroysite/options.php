<?
$module_id = "simpletemplates.simplestroysite";
$RIGHT_W = $RIGHT_R = $USER->IsAdmin();

if($RIGHT_R || $RIGHT_W):

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");
IncludeModuleLangFile(__FILE__);

$arSites = array();
$arSiteList = array();
$dbSites = CSite::GetList($b = "sort", $o = "asc", array("ACTIVE" => "Y"));
while ($arSite = $dbSites->Fetch())
{
    $arSites[] = $arSite;
    $arSiteList[] = $arSite['ID'];
}
    
$arAllOptions = array(
    array("smt_main_color", GetMessage("SMT_OPTIONS_MAIN_COLOR"), array("colorbox", 12)),
    array("smt_main_button_color", GetMessage("SMT_OPTIONS_BUTTON_COLOR"), array("colorbox", 12)),
    array("smt_main_color_link", GetMessage("SMT_OPTIONS_COLOR_LINK"), array("colorbox", 12)),
    array("smt_main_text_color", GetMessage("SMT_OPTIONS_TEXT_COLOR"), array("colorbox", 12)),
    array("smt_main_menu_color", GetMessage("SMT_OPTIONS_MENU_COLOR"), array("colorbox", 12)),
    array("smt_main_show_slider", GetMessage("SMT_OPTIONS_MAIN_SHOW_SLIDER"), array("checkbox")),
    array("smt_main_show_benefits", GetMessage("SMT_OPTIONS_MAIN_SHOW_BENEFITS"), array("checkbox")),
    array("smt_main_show_about", GetMessage("SMT_OPTIONS_MAIN_SHOW_ABOUT"), array("checkbox")),
    array("smt_main_show_services", GetMessage("SMT_OPTIONS_MAIN_SHOW_SERVICES"), array("checkbox")),
    array("smt_main_show_projects", GetMessage("SMT_OPTIONS_MAIN_SHOW_PROJECTS"), array("checkbox")),
    array("smt_main_show_gallery", GetMessage("SMT_OPTIONS_MAIN_SHOW_GALLERY"), array("checkbox")),
    array("smt_main_show_responses", GetMessage("SMT_OPTIONS_MAIN_SHOW_RESPONSES"), array("checkbox")),
    array("smt_main_show_form", GetMessage("SMT_OPTIONS_MAIN_SHOW_FORM"), array("checkbox")),
    array("smt_main_show_action", GetMessage("SMT_OPTIONS_MAIN_SHOW_ACTION"), array("checkbox")),
    array("smt_main_show_article", GetMessage("SMT_OPTIONS_MAIN_SHOW_ARTICLE"), array("checkbox")),
    array("smt_main_show_news", GetMessage("SMT_OPTIONS_MAIN_SHOW_NEWS"), array("checkbox")),
    array("smt_main_show_banner", GetMessage("SMT_OPTIONS_MAIN_SHOW_BANNER"), array("checkbox")),
    array("smt_main_show_text", GetMessage("SMT_OPTIONS_MAIN_SHOW_TEXT"), array("checkbox")),
    array("smt_main_main_blocks", GetMessage("SMT_OPTIONS_MAIN_BLOCKS"), array("drag_options", 12)),
);

$arAllBlocks = array(
    "slider" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_SLIDER"),
    "benefits" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_BENEFITS"),
    "about" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_ABOUT"),
    "projects" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_PROJECTS"),
    "gallery" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_GALLERY"),
    "info1" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_INFO1"),
    "action" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_ACTION"),
    "info2" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_INFO2"),
    "banner" => GetMessage("SMT_OPTIONS_MAIN_BLOCKS_BANNER"),
);

$aTabs = array(
    array(
        "DIV" => "edit1",
        "TAB" => GetMessage("MAIN_TAB_SET"),
        "TITLE" => GetMessage("MAIN_TAB_TITLE_SET"),
    ),
);
$tabControl = new CAdminTabControl("tabControl", $aTabs);

CModule::IncludeModule($module_id);

if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && (
        isset($_REQUEST["Update"])
        || isset($_REQUEST["Apply"])
        || isset($_REQUEST["RestoreDefaults"])
    )
    && $RIGHT_W
    && check_bitrix_sessid()
)
{
    if (isset($_REQUEST["RestoreDefaults"]))
    {
        COption::RemoveOption($module_id);
    }
    else
    {
        foreach($arSiteList as $site)
        {
            $suffix = ($site <> ''? '_bx_site_'.$site:'');
            $colorProperties = array();
            foreach ($arAllOptions as $arOption)
            {
                $name = $arOption[0];
                $type = $arOption[2][0];
                $val = trim($_REQUEST[$name . $suffix], " \t\n\r");
                if ($arOption[2][0] == "checkbox" && $val != "Y") {
                    $val = "N";
                }
                if($arOption[2][0] == "multiselectbox") {
                    $val = @implode(",", $val);
                }
                COption::SetOptionString($module_id, $name, $val, $arOption[1], $site);
                if ($type == 'colorbox' && $val) {
                    $colorProperties[$name] = $val;
                }
            }
            if(!empty($colorProperties) && is_file($_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/simplestroysite/assets/css/colors/template.less')) {
                $parser = new Less_Parser();
                $parser->parseFile($_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/simplestroysite/assets/css/colors/template.less');
                $parser->ModifyVars( $colorProperties );
                file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/bitrix/templates/simplestroysite/assets/css/colors/template_'.$site.'.css', $parser->getCss());
            }
        }

    }

    if (isset($_REQUEST["back_url_settings"]))
    {
        if(
            isset($_REQUEST["Apply"])
            || isset($_REQUEST["RestoreDefaults"])
        )
            LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&back_url_settings=".urlencode($_REQUEST["back_url_settings"])."&".$tabControl->ActiveTabParam());
        else
            LocalRedirect($_REQUEST["back_url_settings"]);
    }
    else
    {
        LocalRedirect($APPLICATION->GetCurPage()."?mid=".urlencode($module_id)."&lang=".urlencode(LANGUAGE_ID)."&".$tabControl->ActiveTabParam());
    }
}
?>
<script type="text/javascript">
    function initDraggableOrderControl(params)
    {
        var data = JSON.parse(params.data);
        if (data)
        {
            BX.loadScript('/bitrix/js/main/core/core_dragdrop.js', function(){
                (function bx_dnd_order_waiter(){
                    if (!!BX.DragDrop)
                        window['dnd_parameter_' + params.propertyID] = new DragNDropOrderParameterControl(data, params);
                    else
                        setTimeout(bx_dnd_order_waiter, 50);
                })();
            });
        }
    }

    function DragNDropOrderParameterControl(items, params)
    {
        var rand = BX.util.getRandomString(5);

        this.params = params || {};
        this.items = this.getSortedItems(items);

        this.rootElementId = 'dnd_params_container_' + this.params.propertyID + '_' + rand;
        this.dragItemClassName = 'dnd-order-draggable-item-' + this.params.propertyID + '-' + rand;

        this.buildNodes();
        this.initDragDrop();
    }

    DragNDropOrderParameterControl.prototype =
    {
        getPath: function()
        {
            var path = this.params.propertyParams.JS_FILE.split('/');

            path.pop();

            return path.join('/');
        },

        getSortedItems: function(items)
        {
            if (!items)
                return [];

            var inputValue = this.params.oInput.value || this.params.propertyParams.DEFAULT || '',
                result = [],
                k;

            var values = inputValue.split(',');
            for (k in values)
            {
                if (values.hasOwnProperty(k))
                {
                    values[k] = BX.util.trim(values[k]);
                    if (items[values[k]])
                    {
                        result.push({
                            value: values[k],
                            message: items[values[k]]
                        });
                    }
                }
            }

            for (k in items)
            {
                if (items.hasOwnProperty(k) && !BX.util.in_array(k, values))
                {
                    result.push({
                        value: k,
                        message: items[k]
                    });
                }
            }

            return result;
        },

        buildNodes: function()
        {
            var baseNode = BX.create('DIV', {
                props: {className: 'dnd-order-draggable-control-container', id: this.rootElementId}
            });

            for (var k in this.items)
            {
                if (this.items.hasOwnProperty(k))
                {
                    baseNode.appendChild(
                        BX.create('DIV', {
                            attrs: {'data-value': this.items[k].value},
                            props: {
                                className: 'dnd-order-draggable-control dnd-order-draggable-item ' + this.dragItemClassName
                            },
                            text: this.items[k].message
                        })
                    );
                }
            }

            this.params.oCont.appendChild(baseNode);
        },

        initDragDrop: function()
        {
            if (BX.isNodeInDom(this.params.oCont))
            {
                this.dragdrop = BX.DragDrop.create({
                    dragItemClassName: this.dragItemClassName,
                    dragItemControlClassName: 'dnd-order-draggable-control',
                    sortable: {rootElem: BX(this.rootElementId)},
                    dragEnd: BX.delegate(function(eventObj, dragElement, event){
                        this.saveData();
                    }, this)
                });
            }
            else
            {
                setTimeout(BX.delegate(this.initDragDrop, this), 50);
            }
        },

        saveData: function()
        {
            var items = this.params.oCont.querySelectorAll('.' + this.dragItemClassName),
                arr = [];

            for (var k in items)
            {
                if (items.hasOwnProperty(k))
                {
                    arr.push(items[k].getAttribute('data-value'));
                }
            }

            this.params.oInput.value = arr.join(',');
        }
    };
</script>
<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=urlencode($module_id)?>&amp;lang=<?=LANGUAGE_ID?>">
    <?
    $tabControl->Begin();
    $tabControl->BeginNextTab();?>
    <tr><td colspan="2">
    <?
    $aSiteTabs = array();
    foreach($arSites as $arSite) {
        $aSiteTabs[] = array("DIV" => "opt_site_".$arSite["ID"], "TAB" => '['.$arSite["ID"].'] ' . htmlspecialcharsbx($arSite["NAME"]), 'TITLE' => ' ['.$arSite["ID"].'] ' . htmlspecialcharsbx($arSite["NAME"]));
    }

    $siteTabControl = new CAdminViewTabControl("siteTabControl", $aSiteTabs);
    $siteTabControl->Begin();

    foreach($arSiteList as $site):
        $suffix = ($site <> ''? '_bx_site_'.$site:'');
        $siteTabControl->BeginNextTab();
        ?>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="edit-table">
        <?foreach($arAllOptions as $arOption):
        $val = COption::GetOptionString($module_id, $arOption[0], "", $site);
        $arOption[0] .= $suffix;
        $type = $arOption[2];
        ?>
            <tr>
                <td width="40%" nowrap <?if($type[0]=="textarea") echo 'class="adm-detail-valign-top"'?>>
                    <label for="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo $arOption[1]?></label>
                </td>
                <td width="60%">
                    <?if($type[0]=="checkbox"):?>
                        <input type="checkbox" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>" value="Y"<?if($val=="Y")echo" checked";?>>
                    <?elseif($type[0]=="text"):?>
                        <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>">
                    <?elseif($type[0]=="drag_options"):?>
                        <input type="hidden" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>">
                        <div id="<?echo htmlspecialcharsbx($arOption[0])?>_container"></div>
                        <script type="text/javascript">
                            BX.ready(function() {
                                initDraggableOrderControl({data: '<?=Bitrix\Main\Web\Json::encode($arAllBlocks)?>', oInput: BX('<?echo htmlspecialcharsbx($arOption[0])?>'), oCont: BX('<?echo htmlspecialcharsbx($arOption[0])?>_container')});
                            });
                        </script>
                    <?elseif($type[0]=="colorbox"):?>
                        <input type="text" size="<?echo $type[1]?>" maxlength="255" value="<?echo htmlspecialcharsbx($val)?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>">
                        <?
                        $APPLICATION->IncludeComponent(
                            "simpletemplates:spectrum.colorpicker",
                            "",
                            array(
                                "ID" => htmlspecialcharsbx($arOption[0]),
                                "UNSHIFT_PALETTE" => array("#FFCD4B", "#FFBA35", "#30ABE2", "#34EF5C", "#FF6262", "#DAC725"),
                            )
                        );
                        ?>
                    <?elseif($type[0]=="textarea"):?>
                        <textarea rows="<?echo $type[1]?>" cols="<?echo $type[2]?>" name="<?echo htmlspecialcharsbx($arOption[0])?>" id="<?echo htmlspecialcharsbx($arOption[0])?>"><?echo htmlspecialcharsbx($val)?></textarea>
                    <?elseif($type[0]=="selectbox"):
                        ?><select name="<?echo htmlspecialcharsbx($arOption[0])?>"><?
                        foreach ($type[1] as $key => $value)
                        {
                            ?><option value="<?echo $key?>"<?if($val==$key)echo" selected"?>><?echo htmlspecialcharsbx($value)?></option><?
                        }
                        ?></select><?
                    endif?>
                </td>
            </tr>
        <?endforeach?>
        </table>
    <?endforeach?>
    <?
    $siteTabControl->End();
    ?>
    </td></tr>
    <?$tabControl->Buttons();?>
    <input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Update" value="<?=GetMessage("MAIN_SAVE")?>" title="<?=GetMessage("MAIN_OPT_SAVE_TITLE")?>" class="adm-btn-save">
    <input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="Apply" value="<?=GetMessage("MAIN_OPT_APPLY")?>" title="<?=GetMessage("MAIN_OPT_APPLY_TITLE")?>">
    <?if(strlen($_REQUEST["back_url_settings"])>0):?>
        <input <?if(!$RIGHT_W) echo "disabled" ?> type="button" name="Cancel" value="<?=GetMessage("MAIN_OPT_CANCEL")?>" title="<?=GetMessage("MAIN_OPT_CANCEL_TITLE")?>" onclick="window.location='<?echo htmlspecialcharsbx(CUtil::addslashes($_REQUEST["back_url_settings"]))?>'">
        <input type="hidden" name="back_url_settings" value="<?=htmlspecialcharsbx($_REQUEST["back_url_settings"])?>">
    <?endif?>
    <input <?if(!$RIGHT_W) echo "disabled" ?> type="submit" name="RestoreDefaults" title="<?echo GetMessage("MAIN_HINT_RESTORE_DEFAULTS")?>" onclick="return confirm('<?echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')" value="<?echo GetMessage("MAIN_RESTORE_DEFAULTS")?>">
    <?=bitrix_sessid_post();?>
    <?$tabControl->End();?>
</form>
<?endif;?>
<style>
    .dnd-order-draggable-control-container div.dnd-order-draggable-item{
        width:120px;
        vertical-align: middle;
        line-height: 17px;
        text-align: center;
        background: #fff !important;
        border:1px solid #c1c8d0;
        cursor: grab;
        cursor: -webkit-grab;
        margin: 2px 0 5px;
        border-radius: 2px;
        padding: 5px 0;
        box-shadow: inset 0 0 0 0 rgba(0,0,0,.2);
        transition: box-shadow 250ms ease;
        -webkit-animation: dnd-order-draggable-item .3s linear;
        -moz-animation: dnd-order-draggable-item .3s linear;
        -ms-animation: dnd-order-draggable-item .3s linear;
        -o-animation: dnd-order-draggable-item .3s linear;
        animation: dnd-order-draggable-item .3s linear;
    }
    .dnd-order-draggable-control-container div.dnd-order-draggable-item:active{
        box-shadow: inset 0 0 15px 0 rgba(0,0,0,.2);
        border-style:dashed
    }
    @-webkit-keyframes dnd-order-draggable-item {
        0%,100%{ background: transparent;}
        50%{ background: #cee28c;}
        0%{-webkit-transform: translateX(75px); opacity: 0;}
        100%{-webkit-transform: translateX(0); opacity: 1;}
    }
    @-moz-keyframes dnd-order-draggable-item {
        0%,100%{ background: transparent;}
        50%{ background: #cee28c;}
        0%{-moz-transform: translateX(75px); opacity: 0;}
        100%{-moz-transform: translateX(0); opacity: 1;}

    }
    @-ms-keyframes dnd-order-draggable-item {
        0%,100%{ background: transparent;}
        50%{ background: #cee28c;}
        0%{-ms-transform: translateX(75px); opacity: 0;}
        100%{-ms-transform: translateX(0); opacity: 1;}

    }
    @-o-keyframes dnd-order-draggable-item {
        0%,100%{ background: transparent;}
        50%{ background: #cee28c;}
        0%{-o-transform: translateX(75px); opacity: 0;}
        100%{-o-transform: translateX(0); opacity: 1;}

    }
    @keyframes dnd-order-draggable-item {
        0%,100%{ background: transparent;}
        50%{ background: #cee28c;}
        0%{transform: translateX(75px); opacity: 0;}
        100%{transform: translateX(0); opacity: 1;}

    }
</style>