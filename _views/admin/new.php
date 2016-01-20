<h1 class="page-header">Dodaj knjigu</h1>

<div class="panel panel-default">
    <div class="panel-heading">Dodavanje knjige <a href="/admin/knjige/" class="btn btn-danger btn-xs pull-right">Otkaži</a></div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="//{{root}}/admin/knjiga/insert/" enctype="multipart/form-data">
            <div class="form-group categories">
                <label for="Categories" class="col-md-2 control-label">Kategorije:</label>
                <div class="col-md-10">
                    <select multiple class="form-control" name="Categories[]" placeholder="Kategorije (enter za unos nove)" data-role="tagsinput"></select>
                    <datalist id="CategoriesList">
                        <?php starteach($array['allCategories']); ?>
                        <option value="{{Name}}"></option>
                        <?php endeach(); ?>
                    </datalist>

                    <script>
                        $(function () {
                            $('.form-group.categories input[type="text"]').attr('list', 'CategoriesList').attr('id', 'Categories');
                        });
                    </script>
                </div>
            </div>

            <div class="form-group authors">
                <label for="Authors" class="col-md-2 control-label">Autori:</label>
                <div class="col-md-10">
                    <select multiple class="form-control" name="Authors[]" placeholder="Autori (enter za unos nove)" data-role="tagsinput"></select>
                    <datalist id="AuthorList">
                        <?php starteach($array['allAuthors']); ?>
                        <option value="{{Name}}"></option>
                        <?php endeach(); ?>
                    </datalist>

                    <script>
                        $(function () {
                            $('.form-group.authors input[type="text"]').attr('list', 'AuthorList').attr('id', 'Authors');
                        });
                    </script>
                </div>
            </div>

            <div class="form-group">
                <label for="Title" class="col-md-2 control-label">Naslov:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Title" name="Title" placeholder="Naslov" />
                </div>
            </div>

            <div class="form-group">
                <label for="Subtitle" class="col-md-2 control-label">Podnaslov:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Subtitle" name="Subtitle" placeholder="Podnaslov" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="ShowSubtitle" /> Prikaži podnaslov u bibliotekama
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="PublicationYear" class="col-md-2 control-label">Godina:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="PublicationYear" name="PublicationYear" placeholder="Godina" />
                </div>
            </div>

            <div class="form-group">
                <label for="ISBN" class="col-md-2 control-label">ISBN:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="ISBN" name="ISBN" placeholder="ISBN" />
                </div>
            </div>

            <div class="form-group">
                <label for="Price" class="col-md-2 control-label">Cijena:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Price" name="Price" placeholder="Cijena (kn, za decimalni broj koristiti točku)" />
                </div>
            </div>

            <div class="form-group">
                <label for="DiscountPrice" class="col-md-2 control-label">Cijena (popust):</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="DiscountPrice" name="DiscountPrice" placeholder="Bez popusta (ako je prazno)" />
                </div>
            </div>

            <div class="form-group">
                <label for="Format" class="col-md-2 control-label">Format:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Format" name="Format" placeholder="Format stranica (###x###)" />
                </div>
            </div>

            <div class="form-group">
                <label for="Binding" class="col-md-2 control-label">Uvez:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Binding" name="Binding" placeholder="Vrsta uveza" />
                </div>
            </div>

            <div class="form-group">
                <label for="Pages" class="col-md-2 control-label">Broj stranica:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="Pages" name="Pages" placeholder="Broj stranica" />
                </div>
            </div>

            <div class="form-group">
                <label for="Description" class="col-md-2 control-label">Opis:</label>
                <div class="col-md-10">
                    <textarea class="form-control" id="Description" name="Description" placeholder="Opis..." rows="10"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="Cover" class="col-md-2 control-label">Korice:</label>
                <div class="col-md-10">
                    <input type="file" class="form-control" id="Cover" name="Cover" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="IsInGallery" checked /> Prikaži u bibliotekama
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn btn-primary">Spremi</button>
                </div>
            </div>
        </form>
    </div>
</div>