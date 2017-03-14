<?php

namespace CiDemo\Converter;

use CiDemo\Model\Model;

use CiModel\Collection as ModelCollection;

interface ConverterInterface
{

    /**
     * @param Model $model
     * @return array
     */
    public function convert(Model $model);

    /**
     * @param ModelCollection $collection
     * @return array
     */
    public function convertCollection(ModelCollection $collection);

}