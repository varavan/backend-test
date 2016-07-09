<?php
namespace Caravelo\Component;

class SlugifyTest extends \PHPUnit_Framework_TestCase
{

    public function testBasicSlug()
    {
        // Given
        $test = 'This Is A Test';
        $expected = 'this-is-a-test';

        // When
        $result = Slugify::resolve($test);

        // Then
        $this->assertEquals($expected, $result);

    }
}