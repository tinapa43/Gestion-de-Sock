
<style>
    .invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>
                            
<div class="col-md-8">
    <div class="group-form">
        <select id="id_achat" class="form-control">
            <option>List FRS :</option>
            <?php if($data): foreach($data as $row):  ?>
            <option value="<?= $row->id_achat ?>"> <?= $row->id_achat.' | '.$row->nom_frs ?></option>
            <?php endforeach; endif; ?>
        </select>
    </div>
</div>
<hr>
<div class="col-md-8" style="background-color:  white;border:  1px solid gray;">
    <div class="row">
        <div class="col-xs-12">
        	<div class="invoice-title">
    			<h2>Facture d'achat</h2><h3 class="pull-right" id="ref">Commande N°: 0000</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Facturé à :</strong><br>
    				        <span id="">Sté</span><br>
    				        <span id="">0600 00 00 00</span><br>
    				        <span id="">Adress ...</span>
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Expédiés à :</strong><br>
    				        <span id="frs"></span><br>
    				        <span id="tel"></span><br>
    				        <span id="adress"></span>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<br>
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Commande Date:</strong><br>
    					<span id="date"></span><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Récapitulatif de la commande</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table id="data" class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>Articles</strong></td>
        							<td class="text-center"><strong>Qté</strong></td>
        							<td class="text-center"><strong>Prix</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

<script>  		 
	    $(function () {  
	        
	        // Get list Achats
            $('#id_achat').change( function(){ 
               var id = this.value;
               var row = "";
                 $.ajax({
                   type:'POST',
                   dataType: "json",
                   url: "<?= base_url('index.php/Achats/list_fact') ?>",
                   data: { id_achat: id},
                   success: function(data){
                        console.log('Submission was successful.'); 
                        console.log(data);
                        var frs = data.frs;
                        var achats = data.achats;
                        
                        console.log(frs);
                        console.log(achats);
                        
                        $('#frs').text(frs.nom_frs);
                        $('#tel').text(frs.tel_frs);
                        $('#adress').text(frs.id_frs);
                        $('#ref').text('Commande N°:'+frs.id_achat);
                        $('#date').text(frs.create_achat);
                        
                        $('table#data tbody').html('');
                        
                         $.each(achats, function(index, element) {
                             row += '<tr>';
                             row += '<td> '+ element.desi_art +'</td>';
                             row += '<td> '+ element.qte_achat +'</td>';
                             row += '<td> '+ element.pv_art +'</td>';
                             row += '</tr>';
                        }); 
                         $('table#data tbody').append(row);
                        /*
                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
						<tr>
							<td>Crosin</td>
							<td class="text-center">100 mg</td>
							<td class="text-center">10</td>
							<td class="text-right">30 INR</td>
						</tr>
						<tr>
							<td class="thick-line"></td>
							<td class="thick-line"></td>
							<td class="thick-line text-center"><strong>Subtotal</strong></td>
							<td class="thick-line text-right">80 INR</td>
						</tr>
						<tr>
							<td class="no-line"></td>
							<td class="no-line"></td>
							<td class="no-line text-center"><strong>Shipping</strong></td>
							<td class="no-line text-right">15 INR</td>
						</tr>
						<tr>
							<td class="no-line"></td>
							<td class="no-line"></td>
							<td class="no-line text-center"><strong>Total</strong></td>
							<td class="no-line text-right">95 INR</td>
						</tr>
                        */
                        if(data == null){
                            $('#article').html('');
                            $('#article').append('<option disabled>Vide</option>');
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