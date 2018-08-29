// Instância para tratar do formulário para inserir currículo na plataforma
const curriculumForm = new Vue({
    el: '#curriculumModal',
    //components: { VoerroTagsInput },
    data: {
        area: '',   
        course: '',
        file: null,
        institute: '',
        graduateYear: '',
        habilities: []
    },
    methods: {
        sendInfo() {
            if(!this.isValid()){
                alert("Preencha todos os campos!!!");
            }
 
            $.post('/addCurriculum', {
                area: this.email,
                course: this.course,
                file,
                institute: this.institute,
                graduateYear: this.graduateYear,
                habilities: this.habilities
            }, null, 'json').then(
                r => {
                console.log(r);
                
                // Se o login ocorreu corretamente o r['code'] é igual a 200
                if(r['code'] == 200) {
                    
                } 
                
            }, err => {
                console.log(err.responseJSON);
                // Se o cadastro não ocorreu corretamente o err.responseJSON['code'] é igual a 400
                if(err.responseJSON['code'] == 400) {
                    this.error = err.responseJSON['message'];
                } 
            });
        },
        onFileSelected(event){
            this.file = event.target.files[0];
        },
        isValid() {
            return  this.area && 
                    this.course && 
                    this.file &&
                    this.institute &&
                    this.graduateYear;
        }
    }
});
