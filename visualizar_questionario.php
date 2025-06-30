<?php
// $pdo = new PDO("mysql:host=localhost;dbname=gdf", "root", "");
$host= 'ca8lne8pi75f88.cluster-czrs8kj4isg7.us-east-1.rds.amazonaws.com';
$db = 'dchkp9m6kg8iob';
$user = 'u707dki3acvt0c';
$password = 'p4849cce3b611c7c1beb46009083504c84998915ec654a5fb78e15c745add45d0'; // change to your actual password
$dsn = "pgsql:host=$host;port=5432;dbname=$db;";
$pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$modelo_id = $_GET['id'] ?? null;
if (!$modelo_id) {
  echo "Questionário inválido.";
  exit;
}

// Buscar perguntas
$stmt = $pdo->prepare("SELECT * FROM perguntas_questionario WHERE modelo_id = :id ORDER BY id");
$stmt->execute(['id' => $modelo_id]);
$perguntas = $stmt->fetchAll();

// Buscar respostas para este questionário (usuário, se tiver sistema login, ajuste conforme)
$stmt2 = $pdo->prepare("SELECT pergunta, resposta FROM respostas_questionario WHERE modelo_id = :id");
$stmt2->execute(['id' => $modelo_id]);
$respostasArray = $stmt2->fetchAll(PDO::FETCH_KEY_PAIR);
?>

<style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #2c3e50;
    padding: 20px;
  }
  h2 {
    color: #34495e;
    border-bottom: 2px solid #2980b9;
    padding-bottom: 8px;
    margin-bottom: 20px;
  }
  form {
    background: #fff;
    padding: 25px 30px;
    border-radius: 8px;
    max-width: 900px;
    margin: auto;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
  }
  .pergunta {
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 1px solid #ddd;
  }
  .pergunta:last-child {
    border-bottom: none;
  }
  .pergunta strong {
    display: block;
    font-size: 1.1em;
    margin-bottom: 12px;
    color: #2980b9;
  }
  .opcoes label {
    display: inline-block;
    background: #ecf0f1;
    padding: 8px 14px;
    margin: 5px 10px 5px 0;
    border-radius: 20px;
    cursor: default;
    user-select: none;
    transition: background-color 0.3s ease;
    border: 1px solid transparent;
    font-size: 0.9em;
  }
  .opcoes label input[type="radio"] {
    display: none;
  }
  .opcoes label.checked {
    background-color: #2980b9;
    color: white;
    border-color: #1c5980;
  }
  textarea {
    width: 100%;
    resize: vertical;
    padding: 12px 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1em;
    background-color: #f0f3f4;
    color: #555;
    cursor: not-allowed;
  }
</style>

<div>
  <h2>Visualização do Questionário</h2>
  <form>
    <?php foreach ($perguntas as $p): ?>
      <div class="pergunta">
        <strong><?= htmlspecialchars($p['texto']) ?></strong>

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
          <div class="opcoes">
          <?php foreach ($opcoes as $opcao):
            $isChecked = (isset($respostasArray[$p['texto']]) && $respostasArray[$p['texto']] === $opcao);
          ?>
            <label class="<?= $isChecked ? 'checked' : '' ?>">
              <input type="radio" disabled <?= $isChecked ? 'checked' : '' ?>>
              <?= htmlspecialchars($opcao) ?>
            </label>
          <?php endforeach; ?>
          </div>

        <?php else: ?>
          <textarea rows="3" disabled><?= htmlspecialchars($respostasArray[$p['texto']] ?? '') ?></textarea>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </form>
</div>
