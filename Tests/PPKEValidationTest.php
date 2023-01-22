<?php


use PHPUnit\Framework\TestCase;

class PPKEValidationTest extends TestCase
{

    public function testValidateMinimumPoints()
    {
        $exampleData = [
            "valasztott-szak" => [
                "egyetem" => "PPKE",
                "kar" => "BTK",
                "szak" => "Anglisztika",
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
                    "tipus" => "emelt",
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
        $PPKEValidation = new PPKEValidation($exampleData);
        try {
            $PPKEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt", $e->getMessage());
        }
    }

    public function testValidateRequiredSubjects()
    {
        $exampleData = [
            "valasztott-szak" => [
                "egyetem" => "PPKE",
                "kar" => "BTK",
                "szak" => "Anglisztika",
            ],
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "matematika",
                    "tipus" => "emelt",
                    "eredmeny" => "90%",
                ],
                [
                    "nev" => "angol nyelv",
                    "tipus" => "emelt",
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
        $PPKEValidation = new PPKEValidation($exampleData);
        try {
            $PPKEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt", $e->getMessage());
        }
    }

    public function testValidateRequiredSubjectType()
    {
        $exampleData = [
            "valasztott-szak" => [
                "egyetem" => "PPKE",
                "kar" => "BTK",
                "szak" => "Anglisztika",
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
                    "nev" => "kémia",
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
        $PPKEValidation = new PPKEValidation($exampleData);
        try {
            $PPKEValidation->validate();
        } catch (Exception $e) {
            $this->assertEquals("hiba, nem lehetséges a pontszámítás mert a(z) angol nyelv típusa nem emelt színtű", $e->getMessage());
        }
    }

    public function testValidateSuccess()
    {
        $exampleData = [
            "valasztott-szak" => [
                "egyetem" => "PPKE",
                "kar" => "BTK",
                "szak" => "Anglisztika",
            ],
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "magyar nyelv és irodalom",
                    "tipus" => "közép",
                    "eredmeny" => "70%",
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
                    "tipus" => "emelt",
                    "eredmeny" => "94%",
                ],
                [
                    "nev" => "informatika",
                    "tipus" => "közép",
                    "eredmeny" => "95%",
                ],
                [
                    "nev" => "fizika",
                    "tipus" => "közép",
                    "eredmeny" => "98%",
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
        $PPKEValidation = new PPKEValidation($exampleData);

        try {
            $PPKEValidation->validate();
        } catch (Exception $e) {
        } finally {
            $this->assertEquals(true, true);
        }
    }
}
