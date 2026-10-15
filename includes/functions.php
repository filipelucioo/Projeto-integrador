<?php 
include './database/conect.php';


function Cadastrar($conexao, $nome, $nasc, $turma, $ativo)
{
    $sql = "INSERT INTO alunos (nome, nasc, turma, ativo) VALUES (:nome, :nasc, :turma, :ativo)";

    $stmt = $conexao ->prepare($sql);
    $stmt->bindParam(":nome",$nome);
    $stmt->bindParam(":nasc",$nasc);
    $stmt->bindParam(":turma",$turma);
    $stmt->bindParam(":ativo",$ativo);

    $stmt->execute();
    echo "Aluno cadastrado com sucesso!";   

}

function deletar($conexao, $id){

    
        $sql = "DELETE FROM alunos WHERE id = :id";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        echo "Registro $id deletado.";
    }
    
function listar($conexao){
  

$sql = "SELECT * FROM alunos";

$stmt= $conexao->prepare($sql);
$stmt->execute();

$alunos = $stmt->fetchAll
(PDO::FETCH_ASSOC);

foreach($alunos as $aluno){
    echo "<hr>";
    echo "ID: {$aluno['id']} <br>";
    echo "Nome: {$aluno['nome']}<br>";
    echo "Nascimento: {$aluno['nasc']} <br>";
    echo "Turma: {$aluno['turma']} <br>";
    echo "Ativo: {$aluno['ativo']} <br>";
}

}
function consultar($conexao, $id){
$sql = "SELECT nome, nasc, turma, ativo FROM alunos WHERE id = :id";

$stmt =$conexao->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$aluno = $stmt->fetch(PDO::FETCH_ASSOC);

echo "Aluno: {$aluno['nome']} <br> Turma:{$aluno['turma']} <br>
Nascimento: {$aluno['nasc']} <br> Ativo:{$aluno['turma']}";


}

function atualizar($conexao, $id, $nome, $turma, $nasc, $ativo){

    $sql = "UPDATE alunos SET nome = :nome turma = :turma nasc = :nasc ativo = :ativo WHERE id = :id";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":turma", $turma);
    $stmt->bindParam(":nasc", $nasc);
    $stmt->bindParam(":ativo", $ativo);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

}
    
//Função para cadastrar usuario    
function Cadastrar_user($conexao, $email, $senha,)
{
    $sql = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";

    $stmt = $conexao ->prepare($sql);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":senha",$senha);

    $stmt->execute();
    echo "Usuario cadastrado com sucesso!";   

}
function consultar_user($conexao, $email){
$sql = "SELECT id, email, senha FROM usuarios WHERE email = :email";

$stmt =$conexao->prepare($sql);
$stmt->bindParam(":email",$email );
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

return $usuario;




}
?>