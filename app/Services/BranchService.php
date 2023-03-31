<?php

namespace app\Services;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchCollection;
use App\Models\Branch;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BranchService
{
  public function index()
  {
    $branches = new BranchCollection(Branch::paginate(25));

    return response()->success(200, $branches);
  }

  public function show(string $id)
  {
    try {
      $branch = Branch::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    return response()->success(200, $branch);
  }

  public function create(StoreBranchRequest $request)
  {
    try {
      $validated = $request->validated();
      $branch = Branch::create($validated);
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not create'));
    }

    return response()->success(201, $branch);
  }

  public function update(UpdateBranchRequest $request, string $id)
  {
    try {
      $branch = Branch::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $branch->fill($request->all())->save();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not update'));
    }

    return response()->success(200, $branch);
  }

  public function delete(string $id)
  {
    try {
      $branch = Branch::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $branch->delete();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not delete'));
    }

    return response()->success(200, $branch);
  }
}
