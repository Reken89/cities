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
        
        $txt = file("src/cities.txt");
        foreach ($txt as $key => $value) {
            if(mb_substr($value, 0, 1, "UTF-8") == $letter){
                $cities[$num++] = $value;
            }
        }
        var_dump($_SESSION['named']);
    }
}
