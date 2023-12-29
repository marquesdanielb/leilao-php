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

    public function testAvaliadorDeveBuscar3MaioresValores()
    {
        // Arrange
        $leilao = new Leilao('Golf GTI 2.0');

        $uramashi = new Usuario('Uramashi');
        $koabara = new Usuario('Koabara');
        $naruto = new Usuario('Naruto');
        $jiraya = new Usuario('Ero Senin');

        $leilao->recebeLance(new Lance($uramashi, 1500));
        $leilao->recebeLance(new Lance($koabara, 1000));
        $leilao->recebeLance(new Lance($naruto, 2000));
        $leilao->recebeLance(new Lance($jiraya, 1700));

        // Act
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        $maiores = $leiloeiro->getMaioresLances();

        // Assert
        self::assertCount(3, $maiores);
        self::assertEquals(2000, $maiores[0]->getValor());
        self::assertEquals(1700, $maiores[1]->getValor());
        self::assertEquals(1500, $maiores[2]->getValor());
    }
}

