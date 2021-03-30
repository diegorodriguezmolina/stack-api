<?php

namespace Tests\Feature;

use Tests\TestCase;

class QuestionsTest extends TestCase
{
    private $header = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];
    private $endpoint = 'api/questions';

    public function testRequiredFieldsForGetQuestions()
    {
        $this->json('GET', $this->endpoint, $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "tagged" => ["The tagged field is required."]
                ]
            ]);
    }

    public function testSuccessfulRequest()
    {
        $params = 'tagged=react&todate=2021-03-12&fromdate=2020-09-12';
        $this->json('GET', $this->endpoint . '?' . $params, $this->header)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    "items" => [
                        [
                            'tags',
                            'owner',
                            'is_answered',
                            'view_count',
                            'answer_count',
                            'score',
                            'last_activity_date',
                            'creation_date',
                            'question_id',
                            'content_license',
                            'link',
                            'title'
                        ],
                    ],
                ]
            );
    }

    public function testIncorrectFromDateParam()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromdate=224020-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromdate" => ["The fromdate is not a valid date."]
                ]
            ]);
    }

    public function testIncorrectFromDateParamFormat()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromdate=2020/09/12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromdate" => ["The fromdate does not match the format Y-m-d."]
                ]
            ]);
    }

    public function testIncorrectFromDateParamAfterToday()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromdate=2021-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromdate" => ["The fromdate must be a date before tomorrow."]
                ]
            ]);
    }

    public function testIncorrectToDateParam()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&todate=224020-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "todate" => ["The todate is not a valid date."]
                ]
            ]);
    }

    public function testIncorrectToDateParamFormat()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&todate=2020/09/12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "todate" => ["The todate does not match the format Y-m-d."]
                ]
            ]);
    }

    public function testIncorrectToDateParamAfterToday()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&todate=2021-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "todate" => ["The todate must be a date before tomorrow."]
                ]
            ]);
    }
}
