

const contactForm = new Vue({
    el: '#contactForm',
    data: {
        name: '',
        email: '',
        message: ''
    },
    methods: {
        sendMessage($event) {

            $.post('/contact', {
                name: this.name,
                email: this.email,
                message: this.message
            }, null, 'json').then(r => {
                console.log(r);
            }, err => {
                console.log(err.responseJSON);
            });

            $event.preventDefault();
            $event.stopPropagation();
        }
    },
    computed: {
        isValid() {
            return this.name && this.email && this.message;
        }
    }
});
