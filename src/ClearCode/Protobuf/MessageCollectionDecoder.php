<?php

namespace ClearCode\Protobuf;

use Protobuf\Message;
use Protobuf\MessageCollection;
use Protobuf\Stream;

class MessageCollectionDecoder
{
    private $decoder;

    public function __construct(MessageDecoder $decoder)
    {
        $this->decoder = $decoder;
    }

    /**
     * @inheritdoc
     */
    public function decode(Stream $stream, $messageFQCN)
    {
        $messages = [];
        /** @var MessageCollection $messages */
        do {
            $message = $this->decoder->decode($stream, $messageFQCN);
            if (true === $message instanceof Message) {
                $messages[] = $message;
            }
        } while (true === $message instanceof Message);

        return $messages;
    }
}
