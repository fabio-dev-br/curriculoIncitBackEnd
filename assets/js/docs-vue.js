
var vueExampleApp = new Vue({
    el: "#exampleApp",
    data: {
        trips: []
    },
    methods: {
        removeTrip: function (tripId) {
            if (confirm('Tem certeza que deseja remover a viagem ' + tripId)) {
                var index = this.trips.findIndex(t => t.id == tripId);

                if (index > -1) {
                    this.trips.splice(index, 1);
                }
            }
        }
    },
    created() { // vue lifecycle hook
        $.get('/docs/vue/loadData', null, null, 'json').then(response => {
            this.trips = response.data;
        });
    }
});


