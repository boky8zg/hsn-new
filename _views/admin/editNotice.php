<h1 class="page-header">Uredi obavijest</h1>

<div class="panel panel-default">
    <div class="panel-heading">Uređivanje obavijesti <a href="/admin/obavijesti/" class="btn btn-danger btn-xs pull-right">Otkaži</a></div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="//{{root}}/admin/obavijest/update/">
            <input type="hidden" name="IDNotice" value="{{IDNotice}}" />
            
            <div class="form-group">
                <label for="Title" class="col-md-2 control-label">Naslov:</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="Title" name="Title" placeholder="Naslov" value="{{Title}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="Text" class="col-md-2 control-label">Tekst:</label>
                <div class="col-md-10">
                    <textarea class="richedit form-control" id="Text" name="Text" placeholder="Tekst..." rows="20">{{Text}}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="IsInGallery"<?php if ($array['IsPinned'] == '1') echo ' checked'; ?> /> Zakači na vrh
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