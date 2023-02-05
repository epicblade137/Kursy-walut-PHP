<html>
<head>
    <title>Zadanie kursy walut</title>
    <link rel="stylesheet" href="sztyle.css">
</head>
<body>
<div id="header">
        <h1>Kursy Walut</h1>
    </div>

    <form action="file2.php" method="POST">
    <div id="container">

    <label class="ap" style="padding: 85px";>Wybierz datę:</label>
    <ul>
            <li>Czas potrzebny jest, do ustalenia kursu w poniedziałki, </li>
            <li>Do godziny 12:00 obowiązują kursy z poprzedniego piątku,</li>
            <li>Uwaga, wybranie niepoprawnej daty!</li>
    </ul>
        <input type="datetime-local" id="dat" name="dat" value="2000-01-01T08:30" class="ap"></input>
        <input type="submit" value="Wyślij" id="send" class="bp"></input>
        <br /><br />
    </form>

    <?php
$url = "http://api.nbp.pl/api/exchangerates/tables/c/";
$today = date("Y/d/m");
$tab = ["Accept: application/json"];
//tabela aktualnych kursów
$data = getdate();
$conn = curl_init();

curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($conn, CURLOPT_URL, $url);
curl_setopt($conn, CURLOPT_HEADER, 0);
curl_setopt($conn, CURLOPT_HTTPHEADER, $tab);
//sesja curl
$response = curl_exec($conn);
curl_close($conn);

$j = json_decode($response);
?>
<label class="ap"><?="Aktualny kurs z dnia $today:" ?></label>
<br /><br />
<table class="darkTable">
<thead>
<tr>
<th>Waluta</th>
<th>Sprzedaż</th>
<th>Kupno</th>
</tr>
</thead>
<tbody>
<tr>
<td><?=$j[0]->rates[3]->code ?></td><td><?=$j[0]->rates[3]->bid
?></td><td><?=$j[0]->rates[3]->ask ?></td></tr>
<tr>
<td><?=$j[0]->rates[0]->code ?></td><td><?=$j[0]->rates[0]->bid
?></td><td><?=$j[0]->rates[0]->ask ?></td></tr>
<tr>
<td><?=$j[0]->rates[5]->code ?></td><td><?=$j[0]->rates[5]->bid
?></td><td><?=$j[0]->rates[5]->ask ?></td></tr>
<tr>
<td><?=$j[0]->rates[6]->code ?></td><td><?=$j[0]->rates[6]->bid
?></td><td><?=$j[0]->rates[6]->ask ?></td></tr>
</tbody>
</tr>
</table>
</div>
</body>
</html>
