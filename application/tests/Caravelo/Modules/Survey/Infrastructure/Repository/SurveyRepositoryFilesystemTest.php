<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;

use Caravelo\Modules\Survey\Domain\Model\Question;
use Caravelo\Modules\Survey\Domain\Model\Survey;
use Caravelo\Modules\Survey\Domain\Model\Tag;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class SurveyRepositoryFilesystemTest extends \PHPUnit_Framework_TestCase
{
    static  $DUMMY_DATA = [
        'name' => 'test name',
        'slug' => 'test-name',
        'description' => 'description fake',
        'createdAt' => "2016-08-09T12:30:00"
    ];

    /** @var  FilesystemYmlReader | \PHPUnit_Framework_MockObject_MockObject */
    private $ymlReaderMock;
    /** @var  SurveyRepositoryFilesystem */
    private $surveyRepository;
    /** @var  QuestionRepositoryFilesystem | \PHPUnit_Framework_MockObject_MockObject */
    private $questionRepositoryMock;
    /** @var  TagRepositoryFilesystem | \PHPUnit_Framework_MockObject_MockObject */
    private $tagRepositoryMock;

    public function setUp()
    {
        $this->ymlReaderMock = $this->createMock(FilesystemYmlReader::class);
        $this->questionRepositoryMock = $this->createMock(QuestionRepositoryFilesystem::class);
        $this->tagRepositoryMock = $this->createMock(TagRepositoryFilesystem::class);

        $this->surveyRepository = new SurveyRepositoryFilesystem(
            $this->ymlReaderMock,
            $this->questionRepositoryMock,
            $this->tagRepositoryMock
        );
    }


    public function testFindAll()
    {
        // Given
        $this->mockAnyQuestions();
        $this->mockYmlReaderForAnySlug();
        $this->mockTagRepositoryForAnySlug();

        // When
        $surveys = $this->surveyRepository->findAll();

        // Then
        $this->assertNotEmpty($surveys);
        /** @var Survey $survey */
        $survey = end($surveys);
        $this->assertTrue($survey instanceof Survey);

        // questions fetch
        $this->assertNotEmpty($survey->getQuestions());
        $questions = $survey->getQuestions();
        $question = end($questions);
        $this->assertTrue($question instanceof Question);

        // tags fetch
        $this->assertNotEmpty($survey->getTags());
        $tags = $survey->getTags();
        $tag = end($tags);
        $this->assertTrue($tag instanceof Tag);

    }

    public function testFindBySlugWhichExists()
    {
        // Given
        $this->mockAnyQuestions();
        $this->mockYmlReaderForAnySlugAndFilterByAttribute();
        $this->mockTagRepositoryForAnySlug();

        // When
        $survey = $this->surveyRepository->findOneBySlug(self::$DUMMY_DATA['slug']);

        // Then
        $this->assertTrue($survey instanceof Survey);
        $this->assertEquals($survey->getName(), self::$DUMMY_DATA['name']);
        $this->assertEquals($survey->getSlug(), self::$DUMMY_DATA['slug']);

    }

    public function mockTagRepositoryForAnySlug()
    {
        $this->tagRepositoryMock->expects($this->once())->method('findBySurveySlug')->will($this->returnValue([
            new Tag('test', 'test', new \DateTime())
        ]));
    }


    public function mockYmlReaderForAnySlug()
    {
        $this->ymlReaderMock->expects($this->once())->method('getContent')->will($this->returnValue(['test' => self::$DUMMY_DATA]));
    }

    public function mockYmlReaderForAnySlugAndFilterByAttribute()
    {
        $this->ymlReaderMock->expects($this->once())->method('findByAttribute')->will($this->returnValue(['test' => self::$DUMMY_DATA]));
    }


    public function mockAnyQuestions()
    {
        $this->questionRepositoryMock->expects($this->once())->method('findBySurveySlug')->will($this->returnValue(
            [
                new Question(1,'title', new \DateTime())
            ]
        ));
    }

}