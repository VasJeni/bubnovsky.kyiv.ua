<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$mail_to = "pinurovno@gmail.com, bubnovskyfacebook2@gmail.com, max.kravez@icloub.com";

		# Sender Data
		$subject = "Лендинг - Киев";
		$name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
		$phone = trim($_POST["phone"]);
		$form = trim($_POST["form"]);
		$clientId = trim($_POST["clientId"]);

		if ( empty($name) OR empty($phone)) {
			# Set a 400 (bad request) response code and exit.
			http_response_code(400);
			echo "Заполните форму и повторите попытку.";
			exit;
		}

		# Mail Content
		$content = "Город: Киев\n";
		$content .= "Имя: $name\n";
		$content .= "Номер телефона: $phone\n";
		$content .= "Тема: ЛЕЧЕНИЕ БОЛИ В СПИНЕ И СУСТАВАХ БЕЗ ОПЕРАЦИЙ!\n";
		$content .= "Форма: №$form\n";
		$content .= "Домен: https://kiev.bubnovsky.com.ua/\n";
		$content .= "Client ID: $clientId\n";

		# email headers.
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/plain;charset=UTF-8" . "\r\n";
		$headers .= "From: robot@kiev.bubnovsky.com.ua";

		# Send the email.
		$success = mail($mail_to, $subject, $content, $headers);
		if ($success) {
			# Set a 200 (okay) response code.
			http_response_code(200);
			
			header("Location: http://bubnovsky.kyiv.ua/success.html"); 
			echo "Спасибо, ваша заявка принята! Администратор свяжется с вами для уточеннения времени.";
		} else {
			# Set a 500 (internal server error) response code.
			http_response_code(500);
			echo "Упс! Что-то пошло не так, мы не смогли отправить Ваш запрос.";
		}

		} else {
			# Not a POST request, set a 403 (forbidden) response code.
			http_response_code(403);
			echo "Возникла проблема с отправкой формы, повторите попытку.ы";
		}
?>