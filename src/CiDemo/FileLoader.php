<?php

namespace CiDemo;

class FileLoader
{

    /**
     * @param string $path
     * @return string
     */
    public function load($path)
    {
        return file_get_contents((string)$path);
    }

    /**
     * @param string $path
     * @return string
     */
    public function loadDecoded($path)
    {
        return gzdecode(hex2bin($this->load($path)));
    }

}