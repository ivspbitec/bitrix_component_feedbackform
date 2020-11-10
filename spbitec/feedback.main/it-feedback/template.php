<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);



?>


<section class="it-section __feedback __dark" >
   <div class="container">

      <p class="contact_success_box" style="-display:none;"><?=$arResult['OK_MESSAGE']?></p>
      <p class="contact_success_box" style="-display:none;">
      
      <?      
      pr($arResult['ERROR_MESSAGE'])      
      ?>
      </p>

      <h2>
         ОФОРМЛЕНИЕ ЗАКАЗА
      </h2>
      <div class="lead">
         Пожалуйста, заполните форму и мы с вами свяжемся. 
      </div>
      <form class="" id="contact-form" role="form" data-toggle="validator" action="<?=POST_FORM_ACTION_URI?>" method="POST">
         <div class="row">
            <div class="col-md-6">
               <div class="form-group">
                  <input type="text" class="form-control" name="message[name]" value="<?=$arResult['MESSAGE']['NAME']?>" placeholder="<?=$arParams['NAME_HINT_TEXT']?>">

               </div>
               <div class="form-group">
                  <input type="text" class="form-control" name="message[lname]" value="<?=$arResult['MESSAGE']['LNAME']?>"  placeholder="<?=$arParams['LNAME_HINT_TEXT']?>">      
               </div>
            </div>

            <div class="col-md-6">
               <div class="form-group">
                  <input type="text" class="form-control" name="message[email]" value="<?=$arResult['MESSAGE']['EMAIL']?>"  required="true" placeholder="<?=$arParams['EMAIL_HINT_TEXT']?>">

               </div>
               <div class="form-group">
                  <input type="text" class="form-control" name="message[phone]" value="<?=$arResult['MESSAGE']['PHONE']?>"  placeholder="<?=$arParams['PHONE_HINT_TEXT']?>">    
               </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label><?=$arParams['MESSAGE_HINT_TITLE']?></label>
                  <textarea  class="form-control  _message" required="true"  name="message[text]" rows="<?=$arParams['MESSAGE_HIDTH']?>"><?=$arResult['MESSAGE']['TEXT']?></textarea>

               </div>
            </div>
         </div>


         <div class="row">
            <div class="col-md-6">    
            	<? if ($arParams["USE_CAPTCHA"]=='Y'):?>
               <script src="https://www.google.com/recaptcha/api.js" async defer></script>
               <div class="g-recaptcha" data-sitekey="<?=$arParams['RECAPTCHA_SITE']?>"></div>
               
               <? endif;?>
            </div>

            <div class="col-md-6">
               <p class='_requiredtext'>
                 * Звездочкой обозначены графы, обязательные для заполнения.
               </p>
            </div>
         </div>


         <div class="row mt-5">
            <div class="col-md-6">

            </div>

            <div class="col-md-6">
               <?=bitrix_sessid_post()?>
               <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
               <input value="<?=$arParams['BUTTON_MESSAGE']?>" class="btn btn-success" type="submit" name="submit">

            </div>
         </div>

      </form>      

   </div>
</section>

