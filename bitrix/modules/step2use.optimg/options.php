<?php

$MODULE_ID = "step2use.optimg";
CModule::IncludeModule($MODULE_ID);

IncludeModuleLangFile(__FILE__);

$MODULE_RIGHT = $APPLICATION->GetGroupRight($MODULE_ID);

if ($MODULE_RIGHT < "R")
    $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

$arOptions = array(
	array(
		"EXTENSIONS_WHITE_LIST",
		GetMessage("ATL_EXTENSIONS_WHITE_LIST"),
		"",
		array(
			"multiselectbox",
			array(
				"png" => "*.png",
				"jpeg" => "*.jpeg",
				"jpg" => "*.jpg"
			)
		)
	),
	array(
		"COMPRESS_LIMIT_BY_STEP",
		GetMessage("ATL_COMPRESS_LIMIT_BY_STEP"),
		"",
		array(
			"text",
			"5"
		)
	),
    array(
        "note" => GetMessage("S2U_ZERO_LIMIT_WARN")
    ),
	array(
		"COMPRESS_QUALITY",
		GetMessage("ATL_COMPRESS_QUALITY"),
		"",
        array(
        "selectbox",
			array(
                "50" => "50",
                "60" => "60",
				"70" => "70 - ".GetMessage("ATL_QUALITY_70_NOTE"),
				"80" => "80",
				"90" => "90",
                "100" => "100 - ".GetMessage("ATL_QUALITY_100_NOTE"),
			))
		/*array(
			"text",
			"5"
		)*/
	),
    array(
        "note" => GetMessage("ATL_COMPRESS_QUALITY_NOTE")
    ),
    array(
		"OPT_PROGRESSIVE_JPEG",
		GetMessage("ATL_OPT_PROGRESSIVE_JPEG"),
		"",
		array(
			"checkbox",
			"",
			""
		)
	),
    array(
		"OPT_STRIPTAGS",
		GetMessage("ATL_OPT_STRIPTAGS"),
		"",
		array(
			"checkbox",
			"",
			""
		)
	),
    array(
		"REINDEX_STEP_LIMIT_IN_SECONDS",
		GetMessage("ATL_REINDEX_STEP_LIMIT_IN_SECONDS"),
		"",
		array(
			"text",
			"5",
		)
	),
    array(
		"RETURN_ORIGS_BY_STEP",
		GetMessage("ATL_RETURN_ORIGS_BY_STEP"),
		"",
		array(
			"text",
			"5",
		)
	),
	array(
		"RECOMPRESS_10_PERCENT",
		GetMessage("ATL_RECOMPRESS_10_PERCENT"),
		"",
		array(
			"checkbox",
			"",
			""
		)
	),
	array(
		"note" => GetMessage("ATL_RECOMPRESS_DESC")
	),
	array(
		"LOGIN",
		GetMessage("ATL_LOGIN"),
		"",
		array(
			"text",
			"25"
		)
	),
	array(
		"PASSWORD",
		GetMessage("ATL_PASSWORD"),
		"",
		array(
			"text",
			"25"
		)
	),
	array(
		"AGENT_ACTIVE",
		GetMessage("ATL_AGENT_ACTIVE"),
		"",
		array(
			"checkbox",
			"",
			""
		)
	),
	array(
		"IGNORE_PATH",
		GetMessage("ATL_IGNORE_PATH"),
		"",
		array(
			"textarea",
			"12",
			"60",
		)
	),
	array(
		"INDEX_ONLY",
		GetMessage("ATL_INDEX_ONLY"),
		"",
		array(
			"textarea",
			"12",
			"60",
		)
	),
	array(
		"MAX_WIDTH",
		GetMessage("ATL_MAX_WIDTH"),
		"",
		array(
			"text",
			"4"
		)
	),
	array(
		"MAX_HEIGHT",
		GetMessage("ATL_MAX_HEIGHT"),
		"",
		array(
			"text",
			"4"
		)
	),
	array(
		"SAVE_ORIG",
		GetMessage("ATL_SAVE_ORIG"),
		"",
		array(
			"checkbox",
			"",
			""
		)
	),
	array(
		"note" => GetMessage("ATL_ORIG_NOTE")
	),

);

