
<?php
// $pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");
$host= 'ca8lne8pi75f88.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com';
$db = 'dchkp9m6kg8iob';
$user = 'u707dki3acvt0c';
$password = 'p4849cce3b611c7c1beb46009083504c84998915ec654a5fb78e15c745add45d0'; // change to your actual password
$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "<h1>Dashboard de Acompanhamento</h1>";

$stmt = $pdo->query("SELECT pergunta, resposta, COUNT(*) as total FROM respostas_questionario GROUP BY pergunta, resposta ORDER BY pergunta");

$current_pergunta = '';
foreach ($stmt as $row) {
    if ($row['pergunta'] != $current_pergunta) {
        if ($current_pergunta != '') echo "</ul>";
        $current_pergunta = $row['pergunta'];
        echo "<h3>$current_pergunta</h3><ul>";
    }
    echo "<li>{$row['resposta']}: {$row['total']}</li>";
}
echo "</ul>";
?>
