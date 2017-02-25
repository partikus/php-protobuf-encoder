<?php

namespace ClearCode\Protobuf;

use Protobuf\Message;
use Protobuf\MessageCollection;
use Protobuf\Stream;

class MessageCollectionEncoder implements MessageEncoder
{
    private $encoder;

    public function __construct(MessageEncoder $byteEncoder)
    {
        $this->encoder = $byteEncoder;
    }

    /**
     * @inheritdoc
     */
    public function encode(Message $messages)
    {
        if (false === $messages instanceof CollectionMessage) {
            throw new \InvalidArgumentException(sprintf("Only %s is supported", CollectionMessage::class));
        }

        /** @var CollectionMessage $messages */
        $stream = Stream::create();
        foreach ($messages->toArray() as $message) {
            $messageStream = $this->encoder->encode($message);
            $stream->write($messageStream->getContents(), $messageStream->getSize());
        }

        return $stream;
    }
}
