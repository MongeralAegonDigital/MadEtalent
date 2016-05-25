# MAD Etalent SOAP Requests

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Esta é uma biblioteca construída especificamente para o framework Laravel na versão 5+.

Sua funcionalidade é fazer todas as requisições SOAP para os servidores do Etalent e tem como base a implementação de 5 métodos disponíveis para os clientes:

- RetornarQuestionario
- GravarCandidatoEtalent
- GravarPerfilEtalentVendas
- RetornarMiniRelatorio

Faça bom uso e colabore conosco :D

## Instalação

Via Composer

``` bash
$ composer require madetalent/etalentsoap
```

## Como utilizar

Segue o exemplo de como constuir o retorno para o método RetornarQuestionario:

``` php
$etalent = new madetalent\etalentsoap\Etalent\ManagerEtalentStrategy(getenv('ETALENT_URL'),
            getenv('ETALENT_USER'), getenv('ETALENT_PASS'));
echo $etalent->getRetornarQuestionario();
```

O getenv está referenciando as variáveis de ambiente usando uma lib externa. Essa parte é opicional para você.

Existem alguns métodos que necessitam do preenchimento de alguns DTO's.

Veja o exemplo para o método GravarCandidatoEtalent:

``` php
$dtoUserEtalent = new madetalent\etalentsoap\Etalent\DTO\User();

$dtoUserEtalent->setNome($explodeName[0]);
$dtoUserEtalent->setSobreNome($explodeName[1]);
$dtoUserEtalent->setSexo($sex);
$dtoUserEtalent->setLogin($user->username);
$dtoUserEtalent->setEmail($user->email);

echo $etalent->setGravarCandidatoEtalent($dtoUserEtalent);
```

## Contribuintes

Veja mais em: [CONTRIBUTING](CONTRIBUTING.md).

## Créditos

- [Jonathan Iqueda][https://www.linkedin.com/profile/view?id=AAMAABVelbIBCTqbkTOmYlrNAYIn4G3VImw1mPM&trk=hp-identity-name]
- [All Contributors][link-contributors]

## Licença

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/:vendor/:package_name.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/:vendor/:package_name/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/:vendor/:package_name.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/:vendor/:package_name.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/:vendor/:package_name.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/:vendor/:package_name
[link-travis]: https://travis-ci.org/:vendor/:package_name
[link-scrutinizer]: https://scrutinizer-ci.com/g/:vendor/:package_name/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/:vendor/:package_name
[link-downloads]: https://packagist.org/packages/:vendor/:package_name
[link-author]: https://github.com/:author_username
[link-contributors]: ../../contributors
