<?
/**
 * Bitrix vars
 *
 * @var CUser $USER
 * @var CMain $APPLICATION
 *
 */

use \Bitrix\Main\Loader,
	 \Bitrix\Main\Application,
	 \Bitrix\Main\SiteTable,
	 \Bitrix\Main\Localization\Loc;

define("ADMIN_MODULE_NAME", "api.reviews");
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php');
Loc::loadMessages(__FILE__);

global $USER, $APPLICATION;

$AR_RIGHT = $APPLICATION->GetGroupRight(ADMIN_MODULE_NAME);
if($AR_RIGHT == 'D')
	$APPLICATION->AuthForm(Loc::getMessage('ACCESS_DENIED'));

if(!Loader::includeModule(ADMIN_MODULE_NAME))
	$APPLICATION->AuthForm(Loc::getMessage('ACCESS_DENIED'));

use \Api\Reviews\AgentTable,
	 \Api\Reviews\Tools,
	 \Api\Reviews\Agent;


$conn    = Application::getConnection();
$context = Application::getInstance()->getContext();
$request = $context->getRequest();
$lang    = $context->getLanguage();


//����� �����
$arFieldTitle   = array();
$arFilterFields = array();
$arFilterTitles = array();

$columns = AgentTable::getEntity()->getFields();
/** @var \Bitrix\Main\Entity\Field $field */
foreach($columns as $code => $column) {
	$arFieldTitle[ $column->getName() ] = $column->getTitle();

	if($column->getDataType() == 'integer' || $column->getDataType() == 'datetime') {
		$arFilterFields[] = 'find_' . $code . '_1';
		$arFilterFields[] = 'find_' . $code . '_2';
	}
	else {
		$arFilterFields[] = 'find_' . $code;
	}

	$arFilterTitles[] = $column->getTitle();
}

$errorMsgs = null;


$sTableID = AgentTable::getTableName();
$oSort    = new CAdminSorting($sTableID, 'ID', 'desc');
$lAdmin   = new CAdminList($sTableID, $oSort);
$lAdmin->InitFilter($arFilterFields);

$filter = array();
if($find_ID_1)
	$filter['>=ID'] = $find_ID_1;
if($find_ID_2)
	$filter['<=ID'] = $find_ID_2;
if($find_DATE_INSERT_1)
	$filter['>=DATE_INSERT'] = $find_DATE_INSERT_1;
if($find_DATE_INSERT_2)
	$filter['<=DATE_INSERT'] = $find_DATE_INSERT_2;
if($find_DATE_EXEC_1)
	$filter['>=DATE_EXEC'] = $find_DATE_EXEC_1;
if($find_DATE_EXEC_2)
	$filter['<=DATE_EXEC'] = $find_DATE_EXEC_2;
if($find_REVIEW_ID_1)
	$filter['>=REVIEW_ID'] = $find_REVIEW_ID_1;
if($find_REVIEW_ID_2)
	$filter['<=REVIEW_ID'] = $find_REVIEW_ID_2;
if($find_SUBSCRIBERS_CNT_1)
	$filter['>=SUBSCRIBERS_CNT'] = $find_SUBSCRIBERS_CNT_1;
if($find_SUBSCRIBERS_CNT_2)
	$filter['<=SUBSCRIBERS_CNT'] = $find_SUBSCRIBERS_CNT_2;
if($find_SENDMAIL_CNT_1)
	$filter['>=SENDMAIL_CNT'] = $find_SENDMAIL_CNT_1;
if($find_SENDMAIL_CNT_2)
	$filter['<=SENDMAIL_CNT'] = $find_SENDMAIL_CNT_2;
if($find_SITE_ID && $find_SITE_ID != 'NOT_REF')
	$filter['=SITE_ID'] = $find_SITE_ID;



if($AR_RIGHT == 'W' && $lAdmin->EditAction()) {
	foreach($request->getPost('FIELDS') as $id => $arFields) {
		$error = false;
		$id    = intval($id);

		if($id <= 0 || !$lAdmin->IsUpdated($id))
			continue;

		/*$reqFields = array('RATING');
		foreach($reqFields as $reqField) {
			if(empty($arFields[ $reqField ])) {
				$error = true;
				$lAdmin->AddUpdateError('#' . $id . ' : ' . Loc::getMessage('ARAA_FIELD_ERROR', array('#FIELD#' => $arFieldTitle[ $reqField ])), $id);
			}
		}*/

		if(!$error) {

			$conn->startTransaction();
			$res = AgentTable::update($id, $arFields);
			if(!$res->isSuccess()) {
				$conn->rollbackTransaction();
				$lAdmin->AddUpdateError(join("\n", $res->getErrorMessages()), $id);
				continue;
			}
			$conn->commitTransaction();
		}
	}
}

if($AR_RIGHT == 'W' && $ids = $lAdmin->GroupAction()) {

	@set_time_limit(0);
	$rsAgents = AgentTable::getList(array(
		 'select' => array('ID', 'REVIEW_ID'),
		 'filter' => array('=ID' => $ids),
	));

	$arAgents = array();
	while($result = $rsAgents->fetch())
		$arAgents[] = $result;

	foreach($arAgents as $arAgent) {
		switch($_REQUEST['action']) {
			case "delete":
				if($arAgent['REVIEW_ID'])
					Agent::delete($arAgent['REVIEW_ID']);
				else
					AgentTable::delete($arAgent['ID']);
				break;
		}
	}
}

$select       = array('*');
$params       = array(
	 'select' => $select,
	 'filter' => $filter,
	 'order'  => array($by => $order),
);
$arSubscribe  = AgentTable::getList($params);
$dbResultList = new CAdminResult($arSubscribe, $sTableID);
$dbResultList->NavStart();

