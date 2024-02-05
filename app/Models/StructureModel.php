<?php

namespace App\Models;

class StructureModel
{
    /**
     * Получаем массив городов
     *
     * @param string $letter
     * @return render()
     */
    public function city(string $letter)
    {
        $num = 0;
        $cities = [];
        
        //Получаем массив городов на нужную нам букву
        $txt = file("src/cities.txt");      
        for ($a = 0; $a < count($txt); $a++){
            if(mb_substr($txt[$a], 0, 1, "UTF-8") == $letter){
                $cities[$num++] = substr($txt[$a], 0, -1);
            }
        }
     
        shuffle($cities);
        return $cities;
       
    }
    
    /**
     * Выполняем проверку, назывался ли город ранее
     *
     * @param string $candidate
     * @return render()
     */
    public function choise(string $candidate)
    {
        foreach ($_SESSION['named'] as $key => $value) {            
            if($value == $candidate){
                $status = "was";
            }
        }
        
        if(isset($status)){
            return false;
        }else{
            return $candidate;
        }
           
    }
}
