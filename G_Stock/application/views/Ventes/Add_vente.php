<div class="col-md-9" style="margin-top: 5px">
    <div class="row">
        <div class="col-sm-12 col-md-11 col-md-offset-1">
            <h1 class="text-center login-title">Vente Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                    
                        <div class="col-md-8 col-md-offset-2">
                            <div class="form-group">
                                <span>Fournisseur</span>
                                <select type="text" class="form-control" name="clt" placeholder="Client">
                                    <?php if($clt): foreach($clt as $row):  ?>
                                    <option value="<?= $row->id_clt ?>"><?= $row->nom_clt ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('clt'); ?>
                            </div>
                            <div class="form-group">
                                <span>Articles</span>
                                <select type="text" class="form-control" name="article" id="article">
                                    <?php if($art): foreach($art as $row):  ?>
                                    <option value="<?= $row->id_art ?>"><?= $row->article_art.' - '.$row->ref_art ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <?php echo form_error('article'); ?>
                            </div>
                          
                            <button class="btn btn-sm btn-primary btn-block" name="btn-add" id="btn-add" >  Ajouter</button>
                        </div>
                        
                        <div class="col-md-8 col-md-offset-2">
                            <br> <h1 class="text-center"> Votre Commande</h1> <hr>
                            <table id="table-vente" class="table">
                                <thead>
                                    <th>Article</th>
                                    <th>Réf</th>
                                    <th>Qté</th>
                                    <th>Prix</th>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            
                            
                            <button class="btn btn-sm btn-success btn-block" name="btn-valide" id="btn-valide" >  Valide</button>
                        </div>
                        <span class="clearfix"></span>
                        
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
    </div>
</div>

<script>  		 
	    $(function () {  
	        
	        
            $('td input#qte').change(function(){
                $('td input#prix').val() = $('td input#prix').val() * $(this).val();
                console.log($(this).val());
                
            }).click().change();
	        
	        // add Article
            $('button#btn-add').click( function(){ 
               ligne="";
               
               var checkstr =  confirm('Vous Voulez Vraiment ajouter Cette Article !!');
                if(checkstr == true){
                    
                    $.ajax({
                       type:'POST',
                       dataType: "json",
                       url: "<?= base_url('index.php/Ventes/cmd') ?>",
                       data: { 
                           id_art: $("#article").val()
                       },
                       success: function(data){
                            console.log('Submission was successful.'); 
                            console.log(data);
                            row = data.art;
                            
                            ligne +="<tr>";
                            ligne +="<td> <input type='hidden' value='"+row.id_art+"' id='id_art'>"+row.article_art+" </td>";
                            ligne +="<td> "+row.desi_art+" </td>";
                            ligne +="<td><input class='form-control' type='number' value='1' id='qte'>  "+row.unite_art+" </td>";
                            ligne +="<td><input class='form-control' type='number' value='"+row.pv_art+"' id='prix'> </td>";
                            ligne +="</tr>";
                            
                            $('table#table-vente tbody').append(ligne);
                            
                            
                       },error: function (data) {
                            console.log('An error occurred.'); 
                            console.log(data.responseText);
                        }, 
                     });
                      return false; 
                }
            });
            
            // add tout qte mp
            $('button#t_cmd').click( function(){ 
               row = $('table#table_mp tbody'); 
               ligne="";
               
               var checkstr =  confirm('Vous Voulez Vraiment ajouter tout la Matiere !!');
               if(checkstr == true){
                   $(row).each(function () {
                       $('tr').each(function () {
                           if($(this).find("td #id_mp").val()){
                               
                                $.ajax({
                                   type:'POST',
                                   dataType: "json",
                                   url: "<?= base_url('index.php/ResponsableProduction/add_matiere') ?>",
                                   data: { 
                                       id_mp: $(this).find("td #id_mp").val(),
                                       id_of: 1,
                                       qte: $(this).find("td #t_qte").val()
                                   },
                                   success: function(data){
                                        console.log('Submission was successful.'); 
                                        console.log(data);
                                        $('table#data tbody').html('');
                                        $.each(data, function(index, row) {
                                            ligne +="<tr>";
                                            ligne +="<td><input type='hidden' value='"+row.id_article+"' id='id_stg'> "+row.designiation_article+" </td>";
                                            ligne +="<td>"+row.reference_article+" </td>";
                                            ligne +="<td> "+row.qte_matiere+" </td>";
                                            ligne +="</tr>";
                                        });
                                        $('table#data tbody').append(ligne);
                                        
                                   },error: function (data) {
                                        console.log('An error occurred.'); 
                                        console.log(data);
                                    }, 
                                 });
                                 
                                 return false;
                           }
                       });
                         
                      });
                      
                }
            });
        });     
       
    </script>
    