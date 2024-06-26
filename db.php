<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'my_db');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysql->connect_errno) {
exit("Ошибка подключения: " . $mysql->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

$email_to = "ncpremote@mail.ru";

$subject = "Новое сообщение с формы обратной связи";
$headers = "From: " . $email;
$headers .= "Reply-To: " . $email;

if (mail($email_to, $subject, $mail_message, $headers)) {
    echo "Email успешно отправлен на указанный адрес.";
} else {
    echo "Ошибка при отправке почты.";
}

if ($stmt = $mysql->prepare("SELECT email FROM feedback WHERE email = ?")) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Пользователь с такой почтой уже существует." . $mysql->error;;
    } else {
        $stmt->close();

if ($stmt = $mysql->prepare("INSERT INTO feedback (name, phone, email, message) VALUES (?, ?, ?, ?)")) {
$stmt->bind_param("ssss", $name, $phone, $email, $message);

if ($stmt->execute()) {
    echo "Данные успешно сохранены.";
} else {
    echo "Ошибка сохранения данных: " . $stmt->error;
}
$stmt->close();
} else {
    echo "Ошибка подготовки запроса: " . $mysql->error;
}
}
} else {
    echo "Ошибка подготовки запроса: " . $mysql->error;
}