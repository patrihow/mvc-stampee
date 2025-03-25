{{ include('layouts/header.php', {title:'Modifier mon compte'})}}

<main class="contenu-principal">

<!-- Contenu Créer un compte start -->
<section class="login-page">
        <div class="login-page-content">
          <div class="logo-login">
            <img src="{{asset}}/images/logo-stampee.png" alt="Logo Stampee" />
          </div>
          <h2 class="titres-secondaires">Modifier mon compte</h2>

          <form class="login-form" method="post">
            <label for="name">Nom</label>
            <input
              class="login-input"
              type="text"
              id="name" name="name" placeholder="Entrez votre nom" value="{{user.name}}"/>
              <!-- {% if errors.name is defined %}
              <span class="span-erreur"> {{errors.name}}</span>
                {% endif %} -->


            <label for="email">Courriel</label>
            <input
              class="login-input"
              type="email"
              id="email"
              name="email"

              placeholder="Entrez votre email"
              value="{{user.email}}"/>
              <!-- {% if errors.email is defined %}
                <span class="span-erreur"> {{errors.email}}</span>
                {% endif %} -->

            <label for="password">Mot de passe</label>
            <input
              class="login-input"
              type="password"
              id="password"
              name="password"

              placeholder="Entrez un mot de passe qui contient des chiffres et des lettres"
            />
            <!-- {% if errors.password is defined %}
                    <span class="span-erreur"> {{errors.password}}</span>
                {% endif %} -->

            <div class="button-group">
              <button type="submit" value="Modifier le compte" class="bouton btn-primaire btn-moyen">Modifier mon compte</button>
              <button type="button" class="bouton btn-secondaire">Annuler</button>
            </div>
          </form>
        </div>
      </section>
      <!-- Contenu Créer un compte ends -->

</main>


{{ include('layouts/footer.php')}}
