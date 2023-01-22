<?php

class Points
{
    private string $requiredSubject;
    private array $optionalSubjects;
    private array $languageTypes = [
        "B2" => 28,
        "C1" => 40,
    ];
    private int $points = 0;
    private int $extraPoints = 0;

    /**
     * @param string $requiredSubject
     * @param array $optionalSubjects
     */
    public function __construct(string $requiredSubject, array $optionalSubjects)
    {
        $this->requiredSubject = $requiredSubject;
        $this->optionalSubjects = $optionalSubjects;
    }

    public function calculate(array $subjects, array $extraPoints): string
    {
        $this->calculateBasicPoints($subjects);
        $this->calculateExtraPoints($extraPoints);
        $extraPoints = min($this->extraPoints, 100);
        return ($this->points + $extraPoints) . " (" . $this->points . " alappont + " . $extraPoints . " többletpont)";
    }

    private function calculateBasicPoints(array $subjects): void
    {
        [$requiredSubjectPoint, $optionalSubjectPoint] = $this->findSubjects($subjects);
        $this->points = ($requiredSubjectPoint + $optionalSubjectPoint) * 2;
    }

    private function calculateExtraPoints(array $extraPoints): void
    {
        $points = [];
        foreach ($extraPoints as $extraPoint) {
            $points[$extraPoint['nyelv']] = $this->languageTypes[$extraPoint['tipus']];
        }
        $this->extraPoints += array_sum($points);
    }

    private function findSubjects(array $subjects): array
    {
        $requiredSubjectPoints = 0;
        $optionalSubjectPoints = 0;
        foreach ($subjects as $subject) {
            $this->addExtraPointsIfItsAdvanced($subject);
            if ($subject['nev'] == $this->requiredSubject) {
                $requiredSubjectPoints = substr($subject['eredmeny'], 0, -1);
                continue;
            }
            if (in_array($subject['nev'], $this->optionalSubjects)) {
                $points = substr($subject['eredmeny'], 0, -1);
                if ($optionalSubjectPoints < $points) {
                    $optionalSubjectPoints = $points;
                }
            }
        }
        return [$requiredSubjectPoints, $optionalSubjectPoints];
    }

    private function addExtraPointsIfItsAdvanced(array $subject): void
    {
        if ($subject['tipus'] == "emelt") {
            $this->extraPoints += 50;
        }
    }
}