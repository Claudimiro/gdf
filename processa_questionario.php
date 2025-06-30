
<?php
// $pdo = new PDO("mysql:host=localhost;dbname=gdf", "root", "");
$host= 'ca8lne8pi75f88.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com';
$db = 'dchkp9m6kg8iob';
$user = 'u707dki3acvt0c';
$password = 'p4849cce3b611c7c1beb46009083504c84998915ec654a5fb78e15c745add45d0'; // change to your actual password
$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// ID do usuário fictício (pode vir de sessão)
$usuario_id = 1;

foreach ($_POST as $pergunta => $resposta) {
    if (is_array($resposta)) {
        $resposta = implode(", ", $resposta);
    }
    $stmt = $pdo->prepare("INSERT INTO respostas_questionario (usuario_id, pergunta, resposta) VALUES (?, ?, ?)");
    $stmt->execute([$usuario_id, $pergunta, $resposta]);
}

echo "<h3>Respostas salvas com sucesso!</h3>";

// Comparação com o gabarito (caso exista)
$stmt = $pdo->query("SELECT pergunta, resposta_correta FROM gabarito");
$gabarito = [];
foreach ($stmt as $row) {
    $gabarito[$row['pergunta']] = $row['resposta_correta'];
}

echo "<h3>Comparação com Gabarito:</h3>";
foreach ($_POST as $pergunta => $resposta) {
    if (is_array($resposta)) $resposta = implode(", ", $resposta);
    if (isset($gabarito[$pergunta])) {
        if (strtolower(trim($resposta)) == strtolower(trim($gabarito[$pergunta]))) {
            echo "<p><b>$pergunta:</b> Correto ✅</p>";
        } else {
            echo "<p><b>$pergunta:</b> Incorreto ❌ (Esperado: {$gabarito[$pergunta]})</p>";
        }
    }
}
?>
