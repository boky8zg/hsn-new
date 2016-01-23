<div class="content">
    <div class="header">
        <div class="col col-1">
            <h1>Obavijesti</h1>
        </div>
    </div>

    <div class="main" >
        <div class="notices">
<?php /*
<?php foreach ($obavijesti as $obavijest): ?>
            <div class="notice">
                <h3 class="notice-title"><?php echo $obavijest['Naslov']; ?></h3>
                <div class="notice-body">
                    <p>
                        <?php echo $obavijest['Tekst']; ?>
                    </p>     
                </div>
            </div>
<?php endforeach; ?>
*/ ?>
            <?php
                if ($array['pinned']):
                foreach($array['pinned'] as $notice):
            ?>
                <div class="notice">
                    <h3 class="notice-title"><?php echo $notice['Title']; ?></h3>
                    <div class="notice-body">
                         <?php echo $notice['Text']; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>

            <?php
                if ($array['unpinned']):
                foreach($array['unpinned'] as $notice):
            ?>
                <div class="notice">
                    <h3 class="notice-title"><?php echo $notice['Title']; ?></h3>
                    <div class="notice-body">
                         <?php echo $notice['Text']; ?>
                    </div>
                </div>
            <?php endforeach; endif; ?>
        </div>

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