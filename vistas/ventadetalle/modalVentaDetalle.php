<div id="capaEmergente" class="col-md-12">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title block-title text-center" id="exampleModalLabel" style="margin-bottom: -8%; padding: 2% 0% 4% 2%; font-size: 25px;">Órden Generada</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="padding: 2rem 5rem 2rem 5rem">
                    <div class="row">
                        <div class="col-md-3">
                            <h5><b>N° de Órden:</b></h5>
                            <h5><b>Fecha:</b></h5>
                        </div>
                        <div class="col-md-3">
                            <?php 
                                $letra = "OR";
                                $numero = sprintf("%04d", rand(0, 9999));
                                $codigoAleatorio = $letra."-".$numero;
                            ?>
                            <h5><?php echo $codigoAleatorio; ?></h5>

                            <p><?php echo date("d/m/Y") ?></p>
                        </div>
                    </div>

                    <div class="row my-5" style="overflow-x: auto;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (count($rpta)): ?>

                                    <?php $total = 0; ?>

                                    <?php foreach($rpta as $value): ?>

                                    <tr>
                                        <td><?php echo $value["codigo"]; ?></td>
                                        <td><?php echo $value["producto"]; ?></td>
                                        <td><?php echo $value["cantidad"]; ?></td>
                                        <td><?php echo $value["precio"]; ?></td>
                                        <td><?php echo $value["subtotal"]; ?></td>
                                    </tr>

                                    <?php $total = $total + $value["subtotal"]; ?>

                                    <?php endforeach; ?>

                                    <?php else: ?>
                                    <tr>
                                        <td scope="col" colspan=12 class="mensajeError">No se encontraron resultados</td>
                                    </tr>
                                    <?php endif; ?>
                            </tbody>

                            <?php if (isset($total)) {
                                $total = $total;
                            }
                            else {
                                $total = 0.00;
                            } ?>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Total</th>
                                    <th><?php echo number_format($total, 2);; ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div> 