<!-- Seção de boa-vindas na página home -->
<section class="welcome-section d-flex align-items-center">
    <div class="container text-center text-white">
        <h1>Bem-vindo ao Currículo Incit</h1>  
    </div>
</section>

<!-- Para lembrar: user_type = 0 para empresa e user_type = 1 para pessoa -->
<!-- Seção contendo os botões de cadastro -->
<section class="pt-2 pb-3">
    <div class="container">
        <div class="row text-center">
            <div class="col-sm mt-4">

                <!-- Botão para abrir o modal de cadastro de empresas -->
                <button type="button" class="btn btn-lg btn-primary" 
                    data-toggle="modal" 
                    data-target="#companyFields"> 
                    Cadastro de empresas 
                </button>
            </div>
            <div class="col-sm mt-4">
            
                <!-- Botão para abrir o modal de cadastro de pessoas -->
                <button type="button" class="btn btn-lg btn-primary" 
                    data-toggle="modal" 
                    data-target="#peopleFields"> 
                    Cadastro de pessoas
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Modal do cadastro de empresas -->
<div class="modal fade" id="companyFields" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="companyModal">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                    data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body" >

                <!-- Formulário de empresa, contém: nome, email, cnpj, senha e tipo de usuário(empresa = 0) -->
                <form>
                    <div class="form-group">
                        <label for="companyName"> Nome da empresa </label>                        
                        <input type="text" class="form-control bg-transparent"
                            id="companyName"
                            v-model="name"
                            placeholder="Digite o nome da empresa... *" required>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="companyEmail"> E-mail da empresa </label>
                        <input type="email" class="form-control bg-transparent"
                            id="companyEmail"
                            aria-describedby="emailHelp"
                            v-model="email"
                            placeholder="Digite o email... *" required>
                        <p class="help-block text-danger"></p>
                        <small class="form-text text-muted" id="emailHelp"> Digite um e-mail no formato: nome@dominio.com </small>
                    </div>
                    <div class="form-group">
                        <label for="companyCnpj"> CNPJ da empresa </label>
                        <input type="text" class="form-control bg-transparent"
                            id="companyCpf"
                            v-model="identity"
                            placeholder="Digite o CNPJ da empresa... *" required>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="companyPassword"> Senha </label>
                        <input type="password" class="form-control bg-transparent"
                            id="companyPassword"
                            aria-describedby="passwordHelp"
                            v-model="password"
                            placeholder="Digite a senha... *" required>
                        <p class="help-block text-danger"></p>
                        <small class="form-text text-muted" id="passwordHelp"> A senha deve possuir no mínimo  </small>
                    </div>
                </form>
            </div>
            
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

<!-- Modal do cadastro de pessoas -->
<div class="modal fade" id="peopleFields" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="personModal">
        
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">

                <!-- Formulário de pessoa, contém: nome, email, cpf, senha e tipo de usuário(pessoa = 1) -->
                <form id="personForm">
                    
                    <!-- Nome -->
                    <div class="form-group">
                        <label for="personName"> Nome </label>
                        <input type="text" class="form-control bg-transparent"
                            id="personName"
                            v-model="name"
                            placeholder="Digite o seu nome... *" required>
                        <p class="help-block text-danger"></p>
                    </div>

                    <!-- E-mail -->
                    <div class="form-group">
                        <label for="personEmail"> E-mail </label>
                        <input type="email" class="form-control bg-transparent"
                            id="personEmail"
                            aria-describedby="emailHelp"
                            v-model="email"
                            placeholder="Digite o seu email... *" required>
                        <p class="help-block text-danger"></p>
                        <small class="form-text text-muted" id="emailHelp"> Digite um e-mail no formato: nome@dominio.com </small>
                    </div>

                    <!-- CPF -->
                    <div class="form-group">
                        <label for="personCpf"> CPF </label>
                        <input type="text" class="form-control bg-transparent"
                            id="personCpf"
                            v-model="identity"
                            placeholder="Digite o seu CPF... *" required>
                        <p class="help-block text-danger"></p>
                    </div>

                    <!-- Senha -->
                    <div class="form-group">
                        <label for="personPassword"> Senha </label>
                        <input type="password" class="form-control bg-transparent"
                            id="personPassword"
                            aria-describedby="passwordHelp"
                            v-model="password"
                            placeholder="Digite uma senha... *" required>
                        <p class="help-block text-danger"></p>
                        <small class="form-text text-muted" id="passwordHelp"> A senha deve possuir no mínimo  </small>
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" 
                    data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary" 
                    data-dismiss="modal" 
                    v-on:click="user_type = 1 , sendInfo()"
                    >Enviar</button>
            </div>
        </div>
    </div>    
</div>