{{ include('layouts/header.php', {title:'Modifier mon compte'}) }}

<main class="contenu-principal">
    <section class="login-page">
        <div class="login-page-content">
            <h2 class="titres-secondaires">Modifier votre compte</h2>

            <form class="login-form" method="post">
                <label for="name">Nom</label>
                <input class="login-input" type="text" id="name" name="name" placeholder="Entrez votre nom" value="{{user.name}}"/>
                {% if errors.name is defined %}
                    <span class="span-erreur"> {{errors.name}}</span>
                {% endif %}

                <label for="email">Courriel</label>
                <input class="login-input" type="email" id="email" name="email" placeholder="Entrez votre email" value="{{user.email}}"/>
                {% if errors.email is defined %}
                    <span class="span-erreur"> {{errors.email}}</span>
                {% endif %}

                <label for="password">Mot de passe</label>
                <input class="login-input" type="password" id="password" name="password" placeholder="Entrez votre mot de passe"/>
                {% if errors.password is defined %}
                    <span class="span-erreur"> {{errors.password}}</span>
                {% endif %}

                <div class="button-group">
                    <button type="submit" value="Mettre à jour" class="bouton btn-primaire btn-moyen">Mettre à jour</button>
                    <button type="button" class="bouton btn-secondaire">Annuler</button>
                </div>
            </form>
        </div>
    </section>
</main>

{{ include('layouts/footer.php') }}