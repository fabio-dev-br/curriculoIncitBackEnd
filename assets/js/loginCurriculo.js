// Instância para tratar do login do usuário na plataforma
const login = new Vue({
    el: '#login',
    data: {
        email: '',
        password: '',
        remember: '',
        error: ''
    },
    methods: {
        sendInfo() {
            if(!this.isValid()){
                alert("Preencha todos os campos!!!");
            }

            $.post('/login2', {
                email: this.email,
                password: this.password
            }, null, 'json').then(
                r => {
                console.log(r);
                
                // Se o login ocorreu corretamente o r['code'] é igual a 200
                // lembrar que quando for fazer o tratamento de sessão ele ocorrerá no back-end
                if(r['code'] == 200) {

                    // Verifica se o usuário é empresa (user_type = 0) ou pessoa (user_type = 1)
                    // e redireciona para o local certo
                    if(r['data']['user_type'] == 0) {
                        window.location.replace("/portalEmpresa");
                    } else {
                        window.location.replace("/portalPessoa");
                    }
                } 
                
            }, err => {
                console.log(err.responseJSON);
                
                // Se o login não ocorreu corretamente o err.responseJSON['code'] é igual a 400
                if(err.responseJSON['code'] == 400) {
                    this.error = err.responseJSON['message'];
                } 
            });
        },
        isValid() {
            return  this.email && 
                    this.password;
        }
    },
    computed: {
        
    }
});


// Instância para esconder o botão de login em caso de click

// const loginButton = new Vue({
//     el: '#loginButton',
//     data: {
//         show: true
//     },
//     methods: {
//         avisa() {            
//             alert("Aaa" + this.show);
//         }
//     }
// });

