<?php

namespace App\Channels\Messages;

class TextMessage
{
    public $text = "";

    public function text($text)
    {
        $this->text .= $text;

        return $this;
    }

    public function line($line)
    {
        $this->text .= $line . "\r\n";

        return $this;
    }
}
