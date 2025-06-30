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

$modelo_id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['respostas'] as $pergunta_id => $resposta) {
        $stmt = $pdo->prepare("INSERT INTO respostas_questionario (modelo_id, pergunta, resposta, data_resposta, status)
                               VALUES (:modelo_id, (SELECT texto FROM perguntas_questionario WHERE id = :pergunta_id), :resposta, NOW(), 'Finalizado')");
        $stmt->execute([
            'modelo_id' => $modelo_id,
            'pergunta_id' => $pergunta_id,
            'resposta' => $resposta
        ]);
    }
    echo "<p style='color: green; font-weight: bold;'>Respostas salvas com sucesso!</p>";
    echo "<a href='gestao_questionario.php' style='display: inline-block; margin-top: 10px;'>← Voltar à Gestão</a>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM perguntas_questionario WHERE modelo_id = :id ORDER BY id");
$stmt->execute(['id' => $modelo_id]);
$perguntas = $stmt->fetchAll();

function getSecao($texto) {
    if (stripos($texto, 'depressão') !== false || stripos($texto, 'humor') !== false) return 'Seção 1: Sintomas de Depressão';
    if (stripos($texto, 'ansiedade') !== false || stripos($texto, 'nervoso') !== false || stripos($texto, 'coração') !== false) return 'Seção 2: Sintomas de Ansiedade';
    if (stripos($texto, 'violência') !== false || stripos($texto, 'agredir') !== false || stripos($texto, 'conflito') !== false) return 'Seção 3: Tendência à Violência';
    if (stripos($texto, 'trabalho') !== false || stripos($texto, 'equipe') !== false || stripos($texto, 'conflitos') !== false) return 'Seção 4: Relações Interpessoais';
    if (stripos($texto, 'dormir') !== false || stripos($texto, 'atividade física') !== false || stripos($texto, 'alimentação') !== false) return 'Seção 5: Adoecimentos Emocionais e Bem-estar Geral';
    return 'Outros';
}

$secoes = [];
foreach ($perguntas as $p) {
    $secao = getSecao($p['texto']);
    $secoes[$secao][] = $p;
}
?>

<style>
  .conteudo {
    max-width: 900px;
    margin: 30px auto;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #222;
  }
  h1 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
  }
  h2.secao {
    background-color: #34495e;
    color: white;
    padding: 10px 20px;
    margin-top: 40px;
    border-radius: 6px;
  }
  form {
    background: #fff;
    padding: 25px;
    box-shadow: 0 2px 10px rgb(0 0 0 / 0.1);
    border-radius: 8px;
  }
  .pergunta {
    border: 1px solid #ddd;
    padding: 18px 25px;
    margin-bottom: 20px;
    border-radius: 6px;
    background-color: #fafafa;
  }
  .pergunta label {
    font-weight: 600;
    display: block;
    margin-bottom: 10px;
  }
  .pergunta textarea {
    width: 100%;
    font-size: 1rem;
    padding: 8px 12px;
    border-radius: 4px;
    border: 1px solid #ccc;
    resize: vertical;
  }
  .opcao {
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    cursor: pointer;
  }
  .opcao input[type="radio"] {
    margin-right: 10px;
    cursor: pointer;
  }
  button.btn.responder {
    background-color: #27ae60;
    color: white;
    border: none;
    padding: 12px 28px;
    font-size: 1.1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  button.btn.responder:hover {
    background-color: #1e8449;
  }
</style>

<div class="conteudo">
  <h1>Responder Questionário</h1>

  <form method="POST">
    <?php foreach ($secoes as $nomeSecao => $perguntasSecao): ?>
      <h2 class="secao"><?= htmlspecialchars($nomeSecao) ?></h2>
      <?php foreach ($perguntasSecao as $p): ?>
        <div class="pergunta">
          <label for="pergunta_<?= $p['id'] ?>"><?= htmlspecialchars($p['texto']) ?></label>

          <?php if ($p['tipo'] === 'alternativa'): ?>
            <?php
              $opcoes = ['Nunca', 'Raramente', 'Às vezes', 'Frequentemente', 'Sempre'];
              if (stripos($p['texto'], 'Na equipe de trabalho você é conhecido') !== false) {
                $opcoes = [
                  'amigo de todos - pessoa com facilidade de fazer amizades, conversar, compartilhar informações pessoais e etc.',
                  'reservado - pessoa de pouca interação, cumprimenta os colegas, conversa quando precisa, mas não se aprofunda nos diálogos.',
                  'engraçado - pessoa que faz piadas, comenta situações e informações para interagir com os colegas, utiliza do humor para isso.',
                  'reclamão - pessoa que costuma reclamar do ambiente, dos colegas, da carga horária e afins',
                  'briguento - pessoa que se irrita com facilidade, se exalta em algumas situações, briga com colegas e etc.'
                ];
              }
              if (stripos($p['texto'], 'Considera sua alimentação') !== false) {
                $opcoes = ['péssima', 'ruim', 'boa', 'muito boa', 'ótima'];
              }
            ?>
            <?php foreach ($opcoes as $opcao): ?>
              <label class="opcao">
                <input type="radio" name="respostas[<?= $p['id'] ?>]" value="<?= htmlspecialchars($opcao) ?>" required>
                <?= htmlspecialchars($opcao) ?>
              </label>
            <?php endforeach; ?>
          <?php else: ?>
            <textarea name="respostas[<?= $p['id'] ?>]" id="pergunta_<?= $p['id'] ?>" rows="4" required></textarea>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php endforeach; ?>

    <button class="btn responder" type="submit">Enviar Respostas</button>
  </form>
</div>
