<?php

class ELTEValidation extends Validation
{
    const REQUIRED_SUBJECT = 'matematika';
    const OPTIONAL_SUBJECTS = ['biológia', 'fizika', 'informatika', 'kémia'];

    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    /**
     * @throws Exception
     */
    public function validate(): void
    {
        $this->haveTheRequiredSubjects();
        $this->haveTheMinimumPoints();
        $this->haveTheOptionalSubject();
    }

    /**
     * @throws Exception
     */
    private function haveTheOptionalSubject(): void
    {
        foreach ($this->data['erettsegi-eredmenyek'] as $subject) {
            if (in_array($subject['nev'], self::OPTIONAL_SUBJECTS)) {
                return;
            }
        }
        throw new Exception("hiba, nem lehetséges a pontszámítás mert egy kötelezően választható tárgyból sincs eredmény");
    }

}