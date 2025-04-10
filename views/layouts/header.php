<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Patricia Bravo" />
    <meta name="description" content="Plateforme d’enchères" />
    <title>{{ title }}</title>

    <!-- Typographies Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <!-- Icones -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />

    <!-- css -->
    <link rel="stylesheet" href="{{asset}}/css/main.css" />
    <!-- Javascript -->
    <script type="module" src="{{asset}}/js/main.js"></script>
  </head>
  <body>
    <!-- Navigation secondaire -->
    <nav class="navigation-secondaire" aria-label="Navigation secondaire">
      <ul>
        {% if guest %}
        <li class="bouton btn-petit">
            <a href="{{base}}/user/create"><i class="fas fa-user-plus"></i> Enregistrement</a>
        </li>
        <li class="bouton btn-petit">
            <a href="{{base}}/login"><i class="fas fa-user-plus"></i> Connexion</a>
        </li>
        {% else %}
        <li class="bouton btn-petit">
          <a href="{{base}}/user/show"><i class="fas fa-user-plus"></i> Mon compte</a>
        </li>
        <li class="bouton btn-petit">
          <a href="{{base}}/logout"
            ><i class="fas fa-user-plus"></i> Déconnexion</a
          >
        </li>
        {% endif %}

        <li>
          <a href="#"><i class="fas fa-globe"></i> Langue</a>
        </li>
        <li><span>|</span></li>
        <li>
          <a href="#"><i class="fas fa-dollar-sign"></i> CAD</a>
        </li>
      </ul>
    </nav>

    <!-- Navigation principale -->
    <nav class="navigation-principale" aria-label="Navigation principale">
      <a href="index.html">
        <img
          width="125"
          src="{{asset}}/images/logo-stampee.png"
          alt="Logo Stampee - Plateforme d’enchères de timbres"
        />
      </a>
      <!--
    <input type="checkbox" id="menu-toggle" class="menu-toggle" aria-label="Ouvrir le menu">
    <label for="menu-toggle" class="menu-icon">
        <i class="fas fa-bars"></i>
    </label>-->

      <ul class="nav-list">
        <li>
          <a href="#">Ventes aux enchères </a
          ><i class="fas fa-chevron-down"></i>
          <ul>
            <li><a href="#">En cours</a></li>
            <li><a href="#">À venir</a></li>
            <li><a href="#">Archives</a></li>
          </ul>
        </li>
        <li><a href="{{base}}/pages/lord-stampee">Coup de cœur du Lord</a></li>
<li><a href="{{base}}/pages/actualites">Actualités philatéliques</a></li>
<li><a href="{{base}}/pages/philatelie">La philatélie, c’est la vie</a></li>
      </ul>

      <!-- Barre de recherche -->
      <form
        class="search-form"
        role="search"
        action="recherche.html"
        method="GET"
      >
        <label for="search" class="visually-hidden">Rechercher</label>
        <input
          type="search"
          id="search"
          name="q"
          placeholder="Rechercher une enchère..."
          aria-label="Rechercher une enchère"
          required
        />
        <button type="submit" aria-label="Lancer la recherche">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="20"
            height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </form>
    </nav>
    <!-- Fin de la Navigation principale -->
