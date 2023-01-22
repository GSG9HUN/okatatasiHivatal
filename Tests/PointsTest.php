<?php


use PHPUnit\Framework\TestCase;

class PointsTest extends TestCase
{

    public function testCalculateExampleData1()
    {
        $exampleData = [
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

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("470 (370 alappont + 100 többletpont)", $result);
    }

    public function testCalculateExampleData2()
    {
        $exampleData = [
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
                    "tipus" => "közép",
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

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("476 (376 alappont + 100 többletpont)", $result);
    }

    public function testCalculateSameLanguageButDifferentLevel()
    {
        $exampleData = [
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
                    "nyelv" => "német",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("460 (370 alappont + 90 többletpont)", $result);
    }

    public function testCalculateNoLanguage()
    {
        $exampleData = [
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
            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("420 (370 alappont + 50 többletpont)", $result);
    }

    public function testCalculateNoAdvancedExam()
    {
        $exampleData = [
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
                    "tipus" => "közép",
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
                    "nyelv" => "német",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("410 (370 alappont + 40 többletpont)", $result);
    }

    public function testCalculateNoLanguageNoAdvancedExam()
    {
        $exampleData = [
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
                    "tipus" => "közép",
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

            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("370 (370 alappont + 0 többletpont)", $result);
    }

    public function testCalculateMultipleLanguageNoAdvancedExam()
    {
        $exampleData = [
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
                    "tipus" => "közép",
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
                [
                    "nev" => "fizika",
                    "tipus" => "közép",
                    "eredmeny" => "98%",
                ],
            ],
            "tobbletpontok" => [
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "angol",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "német",
                ],
                [
                    "kategoria" => "Nyelvvizsga",
                    "tipus" => "C1",
                    "nyelv" => "orosz",
                ],
            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("476 (376 alappont + 100 többletpont)", $result);
    }

    public function testCalculateMultipleAdvancedExamNoLanguage()
    {
        $exampleData = [
            "erettsegi-eredmenyek" => [
                [
                    "nev" => "magyar nyelv és irodalom",
                    "tipus" => "közép",
                    "eredmeny" => "70%",
                ],
                [
                    "nev" => "történelem",
                    "tipus" => "emelt",
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
                [
                    "nev" => "fizika",
                    "tipus" => "közép",
                    "eredmeny" => "98%",
                ],
            ],
            "tobbletpontok" => [
            ],
        ];

        $points = new Points(ELTEValidation::REQUIRED_SUBJECT, ELTEValidation::OPTIONAL_SUBJECTS);
        $result = $points->calculate($exampleData["erettsegi-eredmenyek"], $exampleData["tobbletpontok"]);

        echo $result;

        $this->assertEquals("476 (376 alappont + 100 többletpont)", $result);
    }
}
