<!-- Pied de page start -->
<footer class="pied-de-page">
      <div class="conteneur">
        <!-- Logo et Description -->
        <div class="presentation">
          <img
            src="{{asset}}/images/logo-stampee.png"
            alt="Logo de l'entreprise"
            class="logo"
          />
          <p class="description">Lord Reginald Stampee III</p>
          <p>
            Château de Stampee Highclere Park, Newbury RG20 9RN Winchester,
            Hampshire, Royaume-Uni
          </p>
          <p>Angleterre | Canada | US | Australie</p>
        </div>

        <!-- Navigation principale -->
        <nav class="navigation">
          <div class="bloc">
            <h3 class="titre">À propos</h3>
            <ul class="liste">
              <li><a href="#" class="lien">Lord Reginald Stampee III</a></li>
              <li><a href="#" class="lien">Histoire familiale</a></li>
              <li><a href="#" class="lien">Partenariats</a></li>
              <li><a href="#" class="lien">Contact</a></li>
            </ul>
          </div>

          <div class="bloc">
            <h3 class="titre">Acheter</h3>
            <ul class="liste">
              <li><a href="#" class="lien">Comment placer une offre</a></li>
              <li><a href="#" class="lien">Suivre une enchère</a></li>
              <li><a href="#" class="lien">Trouver l’enchère désirée</a></li>
            </ul>
          </div>

          <div class="bloc">
            <h3 class="titre">Compte</h3>
            <ul class="liste">
            {% if guest %}
              <li><a href="{{base}}/user/create" class="lien">Enregistrement</a></li>
              <li><a href="{{base}}/login" class="lien">Connexion</a></li>
              {% else %}
              <li><a href="{{base}}/user/show" class="lien">Mon compte</a></li>
              <li><a href="{{base}}/logout" class="lien">Déconnexion</a></li>
              <li><a href="#" class="lien">Aide</a></li>
              {% endif %}
            </ul>
          </div>
        </nav>
      </div>

      <!-- Copyright & Liens légaux -->
      <div class="section-legale">
        <p class="copyright">&copy; 2025 Lord Reginald Stampee III</p>
        <nav class="liens-legaux">
          <a href="#" class="lien">Conditions générales</a>
          <span>|</span>
          <a href="#" class="lien">Politique de confidentialité</a>
          <span>|</span>
          <a href="#" class="lien">Utilisation des cookies</a>
          <span>|</span>
          <a href="#" class="lien">Mentions légales</a>
        </nav>
      </div>
    </footer>
    <!-- Pied de page ends -->
  </body>
</html>
