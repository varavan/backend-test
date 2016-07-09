<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;

use Caravelo\Component\Slugify;
use Caravelo\Modules\Survey\Domain\Model\Tag;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class TagRepositoryFilesystemTest extends \PHPUnit_Framework_TestCase
{
    static  $DUMMY_DATA = [
        'name' => 'test name',
        'description' => 'description fake',
        'createdAt' => "2016-08-09T12:30:00"
    ];

    /** @var  FilesystemYmlReader | \PHPUnit_Framework_MockObject_MockObject */
    private $ymlReaderMock;
    /** @var  TagRepositoryFilesystem */
    private $tagRepository;

    public function setUp()
    {
        $this->ymlReaderMock = $this->createMock(FilesystemYmlReader::class);
        $this->tagRepository = new TagRepositoryFilesystem($this->ymlReaderMock);
    }

    public function testSurveySlugExists()
    {
        // Given
        $slug = 'any-survey';
        $this->mockYmlReaderForAnySlug();

        // When
        $tags = $this->tagRepository->findBySurveySlug($slug);
        $tag = $tags[0];

        // Then
        $this->assertTrue($tag instanceof Tag);
        $this->assertEquals($tag->getName(), self::$DUMMY_DATA['name']);
        $this->assertEquals($tag->getSlug(), Slugify::resolve(self::$DUMMY_DATA['name']));


    }

    public function testSurveySlugDoesNotExists()
    {
        // Given
        $slug = 'any-survey';
        $this->mockYmlReaderDoesNotExistsForAnySlug();

        // When
        $tags = $this->tagRepository->findBySurveySlug($slug);

        // Then
        $this->assertEmpty($tags);
    }

    public function mockYmlReaderForAnySlug()
    {
        $this->ymlReaderMock->expects($this->once())->method('findByAttribute')->will($this->returnValue([self::$DUMMY_DATA]));
    }

    public function mockYmlReaderDoesNotExistsForAnySlug()
    {
        $this->ymlReaderMock->expects($this->once())->method('findByAttribute')->will($this->returnValue(false));
    }
}