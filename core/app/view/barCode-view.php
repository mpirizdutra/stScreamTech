<?php

$barCode=array();











     // el maximo es de 250 mas de eso no esta controlado
  // clsBarCode::addBarcode();
 //print_r(clsBarCode::Barra_numericas());

?>


<div class="row" id="contenidos">
    <div class="form-group" style="margin-top: 10px;">

        <div class="col-xs-12 col-xs-12">
            <div id="inf" class="col-md-4 col-xs-12">

            </div>

        </div>
        <div class="col-md-12 col-xs-12">


        </div>
        <div class="col-md-12 col-xs-12">
            <h4>Generar codigo de barra. (Ej: 2020 al 5050)</h4>
            <div class="col-md-8 col-xs-12">
                <div class="input-group form-group col-md-3" >

                    <input type="number" min="1" name="codigo_desde" class="form-control"  id="codigo_desde" placeholder="Codigo desde" >
                </div>

                <div class="input-group form-group col-md-3" >
                    <input type="number" min="1" name="codigo_hasta" class="form-control" id="codigo_hasta" placeholder="Codigo hasta" >

                </div>

                <a id="btnGenerar" class="btn btn-primary">Generar codigos</a>

                <a id="btnImprimir" class="btn btn-success " style="margin-left: 20px">Imprimir codigos</a>

                <div class="alert alert-warning" id="inf" style="display: none;margin-top: 10px">Desde... deve ser menor o igual </div>
            </div>

            <div class="col-md-12 col-xs-12">

                <table id="tableCodebar"  align="conter" style="margin-top: 20px">

                </table>

            </div>

        </div>

    </div>

    <script src="plugins/dist/JsBarcode.all.min.js"></script>
    <script>

        $(document).ready(function(){


            var table_id="table#print_cont ";

            $("div#contenidos").on("click","a#btnGenerar",function(){
                $("div#inf").css("display","none");

                var desde=parseInt($("input#codigo_desde").val());
                var hasta=parseInt($("input#codigo_hasta").val());
                $("table#tableCodebar").empty();
                if(desde<=hasta) {
                    var dat = "GenerarCodigoNrOrden=1&desde=" + desde + "&hasta=" + hasta;


                    $.ajax({
                        url: './?action=barCodes',
                        type: 'POST',
                        data: dat,
                        success: function (res) {
                            //alert(res);
                            //  location.reload();
                            if(res!=""){
                                generarCodigo(res);
                            }

                        }
                    });

                }
                else{$("div#inf").css("display","block");}
            });


            $("a#btnImprimir").click(function(){
               var modal="table#tableCodebar";
               //$(modal).removeClass("table .svg").css("margin","10px");
                $(modal).printArea();
            });





            function arrayjsonbarcode(j){
                $("tqable#tableCodebar").empty();
                json=JSON.parse(j);
                arr=[];
                var num=0;
                var tr="<tr><td><svg class='svg' style='border: 1px solid black;'";//para separar margin:10px
                for (var x in json) {
                    arr.push(json[x]);
                    num=json[x];
                    $("table#tableCodebar").append(tr+" id='barcode"+num+"'"+"></td></tr>");
                }

                return arr;
            }
        function generarCodigo(jsonvalor){
            var valores=Array();
            valores=arrayjsonbarcode(jsonvalor);

            for (var i = 0; i < valores.length; i++) {


                JsBarcode("#barcode" + valores[i], valores[i].toString(), {
                    format: "codabar",
                    lineColor: "#000",
                    width: 2,
                    height: 30,
                    displayValue: true
                });
            }
        }



//fin
        });

    </script>


</div>
