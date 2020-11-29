<?php declare(strict_types=1);

use Routing\Router\Factory\Entity\EntitySignatureFactory;
use PHPUnit\Framework\TestCase;


class EntitySignatureFactoryTest extends TestCase
{
    public function setUp(): void
    {
        $this->entitySignatureFactory = new EntitySignatureFactory;
        parent::setUp();
    }
    
    public function testGetSignatureWithInexistentClassThrowsInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Class InexistentClass don't exists.");
        $this->entitySignatureFactory->getSignature('InexistentClass');
    }

    public function testGetSignatureReturnAValidObject()
    { 
        $simpleObjectMock = new \Mocks\Router\Factory\Entity\SimpleObjectMock(); 
        $signature = $this->entitySignatureFactory->getSignature('\Mocks\Router\Factory\Entity\SimpleObjectMock');
        $this->assertEquals($signature, $simpleObjectMock);
    }
}
