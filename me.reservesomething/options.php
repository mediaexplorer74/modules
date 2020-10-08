<?
//  Me.ReserveSomething Options 
//  v 1.0
//
//  Created: 08-oct-2020

global $MESS;

IncludeModuleLangFile(__FILE__);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_admin.php");

IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"] . BX_ROOT . "/modules/main/options.php");

// id модуля 
$module_id = "me.reservesomething";

CModule::IncludeModule($module_id);

$MOD_RIGHT = $APPLICATION->GetGroupRight($module_id);

// "Интерфейс" для набора опций (задел не под один параметр)
$OptionsFieldsList = 
[
    // 'WF_ID_CREATE' => 'INT', // создание
	// 'WF_ID_MODIFY' => 'INT', // модификация
	// 'WF_ID_DELETE' => 'INT', // удаление
    // 'WF_IBLOCK' => 'INT', // номер инфоблока
	'WF_SOMETHING' => 'STRING',  // текстовый параметр 
];

// цикл по OptionsFieldsList 
foreach ($OptionsFieldsList as $OptionsFieldsName => $OptionsFieldsValue) 
{
    if ($OptionsFieldsValue == 'INT') 
	{
		//dump($OptionsFieldsName);
        $OptionsFields[$OptionsFieldsName] = COption::GetOptionInt($module_id, $OptionsFieldsName);
    } 
	elseif ($OptionsFieldsValue == 'STRING') 
	{
        $OptionsFields[$OptionsFieldsName] = COption::GetOptionString($module_id, $OptionsFieldsName);
    }
}

// Считываем $ME_MODE (режим)
$ME_MODE = COption::GetOptionString($module_id, 'ME_MODE');

// Проверка прав
if ($MOD_RIGHT >= "R"):

    if ($MOD_RIGHT >= "Y" || $USER->IsAdmin()):
	
		// Обработчик POST
        if ($REQUEST_METHOD == "POST" && strlen($Update) > 0 && check_bitrix_sessid()) 
		{
			// в цикле записываем опции 
            foreach ($OptionsFields as $FieldName => $FieldValue) 
			{
                if ($_POST[$FieldName]) 
				{
                    $OptionsFields[$FieldName] = $_POST[$FieldName];
					
                    if ($OptionsFieldsList[$FieldName] == 'INT') 
					{
						// записываем опцию
                        COption::SetOptionInt($module_id, $FieldName, $OptionsFields[$FieldName]);
                    } 
					elseif ($OptionsFieldsList[$FieldName] == 'STRING') 
					{
                        // записываем опцию
						COption::SetOptionString($module_id, $FieldName, $OptionsFields[$FieldName]);
                    }
                }
            }

            if ($_POST['ME_MODE']) 
			{
                $ME_MODE = $_POST['ME_MODE'];
				
				// записываем опцию ME_MODE
                COption::SetOptionString($module_id, 'ME_MODE', $ME_MODE);
            }
        }
		
    endif;

	// *** Future releases ***
    // CModule::IncludeModule('crm');

    $aTabs = array
	(
        array("DIV" => "edit1", "TAB" => GetMessage("ST_SETTINGS"), "TITLE" => GetMessage("ST_SETTINGS")),
        array("DIV" => "edit2", "TAB" => GetMessage("MAIN_TAB_RIGHTS"), "ICON" => "main_settings", "TITLE" => GetMessage("MAIN_TAB_RIGHTS")),
    );
	
    $tabControl = new CAdminTabControl("tabControl", $aTabs);
    $tabControl->Begin();
    ?>
    <form method="POST" action="<? echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialchars($mid) ?>&lang=<?= LANGUAGE_ID ?>" name="webdav_settings">
        <? $tabControl->BeginNextTab(); ?>
        <tr>
            <td><?= GetMessage('ME_MODE') ?></td>
            <td>
			<select name="ME_MODE">
                
				<option value="LIST" <?if($ME_MODE == 'LIST') echo ' selected="selected"' ?>>
                    <?= GetMessage('ME_MODE_LIST') ?>
                </option>
				
                <option value="STANDALONE" <?if($ME_MODE == 'STANDALONE') echo ' selected="selected"' ?>>
                    <?= GetMessage('ME_MODE_STANDALONE') ?>
                </option>
											
				<option value="COMBO" <?if($ME_MODE == 'COMBO') echo ' selected="selected"' ?>>
                    <?= GetMessage('ME_MODE_COMBO') ?>
                </option>
				
            </select>
			</td>
        </tr>
        <? foreach ($OptionsFields as $FieldName => $FieldValue) : 
		    //dump($FieldName);
		?>
            <tr>
                <td ><? echo GetMessage('ME_' . $FieldName) ?></td>
                <td><input type="text" name="<?= $FieldName ?>" id="<?= $FieldName ?>" value=<?= $FieldValue ?>></td>
            </tr>
        <? endforeach; ?>

    <? $tabControl->BeginNextTab(); ?>
    <? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php"); ?>

    <? $tabControl->Buttons(); ?>
    <? ?>
    <input type="submit" name="Update" <? if ($MOD_RIGHT < "W") echo "disabled" ?> value="<? echo GetMessage("MAIN_SAVE") ?>">
    <!--input type="reset" name="reset" value="<? echo GetMessage("MAIN_RESET") ?>"-->
    <input type="hidden" name="Update" value="Y">

    <?= bitrix_sessid_post(); ?>
    <? $tabControl->End(); ?>
    </form>
<? endif; ?>
