{{ include('layouts/header.php', {title:'Timbres'}) }}

<main class="contenu-principal">

<!-- Contenu principal index.html start -->
<header class="entete-principal">
        <img src="{{asset}}/images/hero-1.jpg" alt="Divers timbres exposés" />
        <h1>Découvrez les joyaux des enchères de Printemps 2025</h1>
      </header>

      <div class="container-index">
        <!-- Section Intro -->

        <section class="section-1">
          <h1 class="section-1-heading">
            L’excellence philatélique à portée de main
          </h1>
          <p class="introduction-texte">
            Découvrez une plateforme d’enchères dédiée aux passionnés, où chaque timbre raconte une histoire et trouve son collectionneur.
          </p>
          <a class="bouton btn-secondaire" href="#">Notre mission</a>
        </section>

        <!-- End of Section Intro -->
      </div>

      <!-- Présentation sommaire de Lord Stampee -->
<article class="annonce-vedette">
  <div class="text-container">
      <h2>Lord Reginald Stampee III, un héritage philatélique</h2>
      <p>Visionnaire et collectionneur émérite, Lord Stampee a consacré sa vie à l’art philatélique.
        Depuis plus d’un demi-siècle, ses enchères prestigieuses attirent les connaisseurs du monde entier.</p>
      <a class="bouton btn-secondaire" href="lord-stampee.html">Découvrir son histoire</a>
  </div>
  <img src="{{asset}}/images/lord.webp" alt="Portrait de Lord Stampee">
</article>
<!-- Fin de la Présentation sommaire de Lord Stampee -->

      <!-- La sélection coup de cœur de Lord Stampee -->
      <section class="encheres">
        <h1>La sélection coup de cœur de Lord Stampee</h1>
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
      <!-- Fin Enchères à venir -->

      <!-- les offres vedettes -->
      <section class="encheres">
        <h1>Offres vedettes</h1>
        <div class="grille">
          <article class="carte">
            <header class="carte-entete">
              <div class="favori">
                <a href="#"><i class="fa-solid fa-heart"></i> 52</a>
              </div>
              <img
                class="carte-image"
                src="{{asset}}/images/timbres/03-jeanclaude.jpg"
                alt="Nicolas Cage 1964 - États-Unis Légende d’Hollywood, Trésor mondial"
              />
            </header>
            <div class="carte-contenu">
              <p class="carte-temps">Il reste 7h 02m 00s</p>
              <h3>
                <strong
                  >Timbre oblitéré – Jean-Claude Killy 3F France 2000 Y&T
                  3315</strong
                >
              </h3>
              <p class="texte-small">Enchère actuelle</p>
              <span class="prix"><strong>$70</strong></span>
              <footer>
                <a href="#" class="bouton btn-cartes">Enchérir</a>
              </footer>
            </div>
          </article>
          <article class="carte">
            <header class="carte-entete">
              <div class="favori">
                <a href="#"><i class="fa-solid fa-heart"></i> 52</a>
              </div>
              <img
                class="carte-image"
                src="{{asset}}/images/timbres/03-jeanclaude.jpg"
                alt="Nicolas Cage 1964 - États-Unis Légende d’Hollywood, Trésor mondial"
              />
            </header>
            <div class="carte-contenu">
              <p class="carte-temps">Il reste 7h 02m 00s</p>
              <h3>
                <strong
                  >Timbre oblitéré – Jean-Claude Killy 3F France 2000 Y&T
                  3315</strong
                >
              </h3>
              <p class="texte-small">Enchère actuelle</p>
              <span class="prix"><strong>$70</strong></span>
              <footer>
                <a href="#" class="bouton btn-cartes">Enchérir</a>
              </footer>
            </div>
          </article>
          <article class="carte">
            <header class="carte-entete">
              <div class="favori">
                <a href="#"><i class="fa-solid fa-heart"></i> 52</a>
              </div>
              <img
                class="carte-image"
                src="{{asset}}/images/timbres/03-jeanclaude.jpg"
                alt="Nicolas Cage 1964 - États-Unis Légende d’Hollywood, Trésor mondial"
              />
            </header>
            <div class="carte-contenu">
              <p class="carte-temps">Il reste 7h 02m 00s</p>
              <h3>
                <strong
                  >Timbre oblitéré – Jean-Claude Killy 3F France 2000 Y&T
                  3315</strong
                >
              </h3>
              <p class="texte-small">Enchère actuelle</p>
              <span class="prix"><strong>$70</strong></span>
              <footer>
                <a href="#" class="bouton btn-cartes">Enchérir</a>
              </footer>
            </div>
          </article>
          <article class="carte">
            <header class="carte-entete">
              <div class="favori">
                <a href="#"><i class="fa-solid fa-heart"></i> 52</a>
              </div>
              <img
                class="carte-image"
                src="{{asset}}/images/timbres/03-jeanclaude.jpg"
                alt="Nicolas Cage 1964 - États-Unis Légende d’Hollywood, Trésor mondial"
              />
            </header>
            <div class="carte-contenu">
              <p class="carte-temps">Il reste 7h 02m 00s</p>
              <h3>
                <strong
                  >Timbre oblitéré – Jean-Claude Killy 3F France 2000 Y&T
                  3315</strong
                >
              </h3>
              <p class="texte-small">Enchère actuelle</p>
              <span class="prix"><strong>$70</strong></span>
              <footer>
                <a href="#" class="bouton btn-cartes">Enchérir</a>
              </footer>
            </div>
          </article>
        </div>
      </section>
      <!-- Fin les offres vedettes -->
      <!-- Section 1 -->

      <section class="section-1">
        <h1 class="section-1-heading">
          Trouvez la perle rare, une collection de timbres à travers les époques
        </h1>
        <div class="services">
          <div class="service">
            <i class="fas fa-user-tie"></i>
            <h3 class="service-heading">Individuel</h3>
            <p class="service-paragraph">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <a class="bouton btn-secondaire btn-petit" href="#"
              >Creer ma collection</a
            >
          </div>
          <div class="service">
            <i class="fas fa-briefcase"></i>
            <h3 class="service-heading">Collections</h3>
            <p class="service-paragraph">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <a class="bouton btn-secondaire btn-petit" href="#"
              >Creer ma collection</a
            >
          </div>
          <div class="service">
            <i class="fas fa-handshake"></i>
            <h3 class="service-heading">Partenariats</h3>
            <p class="service-paragraph">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
            </p>
            <a class="bouton btn-secondaire btn-petit" href="#"
              >Creer ma collection</a
            >
          </div>
        </div>
      </section>

      <!-- End of Section 1 -->

      <!-- End of Container index -->

</main>

{{ include('layouts/footer.php') }}
