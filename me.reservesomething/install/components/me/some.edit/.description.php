<?
   if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

   $arComponentDescription = array(
	"NAME" => GetMessage("COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("COMPONENT_DESCR"),
	"ICON" => "/images/counter.gif",
	"NAME" => "users.form",
	"DESCRIPTION" => "users.form component",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "me",
		"CHILD" => array(
			"ID" => "grids", // ид дочернего раздела
			"NAME" => "Гриды", // назв. доч. раздела
			"SORT" => 20,
		),
	),
);
?>