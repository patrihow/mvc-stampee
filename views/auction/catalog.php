{{ include('layouts/header.php', {title:'Catalogue des enchères'}) }}


<main class="contenu-principal">
<!-- Contenu encheres.php start -->
<!-- Contenu entete-secondaire start -->
<header class="entete-secondaire">
        <img src="{{asset}}/images/hero-3.webp" alt="Bureau avec timbres, lettres et loupe.">
        <h1>Les trésors philatéliques à votre portée</h1>
      </header>
      <!-- Contenu entete-secondaire ends -->


      <section class="encheres-recherche">

        <div class="grid-container">
          <aside class="filtres-encheres">
            <!-- Filters -->
            <section class="filter-section">
              <header>
                  <h2>Filtres de Collection</h2>
                  <!-- <label for="ouvrir-filtres" class="operation-label">Ouvrir les filtres</label>
                  <input id="ouvrir-filtres" type="checkbox" aria-expanded="false"> -->
              </header>
              <div class="filter-content">
                  <details>
                      <summary>Pays d'origine</summary>
                      <div>
                          <div class="filter-item">
                              <input type="checkbox" id="france" name="pays" value="France">
                              <label for="france">France</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="royaume-uni" name="pays" value="Royaume-Uni">
                              <label for="royaume-uni">Royaume-Uni</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="allemagne" name="pays" value="Allemagne">
                              <label for="allemagne">Allemagne</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="italie" name="pays" value="Italie">
                              <label for="italie">Italie</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="espagne-portugal" name="pays" value="Espagne & Portugal">
                              <label for="espagne-portugal">Espagne & Portugal</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="etats-unis" name="pays" value="États-Unis">
                              <label for="etats-unis">États-Unis</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="asie" name="pays" value="Asie">
                              <label for="asie">Asie</label>
                          </div>
                      </div>
                  </details>

                  <details>
                      <summary>Thématique</summary>
                      <div>
                          <div class="filter-item">
                              <input type="checkbox" id="geographie-tourisme" name="theme" value="Géographie et Tourisme">
                              <label for="geographie-tourisme">Géographie et Tourisme</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="personnages-celebres" name="theme" value="Personnages célèbres">
                              <label for="personnages-celebres">Personnages célèbres</label>
                          </div>

                      </div>
                  </details>

                  <details>
                      <summary>Fourchette de prix</summary>
                      <div class="filter-item">
                          <label for="prix-min">Prix Min:</label>
                          <input type="number" id="prix-min" name="prix-min" placeholder="0">
                      </div>
                      <div class="filter-item">
                          <label for="prix-max">Prix Max:</label>
                          <input type="number" id="prix-max" name="prix-max" placeholder="140">
                      </div>
                  </details>

                  <details>
                      <summary>Époque</summary>
                      <div>
                          <select id="epoque" name="epoque">
                              <option value="1930-1940">1930-1940</option>
                              <option value="1920-1930">1920-1930</option>
                              <option value="1950-1960">1950-1960</option>
                              <option value="1910-1920">1910-1920</option>
                              <option value="2024-plus">2024 en avant</option>
                          </select>
                      </div>
                  </details>

                  <details>
                      <summary>Condition</summary>
                      <div>
                          <div class="filter-item">
                              <input type="checkbox" id="parfaite" name="condition" value="Parfaite">
                              <label for="parfaite">Parfaite</label>
                          </div>
                          <div class="filter-item">
                              <input type="checkbox" id="excellente" name="condition" value="Excellente">
                              <label for="excellente">Excellente</label>
                          </div>

                      </div>
                  </details>
                  <button type="submit" class="bouton btn-secondaire">Appliquer les filtres</button>
              </div>
          </section>
          </aside>

          <!-- Grid Section for Auction Cards -->
    <section id="encheres">

<h1>Enchères en Vedette</h1>
<div class="view-options">
  <button class="grid-view" aria-label="Voir les produits en grille">
    <i class="fas fa-th"></i> Vue en Grille
  </button>
  <button class="list-view" aria-label="Voir les produits en liste">
    <i class="fas fa-list"></i> Vue en Liste
  </button>
</div>
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
    <a href="{{base}}/auction/show?id={{auction.id}}" class="bouton btn-cartes">Voir détails</a>
</footer>
                    </div>
                </article>
            {% endfor %}

        </div>


        <div class="pagination">
          <button class="bouton btn-secondaire" id="anterior" onclick="return false;">Précédent</button>
          <button class="bouton btn-secondaire" id="suivant" onclick="return false;">Suivant</button>
      </div>

      </section>



      <!-- Contenu encheres.html ends -->
</main>

{{ include('layouts/footer.php') }}
