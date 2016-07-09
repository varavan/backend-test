<?php

namespace Caravelo\Modules\Survey\Infrastructure\Component;

class FilesystemYmlReaderTest extends \PHPUnit_Framework_TestCase
{
    const DB_KEY = 'sample-db-1';
    const BAD_DB_KEY = 'fail';

    public function testGetContentWorkProperly()
    {
        // Given
        $reader = $this->makeFilesystemYmlReader();

        // When
        $content = $reader->getContent();

        // Then
        $this->assertEquals(2, count($content));
        $this->assertTrue(array_key_exists(self::DB_KEY, $content));
        $this->assertFalse(array_key_exists(self::BAD_DB_KEY, $content));
    }

    public function testFindByKeyWithSuccessKey()
    {
        // Given
        $reader = $this->makeFilesystemYmlReader();

        // When
        $object = $reader->findByKey(self::DB_KEY);

        // Then
        $this->assertTrue(is_array($object));
        $this->assertGreaterThan(0, count($object));
    }

    public function testFindByKeyWithFailKey()
    {
        // Given
        $reader = $this->makeFilesystemYmlReader();

        // When
        $object = $reader->findByKey(self::BAD_DB_KEY);

        // Then
        $this->assertFalse(is_array($object));
    }


    public function testFindByAttribute()
    {
        // Given
        $reader = $this->makeFilesystemYmlReader();

        // When
        $results = $reader->findByAttribute('id', 1);
        $object = end($results);

        // Then
        $this->assertTrue(is_array($object));
        $this->assertEquals($object['id'], 1);
    }

    public function testFindByInexistentAttribute()
    {
        // Given
        $reader = $this->makeFilesystemYmlReader();

        // When
        $results = $reader->findByAttribute('id', 10000);

        // Then
        $this->assertEmpty($results);
    }


    /**
     * @return FilesystemYmlReader
     */
    private function makeFilesystemYmlReader()
    {
        return new FilesystemYmlReader(__DIR__ . '/../../../../../assets/db/sample.yml');
    }

}