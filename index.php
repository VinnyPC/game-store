<!-- index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Jogos</title>
</head>
<body>
    <h1>Listagem de Jogos</h1>

    <form action="index.php" method="GET">
        <label for="category">Categoria:</label>
        <select name="category" id="category">
            <option value="mmorpg">mmorpg</option>
            <option value="shooter">shooter</option>
            <option value="strategy">strategy</option>
            <option value="moba">moba</option>
            <option value="racing">racing</option>
            <option value="sports">sports</option>
            <option value="social">social</option>
            <option value="sandbox">sandbox</option>
            <option value="open-world">open-world</option>
            <option value="survival">survival</option>
            <option value="pvp">pvp</option>
            <option value="pve">pve</option>
            <option value="pixel">pixel</option>
            <option value="voxel">voxel</option>
            <option value="zombie">zombie</option>
            <option value="turn-based">turn-based</option>
            <option value="first-person">first-person</option>
            <option value="third-Person">third-Person</option>
            <option value="top-down">top-down</option>
            <option value="tank">tank</option>
            <option value="space">space</option>
            <option value="sailing">sailing</option>
            <option value="side-scroller">side-scroller</option>
            <option value="superhero">superhero</option>
            <option value="permadeath">permadeath</option>
            <option value="card">card</option>
            <option value="battle-royale">battle-royale</option>
            <option value="mmo">mmo</option>
            <option value="mmofps">mmofps</option>
            <option value="mmotps">mmotps</option>
            <option value="3d">3d</option>
            <option value="2d">2d</option>
            <option value="anime">anime</option>
            <option value="fantasy">fantasy</option>
            <option value="sci-fi">sci-fi</option>
            <option value="fighting">fighting</option>
            <option value="action-rpg">action-rpg</option>
            <option value="action">action</option>
            <option value="military">military</option>
            <option value="martial-arts">martial-arts</option>
            <option value="flight">flight</option>
            <option value="low-spec">low-spec</option>
            <option value="tower-defense">tower-defense</option>
            <option value="horror">horror</option>
            <option value="mmorts">mmorts</option>
            
        </select>

        <label for="platform">Plataforma:</label>
        <select name="platform" id="platform">
            <option value="all">Todas</option>
            <option value="pc">PC</option>
            <option value="browser">Browser</option>
        </select>

        <label for="sort_by">Ordenar por:</label>
        <select name="sort_by" id="sort_by">
            <option value="release-date">Data de Lançamento</option>
            <option value="popularity">Popularidade</option>
            <option value="alphabetical">Alfabética</option>
            <option value="relevance">Relevância</option>
        </select>

        <button type="submit">Filtrar</button>
    </form>

    <?php
    // Verifica se há parâmetros na URL para filtrar os jogos
    $params = [];
    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $params['category'] = $_GET['category'];
    }
    if (isset($_GET['platform']) && !empty($_GET['platform'])) {
        $params['platform'] = $_GET['platform'];
    }
    if (isset($_GET['sort_by']) && !empty($_GET['sort_by'])) {
        $params['sort-by'] = $_GET['sort_by'];
    }

    // Constrói a string de consulta para a API
    $query_string = http_build_query($params);

    // Faz a requisição para a API
    $url = "https://www.freetogame.com/api/games?" . $query_string;
    $response = file_get_contents($url);

    // Verifica se a requisição foi bem sucedida
    if ($response === false) {
        echo 'Erro ao acessar a API.';
    } else {
        // Converte a resposta JSON em um array PHP
        $data = json_decode($response, true);

        // Verifica se houve erro na decodificação do JSON
        if ($data === null) {
            echo 'Erro ao decodificar a resposta JSON.';
        } else {
            // Exibe os jogos na tela
            foreach ($data as $game) {
                echo "<h2><a href='game.php?id={$game['id']}'>{$game['title']}</a></h2>";
                echo "<p><strong>Genre:</strong> {$game['genre']}</p>";
                //echo "<img src=\"{$game['game_url']}\" alt=\"{$game['title']}\">"; 
                echo "<p><strong>Platform:</strong> {$game['platform']}</p>";
                echo "<p><strong>Developer:</strong> {$game['developer']}</p>";
                echo "<p><strong>Publisher:</strong> {$game['publisher']}</p>";
                echo "<hr>";
            }
        }
    }
    ?>
</body>
</html>
