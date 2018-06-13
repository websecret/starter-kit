<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Models\CustomAttributes\CustomAttributableInterface;
use Illuminate\Http\Request;

abstract class Controller extends BaseController
{
    abstract protected function getModel();

    public function index(Request $request)
    {
        $data = $this->getIndexViewData($request);
        if ($request->ajax()) {
            return $data;
        }
        return view($this->getIndexViewPath(), $data);
    }

    public function form(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        return view($this->getFormViewPath(), $this->getFormViewData($request, $model));
    }

    public function store(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        $this->validateStore($request, $model);
        $model = $this->save($request, $model);
        return $this->actionsAfterSave($request, $model);
    }

    protected function validateStore(Request $request, $model)
    {
        return $this->validate($request, $this->getStoreValidationRules($request, $model));
    }

    protected function getStoreValidationRules(Request $request, $model)
    {
        return [];
    }

    protected function save(Request $request, $model)
    {
        $data = $this->getDataFromSaveRequest($request);
        $model->fill($data)->save();
        if ($model instanceof CustomAttributableInterface) {
            $model->saveCustomAttributes(array_get($data, 'custom_attributes', []));
        }
        return $model;
    }

    protected function getDataFromSaveRequest(Request $request)
    {
        return $request->all();
    }

    public function delete(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        $model->delete();
        return $this->actionsAfterDelete($request);
    }

    public function fast(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        $model->update([$request->input('name') => $request->input('value')]);
        return $this->actionsAfterFast($request, $model);
    }

    protected function actionsAfterSave(Request $request, $model)
    {
        $redirect = redirect($this->redirectToAfterSave($model));
        $message = $this->getSaveSuccessMessage();
        if ($request->ajax()) {
            return array_merge([
                'result' => 'success'
            ], $message ? [
                'message' => $message,
            ] : []);
        }
        if ($message) {
            $redirect->with('message-success', $message);
        }
        return $redirect;
    }

    protected function actionsAfterFast(Request $request, $model)
    {
        $message = $this->getFastSuccessMessage();
        return array_merge([
            'result' => 'success'
        ], $message ? [
            'message' => $message,
        ] : []);
    }

    protected function redirectToAfterSave($model)
    {
        return \URL::previous();
    }

    protected function actionsAfterDelete(Request $request)
    {
        $redirect = redirect($this->redirectToAfterDelete());
        $message = $this->getDeleteSuccessMessage();
        if ($request->ajax()) {
            return array_merge([
                'result' => 'success'
            ], $message ? [
                'message' => $message,
            ] : []);
        }
        if ($message) {
            $redirect->with('message-success', $message);
        }
        return $redirect;
    }

    protected function redirectToAfterDelete()
    {
        return \URL::previous();
    }

    protected function getSaveSuccessMessage()
    {
        return __('messages.save.success');
    }

    protected function getFastSuccessMessage()
    {
        return __('messages.fast.success');
    }

    protected function getDeleteSuccessMessage()
    {
        return __('messages.delete.success');
    }

    protected function getModelInstance($model)
    {
        $modelClass = $this->getModel();
        if (is_null($model)) {
            $model = new $modelClass();
        }
        if (!($model instanceof $modelClass)) {
            $model = (new $modelClass)->resolveRouteBinding($model);
        }
        return $model;
    }

    protected function getModelVariableName()
    {
        return class_basename($this->getModel());
    }

    protected function getViewsPath()
    {
        $namespace = str_replace('App\Models\\', '', $this->getModel());
        $parts = explode('\\', $namespace);
        $routeParts = array_map(function ($part) {
            return kebab_case(str_plural($part));
        }, $parts);
        return 'admin.' . implode('.', $routeParts);
    }

    protected function getIndexViewPath()
    {
        return $this->getViewsPath() . '.index';
    }

    protected function getIndexViewData(Request $request)
    {
        $modelClass = $this->getModel();
        $items = $modelClass::query()->with($this->getRelations())->latest()->paginate();
        return [
            str_plural(camel_case($this->getModelVariableName())) => $items,
        ];
    }

    protected function getRelations()
    {
        return [];
    }

    protected function getFormViewPath()
    {
        return $this->getViewsPath() . '.form';
    }

    protected function getFormViewData(Request $request, $model)
    {
        $data = [
            camel_case($this->getModelVariableName()) => $model,
        ];

        return $data;
    }
}