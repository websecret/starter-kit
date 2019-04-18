<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;
use App\Models\CustomAttributes\CustomAttributableInterface;
use App\Services\Model\Admin as AdminModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

abstract class Controller extends BaseController
{
    abstract protected function getModel();

    protected $canAdd = true;
    protected $canEdit = true;
    protected $canDelete = true;
    protected $canOrder = false;
    protected $paginateIndex = true;
    protected $redirectAfterSave = true;
    protected $count = false;
    protected $defaultOrderColumn = 'created_at';
    protected $defaultOrderDirection = 'desc';

    protected $adminModelService;

    public function __construct()
    {
        $this->adminModelService = new AdminModel($this->getModel());
    }

    public function index(Request $request)
    {
        $data = $this->getIndexViewData($request);
        if ($request->ajax()) {
            return $data;
        }
        return view($this->getIndexViewPath(), $data);
    }

    public function order(Request $request)
    {
        $data = $this->getOrderViewData($request);
        return view($this->getOrderViewPath(), $data);
    }

    public function reorder(Request $request)
    {
        $this->reorderActions($request);
        return $this->actionsAfterReorder($request);
    }

    public function form(Request $request, $model = null)
    {
        $model = $this->getModelInstance($model);
        return view($this->getFormViewPath(), $this->getFormViewData($request, $model));
    }

    public function show(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        return view($this->getShowViewPath(), $this->getShowViewData($request, $model));
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
        return $this->validate($request, $this->getStoreValidationRules($request, $model), [], __('labels'));
    }

    protected function getStoreValidationRules(Request $request, $model)
    {
        $rules = [];
        $fillable = collect($model->getFillable());

        if ($fillable->contains('slug')) {
            $rules['slug'] = 'required';
        }

        if ($fillable->contains('slug')) {
            $rules['slug'] = [
                'required',
                Rule::unique($model->getTable())->ignoreModel($model)
            ];
        }

        return $rules;
    }

    protected function save(Request $request, $model)
    {
        $data = $this->getDataFromSaveRequest($request, $model);
        $this->fillModelBeforeSave($model, $data)->save();
        if ($model instanceof CustomAttributableInterface) {
            $model->saveCustomAttributes(array_get($data, 'custom_attributes', []));
        }
        return $model;
    }

    protected function fillModelBeforeSave($model, $data)
    {
        $model->fill($data);
        return $model;
    }

    protected function getDataFromSaveRequest(Request $request, $model)
    {
        $data = $request->all();
        if ($this->canOrder && !$model->exists) {
            $modelClass = $this->getModel();
            $data[$this->getOrderFieldName()] = $modelClass::query()->count() ? ($modelClass::query()->max($this->getOrderFieldName()) + 1) : 0;
        }
        return $data;
    }

    public function delete(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        $this->deleteActions($request, $model);
        return $this->actionsAfterDelete($request);
    }

    public function fast(Request $request, $model)
    {
        $model = $this->getModelInstance($model);
        $model = $this->fastActions($request, $model);
        return $this->actionsAfterFast($request, $model);
    }

    protected function actionsAfterSave(Request $request, $model)
    {
        $redirect = redirect($this->redirectToAfterSave($model));
        $message = $this->getSaveSuccessMessage();
        if ($request->ajax()) {
            return $this->ajaxDataAfterSave($model, $message);
        }
        if ($message) {
            $redirect->with('message-success', $message);
        }
        if($this->redirectAfterSave) {
            return $redirect;
        }
    }

