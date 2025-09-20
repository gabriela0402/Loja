<?php
    include 'cabecalho.php';
    include 'conexao.php';
    $id = $_GET['id'];

    // Se o formulário foi enviado (método POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['produto'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['estoque'];

        
        $sql = "UPDATE produtos SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':preco' => $preco,
            ':quantidade' => $quantidade,
            ':id' => $id
        ]);

        
        header("Location: listar.php");
        exit;
    }

    
    $sql = "SELECT * FROM produtos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="atualizar.css">
<body>
    <h1>ATUALIZAÇÃO DE PRODUTO</h1>
    <h2>Gabriela Romano</h2>

    <div class="container">
        <form action="" method="POST">
            <div class="mb-3">            
               Nome: <input value="<?php echo $produto['nome'];?>" type="text" name="produto" class="form-control">            
            </div>
            <div class="mb-3">            
                Preço: <input value="<?php echo $produto['preco'];?>" type="text" name="preco" class="form-control">
            </div>
            <div class="mb-3">
                Quantidade: <input value="<?php echo $produto['quantidade'];?>" type="text" name="estoque" class="form-control">            
            </div>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </form>
        <a href="index.php" type="button" class="btn btn-warning">Voltar</a>
    </div>
</body>
</html>
