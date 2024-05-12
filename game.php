<?php
// Verifica se o parâmetro "id" está presente na URL
if (isset($_GET['id'])) {
    // Obtém o ID do jogo da URL
    $game_id = $_GET['id'];
    
    // Faz a requisição para a API com o ID do jogo
    $url = "https://www.freetogame.com/api/game?id={$game_id}";
    $response = file_get_contents($url);

    // Verifica se a requisição foi bem sucedida
    if ($response === false) {
        die('Erro ao acessar a API.');
    }

    // Converte a resposta JSON em um array PHP
    $game = json_decode($response, true);

    // Verifica se houve erro na decodificação do JSON
    if ($game === null) {
        die('Erro ao decodificar a resposta JSON.');
    }

    // Exibe os detalhes do jogo na tela
    echo "<h1>{$game['title']}</h1>";
    echo "<p><strong>Genre:</strong> {$game['genre']}</p>";
    echo "<p><strong>Platform:</strong> {$game['platform']}</p>";
    echo "<p><strong>Developer:</strong> {$game['developer']}</p>";
    echo "<p><strong>Publisher:</strong> {$game['publisher']}</p>";
    echo "<p><strong>Release Date:</strong> {$game['release_date']}</p>";
    echo "<p><strong>Description:</strong> {$game['short_description']}</p>";
} else {
    // Se o parâmetro "id" não estiver presente na URL, redireciona para a página inicial
    header("Location: index.php");
    exit();
}
?>
