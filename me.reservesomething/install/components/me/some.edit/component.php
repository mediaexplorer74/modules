<?
// some.edit - Компонент для работы с параметрами модуля из публичной части корпортала 
//
// Версия 1.0 от 08 октября 2020

// Планируемые исправления в 1.1: 
// * добавить сериализацию-десериализацию
// * редизайн формы редактирования
// * вместо надписи на кнопке "Сохранить" сделать "Сохранить параметры"
//
// 
// Гриды – набор компонентов ядра для создания унифицированного интерфейса. 
// Источником данных для грида будет список пользователей системы. 
// Мы выведем в публичке список пользователей с возможностью редактировать данные пользователя в форме. 
// Поскольку это публичный раздел, то логично будет сделать свои компоненты для вывода списка и формы редактирования отдельного пользователя (*). 
// Тело компонента компонента формы редактирования будет выбирать данные, а шаблон компонента формы - выводить их с помощью грида.  
//
// TODO: Еще можно в гридах реализовать суммириующую строку, т.е. строку, в которой будет общий результат по столбцу.
// 
// Можно либо просто добавлять последнюю строку в массив данных, либо использовать строку статуса (где "выделено" и навигация): 
//    // футер списка, можно задать несколько секций 
//   "FOOTER"=>array(array("title"=>"Всего", "value"=>$arResult["ROWS_COUNT"]), array("title"=>"Сумма", "value"=>"20000"))

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!CModule::IncludeModule('lists'))
{
	ShowError("CC_BLEE_MODULE_NOT_INSTALLED");
	return;
}

$arResult["FORM_ID"] = "user_form";        // форма с уникальной меткой "user_form" * TODO: метку лучше навесить на параметр компонента!
//$arResult["GRID_ID"] = "user_grid";        // Грид с уникальной меткой "user_grid"

$editformpath = "it_form_edit.php"; // путь к формочке редактирования отд. записи
//$mainformpath = $arParams["BACK_URL"];;  //"userstable.php";               // путь к основной форме-списку
$mainformpath = ""; //"userstable.php";          // путь к основной форме-списку

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


// -------------------------------------------------------------------------------
// Проверка прав
if ($MOD_RIGHT >= "R"):

    if ($MOD_RIGHT >= "Y" || $USER->IsAdmin()):
	
		// ************************* А здесь у нас идет обработка POST ********************************
		
		//check: Form submitted via POST method?
		if($_SERVER["REQUEST_METHOD"] == "POST" && check_bitrix_sessid())
		{
						
		   //When Save or Apply buttons was pressed
		   if(isset($_POST["save"]) || isset($_POST["apply"]))
		   {
				//DEBUG
				dump($_POST); 
				
				// записываем опцию "Режим"
				COption::SetOptionString($module_id, 'ME_MODE', $_POST['ME_MODE']);
				
				// записываем опцию "Строковый параметр"
				COption::SetOptionString($module_id, "WF_SOMETHING", $_POST["WF_SOMETHING"]);
				  
				// редирект на главную	  
				LocalRedirect($mainformpath);
		   }
		}

        // *******************************************************************************************
		
    endif;
	
endif;	
// -----------------------------------------------------------------------------------------


// подготовка данных для вьюшки
$arResult["DATA"]["MODE"] = $ME_MODE;
$arResult["DATA"]["OPTIONS"] = $OptionsFields;

// "рефурнишинг" полей =)
//$arResult["DATA"]["WORK_DEPARTMENT"] = user_work_department($arResult["DATA"]["ID"]);
//$arResult["DATA"]["FIO"] = $arResult["DATA"]["LAST_NAME"]." ". $arResult["DATA"]["NAME"]." ".$arResult["DATA"]["SECOND_NAME"];

//dump($arResult["DATA"]);
// вызов шаблона
$this->IncludeComponentTemplate();
?>