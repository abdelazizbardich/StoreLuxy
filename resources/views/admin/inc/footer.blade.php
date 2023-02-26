
                    <footer><span class="text-center" style="display: inline-block;">Merci d'utiliser notre panneau d'administration d'e-commerce (COD). Créé par&nbsp;<a href="https://webiframe.com/" target="_blank" style="color: var(--color-orenge);font-weight: bold;">Webiframe</a> </span>
                        <span
                            style="display: inline-block;float: right;">1.01</span>
                            <div id="golbal-fixed-items" style="width: 0px;height: 0px;">
                                <div id="global-fixed-overlay"></div>
                                <div id="instant-medias-chose-and-upload" style="padding: 15px;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col" style="padding: 0;position: relative;">
                                                <div>
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" href="#tab-1">Ajouter des médias</a></li>
                                                        <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" href="#tab-2">Médiathèque</a></li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane" role="tabpanel" id="tab-1" style="padding: 20vh 15px;">
                                                            <form class="uploadMedias" id="fixed-instent-uploademedia" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <div class="form-group text-center">
                                                                    <p style="font-size: 19px;line-height: 26px;">Déposer des fichiers à télécharger<br>ou</p>
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <button class="btn btn-primary fileSelect" type="button" style="font-size: 19px;">Sélectionnez les fichiers</button>
                                                                    <input type="file" class="filesInput" multiple="" name="files[]" style="font-size: 19px;"  hidden />
                                                                </div>
                                                                <div class="form-group text-center">
                                                                    <p class="text-info" style="font-size: 14px;line-height: 26px;">Taille maximale du fichier de téléchargement: 80 Mo.</p>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane active" role="tabpanel" id="tab-2">
                                                            <div class="header-form">
                                                                <!-- <form style="padding: 10px 0px;" >
                                                                    <div class="form-row" style="margin: 0;">
                                                                        <div class="col-auto" style="padding-left: 0;"><select class="form-control"><option value="14">Tous les médias</option></select></div>
                                                                        <div class="col-auto" style="padding-left: 0;"><select class="form-control"><option value="14">Toutes les dates</option></select></div>
                                                                        <div class="col text-right" style="padding-left: 0;">
                                                                            <div style="width: fit-content;margin-right: 0;margin-left: auto;">
                                                                                <ul class="list-inline">
                                                                                    <li class="list-inline-item"><label style="display: inline-block;margin: 0;padding: 0;font-size: 11px;line-height: 15px;">Chercher:</label></li>
                                                                                    <li class="list-inline-item"><input class="form-control" type="search"></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form> -->
                                                            </div>
                                                            <div style="height: 83%;">
                                                                <div class="row" style="margin: 0;height: 100%;">
                                                                    <div class="col" style="overflow-y: auto;height: 100%;">
                                                                        <ul class="list-inline medias-list">
                                                                            <!-- ---------------- -->
                                                                        </ul>
                                                                    </div>
                                                                    <div class="col-12" >
                                                                        <input type="text" id="media-grid-selected-item-id" hidden />
                                                                        <input type="text" id="media-grid-selected-item-file" hidden />
                                                                    <div class="form-group text-right chose-selected-media"><button class="btn btn-primary" type="button">Choisir</button></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: rgb(0,0,0);background: none;box-shadow: none;"><i class="fa fa-close"></i></button></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="medias-item-detalis" style="padding: 15px;">
                                    <div class="container-fluid">
                                        <div style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 25px;">
                                            <p style="font-size: 26px;line-height: 35px;font-weight: bold;margin: 5px 0px;">Détails du pièce jointes</p>
                                        </div>
                                        <div class="row">
                                            <div class="col" style="padding: 0;position: relative;"><button class="btn btn-primary close" type="button" style="top: 0;right: 0;position: absolute;color: rgb(0,0,0);background: none;box-shadow: none;"><i class="fa fa-close"></i></button>
                                                <div>
                                                    <div class="row align-items-center" style="margin: 0;height: 100%;">
                                                        <div class="col text-center" style="overflow-y: auto;height: 100%;"><img id="item-image"class="img-fluid" src="/assets/admin/img/product-img%20(2).jpg" style="width: 340px;"></div>
                                                        <div class="col-4" style="border-left: 1px solid var(--color-orenge);background-color: var(--color-off-white);padding: 15px;">
                                                            <p style="font-size: 15px;line-height: 19px;"><strong>Nom de fichier: </strong><span id="item-title"> jerry-reinsdorf-bulls-couldnt-have-won-1999-championship-because-of-michael-jordans-finger-injury.jpg</span><br>
                                                            <strong>Type de fichier: </strong><span id="item-type">image/jpeg</span><br>
                                                            <strong>Ajouté à: </strong><span id="item-time">May 19, 2020</span><br>
                                                                <strong>Taille du fichier: </strong><span id="item-size">177</span> KB<br>
                                                                <strong>Dimensions: </strong><span id="item-dimensions">1200 by 675 pixels</span></p>
                                                            <hr>
                                                            <form class="media-file-form" action="/admin/medias/modifier" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('POST')
                                                                <input type="text" value="" id="item-id" name="id" hidden>
                                                                <div class="form-group"><label>Texte alternatif:</label><input name="altTitle" id="item-alt" class="form-control" type="text"></div>
                                                                <div class="form-group"><label>Titre:</label><input name="title" id="item-title-2" class="form-control" type="text"></div>
                                                                <div class="form-group"><label>Description:</label><textarea name="description" id="item-description" class="form-control"></textarea></div>
                                                                <div class="form-group"><label>Copier le lien:</label><input id="item-link" class="form-control" type="text" readonly="true"></div>
                                                                <div class="form-group text-right"><button class="btn btn-primary" type="submit">Enregistrer</button></div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><button class="btn btn-primary close" type="button" style="top: 5px;right: 5px;position: absolute;color: rgb(0,0,0);background: none;box-shadow: none;"><i class="fa fa-close"></i></button></div>
                                <div id="fixed-order-detalis"
                                    style="padding: 15px;">
                                    <div class="container-fluid">
                                        <div style="border-bottom: 1px solid var(--color-orenge);margin-bottom: 25px;padding-right: 35px;">
                                            <ul class="list-inline">
                                                <li class="list-inline-item" style="font-size: 26px;line-height: 35px;font-weight: bold;margin: 5px 0px;">Commonde #<span id="fixed-order-code">5434</span></li>
                                                <li class="list-inline-item" style="float: right;">
                                                    <button class="btn btn-dark done hidden" type="button" >Terminé</button>
                                                    <button class="btn btn-success notDon hidden" type="button" >En cours</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col" style="padding: 0;position: relative;">
                                                <div>
                                                    <div class="row no-gutters align-items-center" style="height: 100%;">
                                                        <div class="col" style="background-color: var(--color-off-white);padding: 15px;">
                                                            <p style="font-size: 26px;line-height: 35px;font-weight: bold;">Détails de la facturation:</p>
                                                            <p style="font-size: 15px;line-height: 19px;"><span id="fixed-order-name">abdelaziz bardich</span><br><span id="fixed-order-adress">N°38 Quartier Tafouket Ait ourir</span><br><span id="fixed-order-city">Marrakech</span><br><br><strong>Téléphone : </strong><span id="fixed-order-phone">0603768705</span></p>
                                                            <hr>
                                                            <div style="overflow-y: auto;height: 35vh;">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Produit</th>
                                                                                <th>Quantité</th>
                                                                                <!-- <th>Tax</th>
                                                                                <th>Livraison</th> -->
                                                                                <th>Total</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody style="height: 30vh;" id="fixed-order-products">
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="text-right"><a class="btn btn-info" role="button" id="fixed-order-link">Modifier</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><button class="btn btn-primary close" type="button" style="top: 5px;right: 5px;position: absolute;color: rgb(0,0,0);background: none;box-shadow: none;"><i class="fa fa-close"></i></button></div>
                            </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="/assets/admin/js/chart.js"></script>
    <script src="/assets/admin/js/datatables.min.js"></script>
    <script src="/assets/admin/js/pdfmake.min.js"></script>
    <script src="/assets/admin/js/vfs_fonts.js"></script>
    <script src="/assets/admin/js/main.js"></script>
    <script src="/assets/admin/js/functions.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script type="text/javascript" src="/assets/admin/js/datetimepicker/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="/assets/admin/js/datetimepicker/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
</body>

</html>