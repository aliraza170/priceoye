<?php

namespace App\Http\Controllers\Api\V1;

use App\Expenses;
use App\Http\Controllers\Controller;
use App\Http\Resources\Expenses as ExpensesResource;
use App\Http\Requests\Admin\StoreExpensesRequest;
use App\Http\Requests\Admin\UpdateExpensesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ExpensesController extends Controller
{
    public function index()
    {
        if (Gate::denies('expenses_access') && Gate::denies('user_access')) {
            return abort(401);
        }
		
		$user_id = \Auth::user()->id;
        return new ExpensesResource(Expenses::select('expenses.*','categories.name as cat_name')
		->join('categories', 'categories.id', '=', 'expenses.category_id')
		->where('expenses.user_id', $user_id)
		->get());
    }

    public function show($id)
    {
        if (Gate::denies('expenses_view')) {
            return abort(401);
        }

       // $expenses = Expenses::with(['categories'])->findOrFail($id);
		$user_id = \Auth::user()->id;
        return new ExpensesResource(Expenses::select('expenses.*','categories.name as cat_name')
		->join('categories', 'categories.id', '=', 'expenses.category_id')
		->where('expenses.user_id', $user_id)
		->where('expenses.id', $id)
		->get()->first());
        return new ExpensesResource($expenses);
    }

    public function store(StoreExpensesRequest $request)
    {
        if (Gate::denies('expenses_create')) {
            return abort(401);
        }
		
        //$expenses = Expenses::create($request->all());
       // $expenses->permission()->sync($request->input('categories', []));
	   
	   $expenses = new Expenses();
	   $expenses->user_id = \Auth::user()->id;
	   $expenses->amount = $request->input('amount');
	   $expenses->category_id = $request->input('category_id');
	   $expenses->save();
        

        return (new ExpensesResource($expenses))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateExpensesRequest $request, $id)
    {
        if (Gate::denies('expenses_edit')) {
            return abort(401);
        }

        $expenses = Expenses::findOrFail($id);
        $expenses->update($request->all());
        $expenses->permission()->sync($request->input('categories', []));
        
        

        return (new ExpensesResource($expenses))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('expenses_delete')) {
            return abort(401);
        }

        $expenses = Expenses::findOrFail($id);
        $expenses->delete();

        return response(null, 204);
    }
}
