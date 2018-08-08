<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="/docs">Docs</a>
        </li>
        <li class="breadcrumb-item active">Beanstalk</li>
    </ol>
</nav>
<section>
    <div class="container">
        <h3 class="section-heading text-center">Beanstalk</h3>
        <hr>
        <p>Descrição:
            <small>Gerenciador de filas de processos</small>.</p>
        <p>Instalação:
            <small>
                <code>sudo apt install beanstalkd</code>
            </small>.</p>
        <p>Documentação:
            <small>
                <a href="https://github.com/kr/beanstalkd/blob/master/doc/protocol.txt">https://github.com/kr/beanstalkd/blob/master/doc/protocol.txt</a>
            </small>
        </p>
        <p>Obs.: O beanstalk é utilizado através do pacote
            <a href="https://packagist.org/packages/pda/pheanstalk">pda/pheanstalk</a>.</p>
        <p>Uso comum: Envio de emails, SMS e demais atividades que podem ser separadas do fluxo de requisição-resposta.</p>
    </div>
</section>
