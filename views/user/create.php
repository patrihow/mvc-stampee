{{ include('layouts/header.php', {title:'Création compte'})}}

<main class="contenu-principal">

<!-- Contenu Créer un compte start -->
<section class="login-page">
        <div class="login-page-content">
          <div class="logo-login">
            <img src="{{asset}}/images/logo-stampee.png" alt="Logo Stampee" />
          </div>
          <h2 class="titres-secondaires">Découvrez de magnifiques collections</h2>
          <p class="intro-texte">
            Inscrivez-vous pour découvrir les nouvelles collections de timbres, les promotions et bien plus encore !
          </p>

          <form class="login-form" method="post">
            <label for="name">Nom</label>
            <input
              class="login-input"
              type="text"
              id="name" placeholder="Entrez votre nom" value="{{user.name}}"/>
              {% if errors.name is defined %}
              <span class="span-erreur"> {{errors.name}}</span>
                {% endif %}


            <label for="email">Courriel</label>
            <input
              class="login-input"
              type="email"
              id="email"
              name="email"

              placeholder="Entrez votre email"
              value="{{user.email}}"/>
              {% if errors.email is defined %}
                <span class="span-erreur"> {{errors.email}}</span>
                {% endif %}

            <label for="password">Mot de passe</label>
            <input
              class="login-input"
              type="password"
              id="password"
              name="password"

              placeholder="Entrez votre mot de passe"
            />
            {% if errors.password is defined %}
                    <span class="span-erreur"> {{errors.password}}</span>
                {% endif %}

            <div class="terms">
              <input type="checkbox" id="terms" name="terms"/>
              <label for="terms">
                J'accepte les Conditions d'utilisation et la Politique de confidentialité de Stampee, et je confirme que j'ai 18 ans ou plus.
              </label>
            </div>


            <div class="button-group">
              <button type="submit" value="Créer le compte" class="bouton btn-primaire btn-moyen">Créer un compte</button>
              <button type="button" class="bouton btn-secondaire">Annuler</button>
            </div>
          </form>
        </div>
      </section>
      <!-- Contenu Créer un compte ends -->

</main>


{{ include('layouts/footer.php')}}
