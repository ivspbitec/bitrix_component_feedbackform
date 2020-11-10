# 1C-Bitrix Component Feedback Form
Site propertys and common library module. Connfigured for every site 
[Spbitec ltd.](http://spbitec.ru "Spbitec ltd.") 2020

### Install
* Copy Folder **spbitec** to **/local/components/**
* Find settings in `/bitrix/admin/settings.php?lang=ru&mid=spbitec.lib&mid_menu=1`
* Copy default template to  `/local/templates/site/components/`

### Using
1. Insert include file to your project

`<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/include/section-feedback.php",),false);?>`

2. Copy file from `/usage/section-feedback.php` to  `/include/section-feedback.php`
3. Use Google reCapcha v2 propertys https://www.google.com/recaptcha/about/
