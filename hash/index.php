<?php

$senha = "123456";
$senhaHash = md5($senha);
$senha2 = md5($senhaHash);

print "Senha: $senha<br>";
print "Hash: $senhaHash<br>";
print "Hash2: $senha2<br>";
?>