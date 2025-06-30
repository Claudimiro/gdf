<?php
include('layout.php');

// $pdo = new PDO("mysql:host=localhost;dbname=gdf", "root", "");
$host= 'ca8lne8pi75f88.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com';
$db = 'dchkp9m6kg8iob';
$user = 'u707dki3acvt0c';
$password = 'p4849cce3b611c7c1beb46009083504c84998915ec654a5fb78e15c745add45d0'; // change to your actual password
$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Total de respostas por status
$totais = [
  'total' => $pdo->query("SELECT COUNT(*) FROM respostas_questionario")->fetchColumn(),
  'finalizado' => $pdo->query("SELECT COUNT(*) FROM respostas_questionario WHERE status = 'Finalizado'")->fetchColumn(),
  'pendente' => $pdo->query("SELECT COUNT(*) FROM respostas_questionario WHERE status = 'Pendente'")->fetchColumn()
];
?>

<div class="conteudo">
  <h1>Resumo dos Questionários</h1>
  <canvas id="grafico" width="400" height="200"></canvas>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('grafico').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Total', 'Finalizados', 'Pendentes'],
        datasets: [{
          label: 'Quantidade',
          data: [<?= $totais['total'] ?>, <?= $totais['finalizado'] ?>, <?= $totais['pendente'] ?>],
          backgroundColor: ['#34495e', '#27ae60', '#c0392b']
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: {
            display: true,
            text: 'Situação dos Questionários'
          }
        }
      }
    });
  </script>
</div>
