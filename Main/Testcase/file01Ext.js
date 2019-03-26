$(document).ready(function() {
   
    var CUDUrl = "./CUD.php";
    
    $("tr.select").on("dblclick", function(e) {
       $.fn.TT_InlineEdit(this, CUDUrl); 
    });
    
    
    $("a#delete").click(function(e) {        
        e.preventDefault();
        $.fn.TT_Delete(CUDUrl);
    });
    
    $("a#save").click(function(e) {       
        e.preventDefault();
        $.fn.TT_Update(CUDUrl);
    });
   
});

