<?php
require_once "BasePlantsTwigController.php";

class ObjectCreateController extends BasePlantsTwigController {
    public $template = "create.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        $query = $this->pdo->query("SELECT * FROM types");
        $context['types'] = $query->fetchAll();
        return $context;
    }

    public function post(array $context) { // добавили параметр
        
            // получаем значения полей с формы
            $title = $_POST['title'];
            $description = $_POST['description'];
            $type = $_POST['type'];
            $info = $_POST['info'];
    
            // вытащил значения из $_FILES
            $tmp_name = $_FILES['image']['tmp_name'];
            $name =  $_FILES['image']['name'];
            
            // используем функцию которая проверяет
            // что файл действительно был загружен через POST запрос
            // и если это так, то переносит его в указанное во втором аргументе место
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name"; // формируем ссылку без адреса сервера

            // создаем текст запрос
            $sql = <<<EOL
INSERT INTO flowers(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url) -- передаем переменную в запрос
EOL;
    
            $query = $this->pdo->prepare($sql);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);
            $query->bindValue("image_url", $image_url); // подвязываем значение ссылки к переменной  image_url
            $query->execute();

            // а дальше как обычно
            $context['message'] = 'Вы успешно создали объект';
            $context['id'] = $this->pdo->lastInsertId();
            
            $this->get($context);
    }
}