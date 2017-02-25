<?php

namespace ClearCode\Protobuf\Tests;

use ClearCode\Protobuf\ByteDecoder;
use ClearCode\Protobuf\MessageDecoder;
use Protobuf\Stream;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ByteDecoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var MessageDecoder */
    private $decoder;

    public function setUp()
    {
        $this->decoder = new ByteDecoder();
    }

    public function test_byte_decoder()
    {
        $content = file_get_contents(__DIR__ . '/fixtures/dummy.pb.bin.expected');
        $stream = Stream::fromString($content);
        /** @var DummyMessage $message */
        $message = $this->decoder->decode($stream, DummyMessage::class);

        $accessor = PropertyAccess::createPropertyAccessor();
        foreach (self::getDummyData() as $field => $expected) {
            $given = $accessor->getValue($message, $field);
            $this->assertSame($expected, $given);
        }
    }

    public static function getDummyData()
    {
        return [
            'Title' => 'Test 123',
            'Description' => 'Description from the text',
            'CreatedAt' => '2016-12-12 12:00:00',
            'UpdatedAt' => '2016-12-12 13:00:00',
        ];
    }
}