function atlOptipicSalePrint() {
?>

<div class="atl-free-gb-list">

    <div class="atl-free-gb">
        <h3><?=GetMessage("ATL_OPTIPIC_ADD_REVIEW_MARKETPLACE")?></h3>
        <h2><?=GetMessage("ATL_OPTIPIC_PLUS_1_GB")?></h2>
        <a href="https://optipic.io/gb-free" target="_blank" class="link"><?=GetMessage("ATL_OPTIPIC_DETAILS")?></a>
    </div>
	<div class="atl-free-gb">
		<h3><?=GetMessage("ATL_OPTIPIC_ADD_RECOM")?></h3>
		<h2><?=GetMessage("ATL_OPTIPIC_PLUS_1_GB")?></h2>
		<a href="https://optipic.io/gb-free" target="_blank" class="link"><?=GetMessage("ATL_OPTIPIC_DETAILS")?></a>
	</div>
    <div class="atl-free-gb">
        <h3><?=GetMessage("ATL_SOCIAL_AD")?></h3>
        <h2><?=GetMessage("ATL_SOCIAL_AD_DISCOUNT")?></h2>
        <a href="https://optipic.io/gb-free" target="_blank" class="link"><?=GetMessage("ATL_OPTIPIC_DETAILS")?></a>
    </div>
    <?/*<div class="atl-free-gb">
        <h3><?=GetMessage("ATL_OPTIPIC_BUY_PROLONG")?></h3>
        <h2><?=GetMessage("ATL_OPTIPIC_ABOUT_50GB")?></h2>
        <a href="https://optipic.ru/gb-free" target="_blank" class="link"><?=GetMessage("ATL_OPTIPIC_DETAILS")?></a>
    </div>*/?>
</div>
<?
}

// Сохраняем все настройки
if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["Update"])>0 && check_bitrix_sessid()) {
    $_POST["COMPRESS_LIMIT_BY_STEP"] = $COMPRESS_LIMIT_BY_STEP = intval($_POST["COMPRESS_LIMIT_BY_STEP"]);
//    var_dump($COMPRESS_LIMIT_BY_STEP);
    foreach($arOptions as $option) {
		__AdmSettingsSaveOption("step2use.optimg", $option);
	}
	COption::SetOptionInt("step2use.optimg", "COMPRESS_LIMIT_BY_STEP", $COMPRESS_LIMIT_BY_STEP);
}


// Переиндексация базы
if($_GET["Reindex"]=="Y") {

    if(!isset($_REQUEST['NS']["last_file"])) {
        //CStepUseOptimg::ClearindexFileBase(true);
    }

	$endOfReindex = CStepUseOptimg::ReindexFileBase(true, $_REQUEST['NS']["last_file"]);
    $res = ($endOfReindex!==true)? GetMessage('ATL_REINDEX_RESULT')."<br/>".'<div id="continue_href">'.$endOfReindex.'</div>': GetMessage('ATL_REINDEX_RESULT_END', array("#RAND#"=>uniqid()));

    $message = new CAdminMessage(array(
        'MESSAGE' => ($endOfReindex===true)? GetMessage('ATL_REINDEX_RESULT_TITLE_END', array("#RAND#"=>uniqid(""))): GetMessage('ATL_REINDEX_RESULT_TITLE'),
       	'TYPE' => 'OK',
       	'DETAILS' => $res,
       	'HTML' => true
    ));
    echo $message->Show();

	/*$messageErr = new CAdminMessage(array(
		'MESSAGE' => ($endOfReindex===true)? GetMessage('ATL_REINDEX_RESULT_TITLE_END', array("#RAND#"=>uniqid(""))): GetMessage('ATL_REINDEX_RESULT_TITLE'),
		'TYPE' => 'OK',
		'DETAILS' => $res,
		'HTML' => true
	));

	echo $messageErr->Show();*/
    ?>
    <script>
    CloseWaitWindow();
	DoReindexNext({'NS':{'last_file':"<? echo $endOfReindex ?>"}});

	<? if($endOfReindex===true): ?>
	EndReindex();
	<? endif; ?>
    </script>
    <?
    exit;
}

