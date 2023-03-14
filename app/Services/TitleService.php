<?php

namespace app\Services;

use App\Http\Requests\StoreTitleRequest;
use App\Http\Requests\UpdateTitleRequest;
use App\Http\Resources\TitleCollection;
use App\Models\Title;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class TitleService
{
  public function index()
  {
    $titles = new TitleCollection(Title::paginate());

    return response()->success(200, $titles);
  }

  public function indexByTopic(string $topicId)
  {
    $titlesByTopic = new TitleCollection(Title::where('topic_id', $topicId)->paginate());

    return response()->success(200, $titlesByTopic);
  }

  public function show(string $id)
  {
    try {
      $title = Title::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    return response()->success(200, $title);
  }

  public function create(StoreTitleRequest $request)
  {

    try {
      $validated = $request->validated();
      $title = Title::create($validated);
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not create'));
    }

    return response()->success(201, $title);
  }

  public function update(UpdateTitleRequest $request, string $id)
  {
    try {
      $title = Title::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $title->fill($request->all())->save();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not update'));
    }

    return response()->success(200, $title);
  }

  public function delete(string $id)
  {
    try {
      $title = Title::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $title->delete();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not delete'));
    }

    return response()->success(200, $title);
  }
}
