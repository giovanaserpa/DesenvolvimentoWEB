<?php
require __DIR__ . '/db.php';

$pdo->exec("
    CREATE TABLE IF NOT EXISTS tb_carro (
        id INT AUTO_INCREMENT PRIMARY KEY,
        marca VARCHAR(100) NOT NULL,
        nome VARCHAR(100) NOT NULL,
        modelo VARCHAR(200) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");


$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $marca = trim($_POST['marca'] ?? '');
    $modelo = trim( $_POST['modelo'] ??'');

    if ($nome === '' || $marca === '' || $modelo === '') {
        $erro = 'Informe nome, marca e modelo.';
    } else {
        $stmt = $pdo->prepare("INSERT INTO tb_carro (nome, marca, modelo) VALUES (:nome, :marca, :modelo)");
        $stmt->execute([
            ':nome'     => $nome,
            ':marca' => $marca,
            ':modelo' => $modelo,
        ]);

        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

$rows = $pdo->query("SELECT id, nome, marca, modelo, created_at FROM tb_carro ORDER BY id DESC")->fetchAll();

function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cadastro</title>
<style>
    body { font-family: system-ui, Arial, sans-serif; margin: 24px; }
    form { display: grid; gap: 12px; max-width: 520px; padding: 16px; border: 1px solid #ddd; border-radius: 8px; }
    label { display: grid; gap: 6px; }
    input[type="text"] { padding: 10px; border: 1px solid #bbb; border-radius: 6px; }
    button { padding: 10px 14px; border: 0; border-radius: 6px; cursor: pointer; }
    .btn { background: #0d6efd; color: white; }
    .erro { color: #b00020; margin: 8px 0; }
    .lista { margin-top: 24px; max-width: 720px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: left; }
    thead th { background: #f7f7f7; }
    .muted { color: #666; font-size: 0.9rem; }
</style>
</head>
<body>

<h1>Cadastro de Carros</h1>

<form method="post" action="">
    <div>
        <p class="muted">Preencha os campos e clique em “Salvar”. Cada novo cadastro aparece abaixo do formulário.</p>
    </div>

    <?php if ($erro): ?>
        <div class="erro"><?= e($erro) ?></div>
    <?php endif; ?>

    <label>
        Nome
        <input type="text" name="nome" maxlength="100" required>
    </label>

    <label>
        Modelo
        <input type="text" name="endereco" maxlength="200" required>
    </label>
    <label>
        Marca
        <input type="text" name="endereco" maxlength="200" required>
    </label>
    <button class="btn" type="submit">Salvar</button>
    </form>

<div class="lista">
    <h2>Cadastros</h2>
    <?php if (!$rows): ?>
        <p class="muted">Ainda não há cadastros.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Criado em</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r): ?>
                <tr>
                    <td><?= e($r['id']) ?></td>
                    <td><?= e($r['nome']) ?></td>
                    <td><?= e($r['endereco']) ?></td>
                    <td><?= e($r['created_at']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
