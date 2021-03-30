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
        $params = 'tagged=react&toDate=2021-03-12&fromDate=2020-09-12';
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

    public function testIncorrectDate()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromDate=224020-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromDate" => ["The from date is not a valid date."]
                ]
            ]);
    }

    public function testIncorrectFormatDate()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromDate=2020/09/12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromDate" => ["The from date does not match the format Y-m-d."]
                ]
            ]);
    }

    public function testIncorrectDateAfterToday()
    {
        $this->json('GET', $this->endpoint . '?tagged=react&fromDate=2021-09-12', $this->header)
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fromDate" => ["The from date must be a date before tomorrow."]
                ]
            ]);
    }
}
