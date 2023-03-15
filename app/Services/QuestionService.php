<?php

namespace app\Services;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Models\Question;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;

class QuestionService
{
  public function index()
  {
    $questions = new QuestionCollection(Question::paginate());

    return response()->success(200, $questions);
  }

  public function indexByTitle(string $titleId)
  {
    $questionsByTitle = new QuestionCollection(Question::where('title_id', $titleId)->paginate());

    return response()->success(200, $questionsByTitle);
  }

  public function show(string $id)
  {
    try {
      $question = Question::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    return response()->success(200, $question);
  }

  public function create(StoreQuestionRequest $request)
  {

    try {
      $validated = $request->validated();
      $question = Question::create($validated);
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not create'));
    }

    return response()->success(201, $question);
  }

  public function update(UpdateQuestionRequest $request, string $id)
  {
    try {
      $question = Question::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $question->fill($request->all())->save();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not update'));
    }

    return response()->success(200, $question);
  }

  public function delete(string $id)
  {
    try {
      $question = Question::FindOrFail($id);
    } catch (ModelNotFoundException $e) {
      throw new HttpResponseException(response()->error(404, 'Not found'));
    }

    try {
      $question->delete();
    } catch (\Exception $e) {
      throw new HttpResponseException(response()->error(500, 'Could not delete'));
    }

    return response()->success(200, $question);
  }
}
