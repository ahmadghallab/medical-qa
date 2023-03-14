<?php

namespace app\Repositories;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicCollection;
use App\Interfaces\TopicInterface;
use App\Models\Topic;

class TopicRepository implements TopicInterface
{
  public function getAllTopics()
  {
    $topics = new TopicCollection(Topic::paginate());

    return response()->success(200, $topics);
  }

  public function getTopicById(int $id)
  {
  }

  public function storeTopic(StoreTopicRequest $request)
  {
    $validated = $request->validated();

    $topic = Topic::create($validated);

    return response()->success(201, $topic);
  }

  public function updateTopic(UpdateTopicRequest $request, int $id)
  {
  }

  public function deleteTopic(int $id)
  {
  }
}
