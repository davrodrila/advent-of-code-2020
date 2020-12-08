<?php


namespace App\day6;


use App\AbstractSolver;
use App\File\FileReader;
use Generator;

class DaySixSolver extends AbstractSolver
{

    /** @var array $groups */
    private array $groups;

    /**
     * DaySixSolver constructor.
     * @param FileReader $fileReader
     */
    public function __construct(FileReader  $fileReader)
    {
        parent::__construct($fileReader);
        $this->groups = $this->fileToArrayGroupedUntilBlankLine();
    }


    /**
     * @return string
     */
    public function solvePartOne(): string
    {
        return array_sum(
            $this->processAnswersGivenByAnyone(
                $this->mergeGroupsOnOneLine(
                    $this->groups
                )
            )
        );
    }

    private function mergeGroupsOnOneLine(array $groups): array
    {
        $mergedGroups =[];
        foreach ($groups as $group) {
            $mergedGroup = '';
            foreach ($group as $answer) {
                $mergedGroup .= $answer;
            }
            $mergedGroups[] = $mergedGroup;
        }

        return $mergedGroups;
    }
    /**
     * @param array $groups
     * @return array
     */
    public function processAnswersGivenByAnyone(array $groups): array {
        $answerCount = $this->initializeAnswerCountArray();
        foreach ($groups as $group) {
            foreach ($this->navigateQuestions() as $question ) {
                if (strpos($group, $question) !== false) {
                    $answerCount[$question]++;
                }
            }
        }

        return $answerCount;
    }

    /**
     * @return string
     */
    public function solvePartTwo(): string
    {
        return array_sum($this->processAnswersGivenByEveryone($this->groups));
    }

    public function processAnswersGivenByEveryone(array $groups): array {
        $answerCount = $this->initializeAnswerCountArray();
        foreach($groups as $group) {
            foreach ($this->navigateQuestions() as $question) {
                $isAnswered = true;
                foreach ($group as $answer) {
                    if (strpos($answer, $question) === false) {
                        $isAnswered = false;
                    }
                }
                if ($isAnswered) {
                    $answerCount[$question]++;
                }
            }
        }

        return $answerCount;
    }

    /**
     * @return Generator
     */
    private function navigateQuestions(): Generator {
        foreach (str_split(ChallengeValues::ABECEDARY) as $question) {
            yield $question;
        }
    }

    /**
     * @return array
     */
    private function initializeAnswerCountArray(): array {
        $answerCount = [];

        foreach (str_split(ChallengeValues::ABECEDARY) as $question) {
            $answerCount[$question] = 0;
        }

        return $answerCount;
    }
}