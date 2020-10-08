<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Настройки модуля me.reservesomething");
?>
<?

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


// 1 Считываем режим 
$ME_MODE = COption::GetOptionString($module_id, 'ME_MODE');

// 2 Cчитываем набор опций

//цикл по OptionsFieldsList 
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




// 1 вывод режима

$str = "Режим: ";

// многовариантный кейс
switch ($ME_MODE) {
    case 'LIST':
        $str .= "List (Список)";
        break;
    case 'STANDALONE':
        $str .= "Standalone (Отдельный)";
        break;
    case 'COMBO':
        $str .= "Combo (Комбинированный)";
        break;
}

echo $str;

?>
<p>
</p>
<?

// 2 вывод опции(й)
foreach($OptionsFields as $key => $item)
{
	// тернарный оператор =)
	echo $key == "WF_SOMETHING" ? "Какой-то строковый параметр" . " : ". $item : "";
}

?>
<p>
 <a href="/some/some.php">Изменить параметры</a>
</p>
 <br>
 <?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
