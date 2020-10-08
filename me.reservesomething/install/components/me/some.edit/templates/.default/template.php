<?
// some.edit - Шаблон компонента для работы с параметрами модуля в публичной части корпортала
//
// Версия 1.0 от 08 октября 2020
// 
// Notes:
// Сделан задел под несколько параметров


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();



$mainformpath = "index.php"; //"userstable.php";               // путь к основному маршруту /some/


$arTab1Fields = array(); 

$arTab1Fields[] = array("id"=>"section1", "name"=>"Параметр списочного типа", "type"=>"section");

$arTab1Fields[] = array
(
	"id"=>"ME_MODE", 
	"name"=>"Режим", 
	"type"=>"list", 
    "items"=>array("LIST"=>"List (Список)", "STANDALONE"=>"Standalone (Отдельный)", "COMBO"=>"Combo (Комбо)"), 
	"value" => $arResult["DATA"]["MODE"]
);

$arTab1Fields[] = array("id"=>"section2", "name"=>"Параметр строкового типа", "type"=>"section");

foreach($arResult["DATA"]["OPTIONS"] as $key=> $item)
{

	$arTab1Fields[] = array("id"=>$key, "name"=>GetMessage('ME_'.$key), "type"=> "string", "value"=>$item);
}


// Вызов "главной интерфейсной формы" (стандартной)
$APPLICATION->IncludeComponent(
	"bitrix:main.interface.form",
	".default", 
	array(
		"GRID_ID"=>$arResult["GRID_ID"],
		"TABS"=>array
		(
			array("id"=>"tab1", "name"=>"Вкладка 1", "title"=>"Параметры модуля", "icon"=>"", "fields"=>$arTab1Fields),
			
			/*
			array("id"=>"tab2", "name"=>"Личные данные", "title"=>"Персональная информация", "icon"=>"", "fields"=>array
			(
				array("id"=>"PERSONAL_BIRTHDAY", "name"=>"День рождения", "type"=>"date"),
				array("id"=>"PERSONAL_PHOTO", "name"=>"Фотография", "type"=>"file", $params=>array("iMaxW"=>150, "iMaxH"=>150, "sParams"=>"border=0", "strImageUrl"=>"", "bPopup"=>true, "sPopupTitle"=>false)),
				array("id"=>"PERSONAL_PROFESSION", "name"=>"Профессия"),
				array("id"=>"PERSONAL_WWW", "name"=>"Веб"),
				array("id"=>"PERSONAL_ICQ", "name"=>"АйСикЮ", "params"=>array("size"=>15)),
				array("id"=>"section1", "name"=>"Разделительная секция", "type"=>"section"),
				array("id"=>"PERSONAL_GENDER", "name"=>"Пол", "type"=>"list", "items"=>array(""=>"(пол)", "M"=>"Мужской", "F"=>"Женский")),
				array("id"=>"PERSONAL_PHONE", "name"=>"Телефон"),
				array("id"=>"PERSONAL_MOBILE", "name"=>"Мобильник"),
				array("id"=>"PERSONAL_CITY", "name"=>"Город"),
				array("id"=>"PERSONAL_STREET", "name"=>"Улица", "type"=>"textarea", "params"=>array("rows"=>5)),
			)),
			
			array("id"=>"tab3", "name"=>"Работа", "title"=>"Информация о работе", "icon"=>"", "fields"=>array(
				array("id"=>"WORK_COMPANY", "name"=>"Компания"),
				array("id"=>"WORK_DEPARTMENT", "name"=>"Отдел", "type"=> "label"),
				array("id"=>"WORK_POSITION", "name"=>"Должность","params"=>array("size"=>400)), // че-то параметр size не передается... ширина не регулируется
			)),
			*/
		),
		"BUTTONS"=>array("back_url"=>$mainformpath, "custom_html"=>"", "standard_buttons"=>true),
		"DATA"=>$arResult["DATA"],
	),
	$component
);


?>