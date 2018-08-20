<section class="welcome-section d-flex align-items-center">
    <div class="container text-center text-white">
        <h1>Bem-vindo ao Currículo Incit</h1>  
    </div>
</section>
<section class="pt-2 pb-3">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm mt-4">
                <!-- Botão para abrir o modal de cadastro de empresas -->
                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#companyFields"> 
                    Cadastro de empresas 
                </button>

                <!-- Modal do cadastro de empresas -->
                <div class="modal fade" id="companyFields">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="companyName"> Nome da empresa </label>
                                        <input aria-labelledby="name companyFields" aria-hidden="true" type="text" class="form-control" id="companyName" placeholder="Digite o nome da empresa...">
                                    </div>
                                    <div class="form-group">
                                        <label for="companyEmail"> E-mail da empresa </label>
                                        <input aria-labelledby="email companyFields" aria-hidden="true" type="email" class="form-control" id="companyEmail" aria-describedby="emailHelp" placeholder="Digite um email...">
                                        <small id="emailHelp" class="form-text text-muted"> Digite um e-mail no formato: nome@dominio.com </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="companyCnpj"> CNPJ da empresa </label>
                                        <input aria-labelledby="cnpj companyFields" aria-hidden="true" type="number" class="form-control" id="companyCnpj" placeholder="Digite o CNPJ da empresa...">
                                    </div>
                                    <div class="form-group">
                                        <label for="companyPassword"> Senha </label>
                                        <input aria-labelledby="password companyFields" aria-hidden="true" type="password" class="form-control" id="companyPassword" aria-describedby="passwordHelp" placeholder="Digite a senha...">
                                        <small id="passwordHelp" class="form-text text-muted"> A senha deve possuir no mínimo  </small>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar</button>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="col-sm mt-4">
                <!-- Botão para abrir o modal de cadastro de pessoas -->
                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#peopleFields"> 
                    Cadastro de pessoas
                </button>

                <!-- Modal do cadastro de pessoas -->
                <div class="modal fade" id="peopleFields">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="personName"> Nome da pessoa </label>
                                        <input aria-labelledby="name personFields" aria-hidden="true" type="text" class="form-control" id="personName" placeholder="Digite o nome da empresa...">
                                    </div>
                                    <div class="form-group">
                                        <label for="personEmail"> E-mail da pessoa </label>
                                        <input aria-labelledby="email personFields" aria-hidden="true" type="email" class="form-control" id="personEmail" aria-describedby="emailHelp" placeholder="Digite um email...">
                                        <small id="emailHelp" class="form-text text-muted"> Digite um e-mail no formato: nome@dominio.com </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="personCpf"> CPF da pessoa </label>
                                        <input aria-labelledby="cpf personFields" aria-hidden="true" type="number" class="form-control" id="personCnpj" placeholder="Digite o CPF da empresa...">
                                    </div>
                                    <div class="form-group">
                                        <label for="personPassword"> Senha </label>
                                        <input aria-labelledby="password personFields" aria-hidden="true" type="password" class="form-control" id="personPassword" aria-describedby="passwordHelp" placeholder="Digite a senha...">
                                        <small id="passwordHelp" class="form-text text-muted"> A senha deve possuir no mínimo  </small>
                                    </div>
                                </form>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Enviar</button>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</section>