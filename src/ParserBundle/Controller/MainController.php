<?php
namespace ParserBundle\Controller;

use Doctrine\ORM\Query;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\DBAL\Driver\PDOSqlite as pdo;

class MainController extends Controller
{
    protected function getDocument()
    {
        define('PATH_TO_DATA', $this->get('kernel')->getRootDir() . '/Resources/data/');
        $inputFile = PATH_TO_DATA . 'xls/first.xlsx';
        $reader = new \PHPExcel_Reader_Excel2007();
        $excelObj = $reader->load($inputFile);
        return $excelObj;
    }

    protected function getDB()
    {
        $em = $this->getDoctrine()->getManager();
        $dbrecords = $em->getRepository('ParserBundle:Pozycje');
        return $dbrecords;
    }

    public function indexAction()
    {

        $sheetsList = $this->getDocument()->getSheetNames();

        return $this->render('parser/index.html.twig', array(
            'sheetList' => $sheetsList
        ));
    }

    public function singleSheetAction($sheetName)
    {
        $worksheet = $this->getDocument()->getSheetByName($sheetName)->toArray();

        unset($worksheet[0]);

        unset($worksheet[1]);

        $worksheet = array_filter($worksheet,
            function ($arr) {
                return $arr[0] !== null;
            });

        $worksheet = array_values($worksheet);

        /*
         * DB repository
         */
        $dbRepo = $this->getDB();
//
        for ($i = 0; $i < count($worksheet); $i++) {
            $excelId = $worksheet[$i][0];
            $label = $worksheet[$i][2];
            $fromDb = $dbRepo->findBy(array('label' => $label));
            if (!empty($fromDb)) {

                if ($excelId == $fromDb[0]->getExcelId()) {
                    $newPrice = $worksheet[$i][5];
                    $this->getDoctrine()->getManager()->persist($fromDb[0]->setPrice($newPrice));
                    $this->getDoctrine()->getManager()->flush();
                    var_dump($fromDb[0]);
                } else {
                    echo 'No matches';
                    die;
                }
            }
//            var_dump($worksheet);
        }

//        var_dump($worksheet);

//        $dbRecords = $dbRepo->findAll(Query::HYDRATE_ARRAY);
//
//        for ($i = 0; $i < count($worksheet); $i++) {
//            $opisPozycji = $worksheet[$i][2];
//
//            $dbLabel = $dbRepo->findBy(array('label' => $opisPozycji));
//            if (!empty($dbLabel)) {
//                $newPrice = $worksheet[$i][5];
//                $this->getDoctrine()->getManager()->persist($dbLabel[0]->setPrice($newPrice));
//                $this->getDoctrine()->getManager()->flush();
//                var_dump($dbLabel);
//            }
//        }

        return $this->render('parser/sheet.html.twig', array(
            'sheetName' => $sheetName,
            'worksheet' => $worksheet
        ));
    }
}