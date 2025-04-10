{{ include('layouts/header.php', {title:'wip'})}}
<main class="contenu-principal">
        <section class="error-404">
        
                <h1>Error 404!</h1>
                <h2>Page not found</h2>
               <p>{{ msg }}</p>
               <img src="{{asset}}/images/error-404.webp" alt="Erreur 404 - Plateforme d'enchères de timbres de toutes les époques et de tous les pays">
        
        </section>
</main>
{{ include('layouts/footer.php')}}
