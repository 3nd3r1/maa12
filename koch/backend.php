<?php

header("Content-type: image/png");

if(isset($_GET["n"]))
{
    $im=imagecreate(500,500);

    $n = $_GET["n"];
    $janat = [[[500,250],[0,250]]];

    $white = imagecolorallocate($im, 255,255,255);
    $black = imagecolorallocate($im, 0,0,0);

    for($i = 1; $i<$n; $i++)
    {
        $kok = count($janat);

        for($j=0;$j<$kok;$j++)
        {
            $jana=$janat[0];
            $dx = $jana[1][0]-$jana[0][0];
            $dy = $jana[1][1]-$jana[0][1];

            //Kahden pisteen etäisyys
            $d = sqrt($dx*$dx+$dy*$dy);

            $x1=$dx/3;
            $x2=$dx/3*2;
            $y1=$dy/3;
            $y2=$dy/3*2;

            $eka = $jana[0];
            $toka = [$eka[0]+$x1, $eka[1]+$y1];
            $kolmas = [$eka[0]+$x2, $eka[1]+$y2];
            $neljas = $jana[1];

            //Nollalla jako
            if($dx==0)
            {
                $dx=1;
            }

            $keskik=deg2rad(60)+atan($dy/$dx);
            $keskari=[$toka[0]+$d/3*cos($keskik),$toka[1]+$d/3*sin($keskik)];
            if($dx<0)
            {
                $keskari=[$toka[0]-$d/3*cos($keskik),$toka[1]-$d/3*sin($keskik)];
            }

            array_push($janat, [$eka,$toka]);
            array_push($janat, [$toka,$keskari]);
            array_push($janat, [$keskari,$kolmas]);
            array_push($janat, [$kolmas,$neljas]);
            array_shift($janat);

        }
    }

    foreach($janat as $jana)
    {
        imageline($im, (int)$jana[0][0], (int)$jana[0][1], (int)$jana[1][0], (int)$jana[1][1], $black);
    }
    imagepng($im);
}
?>