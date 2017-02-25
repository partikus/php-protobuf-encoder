<?php

namespace ClearCode\Protobuf\Tests;

use ClearCode\Protobuf\MessageCollectionEncoder;
use ClearCode\Protobuf\ByteEncoder;
use ClearCode\Protobuf\CollectionMessage;
use Protobuf\MessageCollection;
use Protobuf\Stream;
use Symfony\Component\PropertyAccess\PropertyAccess;

class MessageCollectionEncoderTest extends \PHPUnit_Framework_TestCase
{
    /** @var MessageCollectionEncoder */
    private $encoder;

    public function setUp()
    {
        $this->encoder = new MessageCollectionEncoder(new ByteEncoder());
    }

    public function test_encode_multiple_messages()
    {
        $messages = [];
        foreach (self::getDummyData() as $data) {
            $messages[] = DummyMessage::fromArray($data);
        }

        $stream = $this->encoder->encode(new CollectionMessage($messages));

        file_put_contents(__DIR__ . '/fixtures/dummyCollection.pb.bin', $stream);

        $this->assertSame(
            file_get_contents(__DIR__ . '/fixtures/dummyCollection.pb.bin.expected'),
            file_get_contents(__DIR__ . '/fixtures/dummyCollection.pb.bin')
        );
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
