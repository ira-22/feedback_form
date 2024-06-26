<?php
$to = "";
$name__user = "Имя пользователя: "._POST["name"]."<br>";
$phone__user = "Телефон: "._POST["phone"]."<br>";
$mail__user = "E-mail: "._POST["mail"]."<br>";
$message__user = "Текст сообщения: "._POST["message"]."<br>";
mail ($to, $name__user, $phone__user, $mail__user, $message__user);
?>