<?
define("ADMIN_MODULE_NAME", "fileman");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

if(!\Bitrix\Main\Loader::includeModule("fileman"))
	ShowError(\Bitrix\Main\Localization\Loc::getMessage("MAIN_MODULE_NOT_INSTALLED"));

$isAdmin = $USER->CanDoOperation('lpa_template_edit');
$isUserHavePhpAccess = $USER->CanDoOperation('edit_php');
$canWorkWithHtml = $isAdmin || $isUserHavePhpAccess;

$POST_RIGHT = $APPLICATION->GetGroupRight("fileman");
if($POST_RIGHT=="D")
	$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_js.php");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
switch($request->get('action'))
{
	case 'save_file':

		$result = array(
			'error' => false,
			'errorText' => '',
			'data' => array(
				'list' => array(),
			)
		);
		$fileList = array();

		//New from media library and file structure
		$isCheckedSuccess = false;
		$requestFiles = $request->getPost('NEW_FILE_EDITOR');
		if($requestFiles && is_array($requestFiles))
		{
			foreach($requestFiles as $index=>$value)
			{
				if(is_array($value))
				{
					$filePath = urldecode($value['tmp_name']);
				}
				else
				{
					continue;
				}

				$isCheckedSuccess = false;
				$io = CBXVirtualIo::GetInstance();
				$docRoot = \Bitrix\Main\Application::getDocumentRoot();
				if(strpos($filePath, CTempFile::GetAbsoluteRoot()) === 0)
				{
					$absPath = $filePath;
				}
				elseif(strpos($io->CombinePath($docRoot, $filePath), CTempFile::GetAbsoluteRoot()) === 0)
				{
					$absPath = $io->CombinePath($docRoot, $filePath);
				}
				else
				{
					$absPath = $io->CombinePath(CTempFile::GetAbsoluteRoot(), $filePath);
				}

				if ($io->ValidatePathString($absPath) && $io->FileExists($absPath))
				{
					$docRoot = $io->CombinePath($docRoot, '/');
					$relPath = str_replace($docRoot, '', $absPath);
					$perm = $APPLICATION->GetFileAccessPermission($relPath);
					if ($perm >= "W")
					{
						$isCheckedSuccess = true;
					}
				}

				if($isCheckedSuccess)
				{
					$fileList[$filePath] = CFile::MakeFileArray($io->GetPhysicalName($absPath));
					if(isset($value['name']))
					{
						$fileList[$filePath]['name'] = $value['name'];
					}
				}
				else
				{
					$result['data']['list'][] = array(
						'tmp' => $filePath,
						'path' => ''
					);
				}
			}
		}


		foreach($fileList as $tmpFileName => $file)
		{
			if(strlen($file["name"]) <= 0 || intval($file["size"]) <= 0)
			{
				continue;
			}

			$resultInsertAttachFile = false;
			$file["MODULE_ID"] = "fileman";
			$fid = intval(CFile::SaveFile($file, "fileman", true));
			if($fid > 0 && ($filePath = CFile::GetPath($fid)) && strlen($filePath) > 0)
			{
				$result['data']['list'][] = array(
					'tmp' => $tmpFileName,
					'path' => $filePath
				);
			}
		}

		if (!$isCheckedSuccess && count($fileList) == 0)
		{
			$result['error'] = true;
			$result['errorText'] = GetMessage("ACCESS_DENIED");
		}

		echo CUtil::PhpToJSObject($result);
		break;


	case 'set':

		if (!$canWorkWithHtml)
		{
			$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
		}

		if($request->isPost() && check_bitrix_sessid())
		{
			$src = $request->getPost('src');
			if(\Bitrix\Main\Text\Encoding::detectUtf8($src))
			{
				$src = \Bitrix\Main\Text\Encoding::convertEncodingToCurrent($src);
			}

			// TODO: POST FORM IN IFRAME WITH CONTENT WITHOUT this "set" request
			$_SESSION['bx_block_editor_temp_template'] = $src;
		}
		break;


	case 'preview_mail':

		if (!$canWorkWithHtml)
		{
			$APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
		}

		$request = \Bitrix\Main\Context::getCurrent()->getRequest();
		$previewParams = array(
			'CAN_EDIT_PHP' => $GLOBALS["USER"]->CanDoOperation('edit_php'),
			'SITE' => $request->get('site_id'),
			'HTML' => $_SESSION['bx_block_editor_temp_template'],
			'FIELDS' => array(
				'SENDER_CHAIN_CODE' => 'sender_chain_item_0',
			),
		);
		echo \Bitrix\Fileman\Block\EditorMail::getPreview($previewParams);
		break;
}


require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_js.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin_after.php");