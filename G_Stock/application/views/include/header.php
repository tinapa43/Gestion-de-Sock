
<!DOCTYPE html>
<html>
<head>
	<title>Zee Stocks</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/6.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/modern-business.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    
    
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
</head>
<body style="padding-top: 0;">
    
    <style>
        .filterable {
            margin-top: 15px;
        }
        .filterable .panel-heading .pull-right {
            margin-top: -20px;
        }
        .filterable .filters input[disabled] {
            background-color: transparent;
            border: none;
            cursor: auto;
            box-shadow: none;
            padding: 0;
            height: auto;
        }
        .filterable .filters input[disabled]::-webkit-input-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]::-moz-placeholder {
            color: #333;
        }
        .filterable .filters input[disabled]:-ms-input-placeholder {
            color: #333;
        }

    </style>
    <script>
           /*
        Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
        */
        $(document).ready(function(){
            $('.filterable .btn-filter').click(function(){
                var $panel = $(this).parents('.filterable'),
                $filters = $panel.find('.filters input'),
                $tbody = $panel.find('.table tbody');
                if ($filters.prop('disabled') == true) {
                    $filters.prop('disabled', false);
                    $filters.first().focus();
                } else {
                    $filters.val('').prop('disabled', true);
                    $tbody.find('.no-result').remove();
                    $tbody.find('tr').show();
                }
            });
        
            $('.filterable .filters input').keyup(function(e){
                /* Ignore tab key */
                var code = e.keyCode || e.which;
                if (code == '9') return;
                /* Useful DOM data and selectors */
                var $input = $(this),
                inputContent = $input.val().toLowerCase(),
                $panel = $input.parents('.filterable'),
                column = $panel.find('.filters th').index($input.parents('th')),
                $table = $panel.find('.table'),
                $rows = $table.find('tbody tr');
                /* Dirtiest filter function ever ;) */
                var $filteredRows = $rows.filter(function(){
                    var value = $(this).find('td').eq(column).text().toLowerCase();
                    return value.indexOf(inputContent) === -1;
                });
                /* Clean previous no-result if exist */
                $table.find('tbody .no-result').remove();
                /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                $rows.show();
                $filteredRows.hide();
                /* Prepend no-result row if all rows are filtered */
                if ($filteredRows.length === $rows.length) {
                    $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                }
            });
        });
    </script>
    
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span
                    class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= base_url() ?>">Zee Stocks</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
    			    
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-qrcode"></span>&nbsp Articles <span class="caret"></span> </a>
                        <ul class="dropdown-menu forAnimate" role="dropdown">
                            <li><a href="<?= base_url('Stocks/list_article') ?>"> List d'Articles </a></li>
                            <li><a href="<?= base_url('Stocks/add_article') ?>"> Nouveau Articles </a></li> 
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-th-large"> </span>&nbsp Stocks <span class="caret"></span> </a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="<?= base_url('Stocks/list_stock') ?>"> Voire Stocks </a></li>
                            <!--li><a href="<?= base_url('Stocks/load_stock') ?>"> Mise à jour Stock </a></li-->
                            <li><a href="<?= base_url('Stocks/rep_stock') ?>"> Repture Stocks </a></li>
                            <li><a href="<?= base_url('Stocks/historique_stock') ?>"> Historique du Stocks </a></li>
                            <li><a href="<?= '#'//base_url('') ?>"> Stocks  Mort</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-tasks"> </span>&nbsp Depots <span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="<?= base_url('Depots/list_depot') ?>"> Voire Depots </a></li>
                            <li><a href="<?= base_url('Depots/transfaire_depot') ?>"> Transfaire Stocks </a></li>
                            <li><a href="<?= base_url('Depots/add_depot') ?>"> Nouveau Depot </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-shopping-cart"> </span>&nbsp Achats <span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="<?= base_url('Achats/add_achat') ?>"> Commande </a></li>
                            <li><a href="<?= base_url('Achats/add_avoire_achat') ?>"> Avoire </a></li>
                            <li><a href="<?= base_url('Achats/add_bon_achat') ?>"> Bon de livraison </a></li>
                            <li><a href="<?= base_url('Achats/list_achats') ?>"> List Achats </a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-usd"> </span>&nbsp Ventes <span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="#"> Commande </a></li>
                            <li><a href="#"> Avoire </a></li>
                            <li><a href="#"> Bon de livraison </a></li>
                            <li><a href="#"> Devis </a></li>
                            <li><a href="#"> List Ventes </a></li>
                        </ul>
                    </li>
                     <!--li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-transfer"> </span>&nbsp Réglements <span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                           <li><a href="<?= base_url('Achats/list_reglement') ?>"> List Reglement </a></li>
                           <li><a href="<?= base_url('Achats/fact_reglement') ?>"> Facture </a></li>
                        </ul>
                    </li-->
                    
                    <li class="dropdown">
                        <a  href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span style="font-size:16px;" class="pull-left hidden-xs showopacity glyphicon glyphicon-pencil"> </span>&nbsp Config <span class="caret"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li><a href="<?= base_url('Config/frs_clt') ?>"> Fournisseur / Clients </a></li>
                            <li><a href="<?= base_url('Config/add_famill') ?>"> Famills d'Articles </a></li>
                            <li><a href="<?= base_url('Config/add_info') ?>"> Info Société </a></li>
                        </ul>
                    </li>
                </ul>
            <ul class="nav navbar-nav navbar-right">
                <!--li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-comment"></span>Chats <span class="label label-primary">42</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="label label-warning">7:00 AM</span>Hi :)</a></li>
                        <li><a href="#"><span class="label label-warning">8:00 AM</span>How are you?</a></li>
                        <li><a href="#"><span class="label label-warning">9:00 AM</span>What are you doing?</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="text-center">View All</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-envelope"></span>Inbox <span class="label label-info">32</span>
                </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="label label-warning">4:00 AM</span>Favourites Snippet</a></li>
                        <li><a href="#"><span class="label label-warning">4:30 AM</span>Email marketing</a></li>
                        <li><a href="#"><span class="label label-warning">5:00 AM</span>Subscriber focused email
                            design</a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="text-center">View All</a></li>
                    </ul>
                </li-->
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span
                    class="glyphicon glyphicon-user"></span>Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span>Profile</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url('Login/logout') ?>"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