// Сжатие
/*if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["Docompress"])>0 && check_bitrix_sessid()) {
    CStepUseOptimg::OptimizeAllImgs(true);
}*/
if($_GET["Docompress"]=="Y") {

	if(CStepUseOptimg::GetFilesCount()==0) {
	    $message = new CAdminMessage(array(
            'MESSAGE' => GetMessage('ATL_API_ERROR_ZERO_INDEX'),
           	'TYPE' => 'ERROR',
           	'DETAILS' => GetMessage('ATL_API_ERROR_ZERO_INDEX_DESC'),
           	'HTML' => true
        ));
        echo $message->Show();
        ?>
        <script>
        CloseWaitWindow();
	    EndCompress();
        </script>
        <?
        exit;
	}

    CStepUseOptimg::OptimizeAllImgs(false, false);

    if(COption::GetOptionString("step2use.optimg", "API_ERROR")=="Y") {
        $message = new CAdminMessage(array(
            'MESSAGE' => GetMessage('ATL_API_ERROR'),
           	'TYPE' => 'ERROR',
           	'DETAILS' => (COption::GetOptionString("step2use.optimg", "LAST_API_ERROR"))? GetMessage("ATL_API_ERROR_".COption::GetOptionString("step2use.optimg", "LAST_API_ERROR"), array("#EMAIL#"=>COption::GetOptionString("step2use.optimg", "LOGIN"))).'<br/>'.GetMessage('ATL_API_ERROR_HELP'): GetMessage('ATL_API_ERROR_UNKNOWN').'<br/>'.GetMessage('ATL_API_ERROR_HELP'),
           	'HTML' => true
        ));
        echo $message->Show();
        ?>
        <script>
        CloseWaitWindow();
	    EndCompress();
        </script>
        <?
        exit;
    }

    $res = $DB->Query("SELECT count(*) as CNT FROM atl_optimg_files WHERE ALREADY_PROCESSED_TODAY='N'", false, $err_mess.__LINE__);
	$fileDB = $res->Fetch();
	//var_dump($fileDB["CNT"]);exit;


	//$endOfReindex = CStepUseOptimg::ReturnOrigFiles(true, $_REQUEST['NS']["last_file"]);

    $res = ($fileDB["CNT"]!=0)? GetMessage('ATL_COMPRESS_PROCESSING', array("#CNT#"=>$fileDB["CNT"])): GetMessage("ATL_COMPRESS_PROCESSING_END", array("#RAND#"=>uniqid()));

    $message = new CAdminMessage(array(
        'MESSAGE' => ($fileDB["CNT"]!=0)? GetMessage('ATL_COMPRESS_PROCESSING_TITLE'): GetMessage('ATL_COMPRESS_PROCESSING_TITLE_END', array("#RAND#"=>uniqid(""))),
       	'TYPE' => 'OK',
       	'DETAILS' => $res,
       	'HTML' => true
    ));
    echo $message->Show();
    ?>
    <script>
    CloseWaitWindow();
	DoCompressNext({'NS':{'last_file':"<? echo $endOfReindex ?>"}});

	<? if($fileDB["CNT"]==0): ?>
	EndCompress();
	<? endif; ?>
    </script>
    <?
    exit;
}


// Возвращаем оригиналы
if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["ReturnOrig"])>0 && check_bitrix_sessid()) {
    CStepUseOptimg::ReturnOrigFiles();
}
if($_GET["ReturnOrig"]=="Y") {

	$funcReturn = CStepUseOptimg::ReturnOrigFiles(true);

    $res = ($funcReturn!==true)? GetMessage('ATL_REINDEX_RESULT')."<br/>".'<div id="continue_href">'.$funcReturn.'</div>': GetMessage('ATL_REINDEX_RESULT_END', array("#RAND#"=>uniqid()));

    $message = new CAdminMessage(array(
        'MESSAGE' => ($funcReturn===true)? GetMessage('ATL_RETURNORIG_RESULT_TITLE_END'): GetMessage('ATL_RETURNORIG_RESULT_TITLE'),
       	'TYPE' => 'OK',
       	'DETAILS' => $res,
       	'HTML' => true
    ));
    echo $message->Show();
    ?>
    <script>
    CloseWaitWindow();
DoReturnorigNext({});
<? if($funcReturn===true): ?>
EndReturnorig();
	<? endif; ?>
    </script>
    <?
    exit;
}


// Удаляем оригиналы
if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["DeleteOrig"])>0 && check_bitrix_sessid()) {
	CStepUseOptimg::DeleteOrigFiles();
}
if($_GET["DeleteOrig"]=="Y") {

	$funcReturn = CStepUseOptimg::DeleteOrigFiles(true);

	$res = ($funcReturn!==true)? GetMessage('ATL_REINDEX_RESULT')."<br/>".'<div id="continue_href">'.$funcReturn.'</div>': GetMessage('ATL_REINDEX_RESULT_END', array("#RAND#"=>uniqid()));

	$message = new CAdminMessage(array(
		'MESSAGE' => ($funcReturn===true)? GetMessage('ATL_DELETEORIG_RESULT_TITLE_END'): GetMessage('ATL_DELETEORIG_RESULT_TITLE'),
		'TYPE' => 'OK',
		'DETAILS' => $res,
		'HTML' => true
	));
	echo $message->Show();
	?>
	<script>
		CloseWaitWindow();
		DoDeleteorigNext({});
		<? if($funcReturn===true): ?>
		EndDeleteorig();
		<? endif; ?>
	</script>
	<?
	exit;
}

