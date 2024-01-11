# Leilão Hunter

## Introdução

O Leilão Hunter é uma aplicação PHP destinada a realizar leilões virtuais. Ele é composto por classes que modelam elementos fundamentais de um leilão, como lances, usuários e o próprio leilão. Além disso, inclui um serviço de avaliação que determina o maior e menor lance, bem como os três maiores lances realizados. Este projeto surgiu como uma abordagem que escolhi para aprofundar meu conhecimento em testes de unidade.

## Estrutura de Classes

### Classe `Usuario`

A classe `Usuario` representa um participante do leilão, identificado pelo seu nome.

#### Propriedades

- `nome`: String que armazena o nome do usuário.

#### Métodos

- `__construct(string $nome)`: Construtor que recebe o nome do usuário como parâmetro.
- `getNome(): string`: Retorna o nome do usuário.

### Classe `Lance`

A classe `Lance` representa um lance feito por um usuário em um leilão, contendo informações sobre o usuário que fez o lance e o valor do lance.

#### Propriedades

- `usuario`: Instância da classe `Usuario` representando o usuário que fez o lance.
- `valor`: Valor do lance.

#### Métodos

- `__construct(Usuario $usuario, float $valor)`: Construtor que recebe uma instância de `Usuario` e o valor do lance como parâmetros.
- `getUsuario(): Usuario`: Retorna a instância de `Usuario` associada ao lance.
- `getValor(): float`: Retorna o valor do lance.

### Classe `Leilao`

A classe `Leilao` representa um leilão com uma descrição e a coleção de lances feitos pelos participantes.

#### Propriedades

- `descricao`: Descrição do leilão.
- `lances`: Array contendo instâncias da classe `Lance`.

#### Métodos

- `__construct(string $descricao)`: Construtor que recebe a descrição do leilão como parâmetro.
- `recebeLance(Lance $lance)`: Adiciona um lance à coleção de lances do leilão.
- `getLances(): array`: Retorna a coleção de lances do leilão.

### Classe `Avaliador`

A classe `Avaliador` é responsável por avaliar um leilão, determinando o maior e o menor lance, bem como os três maiores lances.

#### Propriedades

- `menorValor`: Armazena o menor valor de lance.
- `maiorValor`: Armazena o maior valor de lance.
- `maioresLances`: Array contendo os três maiores lances.

#### Métodos

- `avalia(Leilao $leilao)`: Avalia o leilão, calculando o menor e o maior valor de lance, bem como os três maiores lances.
- `getMaiorValor(): float`: Retorna o maior valor de lance.
- `getMenorValor(): float`: Retorna o menor valor de lance.
- `getMaioresLances(): array`: Retorna os três maiores lances.

## Lógica do Código

1. **Classe `Usuario`**: Representa um participante do leilão, mantendo informações sobre o nome do usuário.

2. **Classe `Lance`**: Modela um lance no leilão, com informações sobre o usuário que fez o lance e o valor do lance.

3. **Classe `Leilao`**: Representa um leilão com uma descrição e uma coleção de lances. Permite adicionar lances à coleção e recuperar a lista de lances.

4. **Classe `Avaliador`**: Avalia um leilão, calculando o menor e o maior valor de lance, bem como os três maiores lances. Essa classe é útil para fornecer informações estatísticas sobre o leilão.

A lógica do código segue um fluxo simples: os usuários fazem lances, que são adicionados ao leilão. O `Avaliador` pode então avaliar o leilão para determinar estatísticas relevantes, como o maior e menor lance, e os três maiores lances.

Este projeto fornece uma estrutura básica para a realização de leilões virtuais, e sua expansão pode incluir recursos adicionais, como acompanhamento do tempo do leilão, validação de lances, entre outros.
