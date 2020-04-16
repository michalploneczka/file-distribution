<?php

namespace Abc\Filesystem\Tests;

use Abc\Filesystem\AdapterFactoryInterface;
use Abc\Filesystem\Definition;
use Abc\Filesystem\FilesystemFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Hannes Schulz <schulz@daten-bahn.de>
 */
class FilesystemFactoryTest extends TestCase
{
    /** @var AdapterFactoryInterface|MockObject */
    private $adapterFactory;
    /** @var FilesystemFactory */
    private $subject;

    protected function setUp(): void
    {
        $this->adapterFactory = $this->createMock('Abc\Filesystem\AdapterFactoryInterface');
        $this->subject = new FilesystemFactory($this->adapterFactory);
    }

    public function testCreate()
    {
        $this->adapterFactory->expects($this->once())
            ->method('create')
            ->willReturn(new \Gaufrette\Adapter\Local(sys_get_temp_dir()));

        $definition = new Definition;
        $filesystem = $this->subject->create($definition);

        $this->assertInstanceOf('Abc\Filesystem\Filesystem', $filesystem);
    }
}
