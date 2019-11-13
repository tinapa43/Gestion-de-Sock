
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
            <h1 class="panel-heading text-center">Lits d'Articles </h1>
            <?php if(isset($msg)) { echo $msg; }; ?>
            <div class="col-md-12">
                <?= pagination('Stocks/list_article',12,1) ?> 
            </div> 
            <div class="account-wall filterable">
                <!--input type="text" class="form-control" id="searche" class="form-control" placeholder="Recherche ..." title="Type in a name"-->

                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr class="filters">
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="ID" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Article" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Désigniantion" disabled></th>
                                <th class="hidden-xs"><input type="text" class="form-control" placeholder="Famille" disabled></th>
                                <th><input type="text" class="form-control" placeholder="Prix Vente" disabled></th>
                                <!--th ><input type="text" class="form-control" placeholder="Date" disabled></th-->
                                <th> <button class="btn btn-warning btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art ?></td>
                                <td class="hidden-xs"> <?= $row->desi_art ?></td>
                                <td class="hidden-xs"> <?= $row->famill ?></td>
                                <td class="text-right"> <?= $row->pv_art ?> DH</td>
                                <!--td> <?= $row->create_art ?></td-->
                                <td>
                                    <a href="<?= base_url('Stocks/MAJ_Article/'.$row->id_art) ?>" class="btn btn-sm btn-danger btn-block" >  M.A.J</a>
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