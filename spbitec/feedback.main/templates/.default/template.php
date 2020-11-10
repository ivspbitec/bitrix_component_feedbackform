<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
 $this->setFrameMode(true);
?>

<?if($arParams['USE_IN_COMPONENT']!="Y"):?>
<div class="row">
<?endif?>


<p class="contact_success_box" style="display:none;"><?=$arParams['OK_TEXT']?></p>

<form class="form-horizontal" id="contact-form" role="form" data-toggle="validator" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>

<?if(in_array("NAME", $arParams["USED_FIELDS"]) or in_array("EMAIL", $arParams["USED_FIELDS"]) or in_array("PHONE", $arParams["USED_FIELDS"])):?>
	<div class="col-md-6">
	<?if(in_array("NAME", $arParams["USED_FIELDS"])):?>
		<input type="text" name="names" required="" class="contact-input white-input" placeholder="<?=$arParams['NAME_HINT_TEXT']?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" value="<?=$arResult["AUTHOR_NAME"]?>">
	<?endif?>
	<?if(in_array("EMAIL", $arParams["USED_FIELDS"])):?>
		<input class="contact-input white-input" required="" name="email" placeholder="<?=$arParams['EMAIL_HINT_TEXT']?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" type="email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
	<?endif?>
	<?if(in_array("PHONE", $arParams["USED_FIELDS"])):?> 
		<input class="contact-input white-input" required="" name="phone" placeholder="<?=$arParams['PHONE_HINT_TEXT']?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" type="text"  value="">
	<?endif?>
	</div>
<?endif?>

<?if(in_array("MESSAGE", $arParams["USED_FIELDS"])):?>
    <div class="col-md-6">
        <textarea class="contact-commnent white-input" rows="<?=$arParams['MESSAGE_HIDTH']?>" placeholder="<?=$arParams['MESSAGE_HINT_TITLE']?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?>*<?endif?>" name="message"></textarea>
    </div>
<?endif?>	

	<br/>



	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
		<div class="col-lg-12">
			<div class="col-lg-6">
				<p style="text-align: center;"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></p>
				<div class="col-lg-6">
					<p style="text-align: center;"><input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="158" height="35" alt="CAPTCHA"></p>
				</div>
				<div class="col-lg-6">
					<input class="required form-control" type="text" name="captcha_word" size="30" maxlength="50" value="">
				</div>
			</div>
			<div class="col-lg-6">
			<br/>
				<p style="text-align:  center;">
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
				<input class="contact-submit" type="submit" name="submit" value="<?=$arParams['BUTTON_MESSAGE']?>" style="padding-left: 50px; padding-right: 50px;">
				</p>
			</div>
		</div>
	<?else:?>
		
		            <div class="col-md-12">
				<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
                    	<input value="<?=$arParams['BUTTON_MESSAGE']?>" id="submit-button" class="contact-submit" type="submit" name="submit">
                    </div>

	<?endif;?>

</form>

<?if($arParams['USE_IN_COMPONENT']!="Y"):?>
	</div>
<?endif?>
