 

 <?$APPLICATION->IncludeComponent("spbitec:feedback.main", "it-feedback", Array(
	"BUTTON_MESSAGE" => "Отправить",	// Текст кнопки отправки
		"COMPONENT_TEMPLATE" => "feedback",
      
		"EMAIL_TO" => "spbdesign@yandex.ru",	// E-mail, на который будет отправлено письмо
		"EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
			0 => "7",
			//0 => "19",
		),
		"MESSAGE_HIDTH" => "7",	// Высота поля "Сообщение" (число строк)
		"MESSAGE_HINT_TITLE" => "ДОПОЛНИТЕЛЬНО",	// Заголовок в поле Сообщение
      
		"NAME_HINT_TEXT" => "ИМЯ",	// Подсказка в поле ИМЯ
      "LNAME_HINT_TEXT" => "ФАМИЛИЯ",
		"PHONE_HINT_TEXT" => "КОНТАКТНЫЙ ТЕЛЕФОН",	// Подсказка в поле телефон
		"EMAIL_HINT_TEXT" => "АДРЕС ЭЛЕКТРООННОЙ ПОЧТЫ *",	// Подсказка в поле email
		
      
      "OK_TEXT" => "Спасибо! Ваше сообщение было отправлено!",	// Сообщение, выводимое пользователю после отправки
    
      
      
		"REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения			
			0 => "EMAIL",
			1 => "MESSAGE",
		),
		"USED_FIELDS" => array(	// Выводить поля
			0 => "NAME",
			1 => "LNAME",
			2 => "PHONE",
			3 => "EMAIL",
			4 => "MESSAGE",
		),
		
      "USE_CAPTCHA" => "Y",	// Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
      
		"RECAPTCHA_SECRET" => 	"###",
		"RECAPTCHA_SITE" => 		"###",
		 
       
      
      "USE_IN_COMPONENT" => "N",	// Используется внутри другого компонента (или включаемой области)
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	),
	false
);?>