<?php

namespace App\Services;

use App\Interfaces\AiGeneratedTextInterface;

class GeminiTextService implements AiGeneratedTextInterface
{
    private $text = "Default Text For Gemini";

    public function getAiGeneratedText()
    {
        return "Gemini: " . $this->text;
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