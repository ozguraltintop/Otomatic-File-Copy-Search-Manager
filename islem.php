<?php 

$eski_klasor = $_REQUEST['klasor'];
$yeni_klasor = $_REQUEST['hklasor'];
$dosya_adi   = $_REQUEST['dosya'];
$excel   	 = $_REQUEST['excel'];
$yedek   	 = array();
$tara1   	 = array();
$tara2   	 = array();
#314
$exc = preg_split('/\s+/u', $excel);

$yedek=$exc; 
#314

islem2($exc,$eski_klasor,$yeni_klasor);

function islem2($exc,$e,$y)
{

#toplamdeger
	$toplam1 = count($exc);
	$toplam2 = count($exc)-1;
	$toplam2/=2;
#-----------------------


#degerlerin eslenmesi
	$t       = 0 ;
	for($i=0;$i<$toplam2;$i++)
	{	
		$tara1[$t]=$exc[$i*2];
		$t++;
	}
#---------------------
	$v       = 0 ;
	for($i=0;$i<$toplam2;$i++)
	{	

	  	$tara2[$v]=$exc[$i*2+1];
		$v++;
	}
#-----------------------


#----------------------

	$taratoplam = count($tara1);

	for($i=0;$i<$taratoplam;$i++)
	{

			$json1     = glob($e."/".$tara1[$i]."*");
			$json2     = glob($y."/".$tara1[$i]."*");

			$liste       = array_merge($json1, $json2);
			$listetoplam = count($liste);
			mkdir($tara2[$i]);
			$klasor    = $tara2[$i];
			

			for($m=0;$m<$listetoplam;$m++)
		{		
			$degisken = $liste[$m];
			$bolunmus = explode("/", $degisken);
			$token    = $liste[$m];
			copy($token,$klasor."/".$bolunmus[1]);

		}


	}



	
	header("location:index.php");
	echo "<script>

	$('.bir').hide();
	$('.iki').show();

	
	</script>";
}
#-----------------------------------------------------------
#-----------------------------------------------------------

function islem($e,$y,$d)
{

$json = glob($e."/".$d."*");

$toplamsayi = count($json);
mkdir($y);
mkdir("C:\Users\oaltintop\Desktop".$y);
$degisken = $json[0];
$bolunmus =explode("/", $degisken);

for($i=0;$i<$toplamsayi;$i++)
{		
	$token  = $json[$i];
	$bolunmus =explode("/", $token);
	copy($token,$y."/".$bolunmus[1]);
}

header("location:index.php");
echo "<script>alert('Basarili');</script>";


}
?>