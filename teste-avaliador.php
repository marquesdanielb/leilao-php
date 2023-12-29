<?php

require 'vendor/autoload.php';

use Hunter\Leilao\Model\Lance;
use Hunter\Leilao\Model\Leilao;
use Hunter\Leilao\Model\Usuario;
use Hunter\Leilao\Service\Avaliador;

$leilao = new Leilao('Marea 2.0 Turbo');

$maria = new Usuario('Maria');
$joao = new Usuario('João');

$leilao->recebeLance(new Lance($joao, 2000));
$leilao->recebeLance(new Lance($maria, 2500));

$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);

$maiorValor = $leiloeiro->getMaiorValor();

echo $maiorValor;