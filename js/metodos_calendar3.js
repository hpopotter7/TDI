function inicio() {

  
/*
  $( "#dialog" ).dialog({
    autoOpen: false,
    show: {
      effect: "blind",
      duration: 1000
    },
    hide: {
      effect: "fold",
      duration: 1000
    }
  });
  */

    var mes=new Date().getMonth()+1;
    var mes_actual=mes;
    var anio=new Date().getFullYear();
    var dia=new Date().getDate();
    if(mes<10){
      mes="0"+mes;
    }
    if(dia<10){
      dia="0"+dia;
    }
    fecha=anio+"-"+mes+"-"+dia;
    

    function suma_egresos(anio, mes, dia){
      var datos = {
        "anio": anio,
        "mes": mes,
        "dia": dia,
      };
      $.ajax({
        data: datos,
        url:   'suma_odc_fecha.php',
        type:  'post',
        async: true,
        success:  function (response) {
          var arr=response.split("#");
            $('#resultado_vencidos_atrasada').html(arr[0]);
            $('#resultado_vencidos').html(arr[1]);
            $('#resultado_vigentes').html(arr[2]);
            $('#resultado_vencidos_total').html(arr[3]);
            $('#resultado_mes1').html(arr[4]);
            $('#resultado_mes2').html(arr[5]);
            $('#resultado_mes3').html(arr[6]);
            $('#resultado_total').html(arr[7]);
        }
      });
    }

    var calendarEl = document.getElementById('calendar');
    var calendar;

    initThemeChooser({
      init: function(themeSystem) {
        calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
          
          eventClick: function(info) {
            //funcion_dialogo();
            var fecha=info.event.start;
            var dia=fecha.getDate();
            var mes=fecha.getMonth()+1;
            var anio=fecha.getFullYear();
            if(mes<10){
              mes="0"+mes;
            }
            if(dia<10){
              dia="0"+dia;
            }
            fecha=anio+"-"+mes+"-"+dia;
            
            $.fancybox.open({
              src  : "consultar_odc_por_fecha.php?fecha="+fecha,
              type : 'iframe',
             
              opts : {
                afterShow : function( instance, current ) {
                  //console.info( 'done!' );
                }
              }
            });
            
           // $("#dialog").fancybox();
            //alert('se abre dialogo con información de los eventos ');
            /*
            $('#body').addClass( 'blur' );
            $( "#dialog" ).dialog( "open" );
            */
           /*
            $('body').addClass( 'blur' );
            $('.container' ).addClass( 'blur' );
            */
            
                        /*
            alert('se abre Dialog: ' + info.event.title);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('View: ' + info.view.type);
            */
            info.jsEvent.preventDefault(); // don't let the browser navigate

            if (info.event.url) {
              window.open(info.event.url);
            }
            // change the border color just for fun
            //info.el.style.borderColor = 'red';
          },
          eventMouseEnter: function(info){
            /*
            info.el.style.backgroundColor = 'rgba(228,192,107,0.83)';
           
           var tooltip = '<div class="tooltipevent" style="text-align:center;border-radius:.75em;border:1px solid black;width:75px;color:black;background:rgba(255,186,28,1);position:fixed;z-index:10001;padding:.5em;top:'+(info.jsEvent.pageY-40)+'px;left:'+info.jsEvent.pageX+'px;">' + info.event.extendedProps.description + '</div>';
            var $tooltip = $(tooltip).appendTo('body');

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $tooltip.fadeIn('500');
                $tooltip.fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $tooltip.css('top', e.pageY+10 );
                $tooltip.css('left', e.pageX+10 );
            });
            */
            
          },
          eventMouseLeave: function(info){
            /*
            info.el.style.backgroundColor = 'red';
            $('.tooltipevent').hide();
            */
          },
          eventDrop: function(info) {
            alert(info.event.title + " was dropped on " + info.event.start.toISOString());
        
            if (!confirm("Are you sure about this change?")) {
              info.revert();
            }
          },
          eventRender: function(info) {
            var desc=info.event.extendedProps.description;
            var texto=info.event.title;
            var fecha=info.event.start;
            info.el.innerHTML = info.el.innerHTML.replace('ICON', "<span class='badge badge-dark'>"+desc+"</span> ");
            var hoy=new Date();
            if(fecha<=hoy){
              info.el.style.backgroundColor = 'red';
              info.el.style.borderColor = 'red';
              info.el.innerHTML = info.el.innerHTML.replace('fc-content', "fc-content rojo");
              
            }
            
            
          },
         
          locale: 'es',
          themeSystem: themeSystem,
          
          header: {
            //left: 'prev,next today',
            //center: 'title',
            //right: ''//'dayGridMonth,timeGridWeek' //timeGridWeek,timeGridDay,listMonth'
            left:  '', //'dayGridMonth,timeGridWeek,timeGridDay',,
            center: 'title',
            right: 'prev,next'
          },
          
         /*
         header: {
          left:  '', //'dayGridMonth,timeGridWeek,timeGridDay',,
          center: 'title',
          right: 'prev,next'
        },
        */
          customButtons: {
            prev: {
              text: 'Prev',
              click: function() {
                          // so something before
                          //events: 'consultar_pagos_pendientes.php?mes='+(mes-1)+"&anio="+anio,
                          // do the original command
                          calendar.prev();
                          mes--;
                          if(mes==0){
                            mes=12
                          }
                          if(mes==mes_actual){
                            dia=new Date().getDate();
                          }
                          else{
                            if(mes>mes_actual){
                              dia=1;
                            }
                            else{
                              dia = lastday(anio,mes);
                            }
                            
                            
                          }   
                          
                          suma_egresos(anio,mes,dia);
                          //calendar.fullCalendar( 'refresh' );
                          // do something after
                          
              }
            },
            next: {
              text: 'Next',
              click: function() {
                          // so something before
                         // events: 'consultar_pagos_pendientes.php?mes='+(mes+1)+"&anio="+anio,
                          // do the original command
                          calendar.next();
                          mes++;
                          if(mes==13){
                            mes=1;
                          }
                          if(mes==mes_actual){
                            dia=new Date().getDate();
                          }
                          else{
                            if(mes>mes_actual){
                              dia=1;
                            }
                            else{
                              dia = lastday(anio,mes);
                            }
                            
                          } 
                          
                          suma_egresos(anio,mes,dia);
                          //calendar.fullCalendar( 'refresh'),
                          // do something after
              }
            },
          },
          
          defaultDate: new Date(),
          aspectRatio: 2,
          weekNumbers: false,
          navLinks: false, // can click day/week names to navigate views
          editable: false,
          eventLimit: true, // allow "more" link when too many events
          //events: eventos,
          events: 'consultar_pagos_pendientes.php?mes='+mes+"&anio="+anio,
          showNonCurrentDates: false,
          
          /*
          events: [
            {
              title: '$ICON  $15,000.00',
              start: '2020-05-20',
              description: '1'
            },
            {
              title: '$ICON  $45,000.00',
              start: '2020-05-22',
              description: '4'
            },
            {
              title: '$ICON  $5,000.00',
              start: '2020-05-24',              
              description: '3'
            },
            {
              title: '$ICON  $150,000.00',
              start: '2020-05-25',              
              description: '9'
            },
            {
              title: '$ICON  $32,458.00',
              start: '2020-05-28',
              description: '2'
            },
           
            
          ]
          */
        });
        
        calendar.render();

      },
      
      change: function(themeSystem) {
        //calendar.setOption('themeSystem', 'minty');
        calendar.setOption('themeSystem', themeSystem);
      },
     
    });

 
/*
    $.fancybox.open({
      src  : '#hidden-content',
      type : 'inline',
      opts : {
        afterShow : function( instance, current ) {
          console.info( 'done!' );
        }
      }
    });
    */
   function lastday(y,m){
    return  new Date(y, m, 0).getDate();
    }

    suma_egresos(anio,mes,dia);
    

  }