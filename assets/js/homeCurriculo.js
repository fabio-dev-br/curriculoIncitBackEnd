// Instância para tratar do modal que abrange o cadastro da empresa na plataforma
const companyModal = new Vue({
    el: '#companyModal',
    data: {
        name: '',
        email: '',
        identity: '',
        user_type: '',
        password: ''
    },
    methods: {
        sendInfo() {
            if(!this.isValid()){
                alert("Preencha todos os campos!!!");
            }
  
            $.post('/newAccount', {
                name: this.name,
                email: this.email,
                identity: this.identity,
                user_type: this.user_type,
                password: this.password
            }, null, 'json').then(r => {
                console.log(r);
            }, err => {
                console.log(err.responseJSON);
            });
        },
        isValid() {
            return  this.name && 
                    this.email && 
                    this.identity && 
                    this.password;
        }
    },
    computed: {
        
    }
});


// Instância para tratar do modal que abrange o cadastro da pessoa na plataforma
const personModal = new Vue({
    el: '#personModal',
    data: {
        name: '',
        email: '',
        identity: '',
        user_type: '',
        password: ''
    },
    methods: {
        sendInfo() {
            if(!this.isValid()){
                alert("Preencha todos os campos!!!");
            }
            
            $.post('/newAccount', {
                name: this.name,
                email: this.email,
                identity: this.identity,
                user_type: this.user_type,
                password: this.password
            }, null, 'json').then(r => {
                console.log(r);
            }, err => {
                console.log(err.responseJSON);
            });
        },
        isValid() {
            return  this.name && 
                    this.email && 
                    this.identity && 
                    this.password;
        }
    },
    computed: {
        
    }
});