if($_GET["installed"]=="Y") {
    $message = new CAdminMessage(array(
        'MESSAGE' => GetMessage('ATL_OPTIPIC_INSTALLED'),
       	'TYPE' => 'OK',
       	'DETAILS' =>  GetMessage('ATL_OPTIPIC_INSTALLED_DETAIL', array('#EMAIL#'=>COption::GetOptionString("step2use.optimg", "LOGIN"))),
       	'HTML' => true
    ));
    echo $message->Show();
}
if($_GET["reinstalled"]=="Y") {
    $message = new CAdminMessage(array(
        'MESSAGE' => GetMessage('ATL_OPTIPIC_REINSTALLED'),
       	'TYPE' => 'OK',
       	'HTML' => true
    ));
    echo $message->Show();
}

// Проверяем, хватает ли на балансе МБ для сжатия тех файлов, которые еще не сжаты

$indexedTotal = CStepUseOptimg::GetSumOriginSize();
$compressedTotal = CStepUseOptimg::GetSumCompressedSize();
$diffBytes = CStepUseOptimg::GetSizeLeftToCompress();
$remainingBytes = CStepUseOptimg::GetActiveBytes();

if($diffBytes > $remainingBytes) {
	$recommendData = CStepUseOptimg::getRecommendedTariff($diffBytes);

	$messageRec = new CAdminMessage(array(
		'MESSAGE' => GetMessage('ATL_BALANCE_WARNING'),
		'TYPE' => 'ERROR',
		'DETAILS' => GetMessage('ATL_RECOMMEND_TARIFF') . ' <a href="' . $recommendData['url_to_pay'] .  '">' . GetMessage('ATL_BALANCE_ADD') . ' ' . CStepUseOptimg::fromUtf($recommendData['name']) . '</a>',
		'HTML' => true
	));
	echo $messageRec->Show();
}





// Выводим последнюю ошибку связи с API OptiPic.ru
if(COption::GetOptionString("step2use.optimg", "API_ERROR")=="Y") {
    $message = new CAdminMessage(array(
        'MESSAGE' => GetMessage('ATL_API_ERROR'),
       	'TYPE' => 'ERROR',
       	'DETAILS' => (COption::GetOptionString("step2use.optimg", "LAST_API_ERROR"))? GetMessage("ATL_API_ERROR_".COption::GetOptionString("step2use.optimg", "LAST_API_ERROR"), array("#EMAIL#"=>COption::GetOptionString("step2use.optimg", "LOGIN"))).'<br/>'.GetMessage('ATL_API_ERROR_HELP'): GetMessage('ATL_API_ERROR_UNKNOWN').'<br/>'.GetMessage('ATL_API_ERROR_HELP'),
       	'HTML' => true
    ));
    echo $message->Show();
}


