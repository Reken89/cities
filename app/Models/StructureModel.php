<?php

namespace App\Models;

class StructureModel
{
    /**
     * Получаем массив городов
     *
     * @param string $city
     * @return array
     */
    public function SelectCities(string $city): array
    {
        $examin = mb_substr($city, -1, 1, "UTF-8");
        if($examin == "ь" || $examin == "ъ" || $examin == "ы" || $examin == "й"){
            $last = mb_substr($city, -2, 1, "UTF-8");
        }else{
            $last = mb_substr($city, -1, 1, "UTF-8");
        }

        $letter = mb_convert_case($last, MB_CASE_TITLE, "UTF-8");        
        $num = 0;
        $cities = [];
        
        //Получаем массив городов на нужную нам букву
        $txt = file("src/cities.txt");      
        for ($a = 0; $a < count($txt); $a++){
            if(mb_substr($txt[$a], 0, 1, "UTF-8") == $letter){
                $cities[$num++] = mb_substr($txt[$a], 0, -2, "UTF-8");
            }
        }
     
        shuffle($cities);
        return $cities;       
    }
    
    /**
     * Записываем в глобальный массив
     * Названный город
     *
     * @param string $city
     * @return 
     */
    public function Memory(string $city)
    {
        if(!isset($_SESSION['named'])){
            $_SESSION['named'] = [];
            $_SESSION['num'] = 0;
        }
        
        $_SESSION['num'] += 1;
        $_SESSION['named'][$_SESSION['num']] = $city;       
    }
    
    /**
     * Записываем в глобальную переменную
     * Начисляем 10 очков
     *
     * @param
     * @return 
     */
    public function Points()
    {
        if(!isset($_SESSION['points'])){
            $_SESSION['points'] = 0;
        }
        $_SESSION['points'] += 10;
    }
    
    /**
     * Выполняем проверку, назывался ли город ранее
     *
     * @param string $city
     * @return bool
     */
    public function RepeatCity(string $city): bool
    {
        foreach ($_SESSION['named'] as $key => $value) { 
            if($value == $city){
                $status = "was";
            }
        }
        
        return isset($status) ? false : true;          
    }
    
    /**
     * Выполняем проверку первой буквы
     * Первая буква должна совпадать
     * с последней буквой города
     * который назвала система
     *
     * @param string $word
     * @return bool
     */
    public function FirstLetter(string $word): bool
    {
        $examin = mb_substr($_SESSION['city'], -1, 1, "UTF-8");
        if($examin == "ь" || $examin == "ъ" || $examin == "ы" || $examin == "й"){
            $last = mb_substr($_SESSION['city'], -2, 1, "UTF-8");
        }else{
            $last = mb_substr($_SESSION['city'], -1, 1, "UTF-8");
        }
        
        $letter = mb_convert_case($last, MB_CASE_TITLE, "UTF-8");
        
        return mb_substr($word, 0, 1, "UTF-8") == $letter ? true : false;           
    }
    
    /**
     * Выполняем проверку
     * Является ли введенное слово городом
     *
     * @param string $city
     * @return bool
     */
    public function RealCity(string $city): bool
    {
        $txt = file("src/cities.txt");      
        for ($a = 0; $a < count($txt); $a++){
            $result = mb_substr($txt[$a], 0, -2, "UTF-8");
            if($result == $city){
                $status = "yes";
                break;
            }
        }
        
        return isset($status) ? true : false;          
    }
}
