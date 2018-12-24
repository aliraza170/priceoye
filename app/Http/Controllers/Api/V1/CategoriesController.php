<?php

namespace App\Http\Controllers\Api\V1;

use App\Categories;
use App\Http\Controllers\Controller;
use App\Http\Resources\Categories as CategoriesResource;
use App\Http\Requests\Admin\StoreCategoriesRequest;
use App\Http\Requests\Admin\UpdateCategoriesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class CategoriesController extends Controller
{
    public function index()
    {
        if (Gate::denies('categories_access') && Gate::denies('user_access')) {
            return abort(401);
        }

        return new CategoriesResource(Categories::get());
    }

    public function show($id)
    {
        if (Gate::denies('categories_view')) {
            return abort(401);
        }
        $categories = Categories::findOrFail($id);

        return new CategoriesResource($categories);
    }

    public function store(StoreCategoriesRequest $request)
    {
		//dd($request);
        if (Gate::denies('categories_create')) {
			//exit('you do not have permission');
            return abort(401);
        }
        $categories = Categories::create($request->all());
		//$role->permission()->sync($request->input('permission', []));
        return (new CategoriesResource($categories))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateCategoriesRequest $request, $id)
    {
		//exit('here');
        if (Gate::denies('categories_edit')) {
            return abort(401);
        }
        $categories = Categories::findOrFail($id);
        $categories->update($request->all());
       // $role->permission()->sync($request->input('permission', []));
        
        

        return (new CategoriesResource($categories))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('categories_delete')) {
            return abort(401);
        }

        $categories = Categories::findOrFail($id);
        $categories->delete();

        return response(null, 204);
    }
}
