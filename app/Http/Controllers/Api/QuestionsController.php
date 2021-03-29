<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QuestionsController extends Controller
{
    private $endpoint;

    public function __invoke(QuestionsRequest $request)
    {
        $data = $request->validated();
        $this->endpoint = Http::get('https://api.stackexchange.com/2.2/questions?order=desc&sort=activity&site=stackoverflow&tagged=' . $data['tagged']);

        return $this->endpoint->json();
    }
}
