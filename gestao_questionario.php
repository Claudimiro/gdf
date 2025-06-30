<?php
// gestao_questionario.php

// Ajuste esse usuário para o usuário logado no seu sistema
$usuario_id = 1;

try {
    $host= 'ca8lne8pi75f88.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com';
    $db = 'dchkp9m6kg8iob';
    $user = 'u707dki3acvt0c';
    $password = 'p4849cce3b611c7c1beb46009083504c84998915ec654a5fb78e15c745add45d0'; // change to your actual password
    $dsn = "pgsql:host=$host;port=5432;dbname=$db;";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buscar todos os questionários
    $stmt = $pdo->query("SELECT * FROM questionarios ORDER BY id");
    $questionarios = $stmt->fetchAll();

    // Buscar status das respostas do usuário
    $stmtStatus = $pdo->prepare("SELECT modelo_id, status FROM respostas_questionario WHERE usuario_id = :usuario_id");
    $stmtStatus->execute(['usuario_id' => $usuario_id]);
    $respostas = $stmtStatus->fetchAll();

    $statusRespostas = [];
    foreach ($respostas as $r) {
        $statusRespostas[$r['modelo_id']] = $r['status'];
    }
} catch (PDOException $e) {
    die("Erro ao conectar ou consultar banco: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Gestão de Questionários</title>
<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f4f7f9;
    margin: 0; padding: 0;
  }
  .container {
    display: flex;
    min-height: 100vh;
  }
  .menu-lateral {
    width: 220px;
    background-color: #34495e;
    color: white;
    padding: 20px;
  }
  .menu-lateral h2 {
    margin-top: 0;
    margin-bottom: 30px;
    font-weight: normal;
  }
  .menu-lateral a {
    color: white;
    text-decoration: none;
    display: block;
    margin-bottom: 15px;
    font-size: 16px;
  }
  .menu-lateral a:hover {
    text-decoration: underline;
  }
  .conteudo {
    flex-grow: 1;
    padding: 30px;
  }
  h1 {
    margin-top: 0;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 0 8px rgb(0 0 0 / 0.1);
    border-radius: 8px;
    overflow: hidden;
  }
  th, td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    text-align: left;
  }
  th {
    background-color: #34495e;
    color: white;
  }
  tr:hover {
    background-color: #f1f1f1;
  }
  .btn {
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
  }
  .btn.visualizar {
    background-color: #2980b9;
    color: white;
    margin-right: 8px;
  }
  .btn.visualizar:hover {
    background-color: #1f618d;
  }
  .btn.responder {
    background-color: #27ae60;
    color: white;
  }
  .btn.responder:hover {
    background-color: #1e8449;
  }
  /* Modal */
  #modalVisualizar {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.6);
    z-index: 9999;
    align-items: center;
    justify-content: center;
  }
  #modalVisualizar > div {
    background: white;
    max-width: 800px;
    max-height: 80vh;
    overflow-y: auto;
    border-radius: 8px;
    padding: 20px 30px;
    position: relative;
  }
  #fecharModal {
    position: absolute;
    top: 12px;
    right: 15px;
    font-size: 24px;
    border: none;
    background: none;
    cursor: pointer;
    color: #333;
  }
</style>
</head>
<body>
  <div class="container">
    <nav class="menu-lateral">
      <h2>Menu</h2>
      <a href="gestao_questionario.php">Gestão de Questionários</a>
      <a href="dashboard.php">Dashboard</a>
    </nav>

    <main class="conteudo">
      <h1>Gestão de Questionários</h1>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!$questionarios): ?>
            <tr><td colspan="5" style="text-align:center;">Nenhum questionário cadastrado.</td></tr>
          <?php else: ?>
            <?php foreach ($questionarios as $q): ?>
            <tr>
              <td><?= $q['id'] ?></td>
              <td><?= htmlspecialchars($q['titulo']) ?></td>
              <td><?= htmlspecialchars($q['descricao']) ?></td>
              <td>
                <?= isset($statusRespostas[$q['id']]) ? htmlspecialchars($statusRespostas[$q['id']]) : 'Pendente' ?>
              </td>
              <td>
                <div style="display:flex; gap:8px;">
                  <button class="btn visualizar" data-id="<?= $q['id'] ?>">Visualizar</button>
                  <a class="btn responder" href="responder_questionario.php?id=<?= $q['id'] ?>">Responder</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </main>
  </div>

  <!-- Modal para visualização -->
  <div id="modalVisualizar">
    <div>
      <button id="fecharModal">&times;</button>
      <div id="conteudoModal">Carregando...</div>
    </div>
  </div>

  <script>
    // Abrir modal e carregar via AJAX
    document.querySelectorAll('.visualizar').forEach(btn => {
      btn.addEventListener('click', () => {
        const id = btn.getAttribute('data-id');
        const modal = document.getElementById('modalVisualizar');
        const conteudo = document.getElementById('conteudoModal');
        modal.style.display = 'flex';
        conteudo.innerHTML = 'Carregando...';

        fetch('visualizar_questionario.php?id=' + id)
          .then(res => res.text())
          .then(html => {
            conteudo.innerHTML = html;
            // Desabilitar todos os inputs para somente leitura
            conteudo.querySelectorAll('input, textarea, select').forEach(el => el.disabled = true);
          })
          .catch(() => {
            conteudo.innerHTML = 'Erro ao carregar o questionário.';
          });
      });
    });

    // Fechar modal
    document.getElementById('fecharModal').addEventListener('click', () => {
      document.getElementById('modalVisualizar').style.display = 'none';
    });

    // Fecha modal se clicar fora da área do conteúdo
    document.getElementById('modalVisualizar').addEventListener('click', (e) => {
      if (e.target === document.getElementById('modalVisualizar')) {
        document.getElementById('modalVisualizar').style.display = 'none';
      }
    });
  </script>
</body>
</html>
