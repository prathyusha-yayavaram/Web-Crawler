<!DOCTYPE html>
<html>
<head>
	<title>Search Jewellary</title>
	<h1><center>Search</center></h1>
</head>
<body background="img1.jpg" >
<form action="cosine.php" method="post">
<center><input type="text" name="search" id="query" size="100px" style="height:50px;font-size:25px" placeholder="Search here.." /></center>
</form>
</body>
</html>
<?php
if(isset($_POST['search'])){
	$indfile = fopen("index.txt", "r") or die("Unable to open file !");
	$content = file_get_contents("index.txt");
	$lines = explode("\n",$content);
	$query = $_POST['search'];
	$words = explode(" ", $query);
	$len = sizeof($words);
	$Q = array_fill(0,$len,1);
	$D1 = array_fill(0,$len,0);
	$D2 = array_fill(0,$len,0);
	$D3 = array_fill(0,$len,0);
	$D4 = array_fill(0,$len,0);
	$D5 = array_fill(0,$len,0);
	$D6 = array_fill(0,$len,0);
	$D7 = array_fill(0,$len,0);
	$D8 = array_fill(0,$len,0);
	$D9 = array_fill(0,$len,0);
	$D10 = array_fill(0,$len,0);
	$D11 = array_fill(0,$len,0);
	$D12 = array_fill(0,$len,0);
	$D13 = array_fill(0,$len,0);
	$D14 = array_fill(0,$len,0);
    $D15 = array_fill(0,$len,0);
    $D16 = array_fill(0,$len,0);
    $D17 = array_fill(0,$len,0);
    $D18 = array_fill(0,$len,0);
	$rank = array();
	$docs = array($D1,$D2,$D3,$D4,$D5,$D6,$D7,$D8,$D9,$D10,$D11,$D12,$D13,$D14,$D15,$D16,$D17,$D18);
	$url = array('www.khazanajewellery.com/','www.tanishq.co.in/','www.google.co.in/','www.bluestone.com/','www.malabargoldanddiamonds.com/','www.kalyanjewellersonline.com/','www.grtjewels.com/','www.nakshatra.world/','www.damasjewellery.com/?SID=mkh8bclvs7b6kq50jiht7roiv3','www.nirvanaonline.com/','www.abharan.com/','www.asmidiamonds.in/','www.littlenathella.com/','www.titan.co.in/shop-online/category/jewellery?cm_mmc=GooJewNonB-_-657209451-_-39319815244-_-184427477173&gclid=Cj0KEQjwqtjGBRD8yfi9h42H9YUBEiQAmki5Oj74Vwym43VCaanFYUvLMU-VlY-WfkZIfEJrOdVBgvQaAg7M8P8HAQ','www.shanthijewellers.com/','www.kiahjewels.com/','www.moirafinejewellery.com/','www.orra.co.in/');
	$dno = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18);
	$name = array("khazana","tanishq","amarapalijewels","bluestone","malabar","kalyan","grt","nakshatra","ddamas","nirvana","abharan","asmi","littlenathella","titan","shanthi","kiah","moira","orra");

	//Offers
	$flag = 0;
	foreach ($words as $temp) {
		if($temp == "offer" || $temp == "offers"){
			$flag = 1;
		}
	}



	for ($i=0; $i < $len; $i++) { 
		$cur = $words[$i];
		foreach ($lines as $line) {
			if(strpos($line,$cur)!== FALSE){
				$match = explode(" ",$line);
				$part = explode("/",$match[1]);
				foreach($part as $var){
					$last = explode("-", $var);
					$docs[$last[0]-1][$i]=$last[1];
				}
			}
		}
	}
	function Mod($Xmod,$len)
	{
		$sq=0;
		for ($i=0; $i < $len; $i++) { 
			$sq = $sq + pow($Xmod[$i], 2);
		}
		$res = sqrt($sq);
		return $res;
	}
	for ($i=0; $i < 18; $i++) { 
		$dot = 0;
		for ($j=0; $j < $len; $j++) { 
			$dot = $dot+($docs[$i][$j]*$Q[$j]);
		}
		$den = Mod($Q,$len)*Mod($docs[$i],$len);
		if($den!=0){
		$sim = bcdiv($dot, $den,3);
	    }
	    else{
	    	$sim=0;
	    }
		$rank[]= $sim;
	}
	$rd = array_combine($dno, $rank);
	arsort($rd);
	echo "<div id=\"div0\" style=\"text-align:center;font-size: 25px;align-self:center;width:100%;height:750px;\"><br><br> ";
	foreach ($rd as $key => $value){
		echo "<a href=http://".$url[$key-1].">".$name[$key-1]."</a>"."<br>";
	}
	echo "</div>";

	//location
	echo "<center><a href=\"loc.php\"><h1>Nearby Locations</h1></a></center>";


	//offers
		echo "<br><center><a href=\"off.php\"><h1>Offers</h1></a></center><br>";
}
 ?>