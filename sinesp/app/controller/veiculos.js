module.exports = function(app) {

    function print_console(){

    }
    app.get('/sinesp/:placa', function(req, res) {


        var placa = req.params.placa;

        var fipeClient = new app.client.FipeClient();
        console.log('busca o modelo do carro na sinesp');

        var placa = require('sinesp-api');
        let dados = placa.search(placa);
        var retorno = [];
        console.log(dados);

        dados.then(function(result) {
            //console.log(result.modelo) // "Some User token"
            var modelo = result.modelo;
            retorno = result;
            print_console(modelo);
           // res.status(200).json(result);
        });
    });


    app.get('/placa/:tipoVeiculo', function(req, res) {


        var tipoVeiculo = req.params.tipoVeiculo;

        var fipeClient = new app.client.FipeClient();
        console.log('dadsadadaddadasd');

        var placa = require('sinesp-api');
        let dados = placa.search('DWS2579');
        var retorno = [];
        //console.log(dados);

        dados.then(function(result) {
            //console.log(result.modelo) // "Some User token"
            var modelo = result.modelo;
            var ano = result.ano;
            var dados_carro = modelo.split('/');

            fipeClient.obterMarcas(tipoVeiculo, function(exception, request, response, resultado) {


                for (var i = resultado.length - 1; i >= 0; i--) {
                    if (dados_carro[0] == resultado[i].name) {
                        // console.log(resultado[i].name);
                        //  console.log(resultado[i].id);
                        var marca_carro = resultado[i].id;
                    }
                }

                var parametros = {
                    'tipoVeiculo': 1,
                    'idMarca': marca_carro
                };

                fipeClient.obterModelos(parametros, function(exception, request, response, resultado) {


                    //console.log(dados_carro[1].replace(/\s/g, ''));
                    var nome_modelo = dados_carro[1].split(" ");
                    //console.log(nome_modelo[0]);

                    for (var i = resultado.length - 1; i >= 0; i--) {
                        var lista_modelo = resultado[i].fipe_name.split(' ');
                        if (lista_modelo[0].toLowerCase() == nome_modelo[0].toLowerCase()) {
                            console.log(resultado[i].key);
                            //  console.log(marca_carro);
                            //  console.log(ano);
                            var modelo_selecionado = resultado[i].id;
                            var parametros = {
                                'tipoVeiculo': 1,
                                'idMarca': marca_carro,
                                'idModelo': resultado[i].id,
                                'idVeiculo': resultado[i].key
                            };



                            fipeClient.obterVeiculos(parametros, function(exception, request, response, resultado) {

                                for (var i = resultado.length - 1; i >= 0; i--) {
                                    //console.log(resultado[i].key);
                                    var parametros = {
                                        'tipoVeiculo': 1,
                                        'idMarca': marca_carro,
                                        'idModelo': modelo_selecionado,
                                        'idVeiculo': resultado[i].key
                                    };


                                    fipeClient.obterVeiculo(parametros, function(exception, request, response, resultado) {


                                        console.log(resultado);

                                    });
                                   // res.status(200).json(retorno);
                                }

                                // res.status(200).json(resultado);

                            });

                        }

                    }

                    //res.status(200).json(resultado);

                });
                //res.status(200).json(resultado);
            });

        })



    });




    /**
     * Recupera as Marcas do tipo de Veiculos  que aceita três possíveis valores: carros, motos ou caminhoes.
     * param: tipoVeiculo
     * athor: Marcelo Bicalho
     */
    app.get('/veiculos/:tipoVeiculo', function(req, res) {


        var tipoVeiculo = req.params.tipoVeiculo;

        var fipeClient = new app.client.FipeClient();

        fipeClient.obterMarcas(tipoVeiculo, function(exception, request, response, resultado) {

            if (exception) {
                console.log(exception);
                res.status(400).send(exception);
            }

            //console.log(resultado);
            res.status(200).json(resultado);
        });

    });

    /**
     * Recupera os Modelos da marca selecionada .
     * param: tipoVeiculo
     * param: idMarca
     * athor: Marcelo Bicalho
     */
    app.get('/veiculos/:tipoVeiculo/:idMarca', function(req, res) {

        var fipeClient = new app.client.FipeClient();
        var parametros = {
            'tipoVeiculo': req.params.tipoVeiculo,
            'idMarca': req.params.idMarca
        };

        fipeClient.obterModelos(parametros, function(exception, request, response, resultado) {

            if (exception) {
                console.log(exception);
                res.status(400).send(exception);
            }

            res.status(200).json(resultado);

        });

    });


    /**
     * Recupera os Veiculos/Ano do modelo selecionada .
     * param: tipoVeiculo
     * param: idMarca
     * param: idModelo
     * athor: Marcelo Bicalho
     */
    app.get('/veiculos/:tipoVeiculo/:idMarca/:idModelo', function(req, res) {


        var fipeClient = new app.client.FipeClient();

        var parametros = {
            'tipoVeiculo': req.params.tipoVeiculo,
            'idMarca': req.params.idMarca,
            'idModelo': req.params.idModelo
        };


        fipeClient.obterVeiculos(parametros, function(exception, request, response, resultado) {

            if (exception) {
                console.log(exception);
                res.status(400).send(exception);
            }

            res.status(200).json(resultado);

        });

    });

    /**
     * Recupera as informacoes do veiculo de acordo com o id selecionado.
     * param: tipoVeiculo
     * param: idMarca
     * param: idModelo
     * param: idVeiculo
     * athor: Marcelo Bicalho
     */
    app.get('/veiculos/:tipoVeiculo/:idMarca/:idModelo/:idVeiculo', function(req, res) {


        var fipeClient = new app.client.FipeClient();

        var parametros = {
            'tipoVeiculo': req.params.tipoVeiculo,
            'idMarca': req.params.idMarca,
            'idModelo': req.params.idModelo,
            'idVeiculo': req.params.idVeiculo
        };


        fipeClient.obterVeiculo(parametros, function(exception, request, response, resultado) {

            if (exception) {
                console.log(exception);
                res.status(400).send(exception);
            }

            res.status(200).json(resultado);

        });

    });
}