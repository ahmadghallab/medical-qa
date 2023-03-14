<?php

namespace App\Interfaces;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;

interface TopicInterface
{
  public function getAllTopics();

  public function getTopicById(int $id);

  public function storeTopic(StoreTopicRequest $request);

  public function updateTopic(UpdateTopicRequest $request, int $id);

  public function deleteTopic(int $id);
}
