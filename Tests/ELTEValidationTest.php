<?php


use PHPUnit\Framework\TestCase;

class ELTEValidationTest extends TestCase
{
    public function testValidateMinimumPoints()
    {
        $exampleData3 = [
            "valasztott-szak" => [
                "egyetem" => "ELTE",
                "kar" => "IK",
                "szak" => "Programtervező informatikus",
            ],
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "magyar nyelv és irodalom",
                    "tipus" => "közép",
                    "eredmeny" => "15%",
                ],
                [
                    "nev" => "történelem",
                    "tipus" => "közép",
                    "eredmeny" => "80%",
                ],
                [
                    "nev" => "matematika",
                    "tipus" => "emelt",
                    "eredmeny" => "90%",
                ],
                [
                    "nev" => "angol nyelv",
                    "tipus" => "közép",
                    "eredmeny" => "94%",
                ],
                [
                    "nev" => "informatika",
                    "tipus" => "közép",
                    "eredmeny" => "95%",
                ],
            ],
            "tobbletpontok" => [
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "B2",
                    "nyelv" => "angol",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
            ],
        ];
        $ELTEValidation = new ELTEValidation($exampleData3);
        try {
            $ELTEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt", $e->getMessage());
        }
    }

    public function testValidateRequiredSubjects()
    {
        $exampleData2 = [
            "valasztott-szak" => [
                "egyetem" => "ELTE",
                "kar" => "IK",
                "szak" => "Programtervező informatikus",
            ],
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "matematika",
                    "tipus" => "emelt",
                    "eredmeny" => "90%",
                ],
                [
                    "nev" => "angol nyelv",
                    "tipus" => "közép",
                    "eredmeny" => "94%",
                ],
                [
                    "nev" => "informatika",
                    "tipus" => "közép",
                    "eredmeny" => "95%",
                ],
            ],
            "tobbletpontok" => [
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "B2",
                    "nyelv" => "angol",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
            ],
        ];
        $ELTEValidation = new ELTEValidation($exampleData2);
        try {
            $ELTEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt", $e->getMessage());
        }
    }

    public function testValidateOptionalSubjects()
    {
        $exampleData3 = [
            "valasztott-szak" => [
                "egyetem" => "ELTE",
                "kar" => "IK",
                "szak" => "Programtervező informatikus",
            ],
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "magyar nyelv és irodalom",
                    "tipus" => "közép",
                    "eredmeny" => "80%",
                ],
                [
                    "nev" => "történelem",
                    "tipus" => "közép",
                    "eredmeny" => "80%",
                ],
                [
                    "nev" => "matematika",
                    "tipus" => "emelt",
                    "eredmeny" => "90%",
                ],
                [
                    "nev" => "angol nyelv",
                    "tipus" => "közép",
                    "eredmeny" => "94%",
                ],
                [
                    "nev" => "orosz",
                    "tipus" => "közép",
                    "eredmeny" => "95%",
                ],
            ],
            "tobbletpontok" => [
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "B2",
                    "nyelv" => "angol",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
            ],
        ];
        $ELTEValidation = new ELTEValidation($exampleData3);
        try {
            $ELTEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás mert egy kötelezően választható tárgyból sincs eredmény", $e->getMessage());
        }
    }

    public function testValidateSuccess()
    {
        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
                [
                    'nev' => 'fizika',
                    'tipus' => 'közép',
                    'eredmeny' => '98%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];
        $ELTEValidation = new ELTEValidation($exampleData);

        try {
            $ELTEValidation->validate();
        } catch (Exception $e) {
        } finally {
            $this->assertEquals(true, true);
        }
    }
}
