<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StructureModel;

class IndexController extends BaseController
{
    private $page = "/views/main.html";
    private $back = "/views/main.php";
    private $data;
    
    /**
     * Показываем главную страницу в представлении
     *
     * @param 
     * @return render()
     */
    public function index()
    {
        $this->view->render($this->page, $this->data);
    }
    
    /**
     * Подгружаем back главной страницы в представление
     *
     * @param 
     * @return render()
     */
    public function back()
    {
        $this->view->render($this->back, $this->data);
    }
    
    /**
     * Получаем название города из формы
     * Запускаем работу приложения
     *
     * @param 
     * @return render()
     */
    public function city()
    {      
        $city = $_POST['city'];
        
        if($city == true){
            $object = new StructureModel;
            
            //Отправляем слово на проверку
            if(!empty($_SESSION['named'])){
                $test_one = $object->test_two($city);
                $test_two = $object->test_one($city);
            }
            $test_three = $object->test_three($city);
            
            //Записываем названный город в список названных
            $object->memory($city);
                       
            $last = mb_substr($city, -1, 1, "UTF-8");
            $letter = mb_convert_case($last, MB_CASE_TITLE, "UTF-8");
            $answer = $object->city($letter);
            
            foreach ($answer as $key => $value) { 
                $candidate = $object->test_one($value);
                if($candidate == true){
                    break;
                }else{
                    $value = "Система больше не знает городов";
                }
            }

            //Записываем город в список названных
            $object->memory($value);
                      
            $_SESSION['city'] = $value;
            $_SESSION['text'] = "Введите название города";

        }else{
            $_SESSION['text'] = "Вы не ввели название города!";
        }

    }

}

