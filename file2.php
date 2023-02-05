<html>
<head>
    <title>Zadanie kursy walut</title>
    <link rel="stylesheet" href="sztyle.css">
</head>
<body>
<div id="header">
        <h1>Kursy Walut</h1>
    </div>
<div id="container">
<?php 

if(isset($_POST["dat"])){
$d = date($_POST["dat"]);

//funkcja sprawdzająca czy wybrana data jest weekendem
function czyWeekend($data) {
    
    $r;
    if(date('N', strtotime($data)) >= 6) $r = strtotime("$data last Friday");
    else if(date('N', strtotime($data)) == 1 && date('H', strtotime($data)) < 12) $r = strtotime("$data last Friday");
    else $r = strtotime($data);
    return $r;
}

$nowdat = czyWeekend($d);

$d2 = date("Y-d-m", $nowdat);

$u = "http://api.nbp.pl/api/exchangerates/tables/c/$d2";

$a = array(
    'Accept: application/json'
);

//sesja curl
$conn = curl_init();

curl_setopt($conn, CURLOPT_URL, $u);
curl_setopt($conn, CURLOPT_HEADER, 0);
curl_setopt($conn, CURLOPT_HTTPHEADER, $a);
curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);

$o = curl_exec($conn);
curl_close($conn);

$j = json_decode($o);
//drukowanie tabeli
if($j == null) {
    print "Brak danych, sprawdź poprawność daty!!";
}
else {
    print "<label>Kurs z dnia $d2</label>
    <table>
    <thead>
    <tr>
    <th>Waluta</th>
    <th>Sprzedaż</th>
    <th>Kupno</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <td>". $j[0]->rates[3]->code ."</td><td>". $j[0]->rates[3]
        ->bid ."</td><td>". $j[0]->rates[3]->ask ."</td></tr>
    <tr>
    <td>". $j[0]->rates[0]->code ."</td><td>". $j[0]->rates[0]
        ->bid ."</td><td>". $j[0]->rates[0]->ask ."</td></tr>
    <tr>
    <td>". $j[0]->rates[5]->code ."</td><td>". $j[0]->rates[5]
        ->bid ."</td><td>". $j[0]->rates[5]->ask ."</td></tr>
    <tr>
    <td>". $j[0]->rates[6]->code ."</td><td>". $j[0]->rates[6]
        ->bid ."</td><td>". $j[0]->rates[6]->ask ."</td></tr>
    </tbody>
    </tr>
    </table>" ;
}

}
?>
<a href="file.php">Wróć do poprzedniej strony</a>
</div>
</body>
</html>