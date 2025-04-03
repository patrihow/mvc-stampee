{{ include('layouts/header.php', {title:'Tableau de timbres'})}}
<main class="contenu-principal">
        <section class="table-index">
        <h2>Mes timbres</h2>
		<article>
			<table>
				<thead>
					<tr>
						<th>Nom</th>
                        <th>Description</th>
						<th>époque</th>
						<th>Tirage</th>
						<th>Largeur (cm)</th>
						<th>Longueur (cm)</th>
						<th>is_certified</th>
						<th>stamp_condition_id</th>
						<th>Pays d’origine</th>

						<th>Thématique </th>
                        <th>Color</th>
						<th>Modifier</th>
						<th>Supprimer</th>

					</tr>
				</thead>
				<tbody>
					{% for stamp in AllStamp %}
						<tr>
							<td>{{stamp.name}}</td>
							<td>{{stamp.description}}</td>
							<td>{{stamp.year}}</td>
							<td>{{stamp.tirage}}</td>
							<td>{{stamp.width}}</td>
							<td>{{stamp.height}}</td>
							<td>{{stamp.is_certified}}</td>
							<td>{{stamp.country_id}}</td>
							<td>{{stamp.theme_id}}</td>
                            <td>{{stamp.color_id}}</td>

							<td>
								<a href="{{base}}/stamp/edit?id={{stamp.id}}">Éditer</a>
							</td>
							<td>
								<form action="" method="post" class="form-delete">
									<input type="hidden" name="id" value="{{stamp.id}}">
									<input type="submit" class="bouton block danger" value="Supression">
								</form>
							</td>
						</tr>
					{% endfor %}
				</tbody>
			</table>
		</article>
        </section>
</main>
{{ include('layouts/footer.php')}}
