<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>EcoMap - Catálogo Ecológico</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    * {box-sizing: border-box; margin: 0; padding: 0;}
    body {
      background-color: #e8ffe8;
      font-family: Arial, sans-serif;
      color: #2a3a2d;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #178A17;
      color: white;
      padding: 15px 30px;
    }
    .logo {
      font-size: 1.8rem;
      font-weight: bold;
      letter-spacing: 2px;
    }
    .search-bar {
      display: flex;
      flex: 1;
      max-width: 700px;
      align-items: center;
      gap: 8px;
      margin: 0 30px;
    }
    .search-bar input {
      flex-grow: 1;
      border: none;
      padding: 10px 15px;
      outline: none;
      background: #fff;
      color: #2a3a2d;
      border-radius: 4px;
      font-size: 1em;
    }
    .btn-group {
      display: flex;
      gap: 8px;
    }
    .search-bar button, .filter-toggle {
      background: #178A17;
      color: white;
      border: none;
      padding: 9px 18px;
      border-radius: 4px;
      cursor: pointer;
      font-weight: 600;
      font-size: 1em;
      transition: background 0.2s;
    }
    .search-bar button:hover, .filter-toggle:hover {
      background: #136b13;
    }
    nav a {
      color: white;
      margin-left: 22px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.06em;
    }
    nav a:hover {
      text-decoration: underline;
    }
    .main-wrapper {
      display: flex;
      flex-direction: column;
      margin: 32px 0 0 0;
    }
    .filter-bar {
      background: #cfffcf;
      border-radius: 10px;
      padding: 16px 14px;
      box-shadow: 0 2px 6px #0001;
      display: none;
      flex-direction: column;
      gap: 12px;
      max-width: 720px;
      margin: 10px auto 20px auto;
      animation: fadein 0.6s;
    }
    @keyframes fadein {
      from {opacity: 0;}
      to {opacity: 1;}
    }
    .filter-bar label {
      color: #228B22;
      font-size: 1.01em;
      font-weight: bold;
      margin-bottom: 6px;
      display: block;
    }
    .filter-bar input, .filter-bar select {
      width: 100%;
      padding: 7px;
      border-radius: 4px;
      border: 1px solid #a6e0a6;
      background: #f6fff6;
      margin-bottom: 10px;
      font-size: 1em;
    }
    .filter-bar button {
      background: #178A17;
      color: #fff;
      border-radius: 4px;
      border: none;
      padding: 8px;
      font-weight: bold;
      width: 100px;
      margin-top: 4px;
      cursor: pointer;
      font-size: 1em;
      align-self: flex-end;
      transition: background 0.2s;
    }
    .filter-bar button:hover {
      background: #136b13;
    }
    .catalog {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      justify-items: center;
      padding: 20px 40px 40px 40px;
      max-width: 1400px;
      margin: 0 auto;
    }
    .item {
      border: 2px solid #228B22;
      background: #f6fff6;
      padding: 13px;
      border-radius: 12px;
      min-width: 210px;
      max-width: 330px;
      min-height: 360px;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 0 4px 12px #0001;
      transition: box-shadow 0.2s;
      margin-bottom: 4px;
    }
    .item:hover {
      box-shadow: 0 8px 28px #228B2233;
    }
    .img-box {
      width: 100%;
      height: 140px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #ecfcec;
      border-radius: 8px;
      margin-bottom: 12px;
    }
    .item img {
      max-width: 95%;
      max-height: 95%;
      object-fit: contain;
      background: transparent;
      border-radius: 6px;
    }
    .item h2,
    .item p,
    .preco {
      width: 100%;
      text-align: center;
    }
    .item h2 {
      color: #178A17;
      font-size: 1.15em;
      margin-bottom: 5px;
      font-weight: bold;
    }
    .preco {
      font-size: 1.1em;
      color: #178A17;
      font-weight: bold;
      margin: 6px 0;
    }
    .item .avaliacao {
      color: #ffa502;
      font-size: 1.04em;
      margin-bottom: 8px;
    }
    .item p {
      color: #346C34;
      font-size: 0.96em;
      margin-bottom: 11px;
    }
    .comprar {
      margin-top: auto;
      background: #228B22;
      color: #fff;
      padding: 8px 17px;
      border-radius: 8px;
      text-decoration: none;
      display: block;
      text-align: center;
      font-size: 1em;
      font-weight: bold;
    }
    @media (max-width: 1000px) {
      .catalog {
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        padding: 10px;
      }
      .item {
        min-width: 180px;
      }
    }
    @media (max-width: 700px) {
      .search-bar input {
        width: 160px;
      }
      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      nav {
        margin-top: 8px;
      }
      .main-wrapper {
        margin-top: 8px;
      }
      .filter-bar {
        max-width: 99vw;
      }
      .catalog {
        padding: 0 8px;
      }
    }
  </style>
  <script>
    function toggleFilterBar() {
      let fb = document.getElementById("filterBar");
      fb.style.display = fb.style.display === "flex" ? "none" : "flex";
    }
  </script>
