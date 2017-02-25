<?php

namespace ClearCode\Protobuf;

use Protobuf\ComputeSizeContext;
use Protobuf\Configuration;
use Protobuf\Message;
use Protobuf\MessageCollection;
use Protobuf\ReadContext;
use Protobuf\WriteContext;

class CollectionMessage implements \Countable, Message
{
    private $messages;

    public function __construct(array $messages = [])
    {
        $this->messages = new MessageCollection($messages);
    }

    public function add(Message $message)
    {
        $key = spl_object_hash($message);
        $this->messages->add($key, $message);
    }

    public function remove(Message $message)
    {
        $key = spl_object_hash($message);
        $this->messages->offsetUnset($key);
    }

    public function count()
    {
        return $this->messages->count();
    }

    public function toArray()
    {
        $result = [];
        foreach ($this->messages->getIterator() as $message) {
            $result[] = $message;
        }

        return $result;
    }

    /**
     */
    public static function fromStream($stream, Configuration $configuration = null)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function toStream(Configuration $configuration = null)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function serializedSize(ComputeSizeContext $context)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function readFrom(ReadContext $context)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function writeTo(WriteContext $context)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function merge(Message $message)
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function unknownFieldSet()
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function extensions()
    {
        throw new \BadMethodCallException();
    }

    /**
     * @inheritdoc
     */
    public function clear()
    {
    }
}
