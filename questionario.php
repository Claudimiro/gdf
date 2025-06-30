
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
   <title>Registrar Avaliação</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 20px;
    }
    h1, h2 {
      color: #2c3e50;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      max-width: 900px;
      margin: auto;
    }
    label {
      display: block;
      margin-top: 20px;
      font-weight: bold;
    }
    input[type="radio"], input[type="checkbox"] {
      margin-right: 8px;
    }
    textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      resize: vertical;
    }
    input[type="submit"] {
      margin-top: 30px;
      background-color: #2980b9;
      color: white;
      border: none;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #1c6ea4;
    }
  </style>
</head>
<body>
  <h1>Questionário de Avaliação de Sintomas Emocionais e Comportamentais</h1>
  <form method="post" action="processa_questionario.php">
<h2>Seção 1: Sintomas de Depressão</h2><label>Com que frequência você se sente triste ou desanimado?</label><br><input type='radio' name='depressao_triste' value='Nunca'> Nunca<br>
<input type='radio' name='depressao_triste' value='Raramente'> Raramente<br>
<input type='radio' name='depressao_triste' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='depressao_triste' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='depressao_triste' value='Quase sempre'> Quase sempre<br>
<label>Você tem perdido o interesse por atividades que costumava gostar?</label><br><input type='radio' name='depressao_interesse' value='Nunca'> Nunca<br>
<input type='radio' name='depressao_interesse' value='Raramente'> Raramente<br>
<input type='radio' name='depressao_interesse' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='depressao_interesse' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='depressao_interesse' value='Quase sempre'> Quase sempre<br>
<label>Você tem sentido fadiga ou falta de energia nas atividades de rotina?</label><br><input type='radio' name='depressao_fadiga' value='Nunca'> Nunca<br>
<input type='radio' name='depressao_fadiga' value='Raramente'> Raramente<br>
<input type='radio' name='depressao_fadiga' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='depressao_fadiga' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='depressao_fadiga' value='Quase sempre'> Quase sempre<br>
<label>Descreva brevemente como tem se sentido ultimamente em relação ao seu humor:</label><br><textarea name='depressao_descricao' rows='4' cols='50'></textarea><br><h2>Seção 2: Sintomas de Ansiedade</h2><label>Você costuma se sentir nervoso ou inquieto sem motivo aparente?</label><br><input type='radio' name='ansiedade_nervoso' value='Nunca'> Nunca<br>
<input type='radio' name='ansiedade_nervoso' value='Raramente'> Raramente<br>
<input type='radio' name='ansiedade_nervoso' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='ansiedade_nervoso' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='ansiedade_nervoso' value='Quase sempre'> Quase sempre<br>
<label>Você tem dificuldades para controlar a preocupação ou o medo?</label><br><input type='radio' name='ansiedade_preocupacao' value='Nunca'> Nunca<br>
<input type='radio' name='ansiedade_preocupacao' value='Raramente'> Raramente<br>
<input type='radio' name='ansiedade_preocupacao' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='ansiedade_preocupacao' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='ansiedade_preocupacao' value='Quase sempre'> Quase sempre<br>
<label>Você sente que seu coração acelera ou tem palpitações sem esforço físico?</label><br><input type='radio' name='ansiedade_palpitacoes' value='Nunca'> Nunca<br>
<input type='radio' name='ansiedade_palpitacoes' value='Raramente'> Raramente<br>
<input type='radio' name='ansiedade_palpitacoes' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='ansiedade_palpitacoes' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='ansiedade_palpitacoes' value='Quase sempre'> Quase sempre<br>
<label>Você sente algum desses sintomas com frequência? (Selecione os que se aplicam)</label><br><input type='checkbox' name='ansiedade_sintomas[]' value='vômitos'> vômitos<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='diarreia'> diarreia<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='tonturas e desmaios'> tonturas e desmaios<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='urticárias na pele, sem alergias aparentes'> urticárias na pele, sem alergias aparentes<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='dificuldades para dormir'> dificuldades para dormir<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='alteração no apetite (para mais e para menos)'> alteração no apetite (para mais e para menos)<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='enxaquecas persistentes'> enxaquecas persistentes<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='dificuldades de concentração'> dificuldades de concentração<br>
<input type='checkbox' name='ansiedade_sintomas[]' value='perdas de memória'> perdas de memória<br>
<label>Se sim, com que frequência sente:</label><br><textarea name='ansiedade_sintomas_frequencia' rows='3' cols='50'></textarea><br><label>Compartilhe se há situações específicas que aumentam sua ansiedade ou preocupação:</label><br><textarea name='ansiedade_situacoes' rows='4' cols='50'></textarea><br><h2>Seção 3: Tendência à Violência</h2><label>Você já sentiu vontade de agredir alguém em alguma situação?</label><br><input type='radio' name='violencia_agredir' value='Nunca'> Nunca<br>
<input type='radio' name='violencia_agredir' value='Raramente'> Raramente<br>
<input type='radio' name='violencia_agredir' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='violencia_agredir' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='violencia_agredir' value='Quase sempre'> Quase sempre<br>
<label>Se respondeu frequentemente ou quase sempre, nos diga o(s) motivo(s):</label><br><textarea name='violencia_motivos' rows='3' cols='50'></textarea><br><label>Quando enfrenta um conflito, sua reação costuma ser:</label><br><input type='radio' name='violencia_reacao' value='Procurar resolver pacificamente'> Procurar resolver pacificamente<br>
<input type='radio' name='violencia_reacao' value='Ficar nervoso, mas controlar-se'> Ficar nervoso, mas controlar-se<br>
<input type='radio' name='violencia_reacao' value='Ficar irritado e querer reagir de forma agressiva'> Ficar irritado e querer reagir de forma agressiva<br>
<input type='radio' name='violencia_reacao' value='Perder o controle e agir impulsivamente'> Perder o controle e agir impulsivamente<br>
<input type='radio' name='violencia_reacao' value='Não sei responder'> Não sei responder<br>
<label>Você acredita que tem tendência a agir com violência em situações de estresse?</label><br><input type='radio' name='violencia_tendencia' value='Nunca'> Nunca<br>
<input type='radio' name='violencia_tendencia' value='Raramente'> Raramente<br>
<input type='radio' name='violencia_tendencia' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='violencia_tendencia' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='violencia_tendencia' value='Quase sempre'> Quase sempre<br>
<label>Descreva alguma situação recente em que sentiu vontade de agir de forma agressiva:</label><br><textarea name='violencia_descricao' rows='4' cols='50'></textarea><br><h2>Seção 4: Relações Interpessoais</h2><label>Você vê relevância no seu trabalho?</label><br><input type='radio' name='relacao_trabalho' value='Nunca'> Nunca<br>
<input type='radio' name='relacao_trabalho' value='Raramente'> Raramente<br>
<input type='radio' name='relacao_trabalho' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='relacao_trabalho' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='relacao_trabalho' value='Quase sempre'> Quase sempre<br>
<label>Na equipe de trabalho você é conhecido como:</label><br><input type='radio' name='relacao_imagem' value='amigo de todos'> amigo de todos<br>
<input type='radio' name='relacao_imagem' value='reservado'> reservado<br>
<input type='radio' name='relacao_imagem' value='engraçado'> engraçado<br>
<input type='radio' name='relacao_imagem' value='reclamão'> reclamão<br>
<input type='radio' name='relacao_imagem' value='briguento'> briguento<br>
<label>Como você lida com conflitos e desentendimentos?</label><br><textarea name='relacao_conflito' rows='4' cols='50'></textarea><br><label>Você se sente confortável em pedir ajuda e apoio quando precisa?</label><br><input type='radio' name='relacao_ajuda' value='Nunca'> Nunca<br>
<input type='radio' name='relacao_ajuda' value='Raramente'> Raramente<br>
<input type='radio' name='relacao_ajuda' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='relacao_ajuda' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='relacao_ajuda' value='Quase sempre'> Quase sempre<br>
<label>Quais atitudes você acha que contribuem para uma comunicação saudável?</label><br><textarea name='relacao_comunicacao' rows='4' cols='50'></textarea><br><h2>Seção 5: Adoecimentos Emocionais e Bem-estar Geral</h2><label>Você tem sentido dificuldades para dormir ou tem tido pesadelos?</label><br><input type='radio' name='bem_dormir' value='Nunca'> Nunca<br>
<input type='radio' name='bem_dormir' value='Raramente'> Raramente<br>
<input type='radio' name='bem_dormir' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='bem_dormir' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='bem_dormir' value='Quase sempre'> Quase sempre<br>
<label>Você pratica atividade física?</label><br><input type='radio' name='bem_atividade' value='Nunca'> Nunca<br>
<input type='radio' name='bem_atividade' value='Raramente'> Raramente<br>
<input type='radio' name='bem_atividade' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='bem_atividade' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='bem_atividade' value='Quase sempre'> Quase sempre<br>
<label>Com que frequência promove atividades de lazer?</label><br><input type='radio' name='bem_lazer' value='Nunca'> Nunca<br>
<input type='radio' name='bem_lazer' value='Raramente'> Raramente<br>
<input type='radio' name='bem_lazer' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='bem_lazer' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='bem_lazer' value='Quase sempre'> Quase sempre<br>
<label>Com que frequência promove atividades de descanso e relaxamento?</label><br><input type='radio' name='bem_descanso' value='Nunca'> Nunca<br>
<input type='radio' name='bem_descanso' value='Raramente'> Raramente<br>
<input type='radio' name='bem_descanso' value='Algumas vezes'> Algumas vezes<br>
<input type='radio' name='bem_descanso' value='Frequentemente'> Frequentemente<br>
<input type='radio' name='bem_descanso' value='Quase sempre'> Quase sempre<br>
<label>Considera sua alimentação:</label><br><input type='radio' name='bem_alimentacao' value='péssima'> péssima<br>
<input type='radio' name='bem_alimentacao' value='ruim'> ruim<br>
<input type='radio' name='bem_alimentacao' value='boa'> boa<br>
<input type='radio' name='bem_alimentacao' value='muito boa'> muito boa<br>
<input type='radio' name='bem_alimentacao' value='ótima'> ótima<br>
<label>Compartilhe conosco como percebe sua saúde geral:</label><br><textarea name='bem_saude' rows='4' cols='50'></textarea><br><br><input type='submit' value='Enviar Questionário'>
</form>
</body>
</html>