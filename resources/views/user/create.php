{% extends 'layout.html' %}

{% block content %}
	<form method="POST" action="/index.php/users/create">
		<div class="row">
			<div class="col-md-9">
				Crea Utente
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<div class="col-md-2">
				<label class="label-control">
					Nome
				</label>
			</div>
			<div class="col-md-3">
				<input class="form-control {% if err_mess.name.err!=''%}input_error{% endif %}" name="name" id="name" placeholder="Nome" value="{{err_mess.nome.value}}"></input>
				<div class="label_error">
					{% if err_mess.name.err!="" %}
						{{err_mess.name.err}}
					{% endif %}
				</div>
			</div>
			<div class="col-md-2">
				<label class="label-control">
					Cognome
				</label>
			</div>
			<div class="col-md-3">
				<input class="form-control {% if err_mess.surname.err!=''%}input_error{% endif %}" name="surname" id="surname" placeholder="Cognome" value="{{err_mess.cognome.value}}"></input>
				<div class="label_error">
					{% if err_mess.surname.err!="" %}
						{{err_mess.surname.err}}
					{% endif %}
				</div>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<div class="col-md-2">
				<label class="label-control">
					Email
				</label>
			</div>
			<div class="col-md-3">
				<input class="form-control {% if err_mess.email.err!=''%}input_error{% endif %}" name="email" id="email" placeholder="Email" value="{{err_mess.email.value}}"></input>
				<div class="label_error">
					{% if err_mess.email.err!="" %}
						{{err_mess.email.err}}
					{% endif %}
				</div>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<div class="col-md-10">
				<div class="text-right">
					<button class="btn btn-info">Crea Utente</button>
				</div>
			</div>
		</div>
	</form>
	{% for mess in err %}
		
	{% endfor %}
{% endblock %}