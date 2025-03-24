{{ include('layouts/header.php', {title:'404 not found'})}}
<main class="error">
        <div >
                <h1>Error 404!</h1>
                <h2>Page not found</h2>
               <h3>{{ msg }}</h3>
               <img src="{{asset}}/images/error-404.webp" alt="Erreur 404 - Plateforme d'enchères de timbres de toutes les époques et de tous les pays">
        </div>
</main>
{{ include('layouts/footer.php')}}