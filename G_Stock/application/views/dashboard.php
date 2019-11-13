<div class="col-md-12">
                <div class="panel panel-info">
                  <div class="panel-heading" >
                    <h3 class="panel-title">My App</h3>
                  </div>
                  <div class="panel-body">
                   <div class="col-md-3">
                     <a href="<?= base_url('Achats/list_achats') ?>">
                      <div class="well dash-box">
                       <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 1</h2>
                       <h4>Achats</h4>
                     </div>
                    </a>
                   </div>
                   <div class="col-md-3">
                     <a href="<?= base_url('Ventes/list_ventes') ?>">
                       <div class="well dash-box">
                         <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 2</h2>
                         <h4>Ventes</h4>
                       </div>
                      </a>
                   </div>
                   <div class="col-md-3">
                    <a href="<?= base_url('Achats/list_reglement') ?>">
                     <div class="well dash-box">
                       <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>3</h2>
                       <h4>Reglements</h4>
                     </div>
                   </div>
                   <div class="col-md-3">
                     <a href="<?= base_url('Stocks/list_stock') ?>">
                     <div class="well dash-box">
                       <h2><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> 4</h2>
                       <h4>Stocks</h4>
                     </div>
                     </a>
                   </div>
                  </div>
                </div>
                <!--Latest User-->
                <div class="panel panel-danger">
                  <div class="panel-heading" >
                    <h3 class="panel-title">Alert Stocks</h3>
                  </div>
                  <div class="panel-body filterable">
                    <table id="data" class="table table-striped table-hover">
                        <thead>
                            <tr class="filters">
                                <th><input type="text" class="form-control" placeholder="ID" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Article" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Désigniantion" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Quantité Stocks" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Prix Vente" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Date" disabled></th>
                                <th> <button class="btn btn-warning btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button> </th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td class="hidden-xs"> <?= $row->desi_art ?></td>
                                <td> <?= $row->qte_mag ?></td>
                                <td> <?= $row->pv_art ?></td>
                                <td class="hidden-xs"> <?= $row->create_art ?></td>
                                <td>
                                    <a href="<?= base_url('Stocks/MAJ_Article').'/'.$row->id_art ?>" class="btn btn-sm btn-success btn-block" >  M.A.J</a>
                                </td>
                            </tr>
                            
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                
                  </div>
                </div>
              </div>
        
