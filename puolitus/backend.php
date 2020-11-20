<?php

require $_SERVER["DOCUMENT_ROOT"].'/vendor/autoload.php';

class puolitus
{
    public $a;
    public $b;
    public $decimal;
    public $fx;

    protected $sread;
    protected $sh;

    function __construct($a, $b, $decimal, $fx) 
    {
        $this->a = $a;
        $this->b = $b;
        $this->decimal = $decimal;
        $this->fx = $fx;

        $this->sread = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $this->sh = $this->sread->getActiveSheet();

        $this->createSheet();
        $this->fillSheet();
    }

    private function func($x)
    {
        return math_eval($this->fx,["x"=>$x]);
    }

    private function createSheet()
    {
        $sh = $this->sh;
        $sh->setCellValue("A1","a");
        $sh->setCellValue("B1","b");
        $sh->setCellValue("C1","c");
        $sh->setCellValue("D1","f(a)");
        $sh->setCellValue("E1","f(b)");
        $sh->setCellValue("F1","f(c)");
        $sh->setCellValue("G1","f(a)*f(b)");

        //Teema tänne
        return true;
    }

    public function tarkkuusCheck($a, $b)
    {
        return (abs($a-$b)<(10**(-$this->decimal)));
    }

    private function fillSheet()
    {
        $sh = $this->sh;

        $a = $this->a;
        $b = $this->b;
        $c = ($a+$b)/2;
        $fxa = $this->func($a);
        $fxb = $this->func($b);
        $fxc = $this->func($c);

        $i = 2;

        while(!$this->tarkkuusCheck($a,$b))
        {
            $sh->setCellValue("A".$i,$a);
            $sh->setCellValue("B".$i,$b);
            $sh->setCellValue("C".$i,$c);
            $sh->setCellValue("D".$i,$fxa);
            $sh->setCellValue("E".$i,$fxb);
            $sh->setCellValue("F".$i,$fxc);
            $sh->setCellValue("G".$i,$fxa*$fxc);

            if($fxa*$fxc>0)
            {
                $a=$c;
            }
            else
            {
                $b=$c;
            }
            $c = ($a+$b)/2;
            $fxa=$this->func($a);
            $fxb=$this->func($b);
            $fxc=$this->func($c);
            $i++;
        }

        return true;
    }

    public function printImage()
    {
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Html($this->sread);
        $writer->save("imgs/test.html");
        echo '<h3>f(x) = '.$this->fx.'</h3><br>';
        echo file_get_contents("imgs/test.html");
        shell_exec("rm ./imgs/test.html");
        return true;
    }

}

?>