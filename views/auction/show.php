{{ include('layouts/header.php', {title: 'Détail de l\'enchère'}) }}



<main class="contenu-principal">

    <header class="entete-fil-ariane">
        <nav aria-label="Fil d'Ariane">
            <ul class="fil-ariane">
                <li>
                    <a href="ventes-a-venir.html" aria-label="Retour à la page précédente">
                        <i class="fas fa-arrow-left"></i> Retour
                    </a>
                </li>
                <li>
                    <span class="separator"> | </span>
                </li>
                <li>{{ auction.name }}</li>
            </ul>
        </nav>
        <div class="navigation-suivante">
            <a href="#" class="bouton-retour" aria-label="Retour à la collection précédente">
                <i class="fas fa-chevron-left"></i> Précédent
            </a>
            <a href="#" class="bouton-retour" aria-label="Aller à la collection suivante">
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
                        <img class="image-produit" src="{{ uploads }}{{ images[0].file }}" alt="{{ images[0].description }}" />
                        <button class="zoom-button" aria-label="Agrandir l'image">
                            <i class="fas fa-search-plus"></i>
                        </button>
                    </figure>
                    <div class="miniatures">
                        {% for image in images %}
                            <img class="miniature" src="{{ uploads }}{{ image.file }}" alt="thumbnail {{ loop.index }}" />
                        {% endfor %}
                    </div>
                </section>

                <!-- Détails du produit -->
                <aside class="details-produits">
                    <header>
                        <h1>{{ stampInfo.name }}</h1>
                        <p>Cette rare édition met en lumière {{ stampInfo.userName }}.</p>
                    </header>

                    <section class="enchere-estimation">
                        <div class="enchere-actuelle">
                            <h2>Enchère actuelle</h2>
                            <p>{{ auction.highestBid }} $</p>
                        </div>

                        <div class="estimation">
                            <h2>Estimation</h2>
                            <p>Vente ouverte jusqu'à {{ auction.finish_at }}</p>
                        </div>
                    </section>

                    <p>Clôture : <strong>Dans {{ auction.timeLeft }}</strong></p>

                    <section class="actions">
                        <div class="input-container">
                            <form action="{{ base }}/bid/store" method="POST">
                                <input type="hidden" name="auction_id" value="{{ auction.id }}">
                                <input type="number" name="bid_amount" class="input-prix" placeholder="Entrez votre prix" min="{{ auction.highestBid + 1 }}" required />
                                <button class="bouton btn-primaire" aria-label="Placer une enchère">Placer une enchère</button>
                            </form>
                        </div>
                        <div class="actions-secondaires">
                            <button class="bouton btn-secondaire btn-petit" aria-label="Suivre l'enchère">
                                <i class="fas fa-eye"></i> Suivre
                            </button>
                            <button class="bouton btn-secondaire btn-petit" aria-label="Partager l'enchère">
                                <i class="fas fa-share"></i> Partager
                            </button>
                        </div>
                    </section>

                    <footer>
                        <p>
                            Essayez notre <a href="#" title="Calculateur de coûts">calculateur de coûts</a>
                        </p>
                    </footer>
                </aside>
            </div>
        </article>
    </section>

    <section class="details-supplementaires">
        <details>
            <summary>Description <i class="fas fa-chevron-right arrow"></i></summary>
            <div class="contenu-details">
                <ul class="details-list">
                    <li><strong>Pays d’origine:</strong> {{ stampInfo.countryName }}</li>
                    <li><strong>Thématique:</strong> {{ stampInfo.theme }}</li>
                    <li><strong>Couleur:</strong> {{ stampInfo.colorName }}</li>
                    <li><strong>Certifié:</strong> {{ stampInfo.isCertified ? 'Oui' : 'Non' }}</li>
                    <li><strong>Condition:</strong> {{ stampInfo.conditionState }}</li>
                </ul>
            </div>
        </details>

        <details>
            <summary>Conditions de la vente<i class="fas fa-chevron-right arrow"></i></summary>
            <div class="contenu-details">
                <ul class="details-list">
                    <li>Date : {{ auction.finish_at }}</li>
                    <li>Vente Privée – Accès exclusif</li>
                </ul>
            </div>
        </details>
    </section>

    <!-- Autres produits -->
    <section class="encheres">
        <h1>Enchères qui pourraient vous intéresser</h1>
        <div class="grille">
            {% for auction in bannerAuctions %}
                <article class="carte">
                    <header class="carte-entete">
                        <img class="carte-image" src="{{ uploads }}{{ auction.fileName }}" alt="{{ auction.stampName }}" />
                    </header>
                    <div class="carte-contenu">
                        <p class="carte-temps">Il reste {{ auction.timeLeft }}</p>
                        <h3><strong>{{ auction.stampName }}</strong></h3>
                        <span class="prix"><strong>${{ auction.starting_price }}</strong></span>
                        <footer>
                            <form action="{{ base }}/bid/store" method="POST" class="enchere-form">
                                <input type="number" name="bid_amount" placeholder="Votre offre" class="input-offre" min="{{ auction.highestBid ? auction.highestBid + 1 : auction.starting_price + 1 }}" required />
                                <input type="hidden" name="auction_id" value="{{ auction.id }}" />
                                <button type="submit" class="bouton miser">
                                    <i class="fas fa-gavel"></i> Miser
                                </button>
                            </form>
                            <a href="/auction/show?id={{ auction.id }}" class="bouton btn-cartes">Voir détails</a>
                        </footer>
                    </div>
                </article>
            {% endfor %}
        </div>
    </section>

</main>

{{ include('layouts/footer.php') }}
