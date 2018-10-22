<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

abstract class NestedsetController extends Controller
{
    protected $canOrder = true;
    protected $paginateIndex = false;

    protected function getIndexViewModelData(Request $request)
    {
        $modelClass = $this->getModel();
        $items = $modelClass::query()->with($this->getRelations())->defaultOrder()->get()->toTree();
        return [
            $this->adminModelService->getViewsPluralName() => $items,
        ];
    }

    protected function getOrderViewModelData(Request $request)
    {
        $modelClass = $this->getModel();
        $items = $modelClass::query()->with($this->getRelations())->defaultOrder()->get()->toTree();
        return [
            $this->adminModelService->getViewsPluralName() => $items,
        ];
    }

    protected function save(Request $request, $model)
    {
        $model = parent::save($request, $model);
        $modelClass = $this->getModel();
        $modelClass::fixTree();
        return $model;
    }

    protected function getDataFromSaveRequest(Request $request, $model)
    {
        return $request->all();
    }

    protected function fillModelBeforeSave($model, $data)
    {
        $model = parent::fillModelBeforeSave($model, $data);
        $model->parent_id = array_get($data, 'parent_id');
        return $model;
    }

    protected function reorderActions(Request $request)
    {
        $data = $request->input('data');
        $modelClass = $this->getModel();
        $modelClass::rebuildTree($data);
    }

    protected function deleteActions(Request $request, $model)
    {
        parent::deleteActions($request, $model);
        $modelClass = $this->getModel();
        $modelClass::fixTree();
    }
}