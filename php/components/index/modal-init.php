<!-- Modal -->
<!-- Modal: Ofeta del día | Deal of the Day | Oferta especial | Combo Especial -->

<?php
if ($dataArrayModalInit != 0) {
    foreach (json_decode($dataArrayModalInit, true) as $dato) {
        $precioNormal = trim($dato['precprod']);
        $montoOff = trim($dato['descuento']);
        $tipDesc = '';
        $precioFinal;
        $montoDescuento;

        if (trim($dato['tipdesc']) == 'P') {
            // P -> Porcentaje | F -> Fijo
            $tipDesc = ' %';
            $precioFinal = $precioNormal - (($precioNormal * $montoOff) / 100);
            $montoDescuento = $precioNormal - $precioFinal;
        } else {
            $tipDesc = ' Fijo';
            $precioFinal = $precioNormal - $montoOff;
            $montoDescuento = $precioNormal - $precioFinal;
        }
?>
        <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <!-- <div class="deal" style="background-image: url('assets/imgs/banner/popup-1.png')"> -->
                        <div class="deal" style="background-image: url('src/img/modal-init/modal-init.png')">
                            <div class="deal-top">
                                <!-- <h6 class="mb-10 text-brand-2">Deal of the Day</h6> -->
                                <h6 class="mb-10 text-brand-2"><?php echo trim($dato['titletop']); ?></h6>
                            </div>
                            <div class="deal-content detail-info">
                                <h4 class="product-title"><a href="shop-product-right.html" class="text-heading"><?php echo trim($dato['denom']); ?></a></h4>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$ <?php echo number_format($precioFinal, 2); ?></span>
                                        <span>
                                            <!-- number_format($numero, 2); -->
                                            <span class="save-price font-md color3 ml-15">$ <?php echo number_format($montoOff, 2) . ' ' . $tipDesc . ' '; ?> Off</span>
                                            <span class="old-price font-md ml-15">$ <?php echo number_format($precioNormal, 2); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="deal-bottom">
                                <p class="mb-20">No te lo pierdas! Este anuncio finaliza en:</p>
                                <div class="deals-countdown pl-5" data-countdown="<?php echo trim($dato['dateend']); ?> 23:59:59">
                                    <span class="countdown-section">
                                        <span class="countdown-amount hover-up">03</span>
                                        <span class="countdown-period"> días </span>
                                    </span>
                                    <span class="countdown-section">
                                        <span class="countdown-amount hover-up">02</span>
                                        <span class="countdown-period"> horas </span>
                                    </span>
                                    <span class="countdown-section">
                                        <span class="countdown-amount hover-up">43</span>
                                        <span class="countdown-period"> minutos </span>
                                    </span><span class="countdown-section">
                                        <span class="countdown-amount hover-up">29</span>
                                        <span class="countdown-period"> segundos </span>
                                    </span>
                                </div>
                                <!-- <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 rates)</span>
                                    </div>
                                </div> -->
                                <!-- <a href="product-detail.php?td=mi" class="btn hover-up">Comprar ahora <i class="fi-rs-arrow-right"></i></a> -->
                                <a href="<?php echo trim($dato['linkprod']); ?>" class="btn hover-up">Comprar ahora <i class="fi-rs-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>