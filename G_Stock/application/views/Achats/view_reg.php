
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
            <h1 class="panel-heading text-center"> Lits Achats d'Articles </h1>
            <hr>
            <div class="account-wall">
                <input type="text" class="form-control" id="searche" placeholder="Recherche ..." title="Type in a name">
                <form class="form-signin" method="POST" action="<?php echo base_url() ?>">
                    <table id="data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Articles</th>
                                <th>FRS</th>
                                <th>Payement</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($data): foreach($data as $row):  ?>
                            <tr>
                                <td> <?= $row->id_art ?></td>
                                <td> <?= $row->article_art  ?></td>
                                <td> <?= $row->nom_frs ?></td>
                                <td> <?= $row->prix ?></td>
                                <td> <?= $row->type_reg ?></td>
                                <td>
                                    <a href="<?= base_url('Achats/detail_reglement').'/'.$row->id_achat ?>" class="btn btn-sm btn-info btn-block" >  Detail</a>
                                </td>
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