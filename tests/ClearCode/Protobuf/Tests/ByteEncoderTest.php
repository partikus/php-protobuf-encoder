<?php

namespace ClearCode\Protobuf\Tests;

use ClearCode\Protobuf\ByteEncoder;
use ClearCode\Protobuf\MessageEncoder;

class ByteEncoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var MessageEncoder */
    private $encoder;

    public function setUp()
    {
        $this->encoder = new ByteEncoder();
    }

    public function test_byte_encoder()
    {
        $message = DummyMessage::fromArray($this->getDummyData());

        $stream = $this->encoder->encode($message);
        file_put_contents(__DIR__ . '/fixtures/dummy.pb.bin', $stream);

        $this->assertSame(
            file_get_contents(__DIR__ . '/fixtures/dummy.pb.bin.expected'),
            $stream->getContents()
        );
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
