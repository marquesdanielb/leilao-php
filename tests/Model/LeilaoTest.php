<?php

namespace Hunter\Leilao\Tests\Model;

use Hunter\Leilao\Model\Lance;
use Hunter\Leilao\Model\Usuario;
use Hunter\Leilao\Model\Leilao;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
    /**
     * @dataProvider geraLances
     */
    public function testLeilaoDeveReceberLances(
        int $qtdLances, 
        Leilao $leilao, 
        array $valores
    )
    {
        static::assertCount($qtdLances, $leilao->getLances());

        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public static function geraLances()
    {
        $pedro = new Usuario("Pedro");
        $tiago = new Usuario("Tiago");

        $leilaoCom2Lances = new Leilao("Barco 22 pés");
        $leilaoCom2Lances->recebeLance(new Lance($pedro, 1000));
        $leilaoCom2Lances->recebeLance(new Lance($tiago, 1500));

        $leilaoCom1Lance = new Leilao("Penteadeira");
        $leilaoCom1Lance->recebeLance(new Lance($pedro, 500));

        return [
            "leilao-dois-lances" => [2, $leilaoCom2Lances, [1000, 1500]],
            "leilao-um-lance" => [1, $leilaoCom1Lance, [500]]
        ];
    }
}