$lAdmin->NavText($dbResultList->GetNavPrint(Loc::getMessage('ARAA_NAV_TITLE')));

$arHeaders = array(
	 array(
			'id'      => 'ID',
			'content' => $arFieldTitle['ID'],
			'sort'    => 'ID',
			'default' => true,
	 ),
	 array(
			'id'      => 'DATE_INSERT',
			'content' => $arFieldTitle['DATE_INSERT'],
			'sort'    => 'DATE_INSERT',
			'default' => true,
	 ),
	 array(
			'id'      => 'DATE_EXEC',
			'content' => $arFieldTitle['DATE_EXEC'],
			'sort'    => 'DATE_EXEC',
			'default' => true,
	 ),
	 array(
			'id'      => 'REVIEW_ID',
			'content' => $arFieldTitle['REVIEW_ID'],
			'sort'    => 'REVIEW_ID',
			'default' => true,
	 ),
	 array(
			'id'      => 'SUBSCRIBERS_CNT',
			'content' => $arFieldTitle['SUBSCRIBERS_CNT'],
			'sort'    => 'SUBSCRIBERS_CNT',
			'default' => true,
	 ),
	 array(
			'id'      => 'SENDMAIL_CNT',
			'content' => $arFieldTitle['SENDMAIL_CNT'],
			'sort'    => 'SENDMAIL_CNT',
			'default' => true,
	 ),
	 array(
			'id'      => 'SITE_ID',
			'content' => $arFieldTitle['SITE_ID'],
			'sort'    => 'SITE_ID',
			'default' => true,
	 ),
);
$lAdmin->AddHeaders($arHeaders);

while($arRecord = $dbResultList->NavNext(true, 'f_')) {
	$row = &$lAdmin->AddRow($f_ID, $arRecord);

	$arActions = array();
	if($AR_RIGHT == 'W') {
		/*$arActions[] = array(
			 'ICON'    => 'edit',
			 'TEXT'    => Loc::getMessage('MAIN_ADMIN_MENU_EDIT'),
			 'ACTION'  => $lAdmin->ActionDoGroup($f_ID, 'edit'),
			 'DEFAULT' => true,
		);*/
		$arActions[] = array(
			 'ICON'   => 'delete',
			 'TEXT'   => Loc::getMessage('MAIN_ADMIN_MENU_DELETE'),
			 'ACTION' => "if(confirm('" . Loc::getMessage('ARAA_DELETE_CONFIRM') . "')) " . $lAdmin->ActionDoGroup($f_ID, 'delete'),
		);
	}

	$row->AddActions($arActions);
}

$lAdmin->AddFooter(
	 array(
			array(
				 'title' => Loc::getMessage('MAIN_ADMIN_LIST_SELECTED'),
				 'value' => $dbResultList->SelectedRowsCount(),
			),
			array(
				 'counter' => true,
				 'title'   => Loc::getMessage('MAIN_ADMIN_LIST_CHECKED'),
				 'value'   => '0',
			),
	 )
);


//�������� ��������
if($AR_RIGHT == 'W') {
	$lAdmin->AddGroupActionTable(Array(
		 'delete' => Loc::getMessage('MAIN_ADMIN_LIST_DELETE'),
	));
}


$lAdmin->CheckListMode();

$APPLICATION->SetTitle(Loc::getMessage('ARAA_PAGE_TITLE'));
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php');
?>
	<form name="find_form" method="GET" action="<?=$APPLICATION->GetCurPage()?>?">
		<?
		$oFilter = new CAdminFilter(
			 $sTableID . "_filter",
			 $arFilterTitles
		);
		?>
		<? $oFilter->Begin(); ?>
		<? foreach($columns as $code => $fld): ?>
			<? //if(!in_array($code, $excludedColumns)):?>
			<tr>
				<td><?=htmlspecialcharsbx($fld->getTitle())?><? if($fld->getDataType() == 'integer'): ?> (<?=Loc::getMessage('ARAA_FROM_AND_TO')?>)<? endif ?>:</td>
				<td>
					<? if($fld->getDataType() == 'integer'): ?>
						<input type="text" name="find_<?=$code?>_1" value="<?=htmlspecialcharsbx($GLOBALS[ 'find_' . $code . '_1' ])?>">
						...
						<input type="text" name="find_<?=$code?>_2" value="<?=htmlspecialcharsbx($GLOBALS[ 'find_' . $code . '_2' ])?>">
					<? elseif($fld->getDataType() == 'datetime'): ?>
						<?=CalendarPeriod("find_{$code}_1", htmlspecialcharsbx($GLOBALS[ 'find_' . $code . '_1' ]), "find_{$code}_2", htmlspecialcharsbx($GLOBALS[ 'find_' . $code . '_2' ]), "find_form", "Y")?>
					<? elseif($code == 'SITE_ID'): ?>
						<?=CLang::SelectBox('find_' . $code, htmlspecialcharsbx($GLOBALS[ 'find_' . $code ]), Loc::getMessage('MAIN_ALL'));?>
					<? else: ?>
						<input type="text" name="find_<?=$code?>" value="<?=htmlspecialcharsbx($GLOBALS[ 'find_' . $code ])?>">
					<? endif ?>
				</td>
			</tr>
			<? //endif?>
		<? endforeach ?>
		<?
		$oFilter->Buttons(array(
			 "table_id" => $sTableID,
			 "url"      => $APPLICATION->GetCurPageParam(),
			 "form"     => "find_form",
		));
		$oFilter->End();
		?>
	</form>
<?
$lAdmin->DisplayList();
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');
?>