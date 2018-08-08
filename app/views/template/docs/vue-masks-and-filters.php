<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/docs">Docs</a>
        </li>
        <li class="breadcrumb-item active">Vue Filters/Masks</li>
    </ol>
</nav>
<section>
    <div class="container-fluid">
        <h3 class="text-center">Exemplo de uso de Filtros</h3>
        <hr>
        <p>Até o momento só existe um filtro customizado:</p>
        <ul>
            <li><b>MoneyFormatter</b>: Transforma um valor de ponto flutuante em um valor monetário. Ex:
                <code>30.15</code> =>
                <code>30,15</code>.</li>
        </ul>

        <p><small>Para mais informações sobre filtros consulte a <a href="https://vuejs.org/v2/guide/filters.html">documentação.</a></small></p>

        <div class="row">
            <div class="col-md-6">
                <pre><?php echo htmlentities('<div id="filterApp">
    <div class="form-group">
        <label>R$ {{value | moneyFormatter}}</label>
        <input type="number" class="form-control" v-model="value">
    </div>
</div>');?></pre>
            </div>
            <div class="col-md-6">
                <pre>
var filterApp = new Vue({
    el: '#filterApp',
    data: {
        value: 0
    }
});</pre>
            </div>
        </div>
    </div>
    <div class="container">
        <h3 class="text-center">Resultado</h3>
        <hr>
        <div class="" <div class="row">
            <div class="col-md-6">
                <div id="filterApp">
                    <div class="form-group">
                        <label>R$ {{value | moneyFormatter}}</label>
                        <input type="number" class="form-control" v-model="value">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
