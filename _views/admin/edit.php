<h1 class="page-header">Uredi knjigu</h1>

<div class="panel panel-default">
    <div class="panel-heading">Uređivanje knjige <a href="/admin/knjige/" class="btn btn-danger btn-xs pull-right">Otkaži</a></div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="//{{root}}/admin/knjiga/update/" enctype="multipart/form-data">
            <input type="hidden" name="IDBook" value="{{IDBook}}" />

            <div class="form-group categories">
                <label for="Categories" class="col-md-2 control-label">Kategorije:</label>
                <div class="col-md-10">
                    <select multiple class="form-control" name="Categories[]" placeholder="Kategorije (enter za unos nove)" data-role="tagsinput">
                        <?php starteach($array['categories']); ?>
                        <option value="{{Name}}">{{Name}}</option>
                        <?php endeach(); ?>
                    </select>
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
                    <select multiple class="form-control" name="Authors[]" placeholder="Autori (enter za unos nove)" data-role="tagsinput">
                        <?php starteach($array['authors']); ?>
                        <option value="{{Name}}">{{Name}}</option>
                        <?php endeach(); ?>
                    </select>
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
                    <input type="text" class="form-control" id="Title" name="Title" placeholder="Naslov" value="{{Title}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Subtitle" class="col-md-2 control-label">Podnaslov:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Subtitle" name="Subtitle" placeholder="Podnaslov" value="{{Subtitle}}" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="ShowSubtitle"<?php if ($array['ShowSubtitle'] == '1') echo ' checked'; ?> /> Prikaži podnaslov u bibliotekama
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="PublicationYear" class="col-md-2 control-label">Godina:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="PublicationYear" name="PublicationYear" placeholder="Godina" value="{{PublicationYear}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="ISBN" class="col-md-2 control-label">ISBN:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="ISBN" name="ISBN" placeholder="ISBN" value="{{ISBN}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Price" class="col-md-2 control-label">Cijena:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Price" name="Price" placeholder="Cijena (kn, za decimalni broj koristiti točku)" value="{{Price}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="DiscountPrice" class="col-md-2 control-label">Cijena (popust):</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="DiscountPrice" name="DiscountPrice" placeholder="Bez popusta (ako je prazno)" value="{{DiscountPrice}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Format" class="col-md-2 control-label">Format:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Format" name="Format" placeholder="Format stranica (cm)" value="{{Width}}x{{Height}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Binding" class="col-md-2 control-label">Uvez:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Binding" name="Binding" placeholder="Vrsta uveza" value="{{Binding}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Pages" class="col-md-2 control-label">Broj stranica:</label>
                <div class="col-md-10">
                    <input type="number" class="form-control" id="Pages" name="Pages" placeholder="Broj stranica" value="{{Pages}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Description" class="col-md-2 control-label">Opis:</label>
                <div class="col-md-10">
                    <textarea class="form-control" id="Description" name="Description" placeholder="Opis..." rows="10">{{Description}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="Cover" class="col-md-2 control-label">Korice:</label>
                <div class="col-md-10">
                    <input type="hidden" name="OldCover" value="{{Cover}}" />
                    <input type="file" class="form-control" id="Cover" name="Cover" />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="IsInGallery"<?php if ($array['IsInGallery'] == '1') echo ' checked'; ?> /> Prikaži u bibliotekama
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