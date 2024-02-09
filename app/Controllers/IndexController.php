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
            if(empty($_SESSION['named'])){
                $test_three = $object->test_three($city);
                if($test_three == true){
                    //Записываем названный город в список названных
                    $object->memory($city);

                    $answer = $object->SelectCities($city);

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
                    
                    //Начисляем очки
                    $object->points();
                }else{
                    $_SESSION['text'] = "Вы неправильно ввели название города!";
                }
            }else{
                $test_one = $object->test_one($city);
                $test_two = $object->test_two($city);
                $test_three = $object->test_three($city);
                
                if($test_one == true && $test_two == true && $test_three == true){
                    //Записываем названный город в список названных
                    $object->memory($city);

                    $answer = $object->SelectCities($city);

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
                    //Начисляем очки
                    $object->points();
                }else{
                    if($test_one == false){
                        $_SESSION['text'] = "Город уже назывался ранее в игре";
                    }elseif ($test_two == false) {
                        $_SESSION['text'] = "По правилам игры, названный Вами город не подходит";
                    }elseif ($test_three == false) {
                        $_SESSION['text'] = "Вы неправильно ввели название города!";
                    }
                }
            }
            
        }else{
            $_SESSION['text'] = "Вы не ввели название города!";
        }

    }

}

