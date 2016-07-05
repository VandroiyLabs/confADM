$(document).ready(function() {


   var $calendar = $('#calendar');
   var id = 1;
   var data_evento = new Date();
   data_evento.setFullYear(2015,09,3);
   
   
   $calendar.weekCalendar({
      
    
      date : data_evento,
      timeslotsPerHour : 4,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 8, end: 22, limitDisplay: true },
      daysToShow : 5,
      
      longMonths : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'], 
      shortMonths : ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'], 
      longDays : ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
      timeSeparator: ' às ', 
      
      height : function($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender : function(calEvent, $event) {
			
			$event.css("backgroundColor", "#"+calEvent.color);
            $event.css("color" , "#000");
            
            $event.find(".wc-title").css({
               "backgroundColor" : "#"+calEvent.color
            });
         
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var tituloField = $dialogContent.find("input[name='titulo']");
         var resumoField = $dialogContent.find("textarea[name='resumo']");
		 var colorField = $dialogContent.find("select[name='color']");
		 
		 var instituicaoField = $dialogContent.find("input[name='instituicao']");
		 var autorField = $dialogContent.find("input[name='autor']");
		 var chamadaField = $dialogContent.find("input[name='chamada']");
		 var localField = $dialogContent.find("input[name='local']");


         $dialogContent.dialog({
            modal: true,
            title: "Adicionar Evento",
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {

                  calEvent.id = id;
                  id++;
                  
                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.titulo = tituloField.val();
                  calEvent.resumo = resumoField.val();
                  calEvent.color = colorField.val();
                  
                  calEvent.instituicao = instituicaoField.val();
                  calEvent.autor = autorField.val();
                  calEvent.chamada = chamadaField.val();
                  calEvent.local = localField.val();

				  //post to events.php	
				  $.post("events.php?action=save&start="+calEvent.start.getTime()/1000+"&end="+calEvent.end.getTime()/1000+"&titulo="+calEvent.titulo+"&resumo="+calEvent.resumo+"&color="+calEvent.color+"&instituicao="+calEvent.instituicao+"&autor="+calEvent.autor+"&chamada="+calEvent.chamada+"&local="+calEvent.local);

                  $calendar.weekCalendar("removeUnsavedEvents");
                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));

      },
      eventDrop : function(calEvent, $event) {
		  		 
		  $.post("events.php?action=update&id="+calEvent.id+"&start="+calEvent.start.getTime()/1000+"&end="+calEvent.end.getTime()/1000+"&titulo="+calEvent.titulo+"&resumo="+calEvent.resumo+"&color="+calEvent.color+"&instituicao="+calEvent.instituicao+"&autor="+calEvent.autor+"&chamada="+calEvent.chamada+"&local="+calEvent.local);
		  		  
      },
      eventResize : function(calEvent, $event) {
		  $.post("events.php?action=update&id="+calEvent.id+"&start="+calEvent.start.getTime()/1000+"&end="+calEvent.end.getTime()/1000+"&titulo="+calEvent.titulo+"&resumo="+calEvent.resumo+"&color="+calEvent.color+"&instituicao="+calEvent.instituicao+"&autor="+calEvent.autor+"&chamada="+calEvent.chamada+"&local="+calEvent.local);
      },
      eventClick : function(calEvent, $event) {

         if (calEvent.readOnly) {
            return;
         }

         var $dialogContent = $("#event_edit_container");
         resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var tituloField = $dialogContent.find("input[name='titulo']").val(calEvent.titulo);
         var colorField = $dialogContent.find("select[name='color']").val(calEvent.color);
         
		 var instituicaoField = $dialogContent.find("input[name='instituicao']").val(calEvent.instituicao);
		 var autorField = $dialogContent.find("input[name='autor']").val(calEvent.autor);
		 var chamadaField = $dialogContent.find("input[name='chamada']").val(calEvent.chamada);         
		 var localField = $dialogContent.find("input[name='local']").val(calEvent.local);         
         
         var resumoField = $dialogContent.find("textarea[name='resumo']");
         
         resumoField.val(calEvent.resumo);
		 /*$event.find(".ui-widget-header").css({
               "background" : "#"+calEvent.color
		 });*/
            
         $dialogContent.dialog({
			 
			 
            modal: true,
            title: "Editar - " + calEvent.titulo,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
               $('#calendar').weekCalendar("removeUnsavedEvents");
            },
            buttons: {
               save : function() {
                  calEvent.start = new Date(startField.val());
                  calEvent.end = new Date(endField.val());
                  calEvent.titulo = tituloField.val();
                  calEvent.resumo = resumoField.val();
                  calEvent.color = colorField.val();
                  
                  calEvent.instituicao = instituicaoField.val();
                  calEvent.autor = autorField.val();
                  calEvent.chamada = chamadaField.val();
                  calEvent.local = localField.val();
                
				  //post to events.php
				  $.post("events.php?action=update&id="+calEvent.id+"&start="+calEvent.start.getTime()/1000+"&end="+calEvent.end.getTime()/1000+"&titulo="+calEvent.titulo+"&resumo="+calEvent.resumo+"&color="+calEvent.color+"&instituicao="+calEvent.instituicao+"&autor="+calEvent.autor+"&chamada="+calEvent.chamada+"&local="+calEvent.local);		  
                  $calendar.weekCalendar("updateEvent", calEvent);
                  $dialogContent.dialog("close");
               },
               "delete" : function() {
				  //post to events.php
				  $.post("events.php?action=delete&id="+calEvent.id);
                  
                  $calendar.weekCalendar("removeEvent", calEvent.id);
                  $dialogContent.dialog("close");
               },
               cancel : function() {
                  $dialogContent.dialog("close");
               }
            }
         }).show();

         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
      /*data : function(start, end, callback) {
         callback(getEventData());
      }*/
      data : "events.php"
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }

   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }
   
   /*
    * Teste
    */
   function setupColor($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $(this).val();
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });

});
