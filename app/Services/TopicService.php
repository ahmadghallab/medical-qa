<?php

namespace app\Services;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicCollection;
use App\Models\Topic;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class TopicService
{
  public function index()
  {
    $topics = new TopicCollection(Topic::paginate());

    return response()->success(200, $topics);
  }

  public function indexByBranch(string $branchId)
  {
    $topicsByBranch = new TopicCollection(Topic::where('branch_id', $branchId)->paginate());

    return response()->success(200, $topicsByBranch);
  }

  public function show(string $id)
  {
    try {
      $topic = Topic::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    return response()->success(200, $topic);
  }

  public function create(StoreTopicRequest $request)
  {

    try {
      $validated = $request->validated();
      $topic = Topic::create($validated);
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not create'));
    }

    return response()->success(201, $topic);
  }

  public function update(UpdateTopicRequest $request, string $id)
  {
    try {
      $topic = Topic::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $topic->fill($request->all())->save();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not update'));
    }

    return response()->success(200, $topic);
  }

  public function delete(string $id)
  {
    try {
      $topic = Topic::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $topic->delete();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not delete'));
    }

    return response()->success(200, $topic);
  }
}
