<?php

namespace CiDemo\Converter;

use CiDemo\Model\Model;

use CiModel\Collection as ModelCollection;

class Json extends Converter implements ConverterInterface
{

    /**
     * @param Model $model
     * @return array
     */
    public function convert(Model $model)
    {
        return $this->toJson($this->doConversion($model));
    }

    /**
     * @param ModelCollection $collection
     * @return array
     */
    public function convertCollection(ModelCollection $collection)
    {
        $data = array();
        foreach($collection as $model) {
            $data[] = $this->doConversion($model);
        }
        return $this->toJson($data);
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function doConversion(Model $model)
    {
        return array(
            'id' => $model->getId(),
            'full_name' => $model->get('firstname') . ' ' . $model->get('lastname')
        );
    }

    /**
     * @param array $data
     * @return string
     */
    protected function toJson(array $data)
    {
        return json_encode($data);
    }
}