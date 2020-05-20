function inicio() {
    var calendarEl = document.getElementById('calendar');
    var calendar;

    initThemeChooser({
      init: function(themeSystem) {
        calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
          
          eventClick: function(info) {
            alert('Event: ' + info.event.title);
            alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            alert('View: ' + info.view.type);
            info.jsEvent.preventDefault(); // don't let the browser navigate

            if (info.event.url) {
              window.open(info.event.url);
            }
            // change the border color just for fun
            info.el.style.borderColor = 'red';
          },
          eventMouseEnter: function(info){
            info.el.style.backgroundColor = 'rgba(228,192,107,0.83)';
           // alert(info.event.extendedProps.description);
           var tooltip = '<div class="tooltipevent" style="border-radius:1em;border:1px solid black;width:20px;color:black;background:rgba(255,186,28,1);position:fixed;z-index:10001;padding:.2em;top:'+(info.jsEvent.pageY-40)+'px;left:'+info.jsEvent.pageX+'px;">' + info.event.extendedProps.description + '</div>';
            var $tooltip = $(tooltip).appendTo('body');

            $(this).mouseover(function(e) {
                $(this).css('z-index', 10000);
                $tooltip.fadeIn('500');
                $tooltip.fadeTo('10', 1.9);
            }).mousemove(function(e) {
                $tooltip.css('top', e.pageY+10 );
                $tooltip.css('left', e.pageX+10 );
            });
            
            
          },
          eventMouseLeave: function(info){
            info.el.style.backgroundColor = '#3788D8';
            $('.tooltipevent').hide();
          },
          eventRender: function(info) {
           

            var desc=info.event.extendedProps.description;
            var texto=info.event.title;
                     
            info.el.innerHTML = info.el.innerHTML.replace('$ICON', "<span class='badge badge-dark'>"+desc+"</span> ");
            
          },
         
          locale: 'es',
          themeSystem: themeSystem,
          header: {
            left: 'prev,next today',
            center: 'title',
            right: ''//'dayGridMonth,timeGridWeek' //timeGridWeek,timeGridDay,listMonth'
          },
          defaultDate: new Date(),
          weekNumbers: false,
          navLinks: false, // can click day/week names to navigate views
          editable: true,
          eventLimit: true, // allow "more" link when too many events
          events: [
            {
              title: '$ICON  $15,000.00',
              start: '2020-05-20',
              url: 'http://google.com/',
              description: '2'
            },
           
            
          ]
        });
        
        calendar.render();

      },
      
      change: function(themeSystem) {
        //calendar.setOption('themeSystem', 'minty');
        calendar.setOption('themeSystem', themeSystem);
      },
     

    });

  }