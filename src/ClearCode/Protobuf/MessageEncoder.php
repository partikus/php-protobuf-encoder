<?php

namespace ClearCode\Protobuf;

use Protobuf\Message;
use Protobuf\Stream;

interface MessageEncoder
{
    /**
     * @param Message $message
     * @return Stream $stream
     */
    public function encode(Message $message);
}
