<?php

namespace CiDemo\Converter;

class Factory
{

    /**
     * @return Json
     */
    public function createJson()
    {
        return new Json();
    }

    /**
     * @return Display
     */
    public function createDisplay()
    {
        return new Display();
    }
    
}