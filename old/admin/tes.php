<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=kategori>
  $("#contoh_get").change(function(){
    var contoh_get = $("#contoh_get").val();
    $.ajax({
        url: "tes_get.php",
        data: "contoh_get="+contoh_get,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=sub_kategori>
            $("#show").html(msg);
        }
    });
  });
 
  
});

</script>
<select id="contoh_get" name="contoh_get" class="autocombo">
<option value="00">- Pilih Petak-</option>
<option value="1">- satu -</option>
<option value="2">- dua-</option>

</select>

<div id="show"></div>