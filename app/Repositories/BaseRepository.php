<?php

namespace App\Repositories;

abstract class BaseRepository
{
    /**
     * @param $input
     *
     * @return mixed
     */
    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
     * @param $column
     * @param $columnValue
     * @param string $operator
     *
     * @return mixed
     */
    public function where($column, $columnValue, $operator = '=')
    {
        return $this->model->where($column, $operator, $columnValue);
    }
}