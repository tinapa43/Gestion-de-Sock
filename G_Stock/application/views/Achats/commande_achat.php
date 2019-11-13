
<script>
    $(document).ready(function() {
        $('.search').select2();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12 panel panel-danger">
            <h1 class="panel-heading text-center"> Achats Article </h1>
            <hr>
            <div class="col-sm-12 col-md-12">
                <?php if(isset($msg)) { echo $msg; }; ?>
                <div class="account-wall">
                        
                        <div class="col-md-8 col-md-offset-2">
                            <div class="col-md-3 form-group">
                                <span>Numeros</span>
                                <input type="text" class="form-control" id="num" name="num" placeholder="cmd001">
                                <?php echo form_error('num'); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Remise</span>
                                <input type="number" class="form-control" name="remise" id="remise" value="0" >
                                <?php echo form_error('remise'); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>TVA</span>
                                <input type="number" class="form-control" name="tva" id="tva" value="0" >
                                <?php echo form_error('tva'); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Mode Payement</span>
                                <select type="text" class="form-control search" id="pay" name="pay" >
                                    <option value="" >Espece</option>
                                    <option value="" >Chèque</option>
                                    <option value="" >Virement Banquaire</option>
                                    <option value="" >Carte Banquaire</option>
                                </select>
                                <?php echo form_error('pay'); ?>
                            </div>
                        </div>
                        
                        <div class="col-md-8 col-md-offset-2">
                            <div class="col-md-3 form-group">
                                <span>Fournisseur</span>
                                <select type="text" class="form-control search" id="frs" name="frs" >
                                    <?php if($frs): foreach($frs as $row):  ?>
                                    <option value="<?= $row->id_frs ?>"><?= $row->nom_frs ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <a href="<?= base_url('Config/frs_clt') ?>" class="btn btn-default btn-xs pull-right" >Nouveau</a>
                                <?php echo form_error('frs'); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Depots</span>
                                <select type="text" class="form-control search" id="depot" name="depot" >
                                    <?php if($depot): foreach($depot as $row):  ?>
                                    <option value="<?= $row->id_depot ?>"><?= $row->id_depot.' - '.$row->depot ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <a href="<?= base_url('Depots/add_depot') ?>" class="btn btn-default btn-xs pull-right" >Nouveau</a>
                                <?php echo form_error('depot'); ?>
                            </div>
                            <div class="col-md-3 form-group">
                                <span>Date</span>
                                <input type="date" class="form-control" id="date" name="date" >
                                <?php echo form_error('date'); ?>
                            </div>
                        </div>
       
                        <span class="clearfix"></span>
                </div>
                <div id="error" style="margin-top: 10px"></div>
            </div>
        </div>
        
        <?= ''//base_url('index.php/Achats/add_achat') ?>
        
        <script>
            
            // add Article
    	    $(function () {     
                $('#Add_art').click( function(){ 
    		        row = "";
                    id = $('select#art_serach option:selected').val() ;
                    url = "<?= base_url('index.php/Articles/get_art') ?>/"+id;
                    remise = 0;
                    tva =0;
                    ht=0;
                    ttc=0;
                    
                     remise = $('#remise').val() / 100;
                     tva = $('#tva').val() / 100;
                     $.ajax({
                       type:'POST',
                       dataType: "json",
                       url: url,
                       data: {  },
                       success: function(data){
                            console.log('Submission was successful.');  
                            console.log(data);
                            
                            $.each(data.info, function(index, ligne) {
                                 
                                if(remise > 0 ){ 
                                    remise = remise * ligne['pv_art'] ;
                                }else {
                                    remise = 0;
                                }
                                
                                ht = ligne['pv_art'] - remise ;
                                tva = tva * ht;
                                ttc =ht + tva ;
                                 
                                 row += '<tr>';
                                  
                                 row += '<td> <input type="hidden" id="id_art" value="'+ ligne['id_art'] +'">'+ ligne['id_art'] +'</td>';
                                 row += '<td>'+ ligne['desi_art'] +'</td>';
                                 row += '<td> <input type="number" id="qte_t" onchange="edite(this)" name="qte_t" value="1" class="form-control" >'+ ligne['unite_art'] +' </td>';
                                 row += '<td> <input type="hidden" id="ht_a" value="'+ ligne['pv_art'] +'"> '+ ligne['pv_art'] +'DH</td>';
                                 row += '<td> <input type="number" id="remise" name="remise" value="'+ $('#remise').val() +'" class="form-control" disabled> </td>';
                                 row += '<td> <input type="number" id="ht" name="ht" value="'+ ht +'" class="form-control" disabled>DH </td>';
                                 row += '<td> <input type="number" id="tva" name="tva" value="'+ $('#tva').val() +'" class="form-control" disabled> </td>';
                                 row += '<td> <input type="number" id="ttc" name="ttc" value="'+ ttc +'" class="form-control" disabled>DH </td>';
                                 row += '<td> <button class="btn btn-danger" onclick="Remove(this)" >X</button> </td>';
                                 row += '</tr>';
                            });
                            $('table tbody').append(row);
                            
                       },error: function (data) {
                            console.log('An error occurred.'); 
                            console.log(data);
                            
                        }, 
                     });
                     
                      return false; 
                });
            });
                
            
            function edite(qte){
                console.log('click');
                remise = 0;
                ht = 0;
                tva = 0;
                
                row = $(qte).closest('tr');
                ht = $(row).find('td input#ht_a').val() * qte.value;
                
                if($(row).find('td input#remise').val() > 0){
                    remise = ($(row).find('td input#remise').val() / 100);
                }else{
                    remise = 0;
                }
                
                remise = remise * ht;
                ht = ht - remise;
                tva = ht * 0.2;
                
                /*
                console.log('remise ' + remise);
                console.log(' - ht ' + ht);
                console.log(' - ttc ' + ttc);
                console.log(' - qte ' + qte.value);
                */
                
                $(row).find('td input#ht').val(ht);
                $(row).find('td input#ttc').val(ht + tva);
                
            }
            
            function Remove(row){
                $(row).closest('tr').remove();
            }
        </script>
    
        <div class="col-md-12 panel panel-info">
            <div class="account-wall">
                <h3 class="text-center">Articles</h3>
                <hr>
                <div class="col-md-4 form-group">
                    <select type="text" class="form-control search" id="art_serach" name="art_serach" >
                        <?php if($art): foreach($art as $row):  ?>
                        <option value="<?= $row->id_art ?>"><?= $row->id_art.' - '.$row->article_art.' - '.$row->desi_art ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    <a href="<?= base_url('Stocks/add_article') ?>" class="btn btn-default btn-xs pull-left" >Nouveau</a>
                </div>
                <div class="col-md-3 form-group">
                    <button id="Add_art" class="btn btn-info" >Ajouter</button>
                </div>
                
                
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Article</th>
                                <th>Qte</th>
                                <th>Prix Unit HT</th>
                                <th>Remise</th>
                                <th>Mt HT</th>
                                <th>TVA</th>
                                <th>Mt TTC</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
                <div clas="col-md-12">
                    <hr>
                    <button id="valide_fact" class="btn btn-success pull-right" >Valide</button>
                </div>
                
                
                <script>  		 
	    		     $( document ).ready(function() {   
	    		         $("#valide_fact").click(function () {
	    		             
	    		             frs = $("#frs option:selected").val();
	    		             depot = $("#depot option:selected" ).val();
	    		             num = $('input#num').val();
	    		             pay = $('#pay option:selected').val();
	    		             date = $('input#date').val();
	    		             id = 0;
	    		             
	    		            $.ajax({
                               type:'POST',
                               dataType: "json",
                               url: "<?= base_url('index.php/Achats/add_facture') ?>",
                               data: {
                                   frs:frs,
                                   depot:depot,
                                   pay:pay,
                                   num:num,
                                   date:date,
                               },
                               success: function(data){
                                    console.log('Submission was successful.');
                                    
                                    console.log(data.fact);
                                    id = data.fact['id'];
                                    console.log(id);
                                    
                                    //debut add article
                                    $("table tbody tr").each(function () {
                                        var id_art = $(this).find('td input#id_art').val();
                                        var remise = $(this).find('td input#remise').val();
                                        var tva = $(this).find('td input#tva').val();
                                        var ht = $(this).find('td input#ht').val();
                                        var ttc = $(this).find('td input#ttc').val();
                                        var qte_cmd =  $(this).find('td input#qte_t').val() ;
                                        
                                        $.ajax({
                                           type:'POST',
                                           dataType: "json",
                                           url: "<?= base_url('index.php/Achats/add_art_facture') ?>",
                                           data: {
                                               id_ligne:id,
                                               id_art:id_art,
                                               remise:remise,
                                               tva:tva,
                                               ht:ht,
                                               ttc:ttc,
                                               qte_cmd:qte_cmd
                                           },
                                           success: function(data){
                                                console.log('Submission was successful.'); 
                                                
                                           },error: function (data) {
                                                console.log('An error occurred.'); 
                                                console.log(data);
                                            }, 
                                        });
                                    });
                                    // fin add article
                                    
                                    alert('Bien Ajouter');
                                    $("table tbody").html('');
                                    
                               },error: function (data) {
                                    console.log('An error occurred.'); 
                                    console.log(data);
                                }, 
                            });
                            return false;
                               
                        });
                    });
                   
                </script>
                
                <span class="clearfix"></span>
            </div>
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>