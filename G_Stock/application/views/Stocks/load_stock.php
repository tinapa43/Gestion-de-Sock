
<script>
    $(document).ready(function(){
      $("#searche").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#data tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });

//<input type="text" id="searche" placeholder="Recherche ..." />
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-warning">
            <h1 class="panel-heading text-center"> Mise à jour Stocks </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <hr>
            <div class="account-wall">
                
                 <div class="col-md-3 group-form">
                    <span>Dépot A</span>
                    <select id="depot" name="depot" class="form-control">
                        <option > List depots</option>
                        <?php if($depot): foreach($depot as $row):  ?>
                        <option value="<?= $row->id_depot ?>"> <?= $row->depot ?> </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                
                <input type="text" class="form-control puul-right" id="searche" placeholder="Recherche ..."  />
                <span class="clearfix"></span>
                
                    <table id="data" class="table table-striped table-bordered display" >
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Article</th>
                                <th>Désigniantion</th>
                                <th>Quantité Stocks</th>
                                <th>Prix Vente</th>
                                <th>Qte M.A.J</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="row">
            
                        </tbody>
                    </table>
                    
                    <span class="clearfix"></span>
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>

<script>  		 
	    $(function () {  
	        
	        // Get list Articles and depot
            $('#depot').change( function(){ 
               var id = this.value;
               var row;
               
                 $.ajax({
                   type:'POST',
                   dataType: "json",
                   url: "<?= base_url('index.php/Stocks/get_stock_article') ?>",
                   data: { id: id},
                   success: function(data){
                        console.log('Submission was successful.'); 
                        console.log(data);
                        $('#row').html('');
                        
                        $.each(data.article, function(index, element) {
                            row += '<tr>';
                            row += '<td>  '+element.id_art+'</td>';
                            row += '<td>  '+element.article_art+'</td>';
                            row += '<td>  '+element.desi_art+'</td>';
                            row += '<td>  <input type="hidden" name="qte_mag" value="'+ element.qte_mag+'"  class="form-control" > '+element.qte_mag+'</td>';
                            row += '<td>  <input type="number" name="prix" value="'+element.pv_art+'" class="form-control" ></td>';
                            row += '<td>  <input type="number" name="qte"  class="form-control" ></td>';
                            row += '<td>  <input type="hidden" name="id_mag" value="'+element.id_mag+'" class="form-control" > <input id="maj" type="submit" value="M.A.J" class="btn btn-sm btn-success btn-block" >';
                            row += '</tr>';
                            
                            $('#row').append(row);
                        });
                        
                        if(data == null){
                            $('#row').html('');
                        }
                        
                   },error: function (data) {
                        console.log('An error occurred.'); 
                        console.log(data);
                    }, 
                 });
                  return false; 
            });
            
            // Effectué modifiction qte d'Article
            $(this).find('input#maj').click( function(){ 
               var row = this.parent();
              console.log($(this).find('input#qte').val() + $(this).find('input#qte_mag').val());
              /*
                 $.ajax({
                   type:'POST',
                   dataType: "json",
                   url: "<?= base_url('index.php/Articles/update_stock') ?>",
                   data: { 
                       id_mag:$(this).find('input#qte').val() + $(this).find('input#qte_mag').val(),
                       qte:$(this).find('').val()
                       
                   },
                   success: function(data){
                        console.log('Submission was successful.'); 
                        console.log(data);
                        
                        
                   },error: function (data) {
                        console.log('An error occurred.'); 
                        console.log(data);
                    }, 
                 });
                  return false; 
                  */
            });
            
            
        });     
       
    </script>
    
