{% extends 'layout.html' %}

{% block content %}
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="col-md-9 text-right">
			<!-- <button class="btn btn-info"> -->
				<a href="/index.php/users/create" class="btn btn-info">Crea utente</a>
				<a href="/index.php/users/fake" class="btn btn-info">Utenti Random</a>
				<a href="/index.php/users/exportpdf" class="btn btn-info">Esporta PDF <i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
				<a href="/index.php/users/exportxls" class="btn btn-info">Esporta XLS <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
			<!-- </button> -->
		</div>
	</div>
	<div class="row">
		&nbsp;
	</div>
	<div class="row">
		<div class="col-md-9">
			<table class="table table-striped" border=1 id="user_list_table">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Cognome</th>
						<th>Email</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					{% for u in users %}
						<tr>
							<td>{{u.name}}</td>
							<td>{{u.surname}}</td>
							<td>{{u.email}}</td>
							<td class="text-right"><button class="btn btn-danger delete_user" id-user="{{u.id}}"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
						</tr>
					{% endfor %}
				</tbody>
			</table>
		</div>
	</div>
	<form method="POST" id="delete_user" action="/index.php/users/delete">
		<input type="hidden" name="id" id="id_user" value="">
	</form>
{% endblock%}

{% block script_zone %}
	<script type="text/javascript">
		$('.delete_user').on('click', function(){
			$('#id_user').val($(this).attr('id-user'));
			$('#delete_user').submit();
		});	
		$('#user_list_table').dataTable();
	</script>
{% endblock %}