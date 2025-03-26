{{ include('layouts/header.php', {title:'Compte utilisateur'}) }}

<main class="contenu-principal">
    <section class="comptes-users">
        <h2>Bienvenue, {{user.name}}</h2>

        <article class="options-users">
            <header><h3>Mes options</h3></header>
            <div>
                <a href="{{base}}/user/edit" class="bouton btn-primaire">Modifier le profil</a>
                <a href="{{base}}/stamp/create" class="bouton btn-secondaire">Créer un timbre</a>
                <a href="{{base}}/stamp/index" class="bouton btn-secondaire">Mes timbres</a>
                <a href="{{ base}}/auction/create" class="bouton btn-secondaire">Créer une enchère</a>
                <a href="{{base}}/auction/index" class="bouton btn-secondaire">Mes enchères</a>
                <a href="#" class="bouton btn-secondaire">Voir mes favoris</a>
            </div>
        </article>

        <article class="options-users">
            <header><h3>Mon profil</h3></header>
            <div>
                <p><strong>Nom d'utilisateur :</strong> {{user.username}}</p>
                <p><strong>Courriel :</strong> {{user.email}}</p>
                <p><strong>Timbres enregistrés :</strong> x</p>
                <p><strong>Enchères à venir :</strong> x</p>
                <p><strong>Enchères en cours :</strong> x</p>
                <p><strong>Enchères expirées :</strong> x</p>
            </div>
        </article>
    </section>
</main>

{{ include('layouts/footer.php') }}