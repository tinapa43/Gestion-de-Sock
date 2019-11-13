
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
        <div class="col-md-12 panel panel-primary">
            <h1 class="panel-heading text-center"> Détail Stocks </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <div class="account-wall">
                <!--input type="text" class="form-control" id="searche" placeholder="Recherche ..."  /-->
                
                    <table id="data" class="table table-striped table-bordered display" >
                        <thead>
                            <tr>
                                <th class="hidden-xs">id</th>
                                <th>Dépot</th>
                                <th>Article</th>
                                <th class="hidden-xs">Désigniantion</th>
                                <th class="hidden-xs">Famills</th>
                                <th>Quantité Stocks</th>
                                <th>Prix Vente</th>
                                <!--th class="hidden-xs">Date</th-->
                                <th> <button class="btn btn-warning btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td class="hidden-xs"> <?= $row->id_art ?></td>
                                <td> <?= $row->depot ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td class="hidden-xs"> <?= $row->desi_art ?></td>
                                <td class="hidden-xs"> <?= $row->famill ?></td>
                                <td> <?= $row->qte_stock.' '.$row->unite_art ?></td>
                                <td> <?= $row->pv_art ?></td>
                                <!--td class="hidden-xs"> <?= $row->create_art ?></td-->
                                <td>
                                    <a href="<?= base_url('Stocks/maj_Stock').'/'.$row->id_stock ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
                                </td>
                            </tr>
                            
                            <?php endforeach; endif; ?>
                        </tbody>
                    </table>
                    
                    <span class="clearfix"></span>
   
            </div
            <div id="error" style="margin-top: 10px"></div>
        </div>
    </div>
</div>

