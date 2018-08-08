<section class="welcome-section d-flex align-items-center">
    <div class="container text-center text-white">
        <h1>Bem-vindo ao PHPSTART</h1>
        <p>Consulte a
            <a class="badge badge-light" href="/docs">DOCUMENTAÇÃO</a>
        </p>
    </div>
</section>
<section class="pt-3 pb-3">
    <div class="container">
        <h2 class="text-center">Serviços</h2>
        <hr>
        <div class="row text-center">
            <div class="col-sm mt-4">
                <img src="/img/services/keyboard.svg" width="128">
                <h5 class="mt-2">100% Intel Cores</h5>
                <p class="text-justify text-muted mt-1">
                    Latest generation Intel CPUs guarantee consistent performance.
                </p>
            </div>
            <div class="col-sm mt-4">
                <img src="/img/services/magnifying-glass.svg" width="128">
                <h5 class="mt-2">Infinite OS combinations</h5>
                <p class="text-justify text-muted mt-1">
                    Deploy CentOS, Debian, Ubuntu, Windows, FreeBSD, (and more!) or use our Upload ISO feature.
                </p>
            </div>
            <div class="col-sm mt-4">
                <img src="/img/services/thumb-is-still-top.svg" width="128">
                <h5 class="mt-2">Root administrator access</h5>
                <p class="text-justify text-muted mt-1">
                    Full "root" access and a dedicated IP address included with all VMs.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="pt-3 pb-3">
    <div class="container">
        <h2 class="text-center">Depoimentos</h2>
        <hr>
        <blockquote class="blockquote text-center text-muted font-italic">
            <p class="mb-0 small">“Let us return for a moment to Lady Lovelace’s objection, which stated that the machine can only do what we tell
                it to do. One could say that a man can "inject" an idea into the machine, and that it will respond to a certain
                extent and then drop into quiescence, like a piano string struck by a hammer. Another simile would be an
                atomic pile of less than critical size: an injected idea is to correspond to a neutron entering the pile
                from without. Each such neutron will cause a certain disturbance which eventually dies away. If, however,
                the size of the pile is sufficiently increased, the disturbance caused by such an incoming neutron will very
                likely go on and on increasing until the whole pile is destroyed. Is there a corresponding phenomenon for
                minds, and is there one for machines? There does seem to be one for the human mind. The majority of them
                seem to be "sub critical," i.e. to correspond in this analogy to piles of sub-critical size. An idea presented
                to such a mind will on average give rise to less than one idea in reply. A smallish proportion are supercritical.
                An idea presented to such a mind may give rise to a whole "theory" consisting of secondary, tertiary and
                more remote ideas. Animals’ minds seem to be very definitely sub-critical. Adhering to this analogy we ask,
                "Can a machine be made to be super-critical?”</p>
            <footer class="blockquote-footer">Alan Turing,
                <cite title="Source Title">Computing machinery and intelligence</cite>
            </footer>
        </blockquote>
    </div>
</section>
<section class="bg-dark text-white pt-3 pb-3">
    <div class="container">
        <h2 class="text-center">Contato</h2>
        <hr>
        <form id="contactForm" v-on:submit="sendMessage($event)">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control bg-transparent text-white"
                            v-model="name"
                            placeholder="Seu nome *" required>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control bg-transparent text-white"
                            v-model="email"
                            placeholder="seu email *" required>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control bg-transparent text-white"
                            v-model="message"
                            placeholder="Sua mensagem *" rows="5" required></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-outline-light btn-lg"
                        v-bind:disabled="!isValid"
                        >Enviar Mensagem</button>
                </div>
            </div>
        </form>
    </div>
</section>
