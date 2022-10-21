<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface RepositoryCrudInterface
{
    public function all();

    public function add($data);

    public function delete(Model $model);

    public function show(Model $model);

}
