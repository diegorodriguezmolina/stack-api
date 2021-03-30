<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionsRequest;
use Illuminate\Support\Facades\Http;

class QuestionsController extends Controller
{
    private $endpoint;

    public function __invoke(QuestionsRequest $request)
    {

        $data = $request->validated();
        $params = '&tagged=' . $data['tagged'];
        $params .= empty($data['fromdate']) ? "" : '&fromdate=' . $data['fromdate'];
        $params .= empty($data['todate']) ? "" : '&todate=' . $data['todate'];

        $this->endpoint = Http::get('https://api.stackexchange.com/2.2/questions?order=desc&sort=activity&site=stackoverflow' . $params);

        return $this->endpoint->json();

    }
}
