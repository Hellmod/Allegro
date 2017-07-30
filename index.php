<pre><?php
require('simple_html_dom.php');
set_time_limit(120);
function szukaj($fraza,$co,$ktora){
    $temp=0;
    $pos=0;
    for($i=0;$i<=$ktora;$i++){
        $pos = strpos($fraza, $co,$temp);
        if ($pos == false)
            return false;
        $temp=$pos+1;
    }
    $pos=$pos+2+strlen($co);
    //$pos+=20;
    //echo $pos."</br>";
    $dlugosc = strpos($fraza,'"',$pos)-$pos;
    $odp = substr($fraza,$pos,$dlugosc);
    //echo $pos." ".$dlugosc." ".$odp." ";
    return $odp;
}

function szukajStrony($fraza){

    $pos = strpos($fraza, "data-page=");
    if ($pos == false)
        return false;
    $pos+=11;
    $dlugosc = strpos($fraza,'"',$pos)-$pos;
    return substr($fraza,$pos,$dlugosc);
}

//$adres="http://allegro.pl/listing/user/listing.php?us_id=45775016&order=pd";
$adres="http://allegro.pl/listing/user/listing.php?us_id=24801306&order=qd";

$html = file_get_html($adres);
    $info['nazwa']  = $html->find("._342830a a",0)->innertext;
    $info['cena']   = szukaj($html,'"normal":{"amount"',0);
    $info['url']   = $html->find("._342830a a",0)->href;
    echo "0_";
    print_r($info);
$j=1;
for($i=1;$i<5;$i++){//60
    $j+=2;
    $info['nazwa']  = $html->find("._342830a a",$i)->innertext;
    $info['cena']   = szukaj($html,'"normal":{"amount"',$i);
    $info['url']   = $html->find("._342830a a",$i)->href;
    //$info['img']   = '<img src="'.szukaj($html,'"medium"',3).'">';
    echo $i."_";
    print_r($info);    
}

$iloscStron= szukajStrony($html)."<br/>";
for($a=2;$a<=$iloscStron;$a++){
    $html = file_get_html($adres."&p=".$a);
        $info['nazwa']  = $html->find("._342830a a",0)->innertext;
        $info['cena']   = szukaj($html,'"normal":{"amount"',0);
        $info['url']   = $html->find("._342830a a",0)->href;
        echo "0_";
        print_r($info);
    $j=1;
    for($i=1;$i<5;$i++){//60
        $j+=2;
        $info['nazwa']  = $html->find("._342830a a",$i)->innertext;
        $info['cena']   = szukaj($html,'"normal":{"amount"',$i);
        $info['url']   = $html->find("._342830a a",$i)->href;
        //$info['img']   = '<img src="'.szukaj($html,'"medium"',3).'">';
        echo $i."_";
        print_r($info);    
    }

}


//______________________ZAPIS DO PLIKU____________________
/*
$fp = fopen("test.txt", "w");
fputs($fp,$html);
fclose($fp);
*/

?>
</pre>