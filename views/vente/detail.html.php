<div class="container mt-5">
    <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </div>
    </div>
</div>

<div class="row">
        <div class="col-lg-4 pb-5  mt-4">
            <!-- Account Sidebar-->
            <div class="author-card pb-3">
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Daniel Adams">
                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">Daniel Adams</h5><span class="author-card-position">Joined February 06, 2017</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush ">
                    <li class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center ">
                            <div><i class="fe-icon-shopping-bag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">Orders List</div>
                            </div><span class="badge badge-secondary">6</span>
                        </div>
                    </li>
                    <li class="list-group-item " href="#"><i class="fe-icon-user text-muted"></i>Profile Settings</li>
                    <li class="list-group-item" href="#"><i class="fe-icon-map-pin text-muted"></i>Addresses</li>
                    <li class="list-group-item" href="https://www.bootdey.com/snippets/view/bs4-wishlist-profile-page" target="__blank">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">My Wishlist</div>
                            </div><span class="badge badge-secondary">3</span>
                        </div>
                    </li>
                    <li class="list-group-item" href="https://www.bootdey.com/snippets/view/bs4-account-tickets" target="__blank">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-tag mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">My Tickets</div>
                            </div><span class="badge badge-secondary">4</span>
                        </div>
                    </li>
                </nav>
            </div>
        </div>
        <!-- Profile Settings-->
        <div class="col-lg-8 pb-5 card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive ">
                 <table class="table table-bordered" id="saveProductionTable" width="100%" cellspacing="0">
                 <thead>
                         <tr>
                             <th>Libelle</th>
                             <th>Type</th> 
                             <th>Quantite </th>          
                          </tr>
                    </thead>
                                    
                    <tbody>
                        <?php if(0==1): ?>
                        <?php  foreach($articlesSelectionner as $articleSelectionner): ?>
                            <tr>
                                <td>
                                    <?= $articleSelectionner[1]->getLibelle() ?>
                                </td>
                                <td>
                                    <?= $articleSelectionner[1]->getType()=="articleConf"? "Article de Confection" : "Article de Vente" ?>
                                </td>
                                <td>
                                    <?= $articleSelectionner[0] ?>
                                </td>
                            </tr>
                        <?php endforeach ?> 
                        <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>       
        </div>
    </div>
</div>