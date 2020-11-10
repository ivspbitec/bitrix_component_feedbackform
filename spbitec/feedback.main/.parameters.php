<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEEDBACK_FORM", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];









$arUsedFields=Array(
	"NAME" => GetMessage("MFP_NAME"), 
	"PHONE" => GetMessage("MFP_PHONE"),
	"EMAIL" => "E-mail", 
	"MESSAGE" => GetMessage("MFP_MESSAGE")
);


$arRequiredFields=Array(
	"NONE" => GetMessage("MFP_ALL_REQ"),
	"NAME" => GetMessage("MFP_NAME"), 
	"PHONE" => GetMessage("MFP_PHONE"),
	"EMAIL" => "E-mail", 
	"MESSAGE" => GetMessage("MFP_MESSAGE")
);




$arComponentParameters = array(
	"PARAMETERS" => array(
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("MFP_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		"OK_TEXT" => Array(
			"NAME" => GetMessage("MFP_OK_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_OK_TEXT"), 
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),

		"USED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_USED_FIELDS"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"Y", 
			"VALUES" => $arUsedFields,
			"DEFAULT"=> $arUsedFields, 
			"COLS"=>25, 
			"PARENT" => "BASE",
			"REFRESH" => "Y",
		),

		"REQUIRED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_REQUIRED_FIELDS"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"Y", 
			"VALUES" => $arRequiredFields,
			"DEFAULT"=>"",
			"COLS"=>25, 
			"PARENT" => "BASE",
		),

		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TEMPLATES"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"Y", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		"USE_IN_COMPONENT" => Array(
			"NAME" => GetMessage("USE_IN_COMPONENT"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N", 
			"PARENT" => "BASE",
		),
		"MESSAGE_HIDTH" => Array(
			"NAME" => GetMessage("MESSAGE_HIDTH"), 
			"TYPE" => "STRING",
			"DEFAULT" => "10", 
			"PARENT" => "BASE",
		),
		"BUTTON_MESSAGE" => Array(
			"NAME" => GetMessage("BUTTON_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("BUTTON_MESSAGE_DEFAULT"), 
			"PARENT" => "BASE",
		),

	)
);


if (in_array("NAME", $arCurrentValues["USED_FIELDS"]))
{
	$arComponentParameters["PARAMETERS"]["NAME_HINT_TEXT"] = array(
		"NAME" => GetMessage("NAME_HINT_TEXT"),
		"TYPE" => "STRING",
		"ADDITIONAL_VALUES" => "N",
		"REFRESH" => "N",
		"DEFAULT"=>GetMessage("NAME_HINT_TEXT_DEFAULT"),
	);
}

if (in_array("EMAIL", $arCurrentValues["USED_FIELDS"]))
{
	$arComponentParameters["PARAMETERS"]["EMAIL_HINT_TEXT"] = array(
		"NAME" => GetMessage("EMAIL_HINT_TEXT"),
		"TYPE" => "STRING",
		"ADDITIONAL_VALUES" => "N",
		"REFRESH" => "N",
		"DEFAULT"=>GetMessage("EMAIL_HINT_TEXT_DEFAULT"),
	);
}
if (in_array("PHONE", $arCurrentValues["USED_FIELDS"]))
{
	$arComponentParameters["PARAMETERS"]["PHONE_HINT_TEXT"] = array(
		"NAME" => GetMessage("PHONE_HINT_TEXT"),
		"TYPE" => "STRING",
		"ADDITIONAL_VALUES" => "N",
		"REFRESH" => "N",
		"DEFAULT"=>GetMessage("PHONE_HINT_TEXT_DEFAULT"),
	);
}

if (in_array("MESSAGE", $arCurrentValues["USED_FIELDS"]))
{
	$arComponentParameters["PARAMETERS"]["MESSAGE_HINT_TITLE"] = array(
		"NAME" => GetMessage("MESSAGE_HINT_TITLE"),
		"TYPE" => "STRING",
		"ADDITIONAL_VALUES" => "N",
		"REFRESH" => "N",
		"DEFAULT"=>GetMessage("MESSAGE_HINT_TITLE_DEFAULT"),
	);
}






?>