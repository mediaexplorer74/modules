<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("Отладка");
?><?$APPLICATION->IncludeComponent(
	"me:some.edit",
	"",
	Array(
		"AUTO_SCROLL" => "N",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"ELEMENT_COUNT" => "",
		"ELEMENT_COUNT_ON_PAGE" => "",
		"HEIGHT_WRAP" => "350",
		"IBLOCK_ID" => "273",
		"IBLOCK_TYPE" => "reestr_specificat",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"PICTURE_FROM" => "0",
		"USE_ELEMENT_ID" => "N",
		"USE_ELEMENT_NAME" => "Y",
		"USE_ELEMENT_PRICE" => "Y",
		"USE_FRACTIONAL_VALUE" => "N",
		"USE_IBLOCK_ID" => "Y",
		"USE_SECTION_ID" => "N"
	)
);?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>