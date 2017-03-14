<?php

namespace CiDemo;

use CiDemo\Model\Factory as ModelFactory;
use CiDemo\Converter\Factory as ConverterFactory;

use CI_DB_driver;
use CI_Cache;

class FactoryFactory
{
    
    /**
     * @param CI_DB_driver $db
     * @param CI_Cache $cache
     * @return ModelFactory
     */
    public function createModelFactory(CI_DB_driver $db, CI_Cache $cache)
    {
        return new ModelFactory($db, $cache);
    }

    /**
     * @return ConverterFactory
     */
    public function createConverterFactory()
    {
        return new ConverterFactory();
    }

    /**
     * @return FileLoader
     */
    public function createFileLoader()
    {
        return new FileLoader();
    }
}