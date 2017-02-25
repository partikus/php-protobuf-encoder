<?php

namespace ClearCode\Protobuf;

use Protobuf\Message;
use Protobuf\Stream;

interface MessageDecoder
{
    /**
     * @param Stream $stream
     * @param string $messageFQCN
     * @return Message
     */
    public function decode(Stream $stream, $messageFQCN);
}
