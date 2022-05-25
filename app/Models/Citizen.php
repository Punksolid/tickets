<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    private $questions = [];

    public function addResponse(int $question_id, string $response)
    {
        return $this->questions[$question_id] = $response;
    }
    public function getResponses(): array
    {
        return $this->questions ?? [];
    }

    public function getResponse(int $question_id): ?string
    {
        return $this->questions[$question_id] ?? null;
    }

}
