<h1 class="page-header">Knjige</h1>

<div class="panel panel-default">
    <div class="panel-heading">Knjige <a href="/admin/knjiga/new/" class="btn btn-primary btn-xs pull-right">Dodaj knjigu</a></div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naslov</th>
                    <th>Podnaslov</th>
                    <th>Autori</th>
                    <th>Uredi</th>
                    <th>Obriši</th>
                </tr>
            </thead>

            <tbody>
                <?php starteach($array['books']); ?>
                <tr>
                    <td>{{IDBook}}</td>
                    <td>{{Title}}</td>
                    <td>{{Subtitle}}</td>
                    <td>Pero Perić</td>
                    <td><a href="/admin/knjiga/edit/{{IDBook}}/">Uredi</a></td>
                    <td><a href="/admin/knjiga/delete/{{IDBook}}/">Obriši</a></td>
                </tr>
                <?php endeach(); ?>
            </tbody>
        </table>

        <nav>
            <ul class="pagination">
                <li<?php if ($array['page'] == 1): ?> class="disabled"<?php endif; ?>>
                    <a href="<?php if ($array['page'] > 1): ?>/admin/knjige/<?php echo $array['page']-1; ?>/<?php endif; ?>" aria-label="Prethodna">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php for($i = 1; $i <= $array['pages']; $i++): ?>
                    <li<?php if ($i == $array['page']): ?> class="active"<?php endif; ?>><a href="<?php if ($i != $array['page']): ?>/admin/knjige/<?php echo $i; ?>/<?php endif; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>

                <li<?php if ($array['page'] == $array['pages']): ?> class="disabled"<?php endif; ?>>
                    <a href="<?php if ($array['page'] < $array['pages']): ?>/admin/knjige/<?php echo $array['page']+1; ?>/<?php endif; ?>" aria-label="Slijedeća">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>