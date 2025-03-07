<?php

namespace App\Services;

class UserGetAIText
{
    public $clientServeAIText;
    public function __construct(ClinetServeAIText $clientServeAIText)
    {
        $this->clientServeAIText = $clientServeAIText;
    }

    public function getUserText()
    {
        return $this->clientServeAIText->getAiText();
    }
}
