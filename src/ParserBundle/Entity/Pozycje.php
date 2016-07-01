<?php
namespace ParserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="pozycje")
 */
class Pozycje
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $excel_id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $code;
    /**
     * @ORM\Column(type="text")
     */
    private $label;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $unit;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set excelId
     *
     * @param string $excelId
     *
     * @return Pozycje
     */
    public function setExcelId($excelId)
    {
        $this->excel_id = $excelId;

        return $this;
    }

    /**
     * Get excelId
     *
     * @return string
     */
    public function getExcelId()
    {
        return $this->excel_id;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Pozycje
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Pozycje
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Pozycje
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Pozycje
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }
}
