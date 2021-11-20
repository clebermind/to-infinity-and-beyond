<?php

namespace App\Tests\Service;

use App\Service\Xml;
use PHPUnit\Framework\TestCase;

class XmlTest extends TestCase
{
    public function testInvalidFile(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('Oops... Something went wrong. Probably an invalid file!');
        $this->expectExceptionCode(10);

        new Xml(dirname(__DIR__, 2) . '/README.md');
    }

    public function testFileNotFound(): void
    {
        $xmlPath = dirname(__DIR__, 2) . '/sample-reaxml-not-exist.xml';
        $this->expectException('Exception');
        $this->expectExceptionMessage("File '{$xmlPath}' not found");
        $this->expectExceptionCode(100);

        new Xml($xmlPath);
    }

    public function testValidFileAndXmlContent(): void
    {
        $xml = new Xml(dirname(__DIR__, 2) . '/sample-reaxml.xml');
        $properties = $xml->getArray();

        $this->assertIsArray($properties);
        $this->assertArrayHasKey('1P3115', $properties);
        $this->assertArrayHasKey('1P0121', $properties);
        $this->assertArrayHasKey('2631096', $properties);
        $this->assertArrayNotHasKey('cleber', $properties);
    }
}