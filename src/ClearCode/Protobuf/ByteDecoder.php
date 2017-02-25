<?php

namespace ClearCode\Protobuf;

use Protobuf\Stream;

class ByteDecoder implements MessageDecoder
{
    /**
     * @inheritdoc
     */
    public function decode(Stream $stream, $messageFQCN)
    {
        if ($stream->eof()) {
            return null;
        }

        $size = $this->readSize($stream);

        if ($size === 0) {
            return null;
        }

        $message = $this->readMessage($stream, $size, $messageFQCN);

        return $message;
    }

    private function readMessage(Stream $stream, $size, $messageFQCN)
    {
        $byteMessage = $stream->read($size);
        $messageStream = Stream::wrap($byteMessage);

        return $messageFQCN::fromStream($messageStream);
    }

    private function readSize(Stream $stream)
    {
        $message = $stream->read(4);
        $length = @unpack(ByteFormats::BYTE_FORMAT, $message);

        if (!$length) {
            return 0;
        }

        return intval($length[1]);
    }
}