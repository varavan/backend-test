<?php

namespace Caravelo\Modules\Survey\Infrastructure\Repository;


use Caravelo\Modules\Survey\Domain\Model\Answer;
use Caravelo\Modules\Survey\Domain\Model\Question;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;
use Caravelo\Modules\Survey\Infrastructure\Factory\AnswerFactory;

class QuestionRepositoryFilesystemTest extends \PHPUnit_Framework_TestCase
{
    static  $DUMMY_DATA = [
        'id' => 4,
        'title' => 'test title',
        'createdAt' => "2016-08-09T12:30:00"
    ];

    /** @var  FilesystemYmlReader | \PHPUnit_Framework_MockObject_MockObject */
    private $ymlReaderMock;
    /** @var  AnswerFactory | \PHPUnit_Framework_MockObject_MockObject */
    private $answerFactoryMock;
    /** @var  QuestionRepositoryFilesystem */
    private $questionRepository;

    public function setUp()
    {
        $this->ymlReaderMock = $this->createMock(FilesystemYmlReader::class);
        $this->answerFactoryMock = $this->createMock(AnswerFactory::class);

        $this->questionRepository = new QuestionRepositoryFilesystem(
            $this->ymlReaderMock,
            $this->answerFactoryMock
        );
    }


    public function testSurveySlugExists()
    {
        // Given
        $slug = 'any-survey';
        $this->mockAnswerFactory();
        $this->mockYmlReaderForAnySlug();

        // When
        $questions = $this->questionRepository->findBySurveySlug($slug);

        // Then
        $this->assertNotEmpty($questions);
        $this->assertTrue($questions[0] instanceof Question);
        $this->assertNotEmpty($questions[0]->getAnswers());
        $answers = $questions[0]->getAnswers();
        $this->assertTrue(end($answers) instanceof Answer);

    }

    public function testSurveySlugDoesNotExists()
    {
        // Given
        $slug = 'any-survey';
        $this->mockAnswerFactory();
        $this->mockYmlReaderDoesNotExistsForAnySlug();

        // When
        $questions = $this->questionRepository->findBySurveySlug($slug);

        // Then
        $this->assertEmpty($questions);
    }

    public function mockYmlReaderForAnySlug()
    {
        $this->ymlReaderMock->expects($this->once())->method('findByAttribute')->will($this->returnValue([self::$DUMMY_DATA]));
    }

    public function mockYmlReaderDoesNotExistsForAnySlug()
    {
        $this->ymlReaderMock->expects($this->once())->method('findByAttribute')->will($this->returnValue(false));
    }

    public function mockAnswerFactory()
    {
        $this->answerFactoryMock->expects($this->any())->method('makeAnswer')->will($this->returnValue(new Answer(3, 'test', new \DateTime())));
    }
}