<?
IncludeModuleLangFile(__FILE__);
global $USER, $atlOptipicInstallErrors;

if(isset($atlOptipicInstallErrors) && is_array($atlOptipicInstallErrors)) {
    foreach($atlOptipicInstallErrors as $atlOptipicInstallError) {
        CAdminMessage::ShowMessage($atlOptipicInstallError);
    }
}

CJSCore::Init(array("jquery"));

$atlOptipicInstallEmail = COption::GetOptionString("step2use.optimg", "LOGIN");
if(!$atlOptipicInstallEmail) $atlOptipicInstallEmail = $USER->GetEmail();
if($_POST["atl_optipic_user_email"]) $atlOptipicInstallEmail = $_POST["atl_optipic_user_email"];

$atlOptipicInstallPass = "";
//$atlOptipicInstallPass = COption::GetOptionString("step2use.optimg", "PASSWORD");
if($_POST["atl_optipic_user_pass"]) $atlOptipicInstallPass = $_POST["atl_optipic_user_pass"];

?>
<form action="<?=$APPLICATION->GetCurPage()?>" name="atl_optipic_form" id="atl_optipic_form" class="form-photo" method="POST">
<?=bitrix_sessid_post()?>
<input type="hidden" name="lang" value="<?=LANGUAGE_ID?>">
<input type="hidden" name="id" value="step2use.optimg">
<input type="hidden" name="install" value="Y">
<input type="hidden" name="step" value="2">
<table style="background: #ffffff; padding: 10px;">
<tbody id="">
    <tr>
        <td><span class="required">*</span><?=GetMessage("ATL_OPTIPIC_REG_EMAIL")?>: </td>
        <td><input type="text" name="atl_optipic_user_email" value="<?=$atlOptipicInstallEmail?>" /></td>
    </tr>
    
    <tr><td colspan="2"><small style="color: #999;"><?=GetMessage("ATL_OPTIPIC_REG_EMAIL_NOTE")?></small></td></tr>
    
    <tr>
        <td nowrap><?=GetMessage("ATL_OPTIPIC_REG_ACCOUNT_EXISTS")?>: </td>
        <td><input type="checkbox" name="atl_optipic_account_exists" <? if($atlOptipicInstallPass) {echo 'checked="checked"';} ?> /></td>
    </tr>
    
    <tr><td colspan="2"><small style="color: #999;"><?=GetMessage("ATL_OPTIPIC_REG_ACCOUNT_EXISTS_NOTE")?></small></td></tr>
    
    <tr id="atl-optipic-pass">
        <td><span class="required">*</span><?=GetMessage("ATL_OPTIPIC_REG_PASS")?>: </td>
        <td><input type="text" name="atl_optipic_user_pass" value="<?=$atlOptipicInstallPass?>" /></td>
    </tr>
	
	<tr>
		<td colspan="2"><input type="submit" value="<?=GetMessage("ATL_OPTIPIC_REGISTER")?>" class="adm-btn-save" id="atl-optipic-install-btn" /></td>
	</tr>
</tbody>
</table>
</form>

<? echo BeginNote(); ?>
<? echo GetMessage("ATL_OPTIPIC_REGISTER_NOTE") ?>
<? echo EndNote(); ?>

<script>
$(function() {

$("input[name=atl_optipic_account_exists]").change(function() {
    var _this = $(this);
    var checked = _this.prop("checked");
    if(_this.prop("checked")) {
        $("#atl-optipic-pass").show();
        $("#atl-optipic-install-btn").val("<?=GetMessage("ATL_OPTIPIC_REG_CONTINUE_INSTALL")?>");
        
    }
    else {
        $("#atl-optipic-pass").hide();
        $("#atl-optipic-install-btn").val("<?=GetMessage("ATL_OPTIPIC_REGISTER")?>");
    }
}).change();

});
</script>

<style>
#atl-optipic-pass {
    display: none;
}
</style>
