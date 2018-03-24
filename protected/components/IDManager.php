<?php
class IDManager{
    public static function genDisplayId($nameId){
        $settingModel = Setting::model()->findByPk($nameId);
        
        $newValue = str_pad($settingModel->value+1, 4, "0", STR_PAD_LEFT);
        $settingModel->value = $newValue;
        $settingModel->save();
        
        return $newValue;
    }
    public static function getYearMonth(){
        $year = date('Y')+543;
        $year = substr($year, -2);
        $month = date('m');
        return $year.$month;
    }
}