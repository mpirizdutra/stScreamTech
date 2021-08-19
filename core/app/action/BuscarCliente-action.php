<?php
ValidacionSesion::Validar();
if(ValidacionSesion::$isLoggedIn) {
    /** Listado de movimiento de caja */

    if (isset($_POST["ClienteBuscar"])) {

        /** *FALTA  usar clscliente  la funcion ya esta echa
         *Desde el cliente no esta validadon el cuit que sea numerico y la cantidad
         * Si no vas a tener que el buscar este dentro de un formulario para que el maxlengt y parne funcione
         * o controlar desde php la cantidad y que sea numerico ej: is numeric o algo asi. Creo que hay una funcion de esa, Revisar
         */


        if (isset($_POST["tipo"]) && isset($_POST["buscar"])) {
            $tipo = $_POST["tipo"];
            $buscar = $_POST["buscar"];
            $res = NULL;

            switch ($tipo) {

                case 1:
                    {
                        //cuit
                        if (is_numeric($buscar)) {
                            $cliente = clsCliente::BuscarCliente($tipo, $buscar);
                            if (count($cliente) > 0) {
                                foreach ($cliente as $cli) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cli->cuit; ?></td>
                                        <td><?php echo $cli->razon_social; ?></td>
                                        <td><?php echo $cli->direccion; ?></td>
                                        <td><?php echo $cli->telefono; ?></td>
                                        <td style="width:130px;text-align: center;">
                                            <a href="index.php?view=editclient&id=<?php echo $cli->idclientes; ?>"
                                               class="btn btn-warning btn-xs">Editar</a>
                                            <!--a href="index.php?view=delclient&id=<?php echo $cli->idclientes; ?>" class="btn btn-danger btn-xs">Eliminar</a-->
                                        </td>
                                    </tr>
                                    <?php

                                }

                            } else {
                                echo 1;
                            }

                        } else {

                            echo 2;
                        }

                        break;
                    }

                case 2:
                    {

                        $cliente = clsCliente::BuscarCliente($tipo, $buscar);
                        if (count($cliente) > 0) {
                            foreach ($cliente as $cli) {
                                ?>
                                <tr>
                                    <td><?php echo $cli->cuit; ?></td>
                                    <td><?php echo $cli->razon_social; ?></td>
                                    <td><?php echo $cli->direccion; ?></td>
                                    <td><?php echo $cli->telefono; ?></td>
                                    <td style="width:130px;text-align: center;">
                                        <a href="index.php?view=editclient&id=<?php echo $cli->idclientes; ?>"
                                           class="btn btn-warning btn-xs">Editar</a>
                                        <!--a href="index.php?view=delclient&id=<?php echo $cli->idclientes; ?>" class="btn btn-danger btn-xs">Eliminar</a-->
                                    </td>
                                </tr>
                                <?php
                            }

                        } else {
                            echo 1;
                        }
                        break;
                    }


                default:
                    {
                        break;
                    }
            }
        } else {
            echo 0;
        }


    }


    /** FIN*/

}else{Core::redir("./");}
?>
