<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Erro 500</h2>
                <p>O servidor teve um problema inesperado.</p>
                <br>
                <code>
                    <small>
                        <?php
                            if ($displayErrors) {
                                echo sprintf('%s em %s, linha %s, código: %s',$e->getMessage(),$e->getFile(),$e->getLine(),$e->getCode());
                            }
                        ?>
                    </small>
                </code>
            </div>
        </div>
    </div>
</section>
