{{ include('layouts/header.php', {title:'Création nouvel timbre'}) }}

<main class="contenu-principal">

<section class="login-page">

<div class="login-page-content">
    <small class="subtitle-form">Étape 1 de 2: Ajoutez les informations de votre timbre</small>
    <h2 class="titres-secondaires">Création nouvel timbre</h2>
    <p class="intro-texte">
    Ici, vous pouvez télécharger votre collection de timbres afin de commencer à participer aux enchères. Dans cette première étape, veuillez renseigner toutes les informations demandées sur votre timbre.
    </p>

    <form class="login-form" method="post" enctype="multipart/form-data">

    <label for="name">Titre du timbre</label>
    <input class="login-input" type="text" id="name" name="name" value="{{stamp.name}}"/>
    {% if errors.name is defined %}
    <span class="span-erreur"> {{errors.name}}</span>
    {% endif %}

    <label for="description">Description du timbre</label>
    <textarea name="description" id="description" rows="15">{{stamp.description}}</textarea>
    {% if errors.description is defined %}
    <span class="span-erreur"> {{errors.description}}</span>
    {% endif %}

    <label for="year">L'époque du timbre</label>
<select class="login-input" id="year" name="year">
    <option value="" disabled selected>Choisir l'année</option>
    {% for year in years %}
        <option value="{{ year }}" {% if stamp.year == year %} selected {% endif %}>{{ year }}</option>
    {% endfor %}
</select>
{% if errors.year is defined %}
<span class="span-erreur"> {{ errors.year }}</span>
{% endif %}

    <label for="tirage">Tirage</label>
    <input class="login-input" type="text" id="tirage" name="tirage" placeholder="Entrez le nombre d'exemplaires imprimés" min="0" step="0.01" value="{{stamp.tirage}}"/>
    {% if errors.tirage is defined %}
    <span class="span-erreur"> {{errors.tirage}}</span>
    {% endif %}

    <p class="hint-message">Saisir les dimensions</p>

    <label for="width">Largeur en cm</label>
    <input class="login-input" type="number" id="width" name="width" value="{{stamp.width}}" min="0" step="0.01"/>
    {% if errors.width is defined %}
    <span class="span-erreur"> {{errors.width}}</span>
    {% endif %}

    <label for="height">Longueur en cm</label>
    <input class="login-input" type="number" id="height" name="height" value="{{stamp.height}}" min="0" step="0.01"/>
    {% if errors.height is defined %}
    <span class="span-erreur"> {{errors.height}}</span>
    {% endif %}

    <label for="stamp_condition_id">Condition</label>
<select name="stamp_condition_id" id="stamp_condition_id">
    <option value="" {% if stamp.stamp_condition_id == null %} selected {% endif %} disabled>Indiquer l'état</option>
    {% for stamp_condition in conditions %}
    <option value="{{ stamp_condition.id }}" {% if stamp.stamp_condition_id == stamp_condition.id %} selected {% endif %}>{{ stamp_condition.name }}</option>
    {% endfor %}
</select>
{% if errors.stamp_condition_id is defined %}
<span class="span-erreur"> {{ errors.stamp_condition_id }}</span>
{% endif %}

    <label for="theme_id">Thématique</label>
<select name="theme_id" id="theme_id">
    <option value="" {% if stamp.stamp_theme_id == null %} selected {% endif %} disabled>Indiquer le theme</option>
    {% for theme in themes %}
    <option value="{{ theme.id }}" {% if stamp.theme_id == theme.id %} selected {% endif %}>{{ theme.name }}</option>
    {% endfor %}
</select>
{% if errors.theme_id is defined %}
<span class="span-erreur"> {{ errors.theme_id }}</span>
{% endif %}

    <label for="color_id">Couleur principale</label>
    <select name="color_id" id="color_id">
        <option value="" {% if stamp.color_id == null %} selected {% endif %} disabled>Choisir la couleur</option>
        {% for color in colors %}
        <option value="{{color.id}}" {% if stamp.color_id == color.id %} selected {% endif %}>{{color.name}}</option>
        {% endfor %}
    </select>
    {% if errors.color_id is defined %}
    <span class="span-erreur"> {{errors.color_id}}</span>
    {% endif %}

    <label for="country_id">Pay d'origine</label>
    <select name="country_id" id="country_id">
        <option value="" {% if stamp.country_id == null %} selected {% endif %} disabled>Choisir le pays</option>
        {% for country in countries %}
        <option value="{{country.id}}" {% if stamp.country_id == country.id %} selected {% endif %}>{{country.name}}</option>
        {% endfor %}
    </select>
    {% if errors.country_id is defined %}
    <span class="span-erreur"> {{errors.country_id}}</span>
    {% endif %}

    <p class="hint-message">Avant de passer à l’étape suivante, assurez-vous que toutes les informations sont correctes. Vous pourrez ensuite téléverser les images de votre timbre.</p>

    <div class="button-group">
        <button type="submit" value="Créer le timbre" class="bouton btn-primaire btn-moyen">Créer le timbre</button>
        <button type="button" class="bouton btn-secondaire">Annuler</button>
    </div>
    </form>
</div>

</section>

</main>

{{ include('layouts/footer.php') }}
