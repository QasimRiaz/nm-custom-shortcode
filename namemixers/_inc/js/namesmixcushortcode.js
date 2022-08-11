$( document ).ready(function() {
  $('.namemixinpurts').bind('input', function(){
    $(this).val(function(_, v){
      return v.replace(/\s+/g, '');
    });
  });
});



function genratenewanmes(numberofinputs){


  var listofids = [];
  var urlnew = window.location.origin + '/wp-admin/admin-ajax.php';

                  var data = new FormData();
                  var nameslist = [];

                  jQuery(".namemixinpurts").each(function(){

                    
                    nameslist.push(jQuery(this).val());
                    


                  });

                  
                  data.append('numberofinpurts', numberofinputs);
                  data.append('nameslist', JSON.stringify(nameslist));
                  data.append('action', 'loadfrm');
                  jQuery('.resultrow').empty();

                  jQuery.ajax({
                      url:urlnew,
                      data: data,
                      cache: false,
                      contentType: false,
                      processData: false,
                      type: 'POST',
                      success: function(data) {

                        var responce = jQuery.parseJSON(data);
                       
                        
                        if(responce.message == "failed"){

                        
                        }else{

                          jQuery('.resultrow').append(responce.result);
                        
                        }


                       

                      }
                  });

         


}

