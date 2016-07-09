<?php

namespace Caravelo\Modules\Survey\Infrastructure\Factory;

use Caravelo\Modules\Survey\Domain\Model\Answer;
use Caravelo\Modules\Survey\Infrastructure\Component\FilesystemYmlReader;

class AnswerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  AnswerFactory */
    private $answerFactory;
    /** @var  FilesystemYmlReader | \PHPUnit_Framework_MockObject_MockObject */
    private $ymlReaderMock;
    /** @var  array */
    private $dummyData;

    public function setUp()
    {
        $this->ymlReaderMock = $this->createMock(FilesystemYmlReader::class);
        $this->dummyData = $this->mockYmlReaderToReturnDummyData();

        $this->answerFactory = new AnswerFactory($this->ymlReaderMock);
    }

    public function testReturnAnswerExpected()
    {
        // Given
        $id = 10;
        $dummyData = $this->dummyData;


        // When
        $answer = $this->answerFactory->makeAnswer($id);

        // Then
        $this->assertTrue($answer instanceof Answer);
        $this->assertEquals($answer->getContent(), $dummyData['content']);


    }

    /**
     * @return array dummy data
     */
    private function mockYmlReaderToReturnDummyData()
    {
        $return = [
            'content' => 'test',
            'createdAt' => "2016-08-09T12:30:00"
        ];

        $this->ymlReaderMock->expects($this->any())->method('getContent')->will($this->returnValue([$return]));

        return $return;
    }
}