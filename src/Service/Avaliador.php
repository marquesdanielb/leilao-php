<?php

namespace Hunter\Leilao\Service;

use Hunter\Leilao\Model\Lance;
use Hunter\Leilao\Model\Leilao;

class Avaliador
{
    private $menorValor = INF;
    private $maiorValor = -INF;
    private $maioresLances;

    public function avalia(Leilao $leilao): void
    {
        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            } 
            
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }

        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2) {
            return $lance2->getValor() - $lance1->getValor(); 
        });
        $this->maioresLances = array_slice($lances, 0, 3);
    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    /**
     * @return Lance[]
     */
    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}