<!-- Seção contendo o botão de cadastro de interesse -->
<section class="pt-2 pb-3">
    <div class="container">
        <div class="row text-left mt-5">
            <div class="col-sm mt-5">

                <!-- Botão para abrir o modal de cadastro de interesse da empresa -->
                <button type="button" class="btn btn-lg btn-primary" 
                    data-toggle="modal" 
                    data-target="#interestField"> 
                    Cadastro de interesse
                </button>
            </div>

        </div>
    </div>
</section>

<!-- Modal do cadastro de interesse -->
<div class="modal fade" id="interestField" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="interestModal">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" >

                
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" 
                    data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" 
                    data-dismiss="modal" 
                    v-on:click="user_type = 0 , sendInfo()"
                    >Enviar</button>
            </div>
        </div>
    </div>    
</div>