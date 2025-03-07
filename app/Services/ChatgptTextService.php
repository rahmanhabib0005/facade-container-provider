<?php

namespace App\Services;

use App\Interfaces\AiGeneratedTextInterface;

class ChatgptTextService implements AiGeneratedTextInterface
{
    private $text = "Default Text For GPT";

    public function getAiGeneratedText()
    {
        return "ChatGPT: " . $this->text;
    }

    public function setAiGeneratedText($text)
    {
        $this->text = $text;
    }

    public function getAiGeneratedTextLength()
    {
        return strlen($this->text);
    }
}
