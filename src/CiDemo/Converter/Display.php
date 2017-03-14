<?php

namespace CiDemo\Converter;

use CiDemo\Model\Model;

use CiModel\Collection as ModelCollection;

class Display extends Converter implements ConverterInterface
{

    /**
     * @param Model $model
     * @return array
     */
    public function convert(Model $model)
    {
        $data = array(
            'id' => $model->getId(),
            'firstname' => $model->get('firstname'),
            'lastname' => $model->get('lastname')
        );
        return $data;
    }

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
        return array('user' => $data); /** @see non-empty list in Mustache */
    }
    
}