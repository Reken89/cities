<?php

namespace App\Models;

class StructureModel
{
    /**
     * Получаем город из списка
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

        //Выбираем из массива, город который ранее не назывался
        for ($i = 0; $i < count($cities); $i++) {
            foreach ($_SESSION['named'] as $key => $value) {
                
                if($value == $cities[$i]){
                    $variant = "yes";
                }
            }
            if(!isset($variant)){
                $cert = $i;
                $variant = "no";
                break;
            }
        }
        
        if($variant == "yes"){
            return false;
        }else{
            return $cities[$i];
        }
       
    }
}
