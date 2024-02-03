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
        if(!isset($_SESSION['named'])){
            $_SESSION['named'] = [];
            $_SESSION['num'] = 0;
        }
        
        $city = $_POST['city'];
        
        if(isset($city)){
            //Записываем названный город в список названных
            $num = $_SESSION['num'];
            $a = $num + 1;
            $_SESSION['named'][$a] = $city;
            $_SESSION['num'] = $a;
                       
            $last = mb_substr($city, -1, 1, "UTF-8");
            $letter = mb_convert_case($last, MB_CASE_TITLE, "UTF-8");
            $object = new StructureModel;
            $answer = $object->city($letter);
            
            foreach ($answer as $key => $value) { 
                $candidate = $object->choise($value);
                if($candidate == true){
                    break;
                }else{
                    $candidate = "Система больше не знает городов";
                }
            }
            
            //Записываем город в список названных
            $b = $a + 1;
            $_SESSION['named'][$b] = $candidate;
            $_SESSION['num'] = $b;
            
            var_dump($candidate);

        }

    }

}

