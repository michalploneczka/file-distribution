<?php

namespace Abc\Filesystem\Tests;

use Abc\Filesystem\AdapterFactory;
use Abc\Filesystem\FilesystemType;
use PHPUnit\Framework\TestCase;

class AdapterFactoryTest extends TestCase
{
    /** @var AdapterFactory */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();
        $this->subject = new AdapterFactory();
    }

    /**
     * @dataProvider getValidArgs()
     */
    public function testCreate($type, $path, $options, $expectedAdapterClass)
    {
        $filesystem = $this->subject->create($type, $path, $options);

        $this->assertInstanceOf('Gaufrette\Adapter', $filesystem);
    }

    public function testCreateAdapterThrowsInvalidArgumentExceptionForUnsupportedTypes()
    {
        $this->expectException('\InvalidArgumentException');

        $this->subject->create('foobar', '/path/to/nowhere');
    }

    public function testCreateThrowsInvalidArgumentExceptionIfFtpHostIsEmpty()
    {
        $this->expectException('\InvalidArgumentException');

        $filesystem = $this->subject->create(FilesystemType::FTP, '/foobar');
    }

    /**
     * @return array
     */
    public static function getValidArgs()
    {
        return array(
            array(FilesystemType::LOCAL, '/tmp', array(), 'Gaufrette\Adapter\Local'),
            array(FilesystemType::FTP, '/tmp', array('host' => 'ftp.domain.tld'), 'Gaufrette\Adapter\Ftp')
        );
    }
}
