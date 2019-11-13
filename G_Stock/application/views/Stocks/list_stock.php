
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
        <div class="col-md-12 panel panel-info">
            <h1 class="panel-heading text-center">Lits Stocks </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <div class="account-wall filterable">
                <!--input type="text" class="form-control" id="searche" placeholder="Recherche ..."  /-->
                
                    <table id="data" class="table table-striped table-bordered display" >
                        <thead>
                            <tr class="filters">
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="ID" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Article" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Désigniantion" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Famill" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Quantité Stocks" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Prix Vente" disabled></th>
                                <th> <button class="btn btn-warning btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td class="hidden-xs"> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td class="hidden-xs"> <?= $row->desi_art ?></td>
                                <td class="hidden-xs"> <?= $row->famill ?></td>
                                <td class="text-right"> <?= $row->qte_stock_t.' '.$row->unite_art ?></td>
                                <td class="text-right"> <?= $row->pv_art ?> dh</td>
                                <!--td class="hidden-xs"> <?= $row->create_art ?></td-->
                                <td>
                                    <a href="<?= base_url('Stocks/Detail_Stock').'/'.$row->id_art ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
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

