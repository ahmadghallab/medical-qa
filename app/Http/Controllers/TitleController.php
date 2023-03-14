<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTitleRequest;
use App\Http\Requests\UpdateTitleRequest;
use App\Services\TitleService;

class TitleController extends Controller
{

    public function __construct(
        protected TitleService $title,
    ) {
    }

    public function index()
    {
        return $this->title->index();
    }

    public function indexByTopic(string $topicId)
    {
        return $this->title->indexByTopic($topicId);
    }

    public function store(StoreTitleRequest $request)
    {
        return $this->title->create($request);
    }

    public function show(string $id)
    {
        return $this->title->show($id);
    }

    public function update(UpdateTitleRequest $request, string $id)
    {
        return $this->title->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->title->delete($id);
    }
}
