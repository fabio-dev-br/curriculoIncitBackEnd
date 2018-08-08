<section>
    <div class="container">
        <h2>Form Validator</h2>
        <hr>
        <form class="intec-form-validator" role="form">
          <div class="form-group has-feedback">
            <label for="inputName" class="control-label">Name</label>
            <input
                type="text"
                class="form-control"
                id="inputName"
                placeholder="Cina Saffary"
                data-error="Coloque seu nome completo aqui =)"
                required>
            <span class="icon-feedback form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group has-feedback">
            <label for="inputTwitter" class="control-label">Twitter</label>
            <div class="input-group">
              <span class="input-group-addon">@</span>
              <input type="text" pattern="^[_A-z0-9]{1,}$" maxlength="15" class="form-control" id="inputTwitter" placeholder="1000hz" required>
            </div>
            <span class="icon-feedback form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group has-feedback">
            <label for="inputEmail" class="control-label">Email</label>
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" data-error="Bruh, that email address is invalid" required>
            <span class="icon-feedback form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
              <label for="inputPassword" class="control-label">Password</label>
            <div class="form-inline row">
              <div class="form-group col-sm-6">
                <input type="password"
                    pattern="^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\d]){1,})(?=(.*[\W]){1,})(?!.*\s).{8,}$"
                    data-pattern-error="A senha deve possuir letras (maiúsculas e minúsculas), números e caracteres especiais"
                    data-minlength="8"
                    data-minlength-error="A senha deve possuir pelo menos 8 caracteres"
                    data-error="Por favor, escolha uma senha"
                    class="form-control"
                    id="inputPassword"
                    placeholder="Password"
                    required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group col-sm-6">
                <input
                    type="password"
                    class="form-control"
                    id="inputPasswordConfirm"
                    data-match="#inputPassword"
                    data-match-error="As senhas não conferem"
                    data-error="Por favor, repita a senha"
                    placeholder="Repita a senha"
                    required>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="radio">
              <label>
                <input type="radio" name="underwear"
                data-error="Marque uma das opções"
                required>
                Boxers
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio"
                    name="underwear"
                    required>
                Briefs
              </label>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input
                    type="checkbox" id="terms"
                    data-error="Você precisa aceitar os termos de uso."
                    required>
                Aceito os termos
              </label>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="form-group">
              <label>Multiplas opções</label>
            <div class="checkbox">
              <label>
                <input
                    type="checkbox"
                    name="fruits[]"
                    value="Maçã"
                    data-atleast="2"
                    data-error="Selecione pelo menos 2 itens"
                    required
                    >
                Maçã
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input
                    type="checkbox"
                    value="Banana"
                    name="fruits[]"
                    data-atleast="2"
                    data-error="Selecione pelo menos 2 itens"
                    required
                    >
                Banana
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input
                    type="checkbox"
                    value="Pera"
                    name="fruits[]"
                    data-atleast="2"
                    data-error="Selecione pelo menos 2 itens"
                    required
                    >
                Pera
              </label>
            </div>
            <div class="checkbox">
              <label>
                <input
                    type="checkbox"
                    value="Uva"
                    name="fruits[]"
                    data-atleast="2"
                    data-error="Selecione pelo menos 2 itens"
                    required
                    >
                Uva
              </label>
            </div>
            <div class="help-block with-errors"></div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
    </div>
</section>
