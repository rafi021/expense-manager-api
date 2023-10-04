<?php
namespace App\Interfaces;

interface BaseInterface
{
    public function allPaginate($perPage);
    public function all();
    public function store($data);
    public function update($data, $slug);
    public function show($slug);
    public function delete($slug);
}
