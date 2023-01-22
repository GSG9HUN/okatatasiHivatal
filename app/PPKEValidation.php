<?php

class PPKEValidation extends Validation
{
    const REQUIRED_SUBJECT = "angol nyelv";
    const REQUIRED_SUBJECT_TYPE = "emelt";
    const OPTIONAL_SUBJECTS = ["francia", "német", "olasz", "orosz", "spanyol", "történelem"];

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @throws Exception
     */
    public function validate()
    {
        $this->haveTheRequiredSubjects();
        $this->haveTheMinimumPoints();
        $this->haveTheRequiredSubjectType();
        $this->haveTheOptionalSubject();
    }

    /**
     * @throws Exception
     */
    private function haveTheOptionalSubject(): void
    {
        foreach ($this->data["erettsegi-eredmenyek"] as $subject) {
            if (in_array($subject["nev"], self::OPTIONAL_SUBJECTS)) {
                return;
            }
        }
        throw new Exception("hiba, nem lehetséges a pontszámítás mert egy kötelezően választható tárgyból sincs eredmény");
    }

    /**
     * @throws Exception
     */
    private function haveTheRequiredSubjectType()
    {
        foreach ($this->data["erettsegi-eredmenyek"] as $subject) {
            if ($subject["nev"] == self::REQUIRED_SUBJECT && $subject["tipus"] != self::REQUIRED_SUBJECT_TYPE) {
                throw new Exception("hiba, nem lehetséges a pontszámítás mert a(z) " . self::REQUIRED_SUBJECT . " típusa nem " . self::REQUIRED_SUBJECT_TYPE . " színtű");
            }
        }
    }

}