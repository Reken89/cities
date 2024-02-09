<?php

use App\Controllers\IndexController;

//Запускаем разбор адресной строки
//Получаем нужное нам значение
$route = explode("/", $_SERVER['REQUEST_URI']);     
$route = str_replace(".php", "", $route);

//Главная страница
if($route[2] == "index" || $route[2] == ""){
    $route = new IndexController;
    $route->Index(); 

//Back главной страницы    
}elseif ($route[2] == "back") {
    $route = new IndexController;
    $route->Back(); 
    
//Роут в основную структуру приложения    
}elseif ($route[2] == "city") {
    $route = new IndexController;
    $route->WorkApplication(); 
    
//Заглушка #    
}else{    
    echo "Запрашиваемая Вами страница не существует!";
}     
