{{ include('layouts/header.php', {title:'Détail de l'enchère'}) }}


<main class="contenu-principal">

<header class="entete-fil-ariane">
        <nav aria-label="Fil d'Ariane">
          <ul class="fil-ariane">
            <li>
              <a
                href="ventes-a-venir.html"
                aria-label="Retour à la page précédente"
              >
                <i class="fas fa-arrow-left"></i> Retour
              </a>
            </li>
            <li>
              <span class="separator"> | </span>
            </li>
            <li>
            {{auction.name}}
            </li>
          </ul>
        </nav>
        <div class="navigation-suivante">
          <a
            href="#"
            class="bouton-retour"
            aria-label="Retour à la collection précédente"
          >
            <i class="fas fa-chevron-left"></i> Précédent
          </a>
          <a
            href="#"
            class="bouton-retour"
            aria-label="Aller à la collection suivante"
          >
            Suivant <i class="fas fa-chevron-right"></i>
          </a>
        </div>
      </header>

      <section class="fiche-enchere">
        <article>
          <div class="contenu-galerie">
            <!-- Galerie du produit -->
            <section class="galerie-produit">
              <figure class="image-principale">
                <img
                  class="image-produit"
                  src="assets/images/timbres/timbre-NicolasCage-1964-1.jpg"
                  alt="Timbre Autriche 1918 - N19"
                />
                <button class="zoom-button" aria-label="Agrandir l'image">
                  <i class="fas fa-search-plus"></i>
                </button>
              </figure>
              <div class="miniatures">
                <img
                  class="miniature"
                  src="assets/images/timbres/timbre-NicolasCage-1964-2.jpg"
                  alt="thumbnail 1"
                />
                <img
                  class="miniature"
                  src="assets/images/timbres/timbre-NicolasCage-1964-3.jpg"
                  alt="thumbnail 2"
                />
                <img
                  class="miniature"
                  src="assets/images/timbres/timbre-NicolasCage-1964-4.jpg"
                  alt="thumbnail 3"
                />
                <img
                  class="miniature"
                  src="assets/images/timbres/timbre-NicolasCage-1964-1.jpg"
                  alt="thumbnail 4"
                />
              </div>
            </section>

            <!-- Détails du produit -->
            <aside class="details-produits">
              <header>
                <h1>{{stampInfo.name}}</h1>
                <p>
                  Cette rare édition met en lumière Nicolas Cage, un acteur aux
                  mille visages.
                </p>
              </header>

              <section class="enchere-estimation">
                <div class="enchere-actuelle">
                  <h2>Enchère actuelle (1.222 enchères)</h2>
                  <p>HKD 6,500</p>
                </div>

                <div class="estimation">
                  <h2>Estimation</h2>
                  <p>USD 30,000 - USD 50,000</p>
                </div>
              </section>

              <p>Clôture : <strong>Dans 4 jours</strong></p>

              <section class="actions">
                <div class="input-container">
                  <input
                    type="number"
                    class="input-prix"
                    placeholder="Entrez votre prix"
                    aria-label="Prix de l'enchère"
                    min="0"
                    required
                  />
                  <button
                    class="bouton btn-primaire btn-moyen"
                    aria-label="Placer une enchère"
                  >
                    Placer une enchère
                  </button>
                </div>
                <div class="actions-secondaires">
                  <button
                    class="bouton btn-secondaire btn-petit"
                    aria-label="Suivre l'enchère"
                  >
                    <i class="fas fa-eye"></i> Suivre
                  </button>
                  <button
                    class="bouton btn-secondaire btn-petit"
                    aria-label="Partager l'enchère"
                  >
                    <i class="fas fa-share"></i> Partager
                  </button>
                </div>
              </section>

              <footer>
                <p>
                  Essayez notre
                  <a href="#" title="Calculateur de coûts"
                    >calculateur de coûts</a
                  >
                </p>
              </footer>
            </aside>
          </div>
        </article>
      </section>

      <section class="details-supplementaires">
        <details>
          <summary>
            Description <i class="fas fa-chevron-right arrow"></i>
          </summary>
          <div class="contenu-details">
            <ul class="details-list">
              <li><strong>Pays d’origine:</strong> États-Unis</li>
              <li><strong>Thématique:</strong> Géographie et Tourisme</li>
              <li><strong>Couleur:</strong> Rouge</li>
              <li><strong>Certifié:</strong> Oui</li>
              <li><strong>Condition:</strong> Bonne</li>
              <li><strong>Prix & enchères:</strong> Enchères</li>
            </ul>
          </div>
        </details>

        <details>
          <summary>
            Conditions de la vente<i class="fas fa-chevron-right arrow"></i>
          </summary>
          <div class="contenu-details">
            <ul class="details-list">
              <li>Date : 30 février 2025</li>
              <li>Vente Privée – Accès exclusif</li>
              <li>Nicolas Cage (1964 - États-Unis)</li>
              <li>Légende d’Hollywood : Une Collection Unique</li>
            </ul>
          </div>
        </details>

        <details>
          <summary>
            Rapport de condition<i class="fas fa-chevron-right arrow"></i>
          </summary>
          <div class="contenu-details">
            <ul class="details-list">
              <li>
                Sur demande, nous nous ferons un plaisir de répondre à vos
                questions de manière détaillée.
              </li>
            </ul>
          </div>
        </details>
      </section>

      <!-- Autres produits -->
      <section class="encheres">
        <h1>Enchères qui pourraient vous intéresser</h1>
        <div class="grille">
      {% for auction in auctions %}
      <article class="carte">
                    <header class="carte-entete">
                        {% if auction.lord_favorite %}
                            <div class="lords-fav">
                                <a href="{{base}}/pages/lord-stampee">Coup de cœur du Lord</a>
                            </div>
                        {% endif %}
                        <div class="favori">
                            <a href="#"><i class="fa-solid fa-heart"></i> 1111</a>
                        </div>
                        <img class="carte-image" src="{{ uploads }}{{ auction.file_name }}" alt="{{ auction.stampName }}" />
                    </header>
                    <div class="carte-contenu">
                        <p class="carte-temps">Il reste {{ auction.finish_at | date('H:i:s') }}</p>
                        <h3><strong>{{ auction.stampName }}</strong></h3>
                        <span class="prix"><strong>${{ auction.starting_price }}</strong></span>
                        <footer>
    <form action="{{ base }}/bid/store" method="POST" class="enchere-form">
        <input type="number" name="bid_amount" placeholder="Votre offre" class="input-offre" min="{{ auction.highestBid ? auction.highestBid + 1 : auction.starting_price + 1 }}" required />
        <input type="hidden" name="auction_id" value="{{ auction.id }}" />
        <button type="submit" class="bouton miser">
            <i class="fa-solid fa-gavel"></i> Miser
        </button>
    </form>
    <a href="/auction/show?id={{ auction.id }}" class="bouton btn-cartes">Voir détails</a>
</footer>
                    </div>
                </article>
            {% endfor %}

        </div>
      </section>
      <!-- Fin Autres produits -->

</main>

{{ include('layouts/footer.php') }}
