<?php

namespace App\Services;

use App\Interfaces\AiGeneratedTextInterface;

class ClinetServeAIText
{
    private $aiTextService;
    public function __construct(AiGeneratedTextInterface $aiTextService)
    {
        $this->aiTextService = $aiTextService;
    }

    public function getAiText()
    {
        return $this->aiTextService->getAiGeneratedText();
    }
}
