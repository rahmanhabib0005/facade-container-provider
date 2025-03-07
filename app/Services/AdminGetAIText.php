<?php

namespace App\Services;

class AdminGetAIText
{

    public $clientServeAIText;
    public function __construct(ClinetServeAIText $clientServeAIText)
    {
        $this->clientServeAIText = $clientServeAIText;
    }

    public function getAdminText()
    {
        return $this->clientServeAIText->getAiText();
    }
}