$aTabs = array(
	array("DIV" => "config", "TAB" => GetMessage("MAIN_TAB_SET"), "ICON" => "main_settings", "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
	array("DIV" => "stats", "TAB" => GetMessage("ATL_STATISTIC"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_STATISTIC_TITLE")),
	array("DIV" => "reindex", "TAB" => GetMessage("ATL_REINDEX"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_REINDEX")),
	array("DIV" => "docompress", "TAB" => GetMessage("ATL_DOCOMPRESS"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_DOCOMPRESS_TITLE")),
	array("DIV" => "returnorig", "TAB" => GetMessage("ATL_RETURN_ORIG"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_RETURN_ORIG_TITLE")),
	array("DIV" => "deleteorig", "TAB" => GetMessage("ATL_DELETE_ORIG"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_DELETE_ORIG_TITLE")),
	array("DIV" => "sale", "TAB" => GetMessage("ATL_SALE"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_SALE_TITLE")),
	array("DIV" => "partneram", "TAB" => GetMessage("ATL_PARTNERAM"), "ICON" => "main_settings", "TITLE" => GetMessage("ATL_PARTNERAM_TITLE")),
);

$tabControl = new CAdminTabControl("tabControl", $aTabs);

$tabControl->Begin();
$tabControl->BeginNextTab();

?>
<form method="post" action="<? echo $APPLICATION->GetCurPage() ?>?mid=<?= urlencode($MODULE_ID) ?>&amp;lang=<?= LANGUAGE_ID ?>">
<?
echo bitrix_sessid_post();
//__AdmSettingsSaveOptions($MODULE_ID, $arOptions);
__AdmSettingsDrawList($MODULE_ID, $arOptions);

// Настройки
$tabControl->BeginNextTab();

$sizeLeftToCompress = CStepUseOptimg::GetSizeLeftToCompress();

$processedCount = CStepUseOptimg::GetFilesProcessedCount();

if($processedCount > 0) {
    $efficiencyData = CStepUseOptimg::GetApiEfficiency();
    $efficiencyPercent = $efficiencyData['effective'];
}else{
    $efficiencyPercent = '0';
}


echo GetMessage("ATL_ALL_AMOUNT").": ".CStepUseOptimg::GetFilesCount()." ".GetMessage("ATL_PCS")." (".CStepUseOptimg::GetHumanFilesize(CStepUseOptimg::GetSumOriginSize()).")<br/>";
echo GetMessage("ATL_ALL_COMPRESSED_AMOUNT").": ". $processedCount ." ".GetMessage("ATL_PCS")." (".CStepUseOptimg::GetHumanFilesize(CStepUseOptimg::GetSumCompressedSize()).")<br/>";
echo GetMessage("ATL_EFFICIENCY").": ". $efficiencyPercent."%<br/>";
$strLeftToCompress =  GetMessage("ATL_LEFT_TO_COMPRESS").": ".CStepUseOptimg::GetUncompressedFilesCount()." ".GetMessage("ATL_PCS");
if($sizeLeftToCompress > 0){
	$strLeftToCompress .= " (".CStepUseOptimg::GetHumanFilesize($sizeLeftToCompress).")";
}
$strLeftToCompress .= "<br/><br/>";
echo $strLeftToCompress;

$activeBytes = CStepUseOptimg::GetActiveBytes();
echo GetMessage("ATL_ACCOUNT_BYTES").": ".CStepUseOptimg::GetHumanFilesize($activeBytes)." (<a href='https://optipic.io/account' target='_blank'>".GetMessage("ATL_ADD_FUNDS")."</a>)";
// Если меньше 100 МБ - выводим предупреждение
//if($activeBytes<104857600) {

//}

// Переиндексация
$tabControl->BeginNextTab();

if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["Reindex"])>0 && check_bitrix_sessid()) {
    echo GetMessage("ATL_REINDEX_DONE").GetMessage("ATL_FILE_IN_INDEX").": ".CStepUseOptimg::GetFilesCount()."<br/><br/>";
}
else {
    echo GetMessage("ATL_REINDEX_ABOUT")."<br/><br/>";
}
?>
<div id="reindex_result_div">&nbsp;</div>
<input type="button" id="start_button_reindex" name="Reindex" value="<?echo GetMessage("ATL_REINDEX_BUTTON")?>" title="<?echo GetMessage("ATL_REINDEX_BUTTON")?>" class="adm-btn-save" onclick="StartReindex();">
<input type="button" id="stop_button_reindex" value="<? echo GetMessage('ATL_BUTTON_STOP'); ?>" onclick="StopReindex();" disabled="">
<input type="button" id="continue_button_reindex" value="<? echo GetMessage('ATL_BUTTON_CONTINUE'); ?>" onclick="ContinueReindex();" disabled="">
<?

// Сжатие
$tabControl->BeginNextTab();

if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["Docompress"])>0 && check_bitrix_sessid()) {
    echo GetMessage("ATL_DOCOMPRESS_DONE")."<br/><br/>";
}

?>
<? /*<input type="submit" name="Docompress" value="<?echo GetMessage("ATL_DOCOMPRESS")?>" title="<?echo GetMessage("ATL_DOCOMPRESS")?>" class="adm-btn-save">*/?>

<div id="compress_result_div">&nbsp;</div>
<input type="button" id="start_button_compress" name="Docompress" value="<?echo GetMessage("ATL_DOCOMPRESS")?>" title="<?echo GetMessage("ATL_DOCOMPRESS")?>" class="adm-btn-save" onclick="StartCompress();">
<input type="button" id="stop_button_compress" value="<? echo GetMessage('ATL_BUTTON_STOP'); ?>" onclick="StopCompress();" disabled="">
<input type="button" id="continue_button_compress" value="<? echo GetMessage('ATL_BUTTON_CONTINUE'); ?>" onclick="ContinueCompress();" disabled="">
<?

// Вернуть оригиналы
$tabControl->BeginNextTab();

if($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["ReturnOrig"])>0 && check_bitrix_sessid()) {
    echo GetMessage("ATL_RETURN_ORIG_DONE")."<br/><br/>";
}

?>


<? /*<input type="submit" name="ReturnOrig" value="<?echo GetMessage("ATL_RETURN_ORIG")?>" title="<?echo GetMessage("ATL_RETURN_ORIG")?>" class="adm-btn-save">*/ ?>

<div id="returnorig_result_div">&nbsp;</div>
<input type="button" id="start_button_returnorig" name="ReturnOrig" value="<?echo GetMessage("ATL_RETURN_ORIG")?>" title="<?echo GetMessage("ATL_RETURN_ORIG")?>" class="adm-btn-save" onclick="StartReturnorig();">
<input type="button" id="stop_button_returnorig" value="<? echo GetMessage('ATL_BUTTON_STOP'); ?>" onclick="StopReturnorig();" disabled="">
<input type="button" id="continue_button_returnorig" value="<? echo GetMessage('ATL_BUTTON_CONTINUE'); ?>" onclick="ContinueReturnorig();" disabled="">

	<?
	// Удалить оригиналы
	$tabControl->BeginNextTab();
	?>

	<div id="deleteorig_result_div">&nbsp;</div>
	<input type="button" id="start_button_deleteorig" name="DeleteOrig" value="<?echo GetMessage("ATL_DELETE_ORIG")?>" title="<?echo GetMessage("ATL_DELETE_ORIG")?>" class="adm-btn-save" onclick="StartDeleteorig();">
	<input type="button" id="stop_button_deleteorig" value="<? echo GetMessage('ATL_BUTTON_STOP'); ?>" onclick="StopDeleteorig();" disabled="">
	<input type="button" id="continue_button_deleteorig" value="<? echo GetMessage('ATL_BUTTON_CONTINUE'); ?>" onclick="ContinueDeleteorig();" disabled="">
	<?

// Акции
$tabControl->BeginNextTab();
?>
<style>
.atl-free-gb-list {
    clear: both;
    width: 100%;
}
.atl-free-gb {
    float: left;
    width: 25%;
    text-align: center;
	padding: 0 4%;
}

.atl-free-gb a.link {
    display: inline-block;

    background-color: #86ad00!important;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.25), inset 0 1px 0 #cbdc00;
	box-shadow: 0 1px 1px rgba(0,0,0,.25), inset 0 1px 0 #cbdc00;
	border: solid 1px;
	border-color:#97c004 #7ea502 #648900;
	background-image: -webkit-linear-gradient(bottom, #729e00, #97ba00)!important;
	background-image: -moz-linear-gradient(bottom, #729e00, #97ba00)!important;
	background-image: -ms-linear-gradient(bottom, #729e00, #97ba00)!important;
	background-image: -o-linear-gradient(bottom, #729e00, #97ba00)!important;
	background-image: linear-gradient(bottom, #729e00, #97ba00)!important;
	color:#fff;
	text-shadow:0 1px rgba(0,0,0,0.1);
	-webkit-font-smoothing: antialiased;
	padding:0px 13px 2px;

	-webkit-border-radius: 4px;
	border-radius: 4px;
	height: 29px;
	line-height: 29px;
	color:#fff;
	text-shadow:0 1px rgba(0,0,0,0.1);
	-webkit-font-smoothing: antialiased;
	text-decoration: none;
	font-weight: bold;
}
</style>
<?
atlOptipicSalePrint();

// Партнерская программа
$tabControl->BeginNextTab();
?>
<?
?>
	<iframe src="https://optipic.io/ru/partneram/?iframe=1" width="100%" height="850px"></iframe>
<?

$tabControl->Buttons();
?>
<input type="submit" <? if ($MODULE_RIGHT < "W") echo "disabled" ?> name="Update" value="<? echo GetMessage("MAIN_SAVE") ?>">
<?

$tabControl->End();

?>
</form>

<h2 style="text-align: center;"><?=GetMessage("ATL_SALE_TITLE");?></h2>
<? atlOptipicSalePrint(); ?>

<script language="JavaScript">

// Переиндексация
var savedNS_reindex;
var stop_reindex;
var interval_reindex = 0;
function StartReindex() {
	stop_reindex=false;
	document.getElementById('reindex_result_div').innerHTML='';
	document.getElementById('stop_button_reindex').disabled=false;
	document.getElementById('start_button_reindex').disabled=true;
	document.getElementById('continue_button_reindex').disabled=true;
	DoReindexNext();
}
function DoReindexNext(NS) {
	var queryString = '&Reindex=Y'
		+ '&lang=ru';
    //queryString += '&NS[sleep_min]=' + document.getElementById('s2u_sleep_min').value;
    //queryString += '&NS[sleep_max]=' + document.getElementById('s2u_sleep_max').value;
    //queryString += '&NS[site_id]=' + document.getElementById('s2u_site_id').value;

	if(!NS)
	{
		//interval = document.getElementById('max_execution_time').value;
        interval_reindex = 0;
		queryString += '&sessid=<?=bitrix_sessid();?>';
	}

	savedNS_reindex = NS;

	if(!stop_reindex) {
		ShowWaitWindow();
		BX.ajax.post(
			'/bitrix/admin/settings.php?mid=step2use.optimg&lang=ru'+queryString,
			NS,
			function(result) {
				document.getElementById('reindex_result_div').innerHTML = result;
				var href = document.getElementById('continue_href');
				if(!href)
				{
					CloseWaitWindow();
					StopReindex();
				}
			}
		);
	}

	return false;
}
function StopReindex() {
	stop_reindex=true;
	document.getElementById('stop_button_reindex').disabled=true;
	document.getElementById('start_button_reindex').disabled=false;
	document.getElementById('continue_button_reindex').disabled=false;
}
function ContinueReindex() {
	stop_reindex=false;
	document.getElementById('stop_button_reindex').disabled=false;
	document.getElementById('start_button_reindex').disabled=true;
	document.getElementById('continue_button_reindex').disabled=true;
	DoReindexNext(savedNS_reindex);
}
function EndReindex() {
	stop_reindex=true;
	document.getElementById('stop_button_reindex').disabled=true;
	document.getElementById('start_button_reindex').disabled=false;
	document.getElementById('continue_button_reindex').disabled=true;
}


// Сжатие
var savedNS_compress;
var stop_compress;
var interval_compress = 0;
function StartCompress() {
	stop_compress=false;
	console.log(stop_compress);
	document.getElementById('compress_result_div').innerHTML='';
	document.getElementById('stop_button_compress').disabled=false;
	document.getElementById('start_button_compress').disabled=true;
	document.getElementById('continue_button_compress').disabled=true;
	DoCompressNext();
}
function DoCompressNext(NS) {
	var queryString = '&Docompress=Y'
		+ '&lang=ru';
    //queryString += '&NS[sleep_min]=' + document.getElementById('s2u_sleep_min').value;
    //queryString += '&NS[sleep_max]=' + document.getElementById('s2u_sleep_max').value;
    //queryString += '&NS[site_id]=' + document.getElementById('s2u_site_id').value;

	if(!NS)
	{
		//interval = document.getElementById('max_execution_time').value;
        interval_compress = 0;
		queryString += '&sessid=<?=bitrix_sessid();?>';
	}

	savedNS_compress = NS;

	if(!stop_compress) {
		ShowWaitWindow();
		BX.ajax.post(
			'/bitrix/admin/settings.php?mid=step2use.optimg&lang=ru'+queryString,
			NS,
			function(result) {
				document.getElementById('compress_result_div').innerHTML = result;
				var href = document.getElementById('continue_href');
				if(!href)
				{
					CloseWaitWindow();
					StopCompress();
				}
			}
		);
	}

	return false;
}
function StopCompress() {
	stop_compress=true;
	document.getElementById('stop_button_compress').disabled=true;
	document.getElementById('start_button_compress').disabled=false;
	document.getElementById('continue_button_compress').disabled=false;
}
function ContinueCompress() {
	stop_compress=false;
	document.getElementById('stop_button_compress').disabled=false;
	document.getElementById('start_button_compress').disabled=true;
	document.getElementById('continue_button_compress').disabled=true;
	DoCompressNext(savedNS_compress);
}
function EndCompress() {
	stop_compress=true;
	document.getElementById('stop_button_compress').disabled=true;
	document.getElementById('start_button_compress').disabled=false;
	document.getElementById('continue_button_compress').disabled=true;
}


// Возврат оригиналов
var savedNS_returnorig;
var stop_returnorig;
var interval_returnorig = 0;
function StartReturnorig() {
    var rlyStartReturn = confirm("<?=GetMessage('ATL_RETURN_CONFIRM_MSG')?>");
    if(rlyStartReturn){
        stop_returnorig=false;
        document.getElementById('returnorig_result_div').innerHTML='';
        document.getElementById('stop_button_returnorig').disabled=false;
        document.getElementById('start_button_returnorig').disabled=true;
        document.getElementById('continue_button_returnorig').disabled=true;
        DoReturnorigNext();
    }

}
function DoReturnorigNext(NS) {
	var queryString = '&ReturnOrig=Y'
		+ '&lang=ru';
    //queryString += '&NS[sleep_min]=' + document.getElementById('s2u_sleep_min').value;
    //queryString += '&NS[sleep_max]=' + document.getElementById('s2u_sleep_max').value;
    //queryString += '&NS[site_id]=' + document.getElementById('s2u_site_id').value;

	if(!NS)
	{
		//interval = document.getElementById('max_execution_time').value;
        interval_returnorig = 0;
		queryString += '&sessid=<?=bitrix_sessid();?>';
	}

	savedNS_returnorig = NS;

	if(!stop_returnorig) {
		ShowWaitWindow();
		BX.ajax.post(
			'/bitrix/admin/settings.php?mid=step2use.optimg&lang=ru'+queryString,
			NS,
			function(result) {
				document.getElementById('returnorig_result_div').innerHTML = result;
				var href = document.getElementById('continue_href');
				if(!href)
				{
					CloseWaitWindow();
					StopReturnorig();
				}
			}
		);
	}

	return false;
}
function EndReturnorig() {
    stop_returnorig=true;
	document.getElementById('stop_button_returnorig').disabled=true;
	document.getElementById('start_button_returnorig').disabled=false;
	document.getElementById('continue_button_returnorig').disabled=true;
}
function StopReturnorig() {
	stop_returnorig=true;
	document.getElementById('stop_button_returnorig').disabled=true;
	document.getElementById('start_button_returnorig').disabled=false;
	document.getElementById('continue_button_returnorig').disabled=false;
}
function ContinueReturnorig() {
	stop_returnorig=false;
	document.getElementById('stop_button_returnorig').disabled=false;
	document.getElementById('start_button_returnorig').disabled=true;
	document.getElementById('continue_button_returnorig').disabled=true;
	DoReturnorigNext(savedNS_returnorig);
}

// Удаление оригиналов
var savedNS_deleteorig;
var stop_deleteorig;
var interval_deleteorig = 0;
function StartDeleteorig() {
    var rlyStartDelete = confirm("<?=GetMessage('ATL_DELETE_CONFIRM_MSG')?>");
    if(rlyStartDelete){
        stop_deleteorig=false;
        document.getElementById('deleteorig_result_div').innerHTML='';
        document.getElementById('stop_button_deleteorig').disabled=false;
        document.getElementById('start_button_deleteorig').disabled=true;
        document.getElementById('continue_button_deleteorig').disabled=true;
        DoDeleteorigNext();
    }

}
function DoDeleteorigNext(NS) {
	var queryString = '&DeleteOrig=Y'
		+ '&lang=ru';
	//queryString += '&NS[sleep_min]=' + document.getElementById('s2u_sleep_min').value;
	//queryString += '&NS[sleep_max]=' + document.getElementById('s2u_sleep_max').value;
	//queryString += '&NS[site_id]=' + document.getElementById('s2u_site_id').value;

	if(!NS)
	{
		//interval = document.getElementById('max_execution_time').value;
		interval_deleteorig = 0;
		queryString += '&sessid=<?=bitrix_sessid();?>';
	}

	savedNS_deleteorig = NS;

	if(!stop_deleteorig) {
		ShowWaitWindow();
		BX.ajax.post(
			'/bitrix/admin/settings.php?mid=step2use.optimg&lang=ru'+queryString,
			NS,
			function(result) {
				document.getElementById('deleteorig_result_div').innerHTML = result;
				var href = document.getElementById('continue_href');
				if(!href)
				{
					CloseWaitWindow();
					StopDeleteorig();
				}
			}
		);
	}

	return false;
}
function EndDeleteorig() {
	stop_deleteorig=true;
	document.getElementById('stop_button_deleteorig').disabled=true;
	document.getElementById('start_button_deleteorig').disabled=false;
	document.getElementById('continue_button_deleteorig').disabled=true;
}
function StopDeleteorig() {
	stop_deleteorig=true;
	document.getElementById('stop_button_deleteorig').disabled=true;
	document.getElementById('start_button_deleteorig').disabled=false;
	document.getElementById('continue_button_deleteorig').disabled=false;
}
function ContinueDeleteorig() {
	stop_deleteorig=false;
	document.getElementById('stop_button_deleteorig').disabled=false;
	document.getElementById('start_button_deleteorig').disabled=true;
	document.getElementById('continue_button_deleteorig').disabled=true;
	DoDeleteorigNext(savedNS_deleteorig);
}


if(window.location.hash.length > 0) {
    var tabID = window.location.hash.replace("#","");
    tabControl.SelectTab(tabID);
}
</script>