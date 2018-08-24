<section class="pt-5 pb-3">
    <!-- Divisão do login -->
    <div id="login">
        <h3 class="text-center font-weight-bold pt-5 py-3">Login</h3>
        <p class="text-center text-danger" v-if="error">{{ error }}</p>
        <div class="container" id="login-container">
            <div class="row justify-content-center align-items-center" id="login-row">
                <div class="card">
                    <div class="card-body">

                            <!-- E-mail -->
                            <div class="form-group">
                                <i class="fa fa-envelope prefix grey-text"></i>
                                <label for="userEmail">Seu e-mail</label>
                                <input type="email" class="form-control mb-2" 
                                    id="userEmail"  
                                    v-model="email"
                                    placeholder="E-mail" required>                            
                            </div>
                            
                            <!-- Senha -->
                            <div class="form-group">
                                <i class="fa fa-lock prefix grey-text"></i>
                                <label for="userPassword">Sua senha</label>
                                <input type="password" class="form-control mb-2"
                                    id="userPassword" 
                                    v-model="password"
                                    placeholder="Senha" required>
                            </div>

                            <!-- Lembrar-me (Lembrete: o input checkbox deve vir antes do label, caso contrário, não funciona)-->
                            <div class="custom-control custom-checkbox align-items-start d-flex flex-column">
                                <input type="checkbox" class="custom-control-input" 
                                    id="loginFormRemember"
                                    v-model="remember">
                                <label class="custom-control-label" for="loginFormRemember" >Lembrar-me</label>
                            </div>                        

                            <!-- Esqueceu a senha -->
                            <div class="d-flex flex-column align-items-center pt-4">                                                                                            
                                <a href="">Esqueceu a senha?</a>                                
                            </div>                                                            

                            <!-- Botão de login - ao clicar chama a função no loginCurriculo.js para fazer o login -->
                            <div class="d-flex flex-column align-items-center mt-4 my-2">
                                <button @click="sendInfo()" class="btn btn-outline-dark my-2">
                                    Fazer login
                                </button>                            
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>