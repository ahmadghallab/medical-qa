<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Services\TopicService;

class TopicController extends Controller
{

    public function __construct(
        protected TopicService $topic,
    ) {
    }

    public function index()
    {
        return $this->topic->index();
    }

    public function indexByBranch(string $branchId)
    {
        return $this->topic->indexByBranch($branchId);
    }

    public function store(StoreTopicRequest $request)
    {
        return $this->topic->create($request);
    }

    public function show(string $id)
    {
        return $this->topic->show($id);
    }

    public function update(UpdateTopicRequest $request, string $id)
    {
        return $this->topic->update($request, $id);
    }

    public function destroy(string $id)
    {
        return $this->topic->delete($id);
    }
}
