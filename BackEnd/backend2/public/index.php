<?php

// подключаем пакеты которые установили через composer
require_once '../vendor/autoload.php';

// создаем загрузчик шаблонов, и указываем папку с шаблонами
// \Twig\Loader\FilesystemLoader -- это типа как в C# писать Twig.Loader.FilesystemLoader, 
// только слеш вместо точек
$loader = new \Twig\Loader\FilesystemLoader('../views');

// создаем собственно экземпляр Twig с помощью которого будет рендерить
$twig = new \Twig\Environment($loader);

$url = $_SERVER["REQUEST_URI"];

$title = "";
$template = "";
// $image = ""; убираем

$context = []; // наш словарик, данные для шаблона принято называть контекстом

if ($url == "/") {
    $title = "Главная";
    $template = "main.twig";
} elseif (preg_match("#/mermaid#", $url)) {
    $title = "Русалка";
    $template = "base_image.twig";
    
    $context['image'] = "/images/085_mermaid.jpg"; // передаем в контекст ключ image
} elseif (preg_match("#/uranus#", $url)) {
    $title = "Уран";
    $template = "base_image.twig";
    
    $context['image'] = "/images/086_uranus.jpg"; // и тут передаем в контекст ключ image
}

// название не пихаю в контекст в роутере,
// потому что это отдельная сущность, общая для всех
$context['title'] = $title;

// ну и рендерю
echo $twig->render($template, $context);
?>