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

<h1>Enchères du moment</h1>
<div class="view-options">
  <button class="grid-view" aria-label="Voir les produits en grille">
    <i class="fas fa-th"></i> Vue en Grille
  </button>
  <button class="list-view" aria-label="Voir les produits en liste">
    <i class="fas fa-list"></i> Vue en Liste
  </button>
</div>
      <div class="grille">
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 12</a>
            </div>
            <img
              class="carte-image"
              src="assets/images/timbres/01-col-britannique-lot.jpg"
              alt="Nicolas Cage 1964 - États-Unis Légende d’Hollywood, Trésor mondial"
            />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 7h 02m 00s</p>
            <h3><strong>Nicolas Cage 1964 - États-Unis - Légende d’Hollywood</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$7120</strong></span>
            <footer>
              <a href="fiche-enchere.html" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>

        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 20</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/03-jeanclaude.jpg" alt="Édition spéciale de timbres de France" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 5h 30m 00s</p>
            <h3><strong>Collection de timbres de France - Édition spéciale</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$450</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 30</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/04-belgique.jpg" alt="Série de timbres de l'Italie historique" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 12h 15m 30s</p>
            <h3><strong>Collection de timbres historiques d'Italie</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$300</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 40</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/autriche-1918-N19-TimbreTB-recto.jpg" alt="Timbres vintage du Royaume-Uni" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 3h 45m 10s</p>
            <h3><strong>Collection de timbres vintage du Royaume-Uni</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$600</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 25</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/Espagne-1953-1.jpg" alt="Timbres de l'Allemagne impériale" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 7h 22m 45s</p>
            <h3><strong>Collection de timbres de l'Allemagne impériale</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$520</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 15</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/timbre-NicolasCage-1964-1.jpg" alt="Série de timbres asiatiques uniques" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 9h 10m 50s</p>
            <h3><strong>Série de timbres asiatiques uniques</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$250</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 22</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/timbre-NicolasCage-1964-3.jpg" alt="Timbres de l'Espace" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 4h 16m 12s</p>
            <h3><strong>Collection de timbres de l'espace</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$700</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 35</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/a8bdd60b-7dcf-4fb3-a041-2e79853fac4e.png" alt="Série de timbres d'Afrique" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 6h 55m 05s</p>
            <h3><strong>Série de timbres d'Afrique</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$400</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 28</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/timbre2.jpg" alt="Série de timbres d'Estonie" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 2h 35m 20s</p>
            <h3><strong>Série de timbres d'Estonie</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$150</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 32</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/timbre1.jpg" alt="Collection de timbres suédois" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 8h 24m 30s</p>
            <h3><strong>Collection de timbres suédois</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$800</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
        <article class="carte">
          <header class="carte-entete">
            <div class="favori">
              <a href="#"><i class="fa-solid fa-heart"></i> 19</a>
            </div>
            <img class="carte-image" src="assets/images/timbres/372dcfb8-7e57-42af-8bc5-1f096ae806d7.png" alt="Collection de timbres des Pays-Bas" />
          </header>
          <div class="carte-contenu">
            <p class="carte-temps">Il reste 1h 50m 00s</p>
            <h3><strong>Collection de timbres des Pays-Bas</strong></h3>
            <p class="texte-small">Enchère actuelle</p>
            <span class="prix"><strong>$350</strong></span>
            <footer>
              <a href="#" class="bouton btn-cartes">Enchérir</a>
            </footer>
          </div>
        </article>
        
       
        

          

        </div>


        <div class="pagination">
          <button class="bouton btn-secondaire" id="anterior" onclick="return false;">Précédent</button>
          <button class="bouton btn-secondaire" id="suivant" onclick="return false;">Suivant</button>
      </div>

      </section>

      

      <!-- Contenu encheres.html ends -->
</main>

{{ include('layouts/footer.php') }}
