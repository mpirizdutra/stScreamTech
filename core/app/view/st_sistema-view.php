<div class="row" >

    <div class="col-md-12 col-xs-12" >
        <h4>Informacion Sistema</h4>
        <br />
    </div>

    <div class="col-md-12 col-xs-12" >


        <div class="col-md-4 col-xs-12">
            <div class="input-group form-group" >
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-cog"></span>
                </span>
                <input type="text"  class="form-control" maxlength="15" name="nombre" required="required" id="nombre" placeholder="Nombre Sistema" value="<?php echo ""; ?>"  />

            </div>

        </div>



    </div>







    <script>
        $(document).ready(function(){


            $("button#respaldo").click(function(){

                HacerRespaldo();

            });

            function HacerRespaldo(){
                var dat="BaseDatosRespaldo=1";
                $("div#inf").empty();
                $.ajax({
                    type: 'POST',
                    url:  './?action=BDbackUP',
                    data: dat,
                    success: function(res) {


                        $("div#inf").append(res);

                    }

                });

            }

        });



    </script>






</div>









