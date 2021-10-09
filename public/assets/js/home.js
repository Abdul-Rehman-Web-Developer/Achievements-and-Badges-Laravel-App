$(document).ready(function(){
	// populate coutries dropdown
	load_countries();
	
	// populate states dropdown
	$('#search_weather_form select[name=country_id]').change(function() {
      $("#search_weather_form select[name=city_id]").html("<option value=''>Select City</option>")
       load_cities($(this).val())
	})

  // user account registration
  $('#search_weather_form').parsley().on('form:submit', function (formInstance) {
            var form=$('#search_weather_form')
            var url=form.attr('action');
            var formData=form.serialize(); 

            $.ajax({
                    url: url,
                    type: "post",                            
                    data: formData,                            
                    beforeSend:function(){
                      $('.weather_report').addClass('d-none')
                      form.find('select,input,button').blur()
                      // show processing spinner
                      form.LoadingOverlay("show")
                    },
                    statusCode: {
             
                        409: function (data) {
                            
                            swal({
                                      title: "Caution",
                                      text: data.responseText,
                                      type: "error",
                                      html:true,
                                  }) 
                            

                        }
                    },
                    success: function(data) {
                      var weather_data=data['weather_data']
                      $('.no_of_days').text(data['no_of_days']+' -Day Forecast')
                      var html="";
                      for(i=0; i< weather_data.length; i++){
                         html+="<tr >" +
                                  "<td >" +
                                     weather_data[i]['date'] +
                                  "</td>" +
                                  "<td class='text-center'>" +
                                      "<img src='"+weather_data[i]['condition_icon']+"' style='width:100px'>"+
                                      "<p >"+weather_data[i]['condition_text']+"</p>"+
                                  "</td>"+
                                  "<td>"+
                                    "<p>"+
                                      "<span>Average: </span>"+
                                      "<span  style='font-weight:bold'>"+weather_data[i]['avg_temp']+"</span>"+
                                    "</p><hr>"+
                                    "<p>"+
                                      "<span>Minimum: </span>"+
                                      "<span  style='font-weight:bold'>"+weather_data[i]['min_temp']+"</span>"+
                                    "</p><hr>"+
                                    "<p>"+
                                      "<span>Maximum: </span>"+
                                      "<span style='font-weight:bold'>"+weather_data[i]['max_temp']+"</span>"+
                                    "</p>"+                
                                  "</td>"+
                                  "<td >"+
                                    weather_data[i]['wind']+
                                  "</td>"+
                                "</tr>";
                      }
                      $('.weather_table tbody').html(html)
                      $('.weather_report').removeClass('d-none')

                      // hide processing spinner
                      form.LoadingOverlay("hide",true)                       
                        
                    },
                    error: function(){
                      swal({
                          title: "Caution",
                          text: "Failed sending data to server, please try again.",
                          type: "error",
                          html:true,
                    }) 
                      
                      // hide processing spinner
                        form.LoadingOverlay("hide",true)
                    }
                   
            })   

      // prevent form submit
    return false;
  });

})




function load_countries(){

	var content_container=$('#search_form_container')
    var url=$('meta[name=get_countries]').attr("content") 

    $.ajax({
            url: url,
            type: "get",                            
            beforeSend:function(){
              content_container.find('select,input,button').blur()
              // show processing spinner
              content_container.LoadingOverlay("show")
            },
            statusCode: {
			   
      			    404: function (data) {
      			        swal({
                              title: "Caution",
                              text: data.responseText,
                              type: "error",
                            	html:true,
                        	}) 
      			    }
      			},
				         
            success: function(data){
              
              var html="<option value=''>Select Country</option>";
              
              for(i=0; i < data['countries'].length; i++){
                html+="<option value='"+data['countries'][i].country+"'>"+data['countries'][i].country+"</option>";
              }
              $("#search_weather_form select[name=country_id]").html(html)
              content_container.LoadingOverlay("hide",true)

            },
            error: function(){
              swal({
                        title: "Caution",
                        text: "Failed sending data to server, please try again.",
                        type: "error",
                      	html:true,
                  	}) 
              // hide processing spinner
                content_container.LoadingOverlay("hide",true)
            }
           
    })   
}  


function load_cities(country_id){

	var content_container=$('#search_form_container')
    var url=$('meta[name=get_cities]').attr("content") 

    $.ajax({
            url: url,
            type: "get",
            data: {country_id: country_id},                            
            beforeSend:function(){
              content_container.find('select,input,button').blur()
              // show processing spinner
              content_container.LoadingOverlay("show")
            },
            statusCode: {
			   
      			    404: function (data) {
      			        swal({
                              title: "Caution",
                              text: data.responseText,
                              type: "error",
                            	html:true,
                        	}) 
      			    }
      			},
				         
            success: function(data){
            	var html="<option value=''>Select City</option>";
              
              for(i=0; i < data['cities'].length; i++){
                html+="<option value='"+data['cities'][i].id+"'>"+data['cities'][i].city+"</option>";
              }
              $("#search_weather_form select[name=city_id]").html(html)
              content_container.LoadingOverlay("hide",true)

            },
            error: function(){
              swal({
                        title: "Caution",
                        text: "Failed sending data to server, please try again.",
                        type: "error",
                      	html:true,
                  	}) 
              // hide processing spinner
                content_container.LoadingOverlay("hide",true)
            }
           
    })   
} 