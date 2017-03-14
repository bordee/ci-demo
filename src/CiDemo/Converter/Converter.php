<?php

namespace CiDemo\Converter;

use CiDemo\Model\Model;

use CiModel\Collection as ModelCollection;

abstract class Converter implements ConverterInterface
{

    /**
     * @param Model $model
     * @return array
     */
    abstract public function convert(Model $model);

    /**
     * @param ModelCollection $collection
     * @return array
     */
    public function convertCollection(ModelCollection $collection)
    {
        $data = array();
        foreach($collection as $model) {
            $data[] = $this->convert($model);
        }
        return $data;
    }

}