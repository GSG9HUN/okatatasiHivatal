<?php

class Validation
{

    private const MINIMUM_PERCENTAGE = 20;
    private const REQUIRED_SUBJECTS = ["magyar nyelv és irodalom", "történelem", "matematika"];
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @throws Exception
     */
    protected function haveTheMinimumPoints(): void
    {
        foreach ($this->data["erettsegi-eredmenyek"] as $subject) {
            $result = substr($subject["eredmeny"], 0, -1);
            if (intval($result) < self::MINIMUM_PERCENTAGE) {
                throw new Exception("hiba, nem lehetséges a pontszámítás a " . $subject["nev"] . " tárgyból elért 20% alatti eredmény miatt");
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function haveTheRequiredSubjects(): void
    {
        foreach (self::REQUIRED_SUBJECTS as $REQUIRED_SUBJECT) {
            $found = false;
            foreach ($this->data["erettsegi-eredmenyek"] as $result) {
                if ($REQUIRED_SUBJECT == $result['nev']) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                throw new Exception("hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt");
            }
        }
    }
}