</head>
<body>
  <header>
    <div class="logo">EcoMap</div>
    <form class="search-bar" method="get" action="">
      <input
        type="text"
        name="search"
        id="searchInput"
        placeholder="Pesquisar produtos ecológicos..."
        value="<?php echo isset($_GET["search"]) ? htmlspecialchars($_GET["search"]) : ""; ?>"
      />
      <div class="btn-group">
        <button type="submit">Buscar</button>
        <button type="button" class="filter-toggle" onclick="toggleFilterBar()">
          Filtrar
        </button>
      </div>
    </form>
    <nav>
      <a href="index.html">Inicio</a>
      <a href="catalogo.php">Catálogo</a>
      <a href="comunidade.html">Comunidade</a>
    </nav>
  </header>
  <div class="main-wrapper">
    <aside class="filter-bar" id="filterBar">
      <form method="get" action="">
        <label for="filter-nome">Nome:</label>
        <input
          type="text"
          name="search"
          id="filter-nome"
          value="<?php echo isset($_GET["search"]) ? htmlspecialchars($_GET["search"]) : ""; ?>"
        />
        <label for="min-price">Preço mínimo:</label>
        <input
          type="number"
          step="0.01"
          name="min_price"
          id="min-price"
          value="<?php echo isset($_GET["min_price"]) ? htmlspecialchars($_GET["min_price"]) : ""; ?>"
        />
        <label for="max-price">Preço máximo:</label>
        <input
          type="number"
          step="0.01"
          name="max_price"
          id="max-price"
          value="<?php echo isset($_GET["max_price"]) ? htmlspecialchars($_GET["max_price"]) : ""; ?>"
        />
        <label for="filter-cat">Categoria:</label>
        <select name="categoria" id="filter-cat">
          <option value="">Todas</option>
          <option value="Limpeza" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Limpeza") ? "selected" : ""; ?>>Limpeza</option>
          <option value="Utensílios" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Utensílios") ? "selected" : ""; ?>>Utensílios</option>
          <option value="Moda" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Moda") ? "selected" : ""; ?>>Moda</option>
          <option value="Cosméticos" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Cosméticos") ? "selected" : ""; ?>>Cosméticos</option>
          <option value="Alimentos" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Alimentos") ? "selected" : ""; ?>>Alimentos</option>
          <option value="Bebidas" <?php echo (isset($_GET["categoria"]) && $_GET["categoria"] == "Bebidas") ? "selected" : ""; ?>>Bebidas</option>
        </select>
        <button type="submit">Filtrar</button>
      </form>
    </aside>
    <section class="catalog">
      <?php
      $conn = new mysqli("localhost", "root", "", "catalogo_db");
      if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
      }

      $whereClauses = [];
      if (!empty($_GET["search"])) {
        $search = $conn->real_escape_string($_GET["search"]);
        $whereClauses[] = "nome LIKE '%$search%'";
      }
      if (!empty($_GET["min_price"])) {
        $min = floatval($_GET["min_price"]);
        $whereClauses[] = "preco >= $min";
      }
      if (!empty($_GET["max_price"])) {
        $max = floatval($_GET["max_price"]);
        $whereClauses[] = "preco <= $max";
      }
      if (!empty($_GET["categoria"])) {
        $cat = $conn->real_escape_string($_GET["categoria"]);
        $whereClauses[] = "categoria = '$cat'";
      }
      $whereSQL = count($whereClauses) ? "WHERE " . implode(" AND ", $whereClauses) : "";
      $sql = "SELECT * FROM produtos $whereSQL ORDER BY nome ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<div class='item'>";
              $img = !empty($row["foto"]) ? htmlspecialchars($row["foto"]) : "https://via.placeholder.com/220x140?text=Sem+imagem";
              echo "<div class='img-box'><img src='" . $img . "' alt='" . htmlspecialchars($row["nome"]) . "' loading='lazy'></div>";
              echo "<h2>" . htmlspecialchars($row["nome"]) . "</h2>";
              echo "<div class='preco'>R$ " . number_format($row["preco"], 2, ',', '.') . "</div>";
              echo "<div class='avaliacao'>☆☆☆☆☆</div>";
              echo "<p>" . htmlspecialchars($row["descricao"]) . "</p>";
              // Link de compra com target="_blank"
              echo "<a class='comprar' href='" . htmlspecialchars($row["link_compra"]) . "' target='_blank'>Onde Comprar</a>";
              echo "</div>";
          }
      } else {
          echo "<p>Nenhum produto ecológico encontrado.</p>";
      }
      $conn->close();
      ?>
    </section>
  </div>
</body>
</html>
