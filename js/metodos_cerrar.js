function inicio(){
  function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'top',
                //closeWith   : ['button'],
                theme       : 'metroui',
                progressBar : true,
                maxVisible  : 5,
                timeout     : [2500],
                animation   : {
                    open  : 'animated slideInDown',
                    close : 'animated slideOutUp',
                    easing: 'swing',
                    speed : 100
                }
            });
            //console.log('html: ' + n.options.id);
            return n;
        }

	var user= parent.$('#label_user').html();	
	var datos={
		"usuario": user
	};
	 $.ajax({
              url:   "ver_eventos3.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                console.log(response);
               $('#c_eventos').html(response);
              }
            });

   $('#cerrar_evento').click(function(){
    alert("aqui se cerraria el evento");

   });
}
