<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Services\QuestionService;

class QuestionController extends Controller
{

    public function __construct(
        protected QuestionService $question,
    ) {
    }

    public function index()
    {
        return $this->question->index();
    }

    public function indexByTitle(string $titleId)
    {
        return $this->question->indexByTitle($titleId);
    }

    public function store(StoreQuestionRequest $request)
    {
        return $this->question->create($request);
    }

    public function show(string $id)
    {
        return $this->question->show($id);
    }

    public function update(UpdateQuestionRequest $request, string $id)
    {
        return $this->question->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->question->delete($id);
    }
}
