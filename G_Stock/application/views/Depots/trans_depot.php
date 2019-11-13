<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center"> Lits Depots </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <hr>
            <div class="account-wall">
                
                <div class="col-md-3 group-form">
                    <span>Dépot Expédition</span>
                    <select id="depot_d" name="depot_d" class="form-control search">
                        <option > List depots</option>
                        <?php if($depot): foreach($depot as $row):  ?>
                        <option value="<?= $row->id_depot ?>"> <?= $row->depot ?> </option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                
                <div class="col-md-3 group-form">
                    <span>Article</span>
                    <select id="article" name="article" class="form-control search">
                        <option disabled> List d'Articles</option>
                        
                    </select>
                </div>
                <div class="col-md-3 group-form">
                    <span>Qté Transfairais </span>
                    <input type="number" name="qte" id="qte" class="form-control" >
                </div>
                <div class="col-md-3 group-form">
                    <span>Dépot Réception</span>
                    <select id="depot_f" name="depot_f" class="form-control search">
                        <option disabled> List depots</option>
                        
                    </select>
                </div>
                <div class="group-form pull-right">
                    <input type="button" id="ajouter" value="ajouter"  class="btn btn-sm btn-success" >
                </div>
                <span class="clearfix"></span>
                <hr>
                <form class="form-signin" method="POST" action="<?php echo base_url() ?>">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Article</th>
                                <th>Dépot out</th>
                                <th>Dépot in</th>
                                <th>Qte effectué</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($trans): foreach($trans as $row):  ?>
                             <tr>
                                 <td><?= $row->article_art ?> </td>
                                 <td><?= get_depot( $row->id_depot_out ) ?> </td>
                                 <td><?= get_depot( $row->id_depot_in ) ?> </td>
                                 <td><?= $row->qte_trans.' '.$row->unite_art ?> </td>
                                 <td><?= $row->create_trans ?> </td>
                             </tr>
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    
                    <span class="clearfix"></span>
                </form>
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>


<script>  		 
	    $(function () {  
	        
	        // Get list Articles and depot
            $('#depot_d').change( function(){ 
               var id = this.value;
              
                 $.ajax({
                   type:'POST',
                   dataType: "json",
                   url: "<?= base_url('index.php/Articles/get_article') ?>",
                   data: { id: id},
                   success: function(data){
                        console.log('Submission was successful.'); 
                        console.log(data);
                        $('#article').html('');
                        $('#depot_f').html('');
                        
                        $.each(data.article, function(index, element) {
                            $('#article').append($('<option>', {
                                text: element.article_art+' | '+element.ref_art,
                                value: element.id_art
                            }));
                        });
                        
                        $.each(data.depot, function(index, element) {
                            $('#depot_f').append($('<option>', {
                                text: element.depot,
                                value: element.id_depot
                            }));
                        });
                        
                        if(data == null){
                            $('#article').html('');
                            $('#article').append('<option disabled>Vide</option>');
                            
                            $('#depot_f').html('');
                            $('#depot_f').append('<option disabled>Vide</option>');
                        }
                        
                        
                   },error: function (data) {
                        console.log('An error occurred.'); 
                        console.log(data);
                    }, 
                 });
                  return false; 
            });
            
            // Effectué transfaire  d'Article
            $('#ajouter').click( function(){ 
               var id = this.value;
              
                 $.ajax({
                   type:'POST',
                   dataType: "json",
                   url: "<?= base_url('index.php/Articles/trans_article') ?>",
                   data: { 
                       depot_d:$('select#depot_d option:selected').val(),
                       depot_f:$('select#depot_f option:selected').val(),
                       qte:$('#qte').val(),
                       article:$('#article').val()
                       
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
            });
            
            
        });     
       
    </script>