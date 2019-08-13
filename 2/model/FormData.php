<?php

class FormData
{
    private $arr;
    private $ready;
    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function validateForm()
    {
        $data = $this->arr;
        foreach ($data as $key=>$value){
            $this->ready[$key] = htmlentities($value);
        }
        $this->ready["datetime"] = $this->getCurrentDate();
    }

    public function getData()
    {
        return $this->ready;
    }

    private function getCurrentDate()
    {
        $date = date("Y-m-d G:i:s");
        return $date;
    }

}


