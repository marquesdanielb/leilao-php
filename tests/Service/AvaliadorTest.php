<?php

namespace Hunter\Leilao\Tests\Service;

use Hunter\Leilao\Model\Lance;
use Hunter\Leilao\Model\Leilao;
use Hunter\Leilao\Model\Usuario;
use Hunter\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    private $leiloeiro;

    public function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao)
    {
        // Arrange
        $this->leiloeiro->avalia($leilao);
        
        // Act
        $maiorValor = $this->leiloeiro->getMaiorValor();

        //Assert
        self::assertEquals(2000, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao)
    {
        // Arrange
        $this->leiloeiro->avalia($leilao);

        // Act
        $menorValor = $this->leiloeiro->getMenorValor();

        //Assert
        self::assertEquals(1000, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveBuscar3MaioresValores(Leilao $leilao)
    {
        // Arrange
        $this->leiloeiro->avalia($leilao);
        // Act
        $maiores = $this->leiloeiro->getMaioresLances();

        // Assert
        self::assertCount(3, $maiores);
        self::assertEquals(2000, $maiores[0]->getValor());
        self::assertEquals(1250, $maiores[1]->getValor());
        self::assertEquals(1000, $maiores[2]->getValor());
    }

    public static function leilaoEmOrdemCrescente()
    {
        $leilao = new Leilao('Marea 2.0 Turbo');

        $yusuke = new Usuario('Yusuke');
        $jiraya = new Usuario('Jiraya');
        $kurama = new Usuario('Kurama');

        $leilao->recebeLance(new Lance($yusuke, 1000));
        $leilao->recebeLance(new Lance($jiraya, 1250));
        $leilao->recebeLance(new Lance($kurama, 2000));

        return [
            "ordem-crescente" => [$leilao]
        ];
    }

    public static function leilaoEmOrdemDecrescente()
    {
        $leilao = new Leilao('Marea 2.0 Turbo');

        $yusuke = new Usuario('Yusuke');
        $jiraya = new Usuario('Jiraya');
        $kurama = new Usuario('Kurama');
        
        $leilao->recebeLance(new Lance($kurama, 2000));
        $leilao->recebeLance(new Lance($jiraya, 1250));
        $leilao->recebeLance(new Lance($yusuke, 1000));

        return [
            "ordem-decrescente" => [$leilao]
        ];
    }

    public static function leilaoEmOrdemAleatoria()
    {
        $leilao = new Leilao('Marea 2.0 Turbo');

        $yusuke = new Usuario('Yusuke');
        $jiraya = new Usuario('Jiraya');
        $kurama = new Usuario('Kurama');
        
        $leilao->recebeLance(new Lance($jiraya, 1250));
        $leilao->recebeLance(new Lance($kurama, 2000));
        $leilao->recebeLance(new Lance($yusuke, 1000));

        return [
            "ordem-aleatoria" => [$leilao]
        ];
    }
}
