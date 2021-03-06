<?php
require_once "BaseController.php"; // обязательно импортим BaseController

class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig ; // ссылка на экземпляр twig, для рендернига
    
    
    public function setTwig($twig) {
        $this->twig = $twig;
    }

    public function getTemplate() {
        return $this->template;
    }

    // переопределяем функцию контекста
    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст
        $context["messages"] = isset($_SESSION['messages']) ? $_SESSION['messages'] : "";
        return $context;
    }
    
    // функция гет, рендерит результат используя $template в качестве шаблона
    // и вызывает функцию getContext для формирования словаря контекста
    public function get(array $context) { // добавил аргумент в get
        echo $this->twig->render($this->getTemplate(), $context); // а тут поменяем getContext на просто $context
    }
}