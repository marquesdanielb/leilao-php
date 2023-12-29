<?php

namespace Hunter\Leilao\Tests\Service;

use Hunter\Leilao\Model\Lance;
use Hunter\Leilao\Model\Leilao;
use Hunter\Leilao\Model\Usuario;
use Hunter\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente()
    {
        // Arrange
        $leilao = new Leilao('Marea 2.0 Turbo');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leiloeiro = new Avaliador();

        // Act
        $leiloeiro->avalia($leilao);
        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert
        self::assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente()
    {
        // Arrange
        $leilao = new Leilao('Marea 2.0 Turbo');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        // Act
        $leiloeiro->avalia($leilao);
        $maiorValor = $leiloeiro->getMaiorValor();

        //Assert
        self::assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente()
    {
        // Arrange
        $leilao = new Leilao('Marea 2.0 Turbo');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        // Act
        $leiloeiro->avalia($leilao);
        $menorValor = $leiloeiro->getMenorValor();

        //Assert
        self::assertEquals(2000, $menorValor);
    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente()
    {
        // Arrange
        $leilao = new Leilao('Marea 2.0 Turbo');

        $maria = new Usuario('Maria');
        $joao = new Usuario('João');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 2000));

        $leiloeiro = new Avaliador();

        // Act
        $leiloeiro->avalia($leilao);
        $menorValor = $leiloeiro->getMenorValor();

        //Assert
        self::assertEquals(2000, $menorValor);
    }
}

