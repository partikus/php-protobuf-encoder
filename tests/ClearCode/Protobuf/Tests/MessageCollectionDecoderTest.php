<?php

namespace ClearCode\Protobuf\Tests;

use ClearCode\Protobuf\ByteDecoder;
use ClearCode\Protobuf\MessageCollectionDecoder;
use Protobuf\Stream;
use Symfony\Component\PropertyAccess\PropertyAccess;

class MessageCollectionDecoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var MessageCollectionDecoder */
    private $decoder;

    public function setUp()
    {
        $this->decoder = new MessageCollectionDecoder(new ByteDecoder());
    }

    public function test_decode_multiple_messages()
    {
        $content = file_get_contents(__DIR__ . '/fixtures/dummyCollection.pb.bin');
        $stream = Stream::fromString($content);
        /** @var DummyMessage $message */
        $messages = $this->decoder->decode($stream, DummyMessage::class);

        $accessor = PropertyAccess::createPropertyAccessor();
        $data = self::getDummyData();

        $this->assertCount(count($data), $messages);
        foreach ($messages as $key => $message) {
            $this->assertEquals(
                $data[$key]['Title'],
                $accessor->getValue($message, 'Title')
            );
        }
    }

    public static function getDummyData()
    {
        return [
            [
                'Title' => 'Test 1',
                'Description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                'CreatedAt' => '2016-12-12 11:00:00',
                'UpdatedAt' => '2016-12-12 11:00:00',
            ],
            [
                'Title' => 'Test 2',
                'Description' => 'Second Description',
                'CreatedAt' => '2016-12-12 12:00:00',
                'UpdatedAt' => '2016-12-12 12:00:00',
            ],
            [
                'Title' => 'Test 3',
                'Description' => 'Third description',
                'CreatedAt' => '2016-12-12 13:00:00',
                'UpdatedAt' => '2016-12-12 13:00:00',
            ],
            [
                'Title' => 'Test 4',
                'Description' => 'Fourth description',
                'CreatedAt' => '2016-12-12 14:00:00',
                'UpdatedAt' => '2016-12-12 14:00:00',
            ]
        ];
    }
}