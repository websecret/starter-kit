<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use FormBuilder;

abstract class Controller extends BaseController
{
    abstract protected function getModel();

    public function index(Request $request)
    {
        $data = $this->getIndexViewData($request);
//        if ($request->ajax()) {
//            return $data;
//        }
        return view($this->getIndexViewPath(), $this->getIndexViewData($request));
    }

    public function form(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        return view($this->getFormViewPath(), $this->getFormViewData($request, $model));
    }

    public function store(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        if ($form = $this->getForm($request, $model)) {
            if (! $form->isValid()) {
                return ['result' => 'error', 'errors' => $form->getErrors()];
            }
        }
        $model = $this->save($request, $model);
        return $this->actionsAfterSave($request, $model);
    }

    protected function save(Request $request, $model)
    {
        $model->fill($request->all())->save();
        return $model;
    }

    public function delete(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        $model->delete();
        return $this->actionsAfterDelete($request);
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
        return 'admin.' . str_plural(kebab_case($this->getModelVariableName()));
    }

    protected function getIndexViewPath()
    {
        return $this->getViewsPath() . '.index';
    }

    protected function getIndexViewData(Request $request)
    {
        $modelClass = $this->getModel();
        $items = $modelClass::query()->latest()->paginate();
        return [
            str_plural(kebab_case($this->getModelVariableName())) => $items,
        ];
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
        if ($form = $this->getForm($request, $model)) {
            $data['form'] = $this->getForm($request, $model);
        }
        return $data;
    }

    protected function getForm(Request $request, $model)
    {
        return FormBuilder::create($this->getFormClass(), [
            'model' => $model,
            'language_name' => 'labels',
        ]);
    }

    protected function getFormClass()
    {
        return '\\App\\Forms\\' . $this->getModelVariableName() . 'Form';
    }
}