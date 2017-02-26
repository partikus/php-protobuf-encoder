PHP Protbuf Encode
==================

[![Build Status](https://travis-ci.org/partikus/php-protobuf-encoder.svg?branch=master)](https://travis-ci.org/partikus/php-protobuf-encoder)

Simple PHP library that allows you encode Protobuf Message to byte code. Additionally this library allows to encode/decode massage into single message.
The implementation is based on [this article](http://eli.thegreenplace.net/2011/08/02/length-prefix-framing-for-protocol-buffers).
  
## How to use it?

### Prepare Proto Message file

```
syntax = "proto3";

package Your.Namespace;

message DummyMessage {
    string Title = 1;
    string Description = 2;
    string CreatedAt = 3;
    string UpdatedAt = 4;
}

```

### Generate PHP files

```
vendor/bin/protobuf --include-descriptors -i . -o src/ DummyMessage.proto
```

### Create PHP objects
 
```
$dummyMessage = Your\Namespace\DummyMessage::fromArray([
    'Title' => 'Test 123',
    'Description' => 'Description from the text',
    'CreatedAt' => '2016-12-12 12:00:00',
    'UpdatedAt' => '2016-12-12 13:00:00',
]);

$encoder = new ClearCode\Protobuf\ByteEncoder();
/** @var \Protobuf\Stream $stream */
$stream = $encoder->encode($dummyMessage);
file_put_contents(__DIR__ . '/dummyMessage.pb.bin', $stream);
```

