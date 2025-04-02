{{ include('layouts/header.php', {title:'Création nouvel timbre - image'}) }}

<main class="contenu-principal">
    <section class="login-page">
        <div class="login-page-content">
            <small class="subtitle-form">Étape 2 de 2: Ajoutez les images de votre timbre</small>
            <h2 class="titres-secondaires">Télécharger les images</h2>
            <p class="intro-texte">
                Ici, vous pouvez télécharger l'image principale et les images secondaires de votre timbre.
            </p>

            <form class="login-form" method="post" enctype="multipart/form-data">

                <div class="file-img">
                    <label for="file_name">Choisissez une image principale</label>
                    <input type="file" name="file_name" id="file_name" accept="image/*" required>
                    {% if errors.file_name is defined %}
                        <span class="span-erreur">{{ errors.file_name }}</span>
                    {% endif %}
                </div>

                <div class="file-img">
                    <label for="description_alt">Ajoutez une brève description de l'image principale</label>
                    <input type="text" name="description_alt" id="description_alt" placeholder="Saisissez une description" value="{{ description.description_alt }}" required>
                    {% if errors.description_alt is defined %}
                        <span class="span-erreur">{{ errors.description_alt }}</span>
                    {% endif %}
                </div>

                <!-- Imagen secundaria 1 -->
                <div class="file-img">
                    <label for="second_file">Choisissez une seconde image</label>
                    <input type="file" name="second_file" id="second_file" accept="image/*">
                    {% if errors.second_file is defined %}
                        <span class="span-erreur">{{ errors.second_file }}</span>
                    {% endif %}
                </div>

                <div class="file-img">
                    <label for="second_description">Description de la seconde image</label>
                    <input type="text" name="second_description" id="second_description" placeholder="Saisissez une description" value="{{ description.second_description }}">
                    {% if errors.second_description is defined %}
                        <span class="span-erreur">{{ errors.second_description }}</span>
                    {% endif %}
                </div>

                <!-- Imagen secundaria 2 -->
                <div class="file-img">
                    <label for="third_file">Choisissez une troisième image</label>
                    <input type="file" name="third_file" id="third_file" accept="image/*">
                    {% if errors.third_file is defined %}
                        <span class="span-erreur">{{ errors.third_file }}</span>
                    {% endif %}
                </div>

                <div class="file-img">
                    <label for="third_description">Description de la troisième image</label>
                    <input type="text" name="third_description" id="third_description" placeholder="Saisissez une description" value="{{ description.third_description }}">
                    {% if errors.third_description is defined %}
                        <span class="span-erreur">{{ errors.third_description }}</span>
                    {% endif %}
                </div>

                <div class="button-group">
                    <button type="submit" class="bouton btn-primaire btn-moyen">Envoyer</button>
                    <button type="button" class="bouton btn-secondaire">Annuler</button>
                </div>
            </form>
        </div>
    </section>
</main>

{{ include('layouts/footer.php') }}
