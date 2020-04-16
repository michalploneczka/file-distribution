<?php

namespace Abc\Filesystem\Tests;

use Abc\Filesystem\Definition;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
    /** @var SerializerInterface */
    protected $serializer;

    protected function setUp(): void
    {
        $this->serializer = SerializerBuilder::create()->build();
    }

    public function testSerializationToJson()
    {
        $definition = new Definition();
        $definition->setType('LOCAL');
        $definition->setPath('/path/to/filesystem');
        $definition->setProperties(array('create' => true, 'mode' => 0755));

        $data = $this->serializer->serialize($definition, 'json');

        $object = $this->serializer->deserialize($data, 'Abc\Filesystem\Definition', 'json');

        $this->assertEquals($definition, $object);
        $this->assertSame($definition->getProperties(), $object->getProperties());
    }
}
