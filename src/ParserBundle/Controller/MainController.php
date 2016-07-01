<?php
/**
 * Created by PhpStorm.
 * User: paulf_000
 * Date: 2016-06-29
 * Time: 22:24
 */

namespace ParserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\DBAL\Driver\PDOSqlite as pdo;
use ParserBundle\Entity\Pozycje;
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

    public function indexAction()
    {
        $pozycje = new Pozycje();
        $em = $this->getDoctrine()->getManager();
        $foo = $em->getRepository('ParserBundle:Pozycje')->findBy(array('id'=> 2));
        var_dump($foo);
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

        foreach ($worksheet as $item) {
            if ($item[0] !== null) {
                var_dump($item);
            }
        }
        return $this->render('parser/sheet.html.twig', array(
            'sheetName' => $sheetName
        ));
    }
}