{{ include('layouts/header.php', {title:'Connexion au compte'})}}

<main class="contenu-principal">
<section class="login-page">
    <div class="login-page-content">
        <div class="logo-login">
            <img src="{{asset}}/images/logo-stampee.png" alt="Logo Stampee" />
        </div>
        <h2 class="titres-secondaires">Connexion à votre portail de membre</h2>
        <p class="intro-texte">
            Connectez-vous pour découvrir les nouvelles collections de timbres, les promotions et bien plus encore !
        </p>

        <form class="login-form" method="post">
            <label for="username">Nom d'utilisateur (Courriel)</label>
            <input class="login-input" type="email" id="username" name="username" placeholder="Entrez votre email" value="{{user.email}}"/>
            {% if errors.username is defined %}
                <span class="span-erreur"> {{errors.username}}</span>
            {% endif %}

            <label for="password">Mot de passe</label>
            <input class="login-input" type="password" id="password" name="password" placeholder="Entrez votre mot de passe"/>
            {% if errors.password is defined %}
                <span class="span-erreur"> {{errors.password}}</span>
            {% endif %}

            <div class="button-group">
                <button type="submit" value="Connexion" class="bouton btn-primaire btn-moyen">Connexion</button>
                <button type="button" class="bouton btn-secondaire">Annuler</button>
            </div>
        </form>
    </div>
</section>
</main>

{{ include('layouts/footer.php')}}