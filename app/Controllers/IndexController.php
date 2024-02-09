<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StructureModel;

class IndexController extends BaseController
{
    private $page = "/views/main.html";
    private $back = "/views/main.php";
    
    /**
     * Показываем главную страницу в представлении
     *
     * @param 
     * @return render()
     */
    public function Index()
    {
        $this->view->render($this->page);
    }
    
    /**
     * Подгружаем back главной страницы в представление
     *
     * @param 
     * @return render()
     */
    public function Back()
    {
        $this->view->render($this->back);
    }
    
    /**
     * Получаем название города из формы
     * Запускаем работу приложения
     *
     * @param 
     * @return
     */
    public function WorkApplication()
    {      
        $city = $_POST['city'];
        
        if($city == true){
            $object = new StructureModel;
            if(empty($_SESSION['named'])){
                $test_three = $object->RealCity($city);
                if($test_three == true){
                    //Записываем названный город в список названных
                    $object->Memory($city);

                    $answer = $object->SelectCities($city);

                    foreach ($answer as $key => $value) { 
                        $candidate = $object->RepeatCity($value);
                        if($candidate == true){
                            break;
                        }else{
                            $value = "Система больше не знает городов";
                        }
                    }

                    //Записываем город в список названных
                    $object->Memory($value);

                    $_SESSION['city'] = $value;
                    $_SESSION['text'] = "Введите название города";
                    
                    //Начисляем очки
                    $object->Points();
                }else{
                    $_SESSION['text'] = "Вы неправильно ввели название города!";
                }
            }else{
                $test_one = $object->RepeatCity($city);
                $test_two = $object->FirstLetter($city);
                $test_three = $object->RealCity($city);
                
                if($test_one == true && $test_two == true && $test_three == true){
                    //Записываем названный город в список названных
                    $object->Memory($city);

                    $answer = $object->SelectCities($city);

                    foreach ($answer as $key => $value) { 
                        $candidate = $object->RepeatCity($value);
                        if($candidate == true){
                            break;
                        }else{
                            $value = "Система больше не знает городов";
                        }
                    }

                    //Записываем город в список названных
                    $object->Memory($value);

                    $_SESSION['city'] = $value;
                    $_SESSION['text'] = "Введите название города";
                    //Начисляем очки
                    $object->Points();
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

