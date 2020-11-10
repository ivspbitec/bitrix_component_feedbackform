<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

if (!empty($_POST)){
   $messageFields=$_POST['message'];
}

$arFields=[]; 								// Массив в почтовый шаблон
$arResult["ERROR_MESSAGE"] = [];		// Сообщения об ошибках


$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");

$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
   $arParams["EVENT_NAME"] = "FEEDBACK_FORM";

$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
   $arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
   $arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"])){

   if(check_bitrix_sessid()){
   
      if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"])){
         foreach($messageFields as $name=>$value){
            $uName=mb_strtoupper($name);
            if (in_array($uName, $arParams["REQUIRED_FIELDS"]) && mb_strlen($value) <= 1){
               $arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ_".$uName);               
            }
            if (($name=='email' || $name=='mail' ) && !check_email($value)){
               $arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
            }
            
            $arFields[$uName]=$value;
         }
      }


      $_SESSION["MF_MESSAGE"] = $messageFields; 
      
      if($arParams["USE_CAPTCHA"] == "Y" && empty($arResult["ERROR_MESSAGE"])){

         if ($_POST['g-recaptcha-response']){
            $ch = curl_init();
            $recptUrl="secret=".$arParams['RECAPTCHA_SECRET']."&response={$_POST['g-recaptcha-response']}&remoteip={$_SERVER['REMOTE_ADDR']}";

            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $recptUrl);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $reCaptchaResult = curl_exec ($ch);
            curl_close ($ch);

            $reCaptchaResult=json_decode($reCaptchaResult, true);
            
            if ($reCaptchaResult['success']!=true){
               $arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
            }
         } else {
            $arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
         }


      }			

      if(empty($arResult["ERROR_MESSAGE"])){
         $arFields["EMAIL_TO"]=$arParams["EMAIL_TO"];         
         
         if(!empty($arParams["EVENT_MESSAGE_ID"])){
            foreach($arParams["EVENT_MESSAGE_ID"] as $v)
               if(IntVal($v) > 0)
                  CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
         }
         else{
            CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);
         }         
         $arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
         unset($_SESSION["MF_MESSAGE"]);         
              
         //LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"], Array("success")));
      }

       
      $arResult["MESSAGE"] = $arFields;
      
   }else{
      $arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
   }
}



if(empty($arResult["ERROR_MESSAGE"])){
   if($USER->IsAuthorized()){
      $arResult["MESSAGE"]["NAME"] = $USER->GetFormattedName(false);
      $arResult["MESSAGE"]["EMAIL"] = htmlspecialcharsbx($USER->GetEmail());
   }else{
      if($_SESSION["MF_MESSAGE"]){
         $arResult["MESSAGE"] = $_SESSION["MF_MESSAGE"];
      }
   }
}
 



$this->IncludeComponentTemplate();
