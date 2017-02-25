<?php

namespace ClearCode\Protobuf;

use Protobuf\Message;
use Protobuf\Stream;

class ByteEncoder implements MessageEncoder
{
    /**
     * @inheritdoc
     */
    public function encode(Message $message)
    {
        $stream = Stream::create();

        $sizeStream = $this->getSizeStream($message);
        $stream->write($sizeStream->getContents(), $sizeStream->getSize());

        $messageStream = $message->toStream();
        $stream->write($messageStream->getContents(), $messageStream->getSize());

        return $stream;
    }

    /**
     * @param Message $message
     * @return Stream
     */
    private function getSizeStream(Message $message)
    {
        $stream = Stream::create();
        $sizeInBytes = pack(ByteFormats::BYTE_FORMAT, $message->toStream()->getSize());
        $stream->write($sizeInBytes, 4);

        return $stream;
    }
}
