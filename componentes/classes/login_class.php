<?php
require_once "./database_class.php";
class Login {
 public function __construct($caminhoLogin){
  if(!isset($_SESSION))
  $redirecionar = $caminhoLogin;
 }
 public function Logar($email, $senha) {
  return (new Database('usuario'))->select($where, $order, $limit)->fetchAll(PDO::FETCH_CLASS, self::class);
 }
}