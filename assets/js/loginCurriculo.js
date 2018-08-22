// Instância para tratar do login do usuário na plataforma
const loginForm = new Vue({
    el: '#loginForm',
    data: {
        email: '',
        password: '',
        remember: ''
    },
    methods: {
        sendInfo() {
            if(!this.isValid()){
                alert("Preencha todos os campos!!!");
            }
            $.post('/login2', {
                email: this.email,
                password: this.password
            }, null, 'json').then(r => {
                console.log(r);
                // Se o login ocorreu corretamente o r['code'] é igual a 200
                if(r['code'] == 200) {
                    alert("aaaaa");
                } 
                
            }, err => {
                console.log(err.responseJSON);
                // Se o login não ocorreu corretamente o err.responseJSON['code'] é igual a 400
                if(err.responseJSON['code'] == 400) {
                    alert(err.responseJSON['message']);
                } 
            });
        },
        isValid() {
            return this.email && this.password;
        }
    },
    computed: {
        
    }
});