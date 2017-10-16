{% extends 'layout.html' %}

{% block script_zone %}
	<script type="text/javascript">
		swal({
			title: "Ok", 
			text: "L'utente è stato cancellato correttamente",
			button: {
				ok:{
					text: 'Torna indietro'
					,value: true
				}
			}
		}).then((value) => {
			switch(value){
				case true:
					window.location.href = '/index.php/users/list';
				break;
			}
		});
	</script>
{% endblock%}