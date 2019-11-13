
        <section class="main">
            <div class="table-content container-fluid">
               	<div  class="row">
                    <div  class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body" style="padding: 5px;">
                                <a href="<?= base_url('cdr/'.str_replace(' ', '-',$_SESSION['username'])) ?>" style="width: 142px;" class="btn btn-info" > Précédent </a>
                            </div>
                        </div>
                    </div>
                
                    <div  class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                		        <div class="preview col-md-12" style="background-color:  white;border-radius: 5px;margin-bottom: 20px;">
                                    <h2 style="margin-left: 30px;" >List des Facturez </h2>
                                </div>
                            		<div class="col-md-12">
                                        <hr>
                                	        <table class="table table-list-search" id="example"  >
                                                <thead>
                                                    <tr>
                                                        <th><i>ID</i></th>
                                                        <th><i>Choffeur</i></th>
                                                        <th><i>Mat.Camion</i></th>
                                                        <th><i>Date</i></th>
                                                        <th><i>Action</i></th> 
                                                    </tr> 
                                                </thead>
                                                <tbody>
                                                  
                                                    <?php if($fact): foreach($fact as $row): ?>
                                                            <tr>
                                                                <td> <?= $row->id_ligne ?>    </td>
                                                                <td> <i class="fas fa-cube"></i> <?= $row->nom_ch ?> </td>
                                                                <td> <?= $row->matricule_ligne ?> </td>
                                                                <td> <?= $row->create_ligne ?></td>
                                                                
                                                                <?php  if($_SESSION['username'] == 'Magasinier'){ ?>
                                                                <td> 
                                                                     <a href="<?= base_url('cdr/Magasinier/detail_facture/'.$row->id_ligne) ?>" style="cursor: pointer;" class="btn btn-sm btn-success"> Detail </a> 
                                                                </td>
                                                                <?php } ?>
                                                                
                                                            </tr>
                                                    <?php  endforeach; endif; ?>
                                                    
                                                </tbody>
                                            </table>   
                        		</div>
                        	</div>
                        </div>
            		</div>
            	</div>
            </div>
        </section>
      