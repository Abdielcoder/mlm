




$('.icon-desktop').on('click', function(){
    var dom = $(this);
    var opt = $(this).attr('data-option');

    if (dom.hasClass("animated bounce")){
       dom.removeClass("animated bounce");
    }else{
       dom.addClass("animated bounce");
    }

    setTimeout(function(){$('.icon-desktop').removeClass("animated bounce");},1000);


    $.ajax({

      type: 'POST',
      url: 'includes/ajax.php',
      data: 'process='+opt,

      beforeSend: function(){

      },
      success: function(data){

           var divex = $('#format-window-'+opt);
           if (divex.length){
              $('#buttond'+opt).addClass('animated flash');
              setTimeout(function(){
                $('#buttond'+opt).removeClass('animated flash');
              },1000);
           }else{
              $('#append-data').append(data);
           }

      	   

      },
      error: function(){

      }

    });

   
});



function App(){

   var dom = $(".panel-default>.panel-heading");
   dom.parent().draggable();

   // Efecto del Cursor Cuando se mueve el folder
   dom.mousedown(function() {
      $(this).addClass("cursorpointer")  
      .mouseup(function() {
      $(this).removeClass("cursorpointer");
      })
    });


   $('.switch').on('click', function(){

      var dm = $(this).attr('data-module');
      var senddata = 'process=7&module='+dm;

      $.ajax({

             type: 'POST',
             url: 'includes/ajax.php',
             data: senddata,

             success: function(data){
               $('#module-'+dm).toggleClass("switchOn");

             },
             error: function(){

             }

      });

   });








}



function CloseWin(dom){

    var dm = $('#format-window-'+dom);
	dm.removeClass('animated fadeInUp');
	dm.removeClass('animated rotateOut');
	dm.removeClass('animated zoomIn');
	dm.addClass('animated rotateOut');
    setTimeout(function(){dm.remove();},1500);


}


function MaxWin(dom){
   var dm = $('#format-window-'+dom);
   var dmb1 = $('#format-window-'+dom).find('.smallw');
   var dmb2 = $('#format-window-'+dom).find('.bigw');

   dmb2.hide();
   dmb1.show();
   dm.animate({
     width: "99%",
     top: "25%",
     left: "10px"
   },1000);
}


function SmallWin(dom){

   var dm = $('#format-window-'+dom);
   var dmb1 = $('#format-window-'+dom).find('.smallw');
   var dmb2 = $('#format-window-'+dom).find('.bigw');

   dmb1.hide();
   dmb2.show();
   dm.animate({
     width: "800px",
     top: "25%",
     left: "30%"
   },1000);

}



function MinusWin(dom){

    var dm = $('#format-window-'+dom);
	dm.removeClass('animated fadeInUp');
	dm.removeClass('animated rotateOut');
	dm.addClass('animated zoomOut').fadeOut(1000);

	var wd = $(dm).find('.titlew').html();
	var wda = $(dm).find('.titlew').attr('data-id');

	// Creación de Botones
	setTimeout(function(){
        $('#minusapp').append('<button id="buttond'+wda+'" class="btn btn-blue animated bounceIn" onclick="ShowW('+wda+')">'+wd+'</button> ');
	},1000);
    
    setTimeout(function(){
       $('#buttond'+wda).removeClass('animated bounceIn');
    },1500);


}


function ShowW(dom){

	var dm = $('#format-window-'+dom);
	$('#buttond'+dom).addClass('animated fadeOutUp');
    setTimeout(function(){
       $('#buttond'+dom).remove();
    },1000);
    dm.removeClass('animated fadeInUp');
	dm.removeClass('animated rotateOut');
	dm.removeClass('animated zoomOut');
    dm.addClass('animated zoomIn').fadeIn(1000);	

}

function UsuariosAdm(){


    $.ajax({

      type: 'POST',
      url: 'includes/ajax.php',
      data: 'process=5',

      beforeSend: function(){

      },
      success: function(response){

      // Replace table’s tbody html with peopleHTML
      $("#users-tbody").html(response);  
      setTimeout(function(){
        $("#usrsTable").DataTable();
        $("#usrsTable").removeAttr("style");

      },1000);

      },
      error: function(){

      }

    });




  
}


function editUserAdm(dom){
     $.ajax({
        
        type: 'POST',
        url: 'includes/ajax.php',
        data: 'process=8&id='+dom,

          beforeSend: function(){

          },
          success: function(response){
            $('#append-user').html(response);
            $('#myModal').modal('show');

          },
          error: function(){

          }
     }); 
}




function saveConfigEmc(){

jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});
var form = $("#emcform");
form.validate({
  rules: {
    
    smtp: "required",
    port: "required",
    typesmtp: "required",
    email: "required",
    password: "required",
    name: "required",
    subject: "required"

  },
});

var dado = form.valid();
if (dado == true){
        var emcfrmdata = $("#emcform").serialize();
        $.ajax({
          type: 'POST',
          url: 'includes/ajax.php',
          data: emcfrmdata,
          beforeSend: function(){

          },
          success: function(response){
             
            if (response == 1)
            {
                alert("Hubo un error al tratar de guardar la configuración del correo, revisa los datos ingresados o tu conexion de internet.");
            }
            else
            {
                alert("Configuración Guardada Correctamente.");
                CloseWin(4);

            }

          },
          error: function(){
               alert("Hubo un error al tratar de guardar la configuración del correo, revisa los datos ingresados o tu conexion de internet.");
          }
    });
}else{
  return;
  }
}











