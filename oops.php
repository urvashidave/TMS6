<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MyClass
{
    public $prop1 = "I am a class property";
    public function setProperty($newval)
    {
        $this->prop1 = $newval;
        
    }
    public function getProperty()
    {
        return $this->prop1;
    }
}   
    //create two object 
    $obj = new MyClass;
    $obj2 = new MyClass;
    
    //get the value of prop1 from both the object
    echo $obj->getProperty();
    echo $obj2->getProperty();
    
    $obj->setProperty("I am new value1");
    $obj2->setProperty("I am new value2");
    
    //output of both prop1 
    
    echo $obj->getProperty();
    echo $obj2->getProperty();
    
?>
    
