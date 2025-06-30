<style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
  }
  .menu {
    width: 220px;
    background-color: #2c3e50;
    color: white;
    padding: 20px;
    height: 100vh;
    position: fixed;
  }
  .menu h2 {
    font-size: 18px;
    border-bottom: 1px solid #fff;
    padding-bottom: 10px;
  }
  .menu a {
    color: white;
    text-decoration: none;
    display: block;
    margin: 10px 0;
  }
  .menu a:hover {
    text-decoration: underline;
  }
  .conteudo {
    margin-left: 240px;
    padding: 30px;
    width: 100%;
  }
  .btn {
    padding: 6px 12px;
    color: white;
    border: none;
    border-radius: 4px;
    text-decoration: none;
    cursor: pointer;
  }
  .visualizar { background-color: #2980b9; }
  .responder { background-color: #27ae60; }
</style>

<div class="menu">
  <h2>Menu</h2>
  <a href="index.php">Dashboard</a>
  <a href="gestao_questionario.php">Consultar Questionário</a>
</div>