    protected function ajaxDataAfterSave($model, $message)
    {
        return array_merge([
            'result' => 'success',
            'entity' => $this->adminModelService->getViewsName(),
            'id' => $model->{$model->getKeyName()},
            'redirect' => $this->redirectAfterSave ? true : false,
        ], $message ? [
            'message' => $message,
        ] : []);
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

    protected function getViewsPath()
    {
        return $this->adminModelService->getViewsPath();
    }

    protected function getSectionPath()
    {
        return $this->adminModelService->getSectionPath();
    }

    protected function getRouteName()
    {
        return 'admin.' . $this->adminModelService->getRouteName();
    }

    protected function getIndexViewPath()
    {
        return $this->getViewsPath() . '.index';
    }

    protected function getIndexViewData(Request $request)
    {
        return array_merge(
            $this->getIndexViewModelData($request),
            $this->getIndexViewAdditionalData($request),
            $this->getIndexViewFilterData($request)
        );
    }

    protected function getIndexViewModelData(Request $request)
    {
        $modelClass = $this->getModel();
        $query = $this->prepareQueryForIndex($modelClass::query(), $request)->with($this->getRelations());
        $toAppends = [];
        if (method_exists($modelClass, 'scopeFilter')) {
            $toAppends['filter'] = $request->input('filter', []);
            $query->filter($request->input('filter', []));
        }

        if (method_exists($modelClass, 'scopeCustomOrderBy')) {
            $sortBy = $request->input('sort_by', $this->defaultOrderColumn);
            $sortDirection = $request->input('sort_direction', $this->defaultOrderDirection);

            $toAppends['sort_by'] = $sortBy;
            $toAppends['sort_direction'] = $sortDirection;

            $query->customOrderBy($sortBy, $sortDirection);
        } else {
            $query->orderBy($this->defaultOrderColumn, $this->defaultOrderDirection);
        }

        $items = $this->paginateIndex ? $query->paginate()->appends($toAppends) : $query->get();
        return [
            $this->adminModelService->getViewsPluralName() => $items,
        ];
    }

    protected function prepareQueryForIndex($query, Request $request)
    {
        return $query;
    }

    protected function getIndexViewAdditionalData(Request $request)
    {
        return [
            'canAdd' => $this->canAdd,
            'canEdit' => $this->canEdit,
            'canDelete' => $this->canDelete,
            'canOrder' => $this->canOrder,
            'paginate' => $this->paginateIndex,
            'count' => $this->count,
            'defaultSortBy' => $this->defaultOrderColumn,
            'defaultSortDirection' => $this->defaultOrderDirection,
            'sectionPath' => $this->getSectionPath(),
            'routeName' => $this->getRouteName(),
        ];
    }

    protected function getIndexViewFilterData(Request $request)
    {
        return [];
    }

    protected function getOrderViewPath()
    {
        return $this->getViewsPath() . '.order';
    }

    protected function getOrderViewData(Request $request)
    {
        return array_merge(
            $this->getOrderViewModelData($request),
            $this->getOrderViewAdditionalData($request)
        );
    }

    protected function getOrderViewModelData(Request $request)
    {
        $modelClass = $this->getModel();
        $items = $modelClass::query()->orderBy($this->getOrderFieldName())->get();
        return [
            $this->adminModelService->getViewsPluralName() => $items,
        ];
    }

    protected function getOrderViewAdditionalData(Request $request)
    {
        return [
            'sectionPath' => $this->getSectionPath(),
            'routeName' => $this->getRouteName(),
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
        return array_merge(
            $this->getFormViewModelData($request, $model),
            $this->getFormViewAdditionalData($request, $model)
        );
    }

    protected function getShowViewPath()
    {
        return $this->getViewsPath() . '.show';
    }

    protected function getShowViewData(Request $request, $model)
    {
        return [
            $this->adminModelService->getViewsName() => $model,
            'sectionPath' => $this->getSectionPath(),
        ];
    }

    protected function getFormViewModelData(Request $request, $model)
    {
        $data = [
            $this->adminModelService->getViewsName() => $model,
        ];
        return $data;
    }

    protected function getFormViewAdditionalData(Request $request, $model)
    {
        return [
            'sectionPath' => $this->getSectionPath(),
            'routeName' => $this->getRouteName(),
        ];
    }

    protected function deleteActions(Request $request, $model)
    {
        $model->delete();
    }

    protected function fastActions(Request $request, $model)
    {
        $model->update([$request->input('name') => $request->input('value')]);
        return $model;
    }

    protected function getOrderFieldName()
    {
        return 'order';
    }

    protected function actionsAfterReorder(Request $request)
    {
        $message = $this->getReorderSuccessMessage();
        return array_merge([
            'result' => 'success'
        ], $message ? [
            'message' => $message,
        ] : []);
    }

    protected function reorderActions(Request $request)
    {
        $data = $request->input('data', []);
        foreach ($data as $order => $value) {
            $modelClass = $this->getModel();
            $modelClass::find($value['id'])->update([$this->getOrderFieldName() => $order]);
        }
    }

    protected function getReorderSuccessMessage()
    {
        return __('messages.reorder.success');
    }

    public function ajaxSelect(Request $request)
    {
        $q = trim($request->input('q', ''));
        if ($q == '') return [];
        $modelClass = $this->getModel();
        $items = $modelClass::query()->ajaxSelect($q)->latest()->take(20)->get();
        return $items->map(function ($item) {
            return [
                'key' => $item->{$item->getKeyName()},
                'value' => data_get($item, static::getAjaxSelectValueField()),
            ];
        });
    }

    protected static function getAjaxSelectValueField()
    {
        return 'title';
    }

    public static function getAjaxSelectValue($model = null)
    {
        if (!$model) return [];
        return [
            $model->{$model->getKeyName()} => $model->{static::getAjaxSelectValueField()},
        ];
    }
}